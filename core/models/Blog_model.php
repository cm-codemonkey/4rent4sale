<?php defined('_EXEC') or die;

class Blog_model extends Model
{
	private $pager;
	private $articleContent;
	private $lang;

	public function __construct()
	{
		parent::__construct();
		$this->pager = new Pager();
		$this->lang = $_COOKIE['lang'];
	}

	public function getMetadata()
	{
		$response = $this->database->select('metadata', [
			'description',
			'keywords'
		], [
			'ORDER' => 'id_metadata DESC',
			'LIMIT' => 1
		]);

		if ( isset($response[0]) && !empty($response[0]) )
			return $response[0];
		else
			return null;
	}

	public function getEntries()
    {
		$query =
			"SELECT vkye_blog_entries.id_entry,
					vkye_blog_entries.title,
					vkye_blog_entries.date,
					vkye_blog_entries.description,
					vkye_blog_entries.cover,
					vkye_blog_entries.id_website_user,
					vkye_website_users.username,
					vkye_properties_locations.title AS title_location

			FROM	vkye_blog_entries,
					vkye_website_users,
					vkye_properties_locations

			WHERE	vkye_blog_entries.popular_blog IS NULL
			AND		vkye_blog_entries.id_location = vkye_properties_locations.id_location

			ORDER BY vkye_blog_entries.date DESC";

		$page = (isset($_GET['page']) AND !empty($_GET['page']) AND is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
		$limit = 20;

		return $this->pager->pager($query, $page, $limit);
    }

	public function getPopularEntries()
    {
		$query =
			"SELECT vkye_blog_entries.id_entry,
					vkye_blog_entries.title,
					vkye_blog_entries.date,
					vkye_blog_entries.description,
					vkye_blog_entries.cover,
					vkye_blog_entries.id_website_user,
					vkye_website_users.username,
					vkye_properties_locations.title AS title_location

			FROM	vkye_blog_entries,
					vkye_website_users,
					vkye_properties_locations

			WHERE	vkye_blog_entries.popular_blog <= 100
			AND		vkye_blog_entries.id_location = vkye_properties_locations.id_location

			ORDER BY vkye_blog_entries.popular_blog ASC";

		$page = (isset($_GET['page']) AND !empty($_GET['page']) AND is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
		$limit = 100;

		return $this->pager->pager($query, $page, $limit);
    }

	public function shortenText($text, $length)
	{
		$shortenText = substr(strip_tags($text), 0, $length);

		if (strlen(strip_tags($text)) > $length)
			$shortenText .= '...';

		return $shortenText;
    }

	public function getEntriesHtml()
	{
		$pager	= $this->getEntries();
		$pagerP	= $this->getPopularEntries();
		$html	= '';

		$clear = 1;

		foreach($pagerP as $article)
		{
			$description	= $this->shortenText(json_decode(html_entity_decode($article['description']), true)[$this->lang], 250);
			$title	= $this->shortenText(json_decode($article['title'], true)[$this->lang], 22);

			$html .=
			'<article class="span4">
				<figure>
					<img src="{$path.images}' . $article['cover'] . '" alt="" />
				</figure>
				<main>
					<h6>' . $title . '</h6>
					<p class="location">@' . $article['username'] . ' / <i class="material-icons">location_on</i>'. $article['title_location'] .'</p>
					<p class="description_blog">' . nl2br(trim(html_entity_decode($description), " \t\n\r\0\x0B\xC2\xA0")) . '</p>
				</main>
				<div class="clear"></div>
				<a href="/blog/view/' . $article['id_entry'] . '/' . strtolower(str_replace(' ', '', $title)) . '">{$lang.btn_read_more}</a>
			</article>' . (($clear == 3) ? '<div class="clear"></div>' : '');

			if ($clear == 3)
				$clear = 1;
			else
				$clear = $clear + 1;
		}

		foreach($pager as $article)
		{
			$description	= $this->shortenText(json_decode(html_entity_decode($article['description']), true)[$this->lang], 250);
			$title	= $this->shortenText(json_decode($article['title'], true)[$this->lang], 22);

			$html .=
			'<article class="span4">
				<figure>
					<img src="{$path.images}' . $article['cover'] . '" alt="" />
				</figure>
				<main>
					<h6>' . $title . '</h6>
					<p class="location">@' . $article['username'] . ' / <i class="material-icons">location_on</i>'. $article['title_location'] .'</p>
					<p class="description_blog">' . nl2br(trim(html_entity_decode($description), " \t\n\r\0\x0B\xC2\xA0")) . '</p>
				</main>
				<div class="clear"></div>
				<a href="/blog/view/' . $article['id_entry'] . '/' . strtolower(str_replace(' ', '', $title)) . '">{$lang.btn_read_more}</a>
			</article>' . (($clear == 3) ? '<div class="clear"></div>' : '');

			if ($clear == 3)
				$clear = 1;
			else
				$clear = $clear + 1;
		}

		return $html;
	}

	public function getEntry($id)
	{
		$query	= [];

		$entry	= $this->database->select('blog_entries', '*', ['id_entry' => $id]);
		$author = $this->database->select('website_users', '*', ['id_website_user' => $entry[0]['id_website_user']]);

		if (!empty($entry))
		{
			array_push($query, $entry[0], $author[0]);

			return $query;
		}
		else
		{
			return null;
		}
	}

	public function getArticle($id)
	{
		$query = $this->database->select('blog_entries', '*', ['id_entry' => $id]);
		return $query[0];
	}

	/*
	/* --------------------------------------------------------------------------- */
	public function getLocations()
	{
		$query = $this->database->select('properties_locations', '*');
		return $query;
	}

	public function getEntryLocation($id)
	{
		$query = $this->database->select('properties_locations', '*', ['id_location' => $id]);
		return $query[0];
	}

	public function getConfigurations()
    {
      $query = $this->database->select('general_configurations', '*', ['id_configuration' => 1]);
      return $query[0];
    }

	public function sendEmail($subject, $html, $to, $from)
	{
		$this->component->loadComponent('phpmailer');

		send_email(
			[
				$to[0] => $to[1]
			],
			[
				$from[0],
				$from[1]
			],
			FALSE,
			FALSE,
			FALSE,
			FALSE,
			$subject,
			$html,
			FALSE
		);
	}
}
