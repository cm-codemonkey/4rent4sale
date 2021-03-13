<?php

defined('_EXEC') or die;

/**
* @package valkyrie.core.controllers
*
* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
* @since October 17, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary create Properties controller
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

class Properties_controller extends Controller
{
	private $lang;

	public function __construct()
	{
		parent::__construct();
		$this->lang = Session::get_value('lang');
	}

	/*
	* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
	* @since October 29, 2018 <1.0.0> <@update>
	* @summary Datos dinámico de titulo, background,
	* Agregar funcion de get_contact para llamar las redes sociales en el sitio web
	*/

	/* Ajax: No ajax
	** Render: Properties page
	------------------------------------------------------------------------------- */
	public function index($filter)
	{
		if (Format::exist_ajax_request() == true)
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

				$lst_properties = '';

				foreach ($properties as $property)
				{
					$details = json_decode($property['details'], true);

					$type = '';
					$price = 0;

					$cicle = 1;

					foreach ($details as $value)
					{
						if ($cicle == 1)
						{
							if ($value['type'] == 'sale')
								$type .= '{$lang.sale}';
							else if ($value['type'] == 'rent')
								$type .= '{$lang.rent}';

							$price = $value['price'];
						}
						else if ($cicle > 1)
						{
							if ($type == '{$lang.sale}' AND $value['type'] == 'rent')
								$type .= ' - {$lang.rent}';
							else if ($type == '{$lang.rent}' AND $value['type'] == 'sale')
								$type .= ' - {$lang.sale}';

							if ($value['price'] < $price)
								$price = $value['price'];
						}

						$cicle = $cicle + 1;
					}

					$lst_properties .=
					'<article>
		                <figure>
		                    <img src="{$path.images}properties/' . $property['background'] . '" alt="Property cover">
							<span class="price">{$lang.from}: $ <strong>' . number_format($price, 0, '.', ',') . ' </strong> {$lang.currency}</span>
							<span class="featured ' . (($property['priority'] == null) ? 'hidden' : '') . '">{$lang.featured}</span>
							<span class="type">' . $type . '</span>
		                </figure>
		                <aside>
		                    <h4>' . json_decode($property['name'], true)[$this->lang] . '</h4>
						</aside>
						<aside class="gray">
							<span><i class="material-icons">place</i>' . json_decode($property['location'], true)[$this->lang] . '</span>
							<span><i class="material-icons">category</i>' . json_decode($property['category'], true)[$this->lang] . '</span>
							<div class="clear"></div>
						</aside>
						<aside>
							<a href="/properties/more/' . $property['id_property'] . '/' . strtolower(str_replace(' ', '', json_decode($property['name'], true)[$this->lang])) . '" class="btn">{$lang.view_data_sheet}</a>
							<div class="clear"></div>
						</aside>
		            </article>';
				}

				echo json_encode([
					'status' => 'success',
					'html' => $lst_properties
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
			define('_title', '{$lang.properties} | {$lang.title} | {$lang.title_desc}');

			$template = $this->view->render($this, 'index');

			$settings = $this->model->get_settings();

			if (!empty($filter))
				$properties = $this->model->get_properties(['location' => 'all', 'category' => $filter, 'price' => 'all', 'type' => 'all']);
			else
				$properties = $this->model->get_properties();

			$locations = $this->model->get_locations();
			$categories = $this->model->get_categories();
			$contact = $this->model->get_contact();

			$social_media = json_decode($contact['social_media'], true);

			$lst_properties = '';
			$lst_locations = '';
			$lst_categories = '';

			foreach ($properties as $property)
			{
				$details = json_decode($property['details'], true);

				$type = '';
				$price = 0;

				$cicle = 1;

				foreach ($details as $value)
				{
					if ($cicle == 1)
					{
						if ($value['type'] == 'sale')
							$type .= '{$lang.sale}';
						else if ($value['type'] == 'rent')
							$type .= '{$lang.rent}';

						$price = $value['price'];
					}
					else if ($cicle > 1)
					{
						if ($type == '{$lang.sale}' AND $value['type'] == 'rent')
							$type .= ' - {$lang.rent}';
						else if ($type == '{$lang.rent}' AND $value['type'] == 'sale')
							$type .= ' - {$lang.sale}';

						if ($value['price'] < $price)
							$price = $value['price'];
					}

					$cicle = $cicle + 1;
				}

				$lst_properties .=
				'<article>
	                <figure>
	                    <img src="{$path.images}properties/' . $property['background'] . '" alt="Property cover">
						<span class="price">{$lang.from}: $ <strong>' . number_format($price, 0, '.', ',') . ' </strong> {$lang.currency}</span>
						<span class="featured ' . (($property['priority'] == null) ? 'hidden' : '') . '">{$lang.featured}</span>
						<span class="type">' . $type . '</span>
	                </figure>
	                <aside>
	                    <h4>' . json_decode($property['name'], true)[$this->lang] . '</h4>
					</aside>
					<aside class="gray">
						<span><i class="material-icons">place</i>' . json_decode($property['location'], true)[$this->lang] . '</span>
						<span><i class="material-icons">category</i>' . json_decode($property['category'], true)[$this->lang] . '</span>
						<div class="clear"></div>
					</aside>
					<aside>
						<a href="/properties/more/' . $property['id_property'] . '/' . strtolower(str_replace(' ', '', json_decode($property['name'], true)[$this->lang])) . '" class="btn">{$lang.view_data_sheet}</a>
						<div class="clear"></div>
					</aside>
	            </article>';
			}

			foreach ($locations as $location)
			{
				$lst_locations .=
				'<option value="' . $location['id_property_location'] . '">' . json_decode($location['name'], true)[$this->lang] . '</option>';
			}

			foreach ($categories as $category)
			{
				$lst_categories .=
				'<option value="' . $category['id_property_category'] . '" ' . ((!empty($filter) AND $filter == $category['id_property_category']) ? 'selected' : '') . '>' . json_decode($category['name'], true)[$this->lang] . '</option>';
			}

			$replace = [
				'{$background}' => json_decode($settings['backgrounds'], true)['backgrounds']['properties'],
				'{$title}' => json_decode($settings['titles'], true)['properties'][$this->lang],
				'{$lst_properties}' => $lst_properties,
				'{$lst_locations}' => $lst_locations,
				'{$lst_categories}' => $lst_categories,
				'{$facebook}' => $social_media['facebook'],
				'{$instagram}' => $social_media['instagram']
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}

	/*
	* @author Julian Alberto Canche Dzib <Development, jcanche@codemonkey.com.mx>
	* @since October 17, 2018 <1.0.0> <@create>
	* @version 1.0.0
	* @summary Funcionalidad del formulario de envio de email
	*/

	/*
	* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
	* @since  October 29, 2018 <1.0.0> <@update>
	* Agregar funcion de get_contact para llamar las redes sociales en el sitio web
	*/

	/* Ajax: No ajax
	** Render: Property display page
	------------------------------------------------------------------------------- */
	public function more($id_property)
	{
		$property = $this->model->get_property_by_id($id_property);
		$contact = $this->model->get_contact();

		if (Format::exist_ajax_request() == true)
		{
			$action = $_POST['action'];

			if ($action == 'ask')
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

				if (isset($phone) AND !is_numeric($phone))
					array_push($errors, ['phone', '{$lang.enter_only_numbers}']);
				else if (isset($phone) AND $phone < 0)
					array_push($errors, ['phone', '{$lang.dont_enter_negative_numbers}']);
				else if (isset($phone) AND strlen($phone) != 10)
					array_push($errors, ['phone', '{$lang.invalid_number}']);
				else if (isset($phone) AND Functions::check_number($phone, 'is_float') == true)
					array_push($errors, ['phone', '{$lang.dont_enter_decimal_numbers}']);
				else if (isset($phone) AND Functions::check_number($phone, 'exist_spaces') == true)
					array_push($errors, ['phone', '{$lang.dont_enter_spaces}']);

				if (empty($errors))
				{
					$header_mail  = 'MIME-Version: 1.0' . "\r\n";
				    $header_mail .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				    $header_mail .= 'From: Tierra Pitaya <' . $contact['email'] . '>' . "\r\n";

					if ($this->lang == 'es')
					{
						$subject_mail = '¡Gracias por preguntar por esta propiedad!';
						$subject_mail_2 = 'Uno de nuestros ejecutivos de venta se pondrá en contacto con usted.';
						$a_title = 'Ver propiedad';
					}
					else if ($this->lang == 'en')
					{
						$subject_mail = '¡Thanks for ask for this property!';
						$subject_mail_2 = 'One of our sales executives will get in touch with you.';
						$a_title = 'View property';
					}

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
									<figure style="width:600px;padding:0px;margin:0px;margin-bottom:10px;overflow:hidden;text-align:center;">
										<img style="width:600px;" src="https://tierrapitaya.com/images/properties/' . $property['background'] . '" alt="Logotype" />
									</figure>
									<h6 style="margin:0px;margin-bottom:30px;padding:0px;font-size:14px;font-weight:300;color:#757575;">' . json_decode($property['name'], true)[$this->lang] . ' | <a href="https://tierrapitaya.com/properties/more/' . $property['id_property'] . '/' . json_decode($property['name'], true)[$this->lang]  . '">' . $a_title . '</a></h6>
									<h4 style="margin:0px;margin-bottom:10px;padding:0px;font-size:18px;font-weight:600;color:#757575;">' . $fullname . '</h4>
									<h6 style="margin:0px;margin-bottom:10px;padding:0px;font-size:14px;font-weight:300;color:#757575;">' . $email . ' | ' . $phone . '</h6>
									<p style="margin:0px;margin-bottom:30px;padding:0px;font-size:14px;font-weight:300;text-align:justify;color:#757575;">' . $message . '</p>
									<p style="margin:0px;padding:0px;font-size:14px;font-weight:300;text-align:center;color:#757575;">' . $subject_mail . ' ' . $subject_mail_2 . '</p>
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
						'message' => $subject_mail . ' ' . $subject_mail_2
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
			else if ($action == 'send')
			{
				$email = (isset($_POST['email']) AND !empty($_POST['email'])) ? $_POST['email'] : null;

				$errors = [];

				if (!isset($email))
					array_push($errors, ['email', '{$lang.dont_leave_this_field_empty}']);
				else if (Functions::check_email($email) == false)
					array_push($errors, ['email', '{$lang.invalid_email}']);

				if (empty($errors))
				{
					//sender
					$from = $contact['email'];
					$from_name = 'Tierra Pitaya';

					if ($this->lang == 'es')
					{
						$subject_mail = 'Ficha técnica (' . json_decode($property['name'], true)[$this->lang] . ')';
						$a_title = 'Ver propiedad en el sitio web';
						$thanks_message = 'La ficha técnica se ha enviado correctamente';
					}
					else if ($this->lang == 'en')
					{
						$subject_mail = 'Datasheet (' . json_decode($property['name'], true)[$this->lang] . ')';
						$a_title = 'View property in website';
						$thanks_message = 'The datasheet has been sent correctly';
					}

					//file
					$file = 'uploads/' . $property['pdf'];

					//email body content
					$html_content =
					'<html>
						<head>
							<title>' . $subject_mail . '</title>
						</head>
						<body>
							<article style="width:600px;padding:20px;box-sizing:border-box;background-color:#eee;">
								<header style="width:100%;padding:40px;box-sizing:border-box;border-bottom:1px solid #eee;background-color:#fff;">
									<figure style="width:520px;padding:0px;margin:0px;overflow:hidden;text-align:center;">
										<img style="height:50px;" src="https://tierrapitaya.com/images/logotype_black.png" class="Logotype" />
									</figure>
								</header>
								<aside style="width:100%;padding:40px;box-sizing:border-box;background-color:#fff;">
									<h4 style="margin:0px;margin-bottom:30px;padding:0px;font-size:18px;font-weight:600;color:#757575;">' . $subject_mail . '</h4>
									<a href="https://tierrapitaya.com/properties/more/' . $property['id_property'] . '/' . json_decode($property['name'], true)[$this->lang]  . '" style="margin:0px;padding:0px;font-size:14px;font-weight:300;text-align:center;color:#757575;">' . $a_title . '</a>
								</aside>
								<footer style="width:100%;padding:40px;box-sizing:border-box;border-top:1px solid #eee;background-color:#fff;">
									<a href="https://tierrapitaya.com/" style="margin:0px;padding:0px;font-size:14px;font-weight:300;text-align:center;color:#757575;">www.tierrapitaya.com</a>
								</footer>
							 </article>
						 </body>
					</html>';

					//boundary
					$semi_rand = md5(time());
					$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

					//Headers
					$header_mail = "From: $from_name" . " <' . $from . '>";
					$header_mail .= "MIME-Version: 1.0\n";
					$header_mail .= "Content-Type: multipart/mixed;\n";
					$header_mail .= "boundary=\"{$mime_boundary}\"";

					//body mail
					$body_mail = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
					"Content-Transfer-Encoding: 7bit\n\n" . $html_content . "\n\n";

					//preparing attachment
					if( !empty($file) > 0 )
					{
						if( is_file($file) )
						{
							$body_mail .= "--{$mime_boundary}\n";
							$fp = fopen( $file,"rb" );
        					$data = fread( $fp,filesize($file) );

							fclose($fp);
							$data = chunk_split(base64_encode($data));
							$body_mail .= "Content-Type: application/octet-stream; name=\"" . basename($file) . "\"\n" .
							"Content-Description: " . basename($file) . "\n" .
							"Content-Disposition: attachment;\n" . " filename=\"" . basename($file) . "\"; size=" . filesize($file) . ";\n" .
							"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
						}
					}

					$body_mail .= "--{$mime_boundary}--";
					$returnpath = "-f" . $from;

					mail($email, $subject_mail, $body_mail, $header_mail, $returnpath);

					// $header_mail  = 'MIME-Version: 1.0;' . "\r\n";
				    // $header_mail .= 'Content-type: multipart/mixed;' . "\r\n";
					// $header_mail .= 'boundary: "=T=P=Y=A=";' . "\r\n";
				    // $header_mail .= 'From: Tierra Pitaya <' . $contact['email'] . '>;' . "\r\n";
					//
					// if ($this->lang == 'es')
					// {
					// 	$subject_mail = 'Ficha técnica (' . json_decode($property['name'], true)[$this->lang] . ')';
					// 	$a_title = 'Ver propiedad en el sitio web';
					// 	$thanks_message = 'La ficha técnica se ha enviado correctamente';
					// }
					// else if ($this->lang == 'en')
					// {
					// 	$subject_mail = 'Datasheet (' . json_decode($property['name'], true)[$this->lang] . ')';
					// 	$a_title = 'View property in website';
					// 	$thanks_message = 'The datasheet has been sent correctly';
					// }
					//
					// $fp = fopen('uploads/' . $property['pdf'], "rb");
					// $size_file = filesize('uploads/' . $property['pdf']);
					// $name_file = basename('uploads/' . $property['pdf']);
				    // $file = fread($fp, $size_file);
					// $file = chunk_split(base64_encode($file));
					//
					// $body_mail = "--=T=P=Y=A=\r\n";
					// $body_mail .= "Content-Type: application/octet-stream;\r\n";
				    // $body_mail .= "name=" . $name_file . ";\r\n";
				    // $body_mail .= "Content-Transfer-Encoding: base64;\r\n";
				    // $body_mail .= "Content-Disposition: attachment;\r\n";
				    // $body_mail .= "filename=" . $name_file . ";\r\n";
				    // $body_mail .= "\r\n";
					// $body_mail .= "$file\r\n";
					// $body_mail .= "--=T=P=Y=A=--\r\n";
					// $body_mail .=
					// '<html>
					// 	<head>
					// 		<title>' . $subject_mail . '</title>
					// 	</head>
					// 	<body>
					// 		<article style="width:600px;padding:20px;box-sizing:border-box;background-color:#eee;">
					// 			<header style="width:100%;padding:40px;box-sizing:border-box;border-bottom:1px solid #eee;background-color:#fff;">
					// 				<figure style="width:520px;padding:0px;margin:0px;overflow:hidden;text-align:center;">
					// 					<img style="height:50px;" src="https://tierrapitaya.com/images/logotype_black.png" alt="Logotype" />
					// 				</figure>
					// 			</header>
					// 			<aside style="width:100%;padding:40px;box-sizing:border-box;background-color:#fff;">
					// 				<h4 style="margin:0px;margin-bottom:30px;padding:0px;font-size:18px;font-weight:600;color:#757575;">' . $subject_mail . '</h4>
					// 				<a href="https://tierrapitaya.com/properties/more/' . $property['id_property'] . '/' . json_decode($property['name'], true)[$this->lang]  . '" style="margin:0px;padding:0px;font-size:14px;font-weight:300;text-align:center;color:#757575;">' . $a_title . '</a>
					// 			</aside>
					// 			<footer style="width:100%;padding:40px;box-sizing:border-box;border-top:1px solid #eee;background-color:#fff;">
					// 				<a href="https://tierrapitaya.com/" style="margin:0px;padding:0px;font-size:14px;font-weight:300;text-align:center;color:#757575;">www.tierrapitaya.com</a>
					// 			</footer>
					// 		 </article>
					// 	 </body>
					// </html>';
					//
					// // mail($contact['email'], $subject_mail, $body_mail, $header_mail);
					// mail($email, $subject_mail, $body_mail, $header_mail);

					echo json_encode([
						'status' => 'success',
						'message' => $thanks_message
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

			$template = $this->view->render($this, 'more');

			$property_gallery = $this->model->get_property_gallery($id_property);

			$details = json_decode($property['details'], true);
			$social_media = json_decode($contact['social_media'], true);

			$lst_details = '';
			$lst_gallery_images = '';

			$cicle = 1;

			foreach ($details as $details)
			{
				$lst_details .=
				'<div class="item ' . (!empty($details['background']) ? 'featured' : '') . ' ' . ((!empty($details['background']) AND $cicle == 2) ? 'right' : '') . '">
					' . (!empty($details['background']) ? '<figure><img src="{$path.images}properties/' . $details['background'] . '" alt="Multiple property details cover" /></figure>' : '') . '
	                ' . (!empty($details['name'][$this->lang]) ? '<h4>' . $details['name'][$this->lang] . '</h4>' : '') . '
					<span class="highlighted">{$lang.' . $details['type'] . '} $ <strong>' . number_format($details['price'], 0, '.', ',') . '</strong> {$lang.currency}</span>
					<span class="right highlighted ' . (($details['available'] == true) ? 'available' : '') . '"><strong>{$lang.' . (($details['available'] == true) ? 'available' : 'unavailable') . '}</strong></span>
					<div class="clear padding-top-20"></div>
					<span><i class="material-icons">rounded_corner</i>' . $details['dimensions'][$this->lang] . '</span>';

				if (!empty($details['characteristics']))
				{
					$lst_details .=
					'<div class="clear padding-top-20"></div>';

					foreach ($details['characteristics'] as $characteristics)
					{
						$lst_details .=
						'<span class="list"><i class="material-icons">keyboard_arrow_right</i>' . $characteristics[$this->lang] . '</span>';
					}
				}

				if (!empty($details['amenities']))
				{
					$lst_details .=
					'<div class="clear padding-top-20"></div>';

					foreach ($details['amenities'] as $amenities)
					{
						$lst_details .=
						'<span class="list"><i class="material-icons">keyboard_arrow_right</i>' . $amenities[$this->lang] . '</span>';
					}
				}

				$lst_details .=
	            '</div>
				<div class="clear"></div>';

				if (!empty($details['background']))
					$cicle = ($cicle == 2) ? 1 : $cicle + 1;
			}

			if (!empty($property_gallery))
			{
				$lst_gallery_images .=
				'<div class="cm-gallery-style-1">';

				foreach ($property_gallery as $image)
				{
					$lst_gallery_images .=
					'<figure>
						<img src="{$path.images}properties/gallery/'. $image['name'] .'" alt="Property gallery image">
						<a href="{$path.images}properties/gallery/'. $image['name'] .'" class="fancybox-thumb" rel="fancybox-thumb"><i class="material-icons">search</i></a>
					</figure>';
				}

				$lst_gallery_images .=
				'	<div class="clear"></div>
				</div>';
			}

			$replace = [
				'{$background}' => $property['background'],
				'{$name}' => json_decode($property['name'], true)[$this->lang],
				'{$location}' => json_decode($property['location'], true)[$this->lang],
				'{$category}' => json_decode($property['category'], true)[$this->lang],
				'{$featured}' => ($property['priority'] >= 1) ? '<span class="right bookmark"><i class="material-icons">grade</i>{$lang.property-featured}</span>' : '',
				'{$description}' => json_decode($property['description'], true)[$this->lang],
				'{$lst_details}' => $lst_details,
				'{$lst_gallery_images}' => $lst_gallery_images,
				'{$lat}' => json_decode($property['map'], true)['lat'],
				'{$lng}' => json_decode($property['map'], true)['lng'],
				'{$facebook}' => $social_media['facebook'],
				'{$instagram}' => $social_media['instagram']
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
