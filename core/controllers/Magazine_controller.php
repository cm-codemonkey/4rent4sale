<?php

defined('_EXEC') or die;

/**
* @package valkyrie.core.controllers
*
* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
* @since October 17, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary create magazine controller
*
* @author Julian Alberto Canche Dzib <Software Development, jcanche@codemonkey.com.mx>
* @since October 24, 2018 <1.0.0> <@update>
* @summary Cargar datos de la tabla de magazine.
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

class Magazine_controller extends Controller
{
	private $lang;

	public function __construct()
	{
		parent::__construct();
		$this->lang = Session::get_value('lang');
	}

	/*
	* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
	* @since October 25 - - October 29, 2018 <1.0.0> <@update>
	* @summary Datos dinámico de titulo, background,
	* Agregar funcion de get_contact para llamar las redes sociales en el sitio web
	*/

	/* Ajax: No ajax
	** Render: magazine page
	------------------------------------------------------------------------------- */
	public function index()
	{
		define('_title',  '{$lang.title}');

		$template = $this->view->render($this, 'index');

		$settings = $this->model->get_settings();
		$magazine_articles = $this->model->get_magazine_articles();
		$contact = $this->model->get_contact();

		$social_media = json_decode($contact['social_media'], true);

		$lst_magazine_articles = '';

		foreach ($magazine_articles as $article)
		{
			$lst_magazine_articles .=
			'<article>
				<figure>
					<img src="{$path.images}magazine/' . $article['background'] . '" alt="Magazine article background">
				</figure>
				<h4>' . json_decode($article['name'], true)[$this->lang] . '</h4>
				<span>{$lang.magazine} | ' . $article['date'] . '</span>
				<a href="/magazine/more/' . $article['id_magazine_article'] . '">{$lang.read_article}</a>
			</article>';
		}

		$replace = [
			'{$background}' => json_decode($settings['backgrounds'], true)['backgrounds']['magazine'],
			'{$title}' => json_decode($settings['titles'], true)['magazine'][$this->lang],
			'{$lst_magazine_articles}' => $lst_magazine_articles,
			'{$facebook}' => $social_media['facebook'],
			'{$instagram}' => $social_media['instagram']
		];

		$template = $this->format->replace($replace, $template);

		echo $template;
	}

	/*
	* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
	* @since October 29, 2018 <1.0.0> <@update>
	* Agregar funcion de get_contact para llamar las redes sociales en el sitio web
	*/

	/* Ajax: No ajax
	** Render: Magazine display page
	------------------------------------------------------------------------------- */
	public function more($id_magazine_article)
	{
		define('_title', '{$lang.title}');

		$template = $this->view->render($this, 'more');

		$magazine = $this->model->get_magazine_by_id($id_magazine_article);
		$user = $this->model->get_user_by_id($magazine['id_user']);
		$images = $this->model->get_gallery_by_magazine($id_magazine_article);
		$contact = $this->model->get_contact();

		$social_media = json_decode($contact['social_media'], true);

		$lst_images = '';
		$count = 1;

		if(!empty($images))
		{
			foreach ($images as $image)
			{
				if ($count == 1)
					$img_style = 1;
				else if ($count == 2)
					$img_style = 2;

				$lst_images .=
				'<figure>
					<img src="{$path.images}magazine/gallery/'. $image['name'] .'" alt="Magazine article gallery image">
					<a href="{$path.images}magazine/gallery/'. $image['name'] .'" class="fancybox-thumb" rel="fancybox-thumb"><i class="material-icons">search</i></a>
				</figure>';

				$count = $count + 1;
			}
		}

		$replace = [
			'{$name}' => json_decode($magazine['name'], true)[$this->lang],
			'{$description}' => json_decode($magazine['description'], true)[$this->lang],
			'{$date}' => $magazine['date'],
			'{$background}' => $magazine['background'],
			'{$avatar}' => !empty($user['avatar']) ? $user['avatar'] : 'avatar.png',
			'{$username}' => $user['fullname'],
			'{$lst_images}' => $lst_images,
			'{$facebook}' => $social_media['facebook'],
			'{$instagram}' => $social_media['instagram']
		];

		$template = $this->format->replace($replace, $template);

		echo $template;
	}
}
