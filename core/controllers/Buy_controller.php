<?php
defined('_EXEC') or die;

class Buy_controller extends Controller
{
	private $lang;

	public function __construct()
	{
		parent::__construct();
		$this->lang = $_COOKIE['lang'];
	}

	public function index()
	{
		define('_title', '{$lang.buy} | 4Rent 4Sale Riviera Maya Realty');

		$template = $this->view->render($this, 'index');
		$template = $this->format->replaceFile($template, 'header');

		$locations	= $this->model->getLocations();
		$buy = $this->model->getConfigurations();
		$configurations = $this->model->getConfigurations();

		$configurations = json_decode($configurations['cover_buy'], true);

		$locationsList	= '';

		foreach ($locations as $location)
		{
			$locationsList .=
			'<a href="/properties?locations=' . str_replace(' ','_',strtolower($location['title'])) . '" data-ripple>' . $location['title'] . '</a>';
		}

		$seo = $this->model->getMetadata();

		$replace = [
			'{$locationsList}' => $locationsList,
			'{$buy_process}' => html_entity_decode(json_decode($buy['buy_process'], true)[$this->lang]),
			'{$background_buy}' => !empty($configurations['background_buy']) ? '{$path.images}' . $configurations['background_buy'] : '{$path.images}empty-image.jpg',
			'{$title}' => $configurations['title_buy_' . $this->lang],
			'{$subtitle}' => $configurations['subtitle_buy_' . $this->lang],
			'{$seo_description}' => $seo['description'],
			'{$seo_keywords}' => $seo['keywords']
		];

		$template = $this->format->replace($replace, $template);

		echo $template;
	}

}
