<?php defined('_EXEC') or die;

class Properties_controller extends Controller
{
	private $lang;

	public function __construct()
	{
		parent::__construct();
		$this->lang = $_COOKIE['lang'];
	}

	public function index()
	{
		define('_title', '{$lang.properties} | 4Rent 4Sale Riviera Maya Realty');

		$template = $this->view->render($this, 'index');
		$template = $this->format->replaceFile($template, 'header');

		$locations = $this->model->getLocationsHeader();
		$configurations = $this->model->getConfigurations();

		$configurations = json_decode($configurations['cover_property'], true);

		$locationsList	= '';

		foreach ($locations as $location)
		{
			$locationsList .=
			'<a href="/properties?locations=' . str_replace(' ','_',strtolower($location['title'])) . '" data-ripple>' . $location['title'] . '</a>';
		}

		$seo = $this->model->getMetadata();

		if (!empty($configurations['background_property_1']) AND !empty($configurations['background_property_2']) AND !empty($configurations['background_property_3']) AND !empty($configurations['background_property_4']))
		{
			if (isset($_GET) && !empty($_GET))
			{
				if (isset($_GET['subcategory']) && !empty($_GET['subcategory']))
				{
					if ($_GET['subcategory'] == 'presale')
						$background_property = '{$path.images}' . $configurations['background_property_2'];
					else if ($_GET['subcategory'] == 'resale')
						$background_property = '{$path.images}' . $configurations['background_property_3'];
					else if ($_GET['subcategory'] == 'lots')
						$background_property = '{$path.images}' . $configurations['background_property_4'];
				}
				else
					$background_property = '{$path.images}' . $configurations['background_property_1'];
			}
			else
				$background_property = '{$path.images}' . $configurations['background_property_1'];
		}
		else
			$background_property = '{$path.images}empty-image.jpg';

		$replace = [
			'{$locationsList}' => $locationsList,
			'{$optProyects}' => $this->model->getOptProyects(),
			'{$filter_locations}' => $this->model->getHtmlLocations(),
			'{$filter_categories}' => $this->model->getHtmlCategories(),
			'{$items}' => $this->model->getHtmlItems(),
			'{$background_property}' => $background_property,
			'{$title}' => $configurations['title_property_' . $this->lang],
			'{$subtitle}' => $configurations['subtitle_property_' . $this->lang],
			'{$seo_description}' => $seo['description'],
			'{$seo_keywords}' => $seo['keywords']
		];

		$template = $this->format->replace($replace, $template);

		echo $template;
	}

	public function view($id)
	{
		$item = $this->model->getItem($id);

		if (Format::existAjaxRequest() == true)
		{
			$action = $_POST['action'];

			if ($action == 'sendInformationProperty')
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
					$property = $this->model->getProperty($id);
					$location = $this->model->getEntryLocation($property['id_location']);
					$category = $this->model->getEntryCategory($property['id_category']);
					$description = html_entity_decode(json_decode($property['description'], true)[$this->lang]);

					$mail = new Mailer(true);

					try {

						if ($this->lang == 'es')
						{
							$subject = $shareName . ' compartió esta propiedad contigo';
							$html  = '<div style="width:100%;padding:30px;box-sizing:border-box;background-color:#F1F1F1;">';
							$html .= '	<div style="width:auto;height:auto;float:none;box-sizing:border-box;">';
							$html .= '		<img src="https://www.propiedadesventatulum.com/administrator/images/properties/' . $property['cover'] . '" style="border:0;width:100%;height:600px;" />';
							$html .= '		<img src="https://propiedadesventatulum.com/images/logo-living-tulum-white.png" style="border:0;width:auto;height:100px;display:block;position:absolute;top:30px;right:30px;margin:0;padding: 10px 10px;" />';
							$html .= '	</div>';
							$html .= '	<div style="width:100%;padding:100px 40px;box-sizing:border-box;background-color:#fff;">';
							$html .= '		<div style="width:90%;max-width:1200px;margin: 0 auto;display:block;clear:both;">';
							$html .= '			<h4 style="color:#616161;text-transform:uppercase;font-weight:400;font-size:18px;margin:0px;margin-bottom:10px;text-align:center;">' . $shareName . ' compartió esta propiedad contigo</h4>';
							$html .= '			<p style="color:#616161;text-align:center;margin-bottom:100px;font-size:16px;font-weight:400;">' . $shareMessage . '</p>';
							$html .= '			<h4 style="color:#000;text-transform:uppercase;font-weight:200;letter-spacing:30px;font-size:24px;line-height:1.35;margin:0px;margin-bottom:10px;">' . $property['title'] . '</h4>';
							$html .= '			<h6 style="color:#000;text-transform:uppercase;font-weight:200;letter-spacing:30px;font-size:16px;line-height:1.35;margin:0px;margin-bottom:10px;">' . $location['title'] . '</h6>';
							$html .= '			<div style="color:#616161;line-height:23px;text-align:justify;margin-bottom:100px;font-size:20px;font-weight:200;">' . $description . '</div>';
			                $html .= '			<div style="width:100%;height:auto;text-align:right;align-items:center;justify-content:center;">';
							$html .= '				<a href="https://www.propiedadesventatulum.com/" style="text-decoration:none;text-transform:uppercase;font-weight:100;padding: 15px 15px;border: 1px solid #0186ba;letter-spacing:4px;">4Rent 4Sale Riviera Maya Realty</a>';
							$html .= '			</div>';
							$html .= 		'</div>';
							$html .= '	</div>';
							$html .= '	<div style="width:100%;height:auto;text-align:center;align-items:center;justify-content:center;">';
							$html .= '		<p style="font-size:14px;font-weight:600;text-align:center;color:#000;">También puedes seguirnos en nuestras redes sociales</p>';
							$html .= '		<a href="https://www.facebook.com/Living-Tulum-Realty-264536504074968/?fref=ts"><img src="http://www.freeiconspng.com/uploads/facebook-logo-png--impending-10.png" style="border:0;width:auto;height:50px;"/></a>';
							$html .= '		<a href="https://twitter.com/livingtulum"><img src="http://pluspng.com/img-png/twitter-png-logo--512.png" style="border:0;width:auto;height:50px;"/></a>';
							$html .= '		<a href="https://www.instagram.com/livingtulumrealty/"><img src="http://pngimg.com/uploads/instagram/instagram_PNG9.png" style="border:0;width:auto;height:50px;"/></a>';
							$html .= '	</div>';
							$html .= '</div>';
						}
						else if ($this->lang == 'en')
						{
							$subject = $shareName . ' shared this property with you';
							$html  = '<div style="width:100%;padding:30px;box-sizing:border-box;background-color:#F1F1F1;">';
							$html .= '	<div style="width:auto;height:auto;float:none;box-sizing:border-box;">';
							$html .= '		<img src="https://www.propiedadesventatulum.com/administrator/images/properties/' . $property['cover'] . '" style="border:0;width:100%;height:600px;" />';
							$html .= '		<img src="https://propiedadesventatulum.com/images/logo-living-tulum-white.png" style="border:0;width:auto;height:100px;display:block;position:absolute;top:30px;right:30px;margin:0;padding: 10px 10px;" />';
							$html .= '	</div>';
							$html .= '	<div style="width:100%;padding:100px 40px;box-sizing:border-box;background-color:#fff;">';
							$html .= '		<div style="width:90%;max-width:1200px;margin: 0 auto;display:block;clear:both;">';
							$html .= '			<h4 style="color:#616161;text-transform:uppercase;font-weight:400;font-size:18px;margin:0px;margin-bottom:10px;text-align:center;">' . $shareName . ' shared this property with you</h4>';
							$html .= '			<p style="color:#616161;text-align:center;margin-bottom:100px;font-size:16px;font-weight:400;">' . $shareMessage . '</p>';
							$html .= '			<h4 style="color:#000;text-transform:uppercase;font-weight:200;letter-spacing:30px;font-size:24px;line-height:1.35;margin:0px;margin-bottom:10px;">' . $property['title'] . '</h4>';
							$html .= '			<h6 style="color:#000;text-transform:uppercase;font-weight:200;letter-spacing:30px;font-size:16px;line-height:1.35;margin:0px;margin-bottom:10px;">' . $location['title'] . '</h6>';
							$html .= '			<div style="color:#616161;line-height:23px;text-align:justify;margin-bottom:100px;font-size:20px;font-weight:200;">' . $description . '</div>';
			                $html .= '			<div style="width:100%;height:auto;text-align:right;align-items:center;justify-content:center;">';
							$html .= '				<a href="https://www.propiedadesventatulum.com/" style="text-decoration:none;text-transform:uppercase;font-weight:100;padding: 15px 15px;border: 1px solid #0186ba;letter-spacing:4px;">4Rent 4Sale Riviera Maya Realty</a>';
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
						}

						$mail->setFrom('noreply@propiedadesventatulum.com', '4Rent 4Sale Riviera Maya Realty');
						$mail->addAddress($shareEmail, $shareName);
						$mail->Subject = $subject;
						$mail->Body = $html;
						$mail->send();

					} catch (Exception $e) { }

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

			if ($action == 'interestedProperty')
			{
				$name			= isset($_POST['name']) ? $_POST['name'] : '';
				$lastname		= isset($_POST['lastname']) ? $_POST['lastname'] : '';
				$email			= isset($_POST['email']) ? $_POST['email'] : '';
				$phone			= isset($_POST['phone']) ? $_POST['phone'] : '';
				$country		= isset($_POST['country']) ? $_POST['country'] : '';
				$observations	= isset($_POST['observations']) ? $_POST['observations'] : '';

				if (empty($observations))
					$message = 'Type your ask';

				if (empty($country))
					$message = 'Enter the country';

				if (empty($phone))
					$message = 'Enter the phone';

				if (Security::checkMail($email) == false)
					$message = 'This not a email';

				if (empty($email))
					$message = 'Type your email';

				if (empty($lastname))
					$message = 'Type your last name';

				if (empty($name))
					$message = 'Type your name';

				if (!isset($message))
				{
					$newInterested = $this->model->newInterested($name, $lastname, $email, $country, $phone, $observations, $id);

					if (!empty($newInterested))
					{
						$property = $this->model->getProperty($id);
						$contact = $this->model->getContact();
						$contact = json_decode($contact['contact_us'], true);

						$mail1 = new Mailer(true);

						try {

							if ($this->lang == 'es')
							{
								$subject1 = 'Gracias por solicitar informacion sobre nuestra propiedad';
								$html1  = '<div style="width:100%;padding:30px;box-sizing:border-box;background-color:#F1F1F1;">';
								$html1 .= '	<div style="width:100%;padding:50px 0px;box-sizing:border-box;background-color:#f44336;">';
								$html1 .= '		<div style="width:200px;height:auto;display:flex;align-items:center;justify-content:center;margin:auto;">';
								$html1 .= '			<div style="width:auto;height:auto;float:none;box-sizing:border-box;">';
								$html1 .= '				<img src="https://propiedadesventatulum.com/images/logo-living-tulum-white.png" style="border:0;width:auto;height:100px;" />';
								$html1 .= '			</div>';
								$html1 .= '			<div style="clear:both;display:block;overflow:hidden;visibility:hidden;width:0;height:0;"></div>';
								$html1 .= '		</div>';
								$html1 .= '	</div>';
								$html1 .= '	<div style="width:100%;padding:100px 40px;box-sizing:border-box;background-color:#fff;">';
								$html1 .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">' . $name . ' ' . $lastname . '</p>';
								$html1 .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Gracias por solicitar información sobre nuestra propiedad (' . $property['title'] . '). En breve uno de nuestros asesores te contactará para mayor información.</p>';
								$html1 .= '		<p style="font-size:14px;font-weight:600;text-align:center;margin-top:100px;color:#000;">Saludos desde el paraíso - 4Rent 4Sale Riviera Maya Realty</p>';
								$html1 .= '		<p style="font-size:14px;font-weight:600;text-align:center;text-transform:lowercase;color:#000;">www.propiedadesventatulum.com</p>';
								$html1 .= '	</div>';
								$html1 .= '	<div style="width:100%;height:auto;text-align:center;align-items:center;justify-content:center;">';
								$html1 .= '		<p style="font-size:14px;font-weight:600;text-align:center;color:#000;">También puedes seguirnos en nuestras redes sociales</p>';
								$html1 .= '		<a href="https://www.facebook.com/Living-Tulum-Realty-264536504074968/?fref=ts"><img src="http://www.freeiconspng.com/uploads/facebook-logo-png--impending-10.png"  style="border:0;width:auto;height:50px;"/></a>';
								$html1 .= '		<a href="https://twitter.com/livingtulum"><img src="http://pluspng.com/img-png/twitter-png-logo--512.png"  style="border:0;width:auto;height:50px;"/></a>';
								$html1 .= '		<a href="https://www.instagram.com/livingtulumrealty/"><img src="http://pngimg.com/uploads/instagram/instagram_PNG9.png"  style="border:0;width:auto;height:50px;"/></a>';
								$html1 .= '	</div>';
								$html1 .= '</div>';
							}
							else if ($this->lang == 'en')
							{
								$subject1 = 'Thanks for requesting information about our property';
								$html1  = '<div style="width:100%;padding:30px;box-sizing:border-box;background-color:#F1F1F1;">';
								$html1 .= '	<div style="width:100%;padding:50px 0px;box-sizing:border-box;background-color:#f44336;">';
								$html1 .= '		<div style="width:200px;height:auto;display:flex;align-items:center;justify-content:center;margin:auto;">';
								$html1 .= '			<div style="width:auto;height:auto;float:none;box-sizing:border-box;">';
								$html1 .= '				<img src="https://propiedadesventatulum.com/images/logo-living-tulum-white.png" style="border:0;width:auto;height:100px;" />';
								$html1 .= '			</div>';
								$html1 .= '			<div style="clear:both;display:block;overflow:hidden;visibility:hidden;width:0;height:0;"></div>';
								$html1 .= '		</div>';
								$html1 .= '	</div>';
								$html1 .= '	<div style="width:100%;padding:100px 40px;box-sizing:border-box;background-color:#fff;">';
								$html1 .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">' . $name . ' ' . $lastname .'</p>';
								$html1 .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Thanks for requesting information about our property (' . $property['title'] . '). Shortly one of our advisors will contact you for more information.</p>';
								$html1 .= '		<p style="font-size:14px;font-weight:600;text-align:center;margin-top:100px;color:#000;">Greetins from paradise - 4Rent 4Sale Riviera Maya Realty</p>';
								$html1 .= '		<p style="font-size:14px;font-weight:600;text-align:center;text-transform:lowercase;color:#000;">www.propiedadesventatulum.com</p>';
								$html1 .= '	</div>';
								$html1 .= '	<div style="width:100%;height:auto;text-align:center;align-items:center;justify-content:center;">';
								$html1 .= '		<p style="font-size:14px;font-weight:600;text-align:center;color:#000;">You can also follow us on our social networks</p>';
								$html1 .= '		<a href="https://www.facebook.com/Living-Tulum-Realty-264536504074968/?fref=ts"><img src="http://www.freeiconspng.com/uploads/facebook-logo-png--impending-10.png"  style="border:0;width:auto;height:50px;"/></a>';
								$html1 .= '		<a href="https://twitter.com/livingtulum"><img src="http://pluspng.com/img-png/twitter-png-logo--512.png"  style="border:0;width:auto;height:50px;"/></a>';
								$html1 .= '		<a href="https://www.instagram.com/livingtulumrealty/"><img src="http://pngimg.com/uploads/instagram/instagram_PNG9.png"  style="border:0;width:auto;height:50px;"/></a>';
								$html1 .= '	</div>';
								$html1 .= '</div>';
							}

							$mail1->setFrom('noreply@propiedadesventatulum.com', '4Rent 4Sale Riviera Maya Realty');
							$mail1->addAddress($email, $name . ' ' . $lastname);
							$mail1->Subject = $subject1;
							$mail1->Body = $html1;
							$mail1->send();

						} catch (Exception $e) { }

						$mail2 = new Mailer(true);

						try {

							$mail2->setFrom($email, $name . ' ' . $lastname);
							$mail2->addAddress($contact['email'], '4Rent 4Sale Riviera Maya Realty');
							$mail2->Subject = 'Nueva solicitud de información sobre ' . $property['title'];
							$mail2->Body  = '<div style="width:100%;padding:30px;box-sizing:border-box;background-color:#F1F1F1;">';
							$mail2->Body .= '	<div style="width:100%;padding:100px 40px;box-sizing:border-box;background-color:#fff;">';
							$mail2->Body .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Cliente: ' . $name . ' ' . $lastname . '</p>';
							$mail2->Body .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Propiedad: ' . $property['title'] . '</p>';
							$mail2->Body .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Correo electrónico: ' . $email . '</p>';
							$mail2->Body .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">País: ' . $country . ' Teléfono: ' . $phone . '</p>';
							$mail2->Body .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Observaciones: ' . $observations . '</p>';
							$mail2->Body .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Idioma: ' . (($this->lang == 'es') ? 'Español' : 'Ingles') . '</p>';
							$mail2->Body .= '	</div>';
							$mail2->Body .= '</div>';
							$mail2->send();

						} catch (Exception $e) { }

						if ($item[0]['title'] === 'KOKOON TULUM')
						{
							Session::setValue('kokoontulum', true);
							$path = '/properties/kokoontulum';
						}
						else
							$path = 'reload';

						echo json_encode([
							'status' => 'success',
							'path' => $path,
							'message' => '{$lang.successfully}'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'Error to insert row'
						]);
					}
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => $message
					]);
				}
			}
		}
		else
		{
			$template = $this->view->render($this, 'view');
			$template = $this->format->replaceFile($template, 'header');

			$locations = $this->model->getLocationsHeader();

			$locationsList	= '';

			define('_title', $item[0]['title'] . ' | {$lang.properties} | 4Rent 4Sale Riviera Maya Realty');

			$property = $item[0];
			$subproperties = $item[1];
			$images = $item[2];
			$location = $item[3];
			$category = $item[4];

			$imagesList = '';

			$type = '';
			$status = '';
			$interested	= '';

			foreach ($locations as $value)
				$locationsList .= '<a href="/properties?locations=' . str_replace(' ','_',strtolower($value['title'])) . '" data-ripple>' . $value['title'] . '</a>';

			if (!empty($images))
			{
				$imagesList .=
				'<section class="property-images">
	                <div id="property-images" class="owl-carousel">';

				foreach ($images as $image)
				{
					$imagesList .=
					'<div class="item" data-image-src="{$path.images}' . $image['title'] . '" alt="" ></div>';
				}

				$imagesList .=
				'	</div>
					<div class="buttons">
						<a href="" id="left"><i class="material-icons">keyboard_arrow_left</i></a>
						<a href="" id="right"><i class="material-icons">keyboard_arrow_right</i></a>
					</div>
				</section>';
			}

			if ($property['multiple'] == true OR $property['status'] == '1')
			{
				if ($property['type'] == '1')
					$type = ($this->lang == 'es') ? 'Propiedad en venta' : 'Property for sell';
				else if ($property['type'] == '2')
					$type = ($this->lang == 'es') ? 'Propiedad en renta' : 'Property for rent';

				$status = ($this->lang == 'es') ? 'Disponible' : 'Available';

				$interested .=
				'<h4>{$lang.properties_view_interested}</h4>
	            <div class="">
	                ' . (empty($property['pdf']) ? '' : '<a href="{$path.images}' . $property['pdf'] . '" download="livingtulum_' . $property['title'] . '.pdf">Download PDF</a>') . '
	                <a href="" data-action="openAsk">{$lang.properties_view_ask}</a>
	            </div>';
			}
			else if ($property['status'] == '2')
			{
				$status = ($this->lang == 'es') ? 'Vendida' : 'Sold';

				$interested .=
				'<h4>{$lang.properties_view_sorry}</h4>
				 <h4>{$lang.properties_view_been} ' . $status . '</h4>';
			}
			else if ($property['status'] == '3')
			{
				$status = ($this->lang == 'es') ? 'Rentada' : 'Rented';

				$interested .=
				'<h4>{$lang.properties_view_sorry}</h4>
				 <h4>{$lang.properties_view_been} ' . $status . '</h4>';
			}
			else if ($property['status'] == '4')
			{
				$status = ($this->lang == 'es') ? 'Apartada' : 'Pulled Apart';

				$interested .=
				'<h4>{$lang.properties_view_sorry}</h4>
				 <h4>{$lang.properties_view_been} ' . $status . '</h4>';
			}

			if ($property['subcategory'] == '1')
				$subcategory = '{$lang.presale}';
			else if ($property['subcategory'] == '2')
				$subcategory = '{$lang.resale}';
			else if ($property['subcategory'] == '3')
				$subcategory = '{$lang.lots}';

			$replace = [
				'{$locationsList}' => $locationsList,
				'{$cover}' => '{$path.images}' . $property['cover'],
				'{$title}' => $property['title'],
				'{$location}' => $location['title'],
				'{$imagesList}' => $imagesList,
				'{$description}' => html_entity_decode(json_decode($property['description'], true)[$this->lang]),
				'{$category}' => !empty($category) ? json_decode($category['title'], true)[$this->lang] : '',
				'{$subcategory}' => $subcategory,
				'{$price}' => number_format($property['price'], 2, '.', ','),
				'{$coin}' => $property['coin'],
				'{$delivery}' => json_decode($property['delivery'], true)[$this->lang],
				'{$type}' => ($property['multiple'] == true OR $property['status'] == '1') ? $type : $status,
				'{$status}' => $status,
				'{$interested}' => $interested,
				'{$share}' => 'https://www.propiedadesventatulum.com/properties/view/' . $id,
				'{$seo_description}' => $property['seo_description'],
				'{$seo_keywords}' => $property['seo_keywords']
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
