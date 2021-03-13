<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.core.controllers
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

class Settings_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
	* @since October 09, 2018 <1.0.0> <@update>
	* @version 1.0.0
	* @summary Se agregó las funcionalidades de nueva/eliminar imagen en slideshow y editar backgrounds y titulos.
	*/

	/* Ajax 1 : Edit titles
	** Ajax 2 : New slideshow image
	** Ajax 3 : Delete slideshow image
	** Ajax 4 : Edit backgrounds
	** Render: Settings page
	------------------------------------------------------------------------------- */
	public function index()
	{
		$settings = $this->model->get_settings();
		$backgrounds = json_decode($settings['backgrounds'], true);

		if (Format::exist_ajax_request() == true)
		{
			$action	= $_POST['action'];

			if ($action == 'titles')
			{
				$title_home_es = (isset($_POST['title_home_es']) AND !empty($_POST['title_home_es'])) ? $_POST['title_home_es'] : null;
				$title_home_en = (isset($_POST['title_home_en']) AND !empty($_POST['title_home_en'])) ? $_POST['title_home_en'] : null;
				$subtitle_home_es = (isset($_POST['subtitle_home_es']) AND !empty($_POST['subtitle_home_es'])) ? $_POST['subtitle_home_es'] : null;
				$subtitle_home_en = (isset($_POST['subtitle_home_en']) AND !empty($_POST['subtitle_home_en'])) ? $_POST['subtitle_home_en'] : null;
				$title_properties_es = (isset($_POST['title_properties_es']) AND !empty($_POST['title_properties_es'])) ? $_POST['title_properties_es'] : null;
				$title_properties_en = (isset($_POST['title_properties_en']) AND !empty($_POST['title_properties_en'])) ? $_POST['title_properties_en'] : null;
				$title_magazines_es = (isset($_POST['title_magazines_es']) AND !empty($_POST['title_magazines_es'])) ? $_POST['title_magazines_es'] : null;
				$title_magazines_en = (isset($_POST['title_magazines_en']) AND !empty($_POST['title_magazines_en'])) ? $_POST['title_magazines_en'] : null;
				$title_contact_es = (isset($_POST['title_contact_es']) AND !empty($_POST['title_contact_es'])) ? $_POST['title_contact_es'] : null;
				$title_contact_en = (isset($_POST['title_contact_en']) AND !empty($_POST['title_contact_en'])) ? $_POST['title_contact_en'] : null;

				$errors = [];

				if (!isset($title_home_es))
					array_push($errors, ['title_home_es', 'No deje este campo vacío']);
				if (!isset($title_home_en))
					array_push($errors, ['title_home_en', 'No deje este campo vacío']);

				if (!isset($subtitle_home_es))
					array_push($errors, ['subtitle_home_es', 'No deje este campo vacío']);
				if (!isset($subtitle_home_en))
					array_push($errors, ['subtitle_home_en', 'No deje este campo vacío']);

				if (!isset($title_properties_es))
					array_push($errors, ['title_properties_es', 'No deje este campo vacío']);
				if (!isset($title_properties_en))
					array_push($errors, ['title_properties_en', 'No deje este campo vacío']);

				if (!isset($title_magazines_es))
					array_push($errors, ['title_magazines_es', 'No deje este campo vacío']);
				if (!isset($title_magazines_en))
					array_push($errors, ['title_magazines_en', 'No deje este campo vacío']);

				if (!isset($title_contact_es))
					array_push($errors, ['title_contact_es', 'No deje este campo vacío']);
				if (!isset($title_contact_en))
					array_push($errors, ['title_contact_en', 'No deje este campo vacío']);

				if (empty($errors))
				{
					$titles = [
						'home' => [
							'es' => $title_home_es,
							'en' => $title_home_en
						],
						'home_subtitle' => [
							'es' => $subtitle_home_es,
							'en' => $subtitle_home_en
						],
						'properties' => [
							'es' => $title_properties_es,
							'en' => $title_properties_en
						],
						'magazine' => [
							'es' => $title_magazines_es,
							'en' => $title_magazines_en
						],
						'contact' => [
							'es' => $title_contact_es,
							'en' => $title_contact_en
						]
					];

					$query = $this->model->edit_titles(json_encode($titles));

					if (!empty($query))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'DATABASE OPERATION ERROR'
						]);
					}
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'labels' => $errors
					]);
				}
			}

			if ($action == 'new')
			{
				$image = $this->model->uploader(str_replace(' ', '+', $_POST['image']), PATH_IMAGES . 'backgrounds/');

				if (!empty($image))
				{
					array_push($backgrounds['slideshows'], $image);

					$backgrounds = json_encode($backgrounds);

					$query = $this->model->edit_backgrounds($backgrounds);

					if (!empty($query))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'DATABASE OPERATION ERROR'
						]);
					}
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'UPLOADER ERROR'
					]);
				}
			}

			if ($action == 'delete')
			{
				$restored = [];
				$cicle = $_POST['cicle'];

				unset($backgrounds['slideshows'][$cicle]);

				foreach ($backgrounds['slideshows'] as $value)
					array_push($restored, $value);

				$backgrounds['slideshows'] = $restored;
				$backgrounds = json_encode($backgrounds);

				$query = $this->model->edit_backgrounds($backgrounds);

				if (!empty($query))
				{
					echo json_encode([
						'status' => 'success'
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'DATABASE OPERATION ERROR'
					]);
				}
			}

			if ($action == 'edit')
			{
				$background = $_POST['background'];
				$image = $this->model->uploader(str_replace(' ', '+', $_POST['image']), PATH_IMAGES . 'backgrounds/');

				if (!empty($image))
				{
					$backgrounds['backgrounds'][$background] = $image;
					$backgrounds = json_encode($backgrounds);

					$query = $this->model->edit_backgrounds($backgrounds);

					if (!empty($query))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'DATABASE OPERATION ERROR'
						]);
					}
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'UPLOADER ERROR'
					]);
				}
			}
		}
		else
		{
			define('_title', '{$lang.title}');

			$template = $this->view->render($this, 'index');

			$titles = json_decode($settings['titles'], true);

			$lst_slideshow	= '';

			$cicle = 0;

			foreach($backgrounds['slideshows'] as $slide)
			{
				$lst_slideshow .=
			 	'<figure class="item">
			 		<img src="../{$path.images}backgrounds/' . $slide . '" alt="slideshow" />
			 		<a href="" data-action="delete" data-cicle="' . $cicle . '"><i class="material-icons">delete</i></a>
				</figure>';

			 	$cicle = $cicle + 1;
			}

			$replace = [
				'{$lst_slideshow}' => $lst_slideshow,
				'{$title_home_es}' => $titles['home']['es'],
				'{$title_home_en}' => $titles['home']['en'],
				'{$subtitle_home_es}' => $titles['home_subtitle']['es'],
				'{$subtitle_home_en}' => $titles['home_subtitle']['en'],
				'{$title_properties_es}' => $titles['properties']['es'],
				'{$title_properties_en}' => $titles['properties']['en'],
				'{$title_magazines_es}' => $titles['magazine']['es'],
				'{$title_magazines_en}' => $titles['magazine']['en'],
				'{$title_contact_es}' => $titles['contact']['es'],
				'{$title_contact_en}' => $titles['contact']['en'],
				'{$properties}' => $backgrounds['backgrounds']['properties'],
				'{$magazine}' => $backgrounds['backgrounds']['magazine'],
				'{$contact_us}' => $backgrounds['backgrounds']['contact_us'],
				'{$subscribe}' => $backgrounds['backgrounds']['subscribe']
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
