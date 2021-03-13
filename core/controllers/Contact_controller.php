<?php

defined('_EXEC') or die;

/**
* @package valkyrie.core.controllers
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
	private $lang;

	public function __construct()
	{
		parent::__construct();
		$this->lang = Session::get_value('lang');
	}

	/*
	* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
	* @since October 25, 2018 <1.0.0> <@update>
	* @summary Datos dinámico de titulo y background
	*/
	/*
	* @author Julian Alberto Canche Dzib <Software Development, jcanche@codemonkey.com.mx>
	* @since October 25, 2018 <1.0.0> <@update>
	* @summary Funcionalidad del email.
	*/

	/* Ajax: Sending contant email
	** Render: Contact page
	------------------------------------------------------------------------------- */
	public function index()
	{
		$contact = $this->model->get_contact();

		if (Format::exist_ajax_request() == true)
		{
			$fullname = (isset($_POST['fullname']) AND !empty($_POST['fullname'])) ? $_POST['fullname'] : null;
			$email = (isset($_POST['email']) AND !empty($_POST['email'])) ? $_POST['email'] : null;
			$phone = (isset($_POST['phone']) AND !empty($_POST['phone'])) ? $_POST['phone'] : null;
			$message = (isset($_POST['message']) AND !empty($_POST['message'])) ? $_POST['message'] : null;

			$errors = [];

			if (!isset($fullname))
				array_push($errors, ['fullname', '{$lang.dont_leave_this_field_empty}']);

			if (!isset($email))
				array_push($errors, ['email', '{$lang.dont_leave_this_field_empty}']);
			else if (Functions::check_email($email) == false)
				array_push($errors, ['email', '{$lang.invalid_email}']);

			if (!isset($phone))
				array_push($errors, ['phone', '{$lang.dont_leave_this_field_empty}']);
			else if (!is_numeric($phone))
				array_push($errors, ['phone', '{$lang.enter_only_numbers}']);
			else if ($phone < 0)
				array_push($errors, ['phone', '{$lang.dont_enter_negative_numbers}']);
			else if (strlen($phone) != 10)
				array_push($errors, ['phone', '{$lang.invalid_number}']);
			else if (Functions::check_number($phone, 'is_float') == true)
				array_push($errors, ['phone', '{$lang.dont_enter_decimal_numbers}']);
			else if (Functions::check_number($phone, 'exist_spaces') == true)
				array_push($errors, ['phone', '{$lang.dont_enter_spaces}']);

			if (!isset($message))
				array_push($errors, ['message', '{$lang.dont_leave_this_field_empty}']);

			if (empty($errors))
			{
				$header_mail  = 'MIME-Version: 1.0' . "\r\n";
			    $header_mail .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			    $header_mail .= 'From: Valkyrie <contacto@valkyrie.com>' . "\r\n";

				if ($this->lang == 'es')
					$subject_mail = '¡Gracias por ponerte en contacto con nosotros!';
				else if ($this->lang == 'en')
					$subject_mail = '¡Thank you for contacting us!';

				$body_mail =
				'<html>
					<head>
						<title>' . $subject_mail . '</title>
					</head>
					<body>
						<article style="width:600px;padding:20px;box-sizing:border-box;background-color:#eee;">
						    <header style="width:100%;padding:40px;box-sizing:border-box;border-bottom:1px solid #eee;background-color:#616161;">
						        <figure style="width:520px;padding:0px;margin:0px;overflow:hidden;text-align:center;">
						            <img style="height: 50px;" src="https://codemonkey.com.mx/images/codemonkey-logo-1-white.png" alt="Logotype" />
						        </figure>
						    </header>
						    <aside style="width:100%;padding:40px;box-sizing:border-box;background-color:#fff;">
						        <h4 style="margin:0px;margin-bottom:10px;padding:0px;font-size:18px;font-weight:600;color:#757575;">' . $fullname . '</h4>
						        <h6 style="margin:0px;margin-bottom:30px;padding:0px;font-size:14px;font-weight:300;color:#757575;">' . $email . ' ' . $phone . '</h6>
						        <p style="margin:0px;margin-bottom:30px;padding:0px;font-size:14px;font-weight:300;text-align:justify;color:#757575;">' . $message . '</p>
						        <p style="margin:0px;padding:0px;font-size:14px;font-weight:300;text-align:justify;color:#757575;">' . $subject_mail . '</p>
						    </aside>
						    <footer style="width:100%;padding:40px;box-sizing:border-box;border-top:1px solid #eee;background-color:#fff;">
						        <a style="margin:0px;padding:0px;font-size:14px;font-weight:300;text-align:center;color:#757575;">www.codemonkey.com.mx</a>
						    </footer>
						 </article>
					 </body>
				</html>';

			    mail($contact['email'], $subject_mail, $body_mail, $header_mail);
			    mail($email, $subject_mail, $body_mail, $header_mail);

				echo json_encode([
					'status' => 'success',
					'message' => $subject_mail
				]);
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
			define('_title', '{$lang.contact_us} | {$lang.title}');

			$template = $this->view->render($this, 'index');

			$settings = $this->model->get_settings();

			$titles = json_decode($settings['titles'], true);
			$backgrounds = json_decode($settings['backgrounds'], true);
			$social_media = json_decode($contact['social_media'], true);

			$replace = [
				'{$title}' => $titles['contact'][$this->lang],
				'{$background}' => $backgrounds['backgrounds']['contact_us'],
				'{$email}' => $contact['email'],
				'{$phone}' => $contact['phone'],
				'{$facebook}' => $social_media['facebook'],
				'{$instagram}' => $social_media['instagram']
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
