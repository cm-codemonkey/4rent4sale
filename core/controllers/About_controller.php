<?php
defined('_EXEC') or die;

class About_controller extends Controller
{
	private $lang;

	public function __construct()
	{
		parent::__construct();
		$this->lang = $_COOKIE['lang'];
	}

	public function index()
	{
		define('_title', '{$lang.about} | Propiedades Venta Tulum Realty');
		$template = $this->view->render($this, 'index');
		$template = $this->format->replaceFile($template, 'header');

		$locations = $this->model->getLocations();
		$about = $this->model->getConfigurations();
		$configurations = $this->model->getConfigurations();

		$configurations = json_decode($configurations['cover_about'], true);

		$locationsList	= '';

		foreach ($locations as $location)
		{
			$locationsList .=
			'<a href="/properties?locations=' . str_replace(' ','_',strtolower($location['title'])) . '" data-ripple>' . $location['title'] . '</a>';
		}

		$seo = $this->model->getMetadata();

		$replace = [
			'{$locationsList}' => $locationsList,
			'{$about}' => html_entity_decode(json_decode($about['about_us'], true)[$this->lang]),
			'{$background_about}' => !empty($configurations['background_about']) ? '{$path.images}' . $configurations['background_about'] : '{$path.images}empty-image.jpg',
			'{$title}' => $configurations['title_about_' . $this->lang],
			'{$subtitle}' => $configurations['subtitle_about_' . $this->lang],
			'{$seo_description}' => $seo['description'],
			'{$seo_keywords}' => $seo['keywords']
		];

		$template = $this->format->replace($replace, $template);

		echo $template;
	}

}
