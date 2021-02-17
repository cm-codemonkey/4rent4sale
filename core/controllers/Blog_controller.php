<?php defined('_EXEC') or die;

class Blog_controller extends Controller
{
	private $lang;

	public function __construct()
	{
		parent::__construct();
		$this->lang = $_COOKIE['lang'];
	}

	public function index()
	{
		define('_title', '{$lang.blog} | Propiedades Venta Tulum Realty');

		$template = $this->view->render($this, 'index');
		$template = $this->format->replaceFile($template, 'header');

		$locations	= $this->model->getLocations();
		$entries	= $this->model->getEntriesHtml();
		$configurations = $this->model->getConfigurations();

		$configurations = json_decode($configurations['cover_blog'], true);

		$locationsList	= '';

		foreach ($locations as $location)
		{
			$locationsList .=
			'<a href="/properties?locations=' . str_replace(' ','_',strtolower($location['title'])) . '" data-ripple>' . $location['title'] . '</a>';
		}

		$seo = $this->model->getMetadata();

		$replace = [
			'{$locationsList}' => $locationsList,
			'{$entries}' => $entries,
			'{$background_blog}' => !empty($configurations['background_blog']) ? '{$path.images}' . $configurations['background_blog'] : '{$path.images}empty-image.jpg',
			'{$title}' => $configurations['title_blog_' . $this->lang],
			'{$subtitle}' => $configurations['subtitle_blog_' . $this->lang],
			'{$seo_description}' => $seo['description'],
			'{$seo_keywords}' => $seo['keywords']
		];

		$template = $this->format->replace($replace, $template);

		echo $template;
	}

	public function view($id)
	{
		if (Format::existAjaxRequest() == true)
		{
			$shareEmail		= isset($_POST['shareEmail']) ? $_POST['shareEmail'] : '';
			$shareName		= isset($_POST['shareName']) ? $_POST['shareName'] : '';
			$shareMessage	= isset($_POST['shareMessage']) ? $_POST['shareMessage'] : '';

			if (empty($shareName))
				$message = '{$lang.write_your_name}';

			if (Security::checkMail($shareEmail) == false)
				$message = '{$lang.not_an_email}';

			if (empty($shareEmail))
				$message = '{$lang.write_the_email}';

			if (!isset($message))
			{
				$article = $this->model->getArticle($id);
				$description = html_entity_decode(json_decode($article['description'], true)[$this->lang]);

				if ($this->lang == 'es')
				{
					$subject = $shareName . ' compartió este articulo contigo';
					$html  = '<div style="width:100%;padding:30px;box-sizing:border-box;background-color:#F1F1F1;">';
					$html .= '	<div style="width:auto;height:auto;float:none;box-sizing:border-box;">';
					$html .= '		<img src="https://www.propiedadesventatulum.com/administrator/images/blog_covers/' . $article['cover'] . '" style="border:0;width:100%;height:600px;" />';
					$html .= '		<img src="https://propiedadesventatulum.com/images/logo-living-tulum-white.png" style="border:0;width:auto;height:100px;display:block;position:absolute;top:30px;right:30px;margin:0;padding: 10px 10px;" />';
					$html .= '	</div>';
					$html .= '	<div style="width:100%;padding:100px 40px;box-sizing:border-box;background-color:#fff;">';
					$html .= '		<div style="width:90%;max-width:1200px;margin: 0 auto;display:block;clear:both;">';
					$html .= '			<h4 style="color:#616161;text-transform:uppercase;font-weight:400;font-size:18px;margin:0px;margin-bottom:10px;text-align:center;">' . $shareName . ' compartió este articulo contigo</h4>';
					$html .= '			<p style="color:#616161;text-align:center;margin-bottom:100px;font-size:16px;font-weight:400;">' . $shareMessage . '</p>';
					$html .= '			<h4 style="color:#616161;text-transform:uppercase;font-weight:200;letter-spacing:15px;font-size:27px;line-height:1.35;margin:0px;margin-bottom:10px;text-align:center;">' . json_decode($article['title'], true)[$this->lang] . '</h4>';
					$html .= '			<div style="color:#616161;line-height:23px;text-align:justify;margin-bottom:100px;font-size:20px;font-weight:200;">' . $description . '</div>';
	                $html .= '			<div style="width:100%;height:auto;text-align:right;align-items:center;justify-content:center;">';
					$html .= '				<a href="https://www.propiedadesventatulum.com/" style="text-decoration:none;text-transform:uppercase;font-weight:100;padding: 15px 15px;border: 1px solid #0186ba;letter-spacing:4px;">Propiedades Venta Tulum Realty</a>';
					$html .= '			</div>';
					$html .= '		</div>';
					$html .= '	</div>';
					$html .= '	<div style="width:100%;height:auto;text-align:center;align-items:center;justify-content:center;">';
					$html .= '		<p style="font-size:14px;font-weight:600;text-align:center;color:#000;">También puedes seguirnos en nuestras redes sociales</p>';
					$html .= '		<a href="https://www.facebook.com/Living-Tulum-Realty-264536504074968/?fref=ts"><img src="http://www.freeiconspng.com/uploads/facebook-logo-png--impending-10.png"  style="border:0;width:auto;height:50px;"/></a>';
					$html .= '		<a href="https://twitter.com/livingtulum"><img src="http://pluspng.com/img-png/twitter-png-logo--512.png"  style="border:0;width:auto;height:50px;"/></a>';
					$html .= '		<a href="https://www.instagram.com/livingtulumrealty/"><img src="http://pngimg.com/uploads/instagram/instagram_PNG9.png"  style="border:0;width:auto;height:50px;"/></a>';
					$html .= '	</div>';
					$html .= '</div>';
					$sendEmail = $this->model->sendEmail($subject, $html, [$shareEmail, $shareName], ['noreply@propiedadesventatulum.com', 'Propiedades Venta Tulum Realty']);
				}
				else if ($this->lang == 'en')
				{
					$subject = $shareName . ' shared this article with you';
					$html  = '<div style="width:100%;padding:30px;box-sizing:border-box;background-color:#F1F1F1;">';
					$html .= '	<div style="width:auto;height:auto;float:none;box-sizing:border-box;">';
					$html .= '		<img src="https://www.propiedadesventatulum.com/administrator/images/blog_covers/' . $article['cover'] . '" style="border:0;width:100%;height:600px;" />';
					$html .= '		<img src="https://propiedadesventatulum.com/images/logo-living-tulum-white.png" style="border:0;width:auto;height:100px;display:block;position:absolute;top:30px;right:30px;margin:0;padding: 10px 10px;" />';
					$html .= '	</div>';
					$html .= '	<div style="width:100%;padding:100px 40px;box-sizing:border-box;background-color:#fff;">';
					$html .= '		<div style="width:90%;max-width:1200px;margin: 0 auto;display:block;clear:both;">';
					$html .= '			<h4 style="color:#616161;text-transform:uppercase;font-weight:400;font-size:18px;margin:0px;margin-bottom:10px;text-align:center;">' . $shareName . ' shared this article with you</h4>';
					$html .= '			<p style="color:#616161;text-align:center;margin-bottom:100px;font-size:16px;font-weight:400;">' . $shareMessage . '</p>';
					$html .= '			<h4 style="color:#616161;text-transform:uppercase;font-weight:200;letter-spacing:15px;font-size:27px;line-height:1.35;margin:0px;margin-bottom:10px;text-align:center;">' . json_decode($article['title'], true)[$this->lang] . '</h4>';
					$html .= '			<div style="color:#616161;line-height:23px;text-align:justify;margin-bottom:100px;font-size:20px;font-weight:200;">' . $description . '</div>';
					$html .= '			<div style="width:100%;height:auto;text-align:right;align-items:center;justify-content:center;">';
					$html .= '				<a href="https://www.propiedadesventatulum.com/" style="text-decoration:none;text-transform:uppercase;font-weight:100;padding: 15px 15px;border: 1px solid #0186ba;letter-spacing:4px;">Propiedades Venta Tulum Realty</a>';
					$html .= '			</div>';
					$html .= '		</div>';
					$html .= '	</div>';
					$html .= '	<div style="width:100%;height:auto;text-align:center;align-items:center;justify-content:center;">';
					$html .= '		<p style="font-size:14px;font-weight:600;text-align:center;color:#000;">You can also follow us on our social networks</p>';
					$html .= '		<a href="https://www.facebook.com/Living-Tulum-Realty-264536504074968/?fref=ts"><img src="http://www.freeiconspng.com/uploads/facebook-logo-png--impending-10.png"  style="border:0;width:auto;height:50px;"/></a>';
					$html .= '		<a href="https://twitter.com/livingtulum"><img src="http://pluspng.com/img-png/twitter-png-logo--512.png"  style="border:0;width:auto;height:50px;"/></a>';
					$html .= '		<a href="https://www.instagram.com/livingtulumrealty/"><img src="http://pngimg.com/uploads/instagram/instagram_PNG9.png"  style="border:0;width:auto;height:50px;"/></a>';
					$html .= '	</div>';
					$html .= '</div>';
					$sendEmail = $this->model->sendEmail($subject, $html, [$shareEmail, $shareName], ['noreply@propiedadesventatulum.com', 'Propiedades Venta Tulum Realty']);
				}

				echo json_encode([
					'status' => 'success'
				]);
			}
			else
			{
				echo json_encode([
					'status' => 'error',
					'message' => $message
				]);
			}
		}
		else
		{
			$template = $this->view->render($this, 'view');
			$template = $this->format->replaceFile($template, 'header');

			$locations	= $this->model->getLocations();
			$item		= $this->model->getEntry($id);

			define('_title', json_decode($item[0]['title'], true)[$this->lang] . ' | {$lang.blog} | Propiedades Venta Tulum Realty');

			if (!empty($item))
			{
				$entry	= $item[0];
				$author	= $item[1];

				$locationsList	= '';

				foreach ($locations as $location)
				{
					$locationsList .=
					'<a href="/properties?locations=' . str_replace(' ','_',strtolower($location['title'])) . '" data-ripple>' . $location['title'] . '</a>';
				}

				$location = $this->model->getEntryLocation($entry['id_location']);

				$replace = [
					'{$locationsList}' => $locationsList,
					'{$location}' => $location['title'],
					'{$cover}' => '{$path.images}' . $entry['cover'],
					'{$title}' => json_decode($entry['title'], true)[$this->lang],
					'{$author}' => $author['username'],
					'{$description}' => html_entity_decode(json_decode($entry['description'], true)[$this->lang]),
					'{$share}' => 'https://www.propiedadesventatulum.com/blog/view/' . $id,
					// '{$comments}' => 'https://www.propiedadesventatulum.com/blog/view/' . $id,
					'{$seo_description}' => $entry['seo_description'],
					'{$seo_keywords}' => $entry['seo_keywords']
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
	}
}
