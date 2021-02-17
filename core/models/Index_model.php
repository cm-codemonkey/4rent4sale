<?php defined('_EXEC') or die;

class Index_model extends Model
{
	public function __construct()
	{
		parent::__construct();
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

	/*
	/* --------------------------------------------------------------------------- */
	public function getProperties()
	{
		$query = $this->database->select('properties', '*', ['status' => '1', 'LIMIT' => 4]);
		return $query;
	}

	public function getPropertyLocation($id)
	{
		$query = $this->database->select('properties_locations', '*', ['id_location' => $id]);
		return $query[0];
	}

	/*
	/* --------------------------------------------------------------------------- */
	public function getLocations()
	{
		$query = $this->database->select('properties_locations', '*');
		return $query;
	}

	/*
	/* --------------------------------------------------------------------------- */
	public function getSliderImages()
    {
        $query = $this->database->select('slider_home', '*');
        return $query;
    }

	/*
	/* --------------------------------------------------------------------------- */
	public function getEntries()
	{
		$query = $this->database->select('blog_entries', '*', ['popular_home[>=]' => 1, 'ORDER' => 'popular_home ASC', 'LIMIT' => 3]);
		return $query;
	}

	public function getEntryAuthor($id)
	{
		$query = $this->database->select('website_users', '*', ['id_website_user' => $id]);
		return $query[0];
	}

	/*
	/* --------------------------------------------------------------------------- */
	public function getComments()
	{
		$query = $this->database->select('comments', '*', ['visible' => true]);
		return $query;
	}

	public function getContact()
	{
		$query = $this->database->select('general_configurations', '*');
		return $query[0];
	}

	/*
	/* --------------------------------------------------------------------------- */
	public function newSubscription($name, $email)
	{
		$today = date('Y-m-d');

		$query = $this->database->insert('subscriptions', [
			'name' => $name,
			'email' => $email,
			'date' => $today
		]);

		return $query;
	}

	public function checkSubscription($email)
	{
		$query = $this->database->select('subscriptions', '*', ['email' => $email]);

		return $query;
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

	public function getConfigurations()
    {
      $query = $this->database->select('general_configurations', '*', ['id_configuration' => 1]);
      return $query[0];
    }
}
