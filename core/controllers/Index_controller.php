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

class Index_controller extends Controller
{
	private $lang;

	public function __construct()
	{
		parent::__construct();
		$this->lang = Session::get_value('lang');
	}

	/*
	* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
	* @since October 24 - October 29, 2018 <1.0.0> <@update>
	* @summary Datos dinámico de categorieas. Datos dinámicos de titulos, subtitulos y slideshow. Datos dinámicos de redes sociales. Multilenguaje del sitio web.
	*
	* @author Julian Alberto Canche Dzib <Developer, jcanche@codemonkey.com.mx>
	* @since October 25, 2018 <1.0.0> <@update>
	* @summary Se integró la funcionalidad de suscribirse.
	*
	* @author Gersón Aarón Gómez Macías <Developer, acabrera@codemonkey.com.mx>
	* @since October 30 / November 01, 2018 <1.0.0> <@update>
	* @summary Se corrigierón errores de estructura y programación. Se anexo la funcionalidad de agregar a la db la suscripción.
	*/

	/* Ajax: Subscription action
	** Render: Home page
	------------------------------------------------------------------------------- */
	public function index()
	{
		$contact = $this->model->get_contact();

		if (Format::exist_ajax_request() == true)
		{
			$action = $_POST['action'];

			if ($action == 'subscription')
			{
				$fullname = (isset($_POST['fullname']) AND !empty($_POST['fullname'])) ? $_POST['fullname'] : null;
				$email = (isset($_POST['email']) AND !empty($_POST['email'])) ? $_POST['email'] : null;

				$errors = [];

				if (!isset($fullname))
					array_push($errors, ['fullname', '{$lang.dont_leave_this_field_empty}']);

				if (!isset($email))
					array_push($errors, ['email', '{$lang.dont_leave_this_field_empty}']);
				else if (Functions::check_email($email) == false)
					array_push($errors, ['email', '{$lang.invalid_email}']);

				if (empty($errors))
				{
					$subscription = [
						'fullname' => $fullname,
						'email' => $email
					];

					$exist = $this->model->get_exist_subscription($subscription['email']);

					if (!empty($exist))
					{
						array_push($errors, ['email', '{$lang.this_subscription_already_exists}']);

						echo json_encode([
							'status' => 'error',
							'labels' => $errors
						]);
					}
					else
					{
						$query = $this->model->new_subscription($subscription);

						if (!empty($query))
						{
							$header_mail  = 'MIME-Version: 1.0' . "\r\n";
						    $header_mail .= 'Content-type: text/html; charset=utf-8' . "\r\n";
						    $header_mail .= 'From: Tierra Pitaya <' . $contact['email'] . '>' . "\r\n";

							if ($this->lang == 'es')
								$subject_mail = '¡Gracias por suscribirte!';
							else if ($this->lang == 'en')
								$subject_mail = '¡Thanks for subscribing!';

							$body_mail =
							'<html>
								<head>
									<title>' . $subject_mail . '</title>
								</head>
								<body>
									<article style="width:600px;padding:20px;box-sizing:border-box;background-color:#eee;">
									    <header style="width:100%;padding:40px;box-sizing:border-box;border-bottom:1px solid #eee;background-color:#fff;">
									        <figure style="width:520px;padding:0px;margin:0px;overflow:hidden;text-align:center;">
									            <img style="height:50px;" src="https://tierrapitaya.com/images/logotype_black.png" alt="Logotype" />
									        </figure>
									    </header>
									    <aside style="width:100%;padding:40px;box-sizing:border-box;background-color:#fff;">
									        <h4 style="margin:0px;margin-bottom:10px;padding:0px;font-size:18px;font-weight:600;color:#757575;">' . $fullname . '</h4>
									        <h6 style="margin:0px;margin-bottom:30px;padding:0px;font-size:14px;font-weight:300;color:#757575;">' . $email . '</h6>
									        <p style="margin:0px;padding:0px;font-size:14px;font-weight:300;text-align:center;color:#757575;">' . $subject_mail . '</p>
									    </aside>
									    <footer style="width:100%;padding:40px;box-sizing:border-box;border-top:1px solid #eee;background-color:#fff;">
									        <a href="https://tierrapitaya.com/" style="margin:0px;padding:0px;font-size:14px;font-weight:300;text-align:center;color:#757575;">www.tierrapitaya.com</a>
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
								'message' => 'DATABASE OPERATION ERROR'
							]);
						}
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

			if ($action == 'map')
			{
				$properties = $this->model->get_properties();
				echo json_encode(['properties' => $properties]);
			}

			if ($action == 'filter')
			{
				$location = (isset($_POST['location']) AND !empty($_POST['location'])) ? $_POST['location'] : null;
				$category = (isset($_POST['category']) AND !empty($_POST['category'])) ? $_POST['category'] : null;
				$price = (isset($_POST['price']) AND !empty($_POST['price'])) ? $_POST['price'] : null;
				$price_from = (isset($_POST['price_from']) AND !empty($_POST['price_from'])) ? $_POST['price_from'] : null;
				$price_to = (isset($_POST['price_to']) AND !empty($_POST['price_to'])) ? $_POST['price_to'] : null;
				$type = (isset($_POST['type']) AND !empty($_POST['type'])) ? $_POST['type'] : null;

				$errors = [];

				if (!isset($location))
					array_push($errors, ['location', '{$lang.dont_leave_this_field_empty}']);

				if (!isset($category))
					array_push($errors, ['category', '{$lang.dont_leave_this_field_empty}']);

				if (!isset($price))
					array_push($errors, ['price', '{$lang.dont_leave_this_field_empty}']);
				else if ($price == 'all' AND $price == 'rank')
					array_push($errors, ['price', '{$lang.invalid_data}']);

				if ($price == 'rank' AND !isset($price_from))
					array_push($errors, ['price_from', '{$lang.dont_leave_this_field_empty}']);
				else if ($price == 'rank' AND $price_from < 0)
					array_push($errors, ['price_from', '{$lang.dont_enter_negative_numbers}']);
				else if ($price == 'rank' AND $price_from >= $price_to)
					array_push($errors, ['price_from', '{$lang.dont_enter_lasted}']);

				if ($price == 'rank' AND !isset($price_to))
					array_push($errors, ['price_to', '{$lang.dont_leave_this_field_empty}']);
				else if ($price == 'rank' AND $price_to < 0)
					array_push($errors, ['price_to', '{$lang.dont_enter_negative_numbers}']);
				else if ($price == 'rank' AND $price_to <= $price_from)
					array_push($errors, ['price_to', '{$lang.dont_enter_bigest}']);

				if (!isset($type))
					array_push($errors, ['type', '{$lang.dont_leave_this_field_empty}']);
				else if ($type == 'all' AND $type == 'sale' AND $type == 'rent')
					array_push($errors, ['type', '{$lang.invalid_data}']);

				if (empty($errors))
				{
					$filter = [
						'location' => $location,
						'category' => $category,
						'price' => $price,
						'price_from' => $price_from,
						'price_to' => $price_to,
						'type' => $type
					];

					$properties = $this->model->get_properties($filter);

					echo json_encode([
						'status' => 'success',
						'properties' => $properties
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
		}
		else
		{
			define('_title', '{$lang.title}');

			$template = $this->view->render($this, 'index');

			$settings = $this->model->get_settings();
			$categories = $this->model->get_categories();
			$magazine_articles = $this->model->get_magazine_articles();
			$f_locations = $this->model->get_locations();
			$f_categories = $this->model->get_categories(true);

			$slideshow = json_decode($settings['backgrounds'], true);
			$titles = json_decode($settings['titles'], true);
			$social_media = json_decode($contact['social_media'], true);

			$lst_slideshow = '';
			$lst_categories = '';
			$lst_magazine_articles = '';
			$lst_f_locations = '';
			$lst_f_categories = '';

			foreach ($slideshow['slideshows'] as $slide)
			{
				$lst_slideshow .=
				'<div class="item" data-image-src="{$path.images}backgrounds/' . $slide . '"></div>';
			}

			foreach ($categories as $category)
			{
				$lst_categories .=
				'<article>
					<figure>
						<img src="{$path.images}properties/categories/' . $category['background'] . '" alt="Category background"/>
					</figure>
					<h4>' . json_decode($category['name'], true)[$this->lang] . '</h4>
					<a href="/properties/index/' . $category['id_property_category'] . '">{$lang.view_more}</a>
				</article>';
			}

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

			foreach ($f_locations as $f_location)
				$lst_f_locations .= '<option value="' . $f_location['id_property_location'] . '">' . json_decode($f_location['name'], true)[$this->lang] . '</option>';

			foreach ($f_categories as $f_category)
				$lst_f_categories .= '<option value="' . $f_category['id_property_category'] . '">' . json_decode($f_category['name'], true)[$this->lang] . '</option>';

			$replace = [
				'{$lst_slideshow}' => $lst_slideshow,
				'{$title}' => $titles['home'][$this->lang],
				'{$subtitle}' => $titles['home_subtitle'][$this->lang],
				'{$lst_categories}' => $lst_categories,
				'{$lst_magazine_articles}' => $lst_magazine_articles,
				'{$lst_f_locations}' => $lst_f_locations,
				'{$lst_f_categories}' => $lst_f_categories,
				'{$background}' => json_decode($settings['backgrounds'], true)['backgrounds']['subscribe'],
				'{$facebook}' => $social_media['facebook'],
				'{$instagram}' => $social_media['instagram']
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
