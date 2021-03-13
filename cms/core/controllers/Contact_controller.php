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

class Contact_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
	* @since October 22, 2018 <1.0.0> <@update>
	* @version 1.0.0
	* @summary Se elimino campo de twitter en social media.
	*/

	/* Ajax: Edit contact
	** Render: Contact page
	------------------------------------------------------------------------------- */
	public function index()
	{
		if (Format::exist_ajax_request() == true)
		{
			$email = (isset($_POST['email']) AND !empty($_POST['email'])) ? $_POST['email'] : null;
			$phone = (isset($_POST['phone']) AND !empty($_POST['phone'])) ? $_POST['phone'] : null;
			$facebook = (isset($_POST['facebook']) AND !empty($_POST['facebook'])) ? $_POST['facebook'] : null;
			$instagram = (isset($_POST['instagram']) AND !empty($_POST['instagram'])) ? $_POST['instagram'] : null;

			$errors = [];

			if (!isset($email))
				array_push($errors, ['email', 'No deje este campo vacío']);
			else if (Functions::check_email($email) == false)
				array_push($errors, ['email', 'Email inválido']);

			if (!isset($phone))
				array_push($errors, ['phone', 'No deje este campo vacío']);

			if (empty($errors))
			{
				$contact = [
					'email' => $email,
					'phone' => $phone,
					'social_media' => json_encode(['facebook' => $facebook, 'instagram' => $instagram])
				];

				$query = $this->model->edit_contact($contact);

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
		else
		{
			define('_title', '{$lang.title}');

			$template = $this->view->render($this, 'index');

			$contact = $this->model->get_contact();

			$social_media = json_decode($contact['social_media'], true);

			$replace = [
				'{$email}' => $contact['email'],
				'{$phone}' => $contact['phone'],
				'{$facebook}' => !empty($social_media['facebook']) ? $social_media['facebook'] : '',
				'{$instagram}' => !empty($social_media['instagram']) ? $social_media['instagram'] : ''

			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
