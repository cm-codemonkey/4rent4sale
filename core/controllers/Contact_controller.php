<?php defined('_EXEC') or die;

class Contact_controller extends Controller
{
	private $lang;

	public function __construct()
	{
		parent::__construct();
		$this->lang = $_COOKIE['lang'];
	}

	public function index()
	{
		if (Format::existAjaxRequest() == true)
		{
			$name 			= isset($_POST['name']) ? $_POST['name'] : '';
			$lastname 		= isset($_POST['lastname']) ? $_POST['lastname'] : '';
			$email 			= isset($_POST['email']) ? $_POST['email'] : '';
			$phone			= isset($_POST['phone']) ? $_POST['phone'] : '';
			$country		= isset($_POST['country']) ? $_POST['country'] : '';
			$mailMessage	= isset($_POST['message']) ? $_POST['message'] : '';

			if (empty($mailMessage))
				$message = 'Ingrese un mensaje';

			if (empty($country))
				$message = 'Ingrese el paí­s';

			if (empty($phone))
				$message = 'Ingrese el telefono';

			if (Security::checkMail($email) == false)
				$message = 'E-mail incorrecto';

			if (empty($email))
				$message = 'Ingrese su correo electrónico';

			if (empty($lastname))
				$message = 'Ingrese su apellido';

			if (empty($name))
				$message = 'Ingrese su nombre';

			if (!isset($message))
			{
				$contact = $this->model->getContact();
				$contact = json_decode($contact['contact_us'], true);

				$mail1 = new Mailer(true);

				try {

					if ($this->lang == 'es')
					{
						$subject1 = 'Gracias por contactarnos';
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
						$html1 .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Gracias por contactarnos. En breve uno de nuestros asesores se pondrá en contacto contigo para mayor información.</p>';
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
						$subject1 = 'Thanks for contact us';
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
						$html1 .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Thanks for contact us. Shortly one of our consultants will contact you for more information.</p>';
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
					$mail2->Subject = 'Nuevo contacto';
					$mail2->Body  = '<div style="width:100%;padding:30px;box-sizing:border-box;background-color:#F1F1F1;">';
					$mail2->Body .= '	<div style="width:100%;padding:100px 40px;box-sizing:border-box;background-color:#fff;">';
					$mail2->Body .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Cliente: ' . $name . ' ' . $lastname . '</p>';
					$mail2->Body .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Correo electrónico: ' . $email . '</p>';
					$mail2->Body .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">País: ' . $country . ' Teléfono: ' . $phone . '</p>';
					$mail2->Body .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Mensaje: ' . $mailMessage . '</p>';
					$mail2->Body .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Idioma: ' . (($this->lang == 'es') ? 'Español' : 'Ingles') . '</p>';
					$mail2->Body .= '	</div>';
					$mail2->Body .= '</div>';
					$mail2->send();

				} catch (Exception $e) { }

				echo json_encode([
					'status' => 'success',
					'message' => '{$lang.success}'
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
			define('_title', '{$lang.contact} | 4Rent 4Sale Riviera Maya Realty');

			$template = $this->view->render($this, 'index');
			$template = $this->format->replaceFile($template, 'header');

			$locations	= $this->model->getLocations();
			$configurations = $this->model->getConfigurations();

			$contact_us	= json_decode($configurations['contact_us'], true);
			$configurations = json_decode($configurations['cover_contact'], true);

			$locationsList	= '';

			foreach ($locations as $location)
			{
				$locationsList .=
				'<a href="/properties?locations=' . str_replace(' ','_',strtolower($location['title'])) . '" data-ripple>' . $location['title'] . '</a>';
			}

			$seo = $this->model->getMetadata();

			$replace = [
				'{$locationsList}' => $locationsList,
				'{$contact_us_phone}' => $contact_us['phone'],
				'{$contact_us_email}' =>  $contact_us['email'],
				'{$contact_us_address}' =>  $contact_us['address'],
				'{$background_contact}' => !empty($configurations['background_contact']) ? '{$path.images}' . $configurations['background_contact'] : '{$path.images}empty-image.jpg',
				'{$title}' => $configurations['title_contact_' . $this->lang],
				'{$subtitle}' => $configurations['subtitle_contact_' . $this->lang],
				'{$seo_description}' => $seo['description'],
				'{$seo_keywords}' => $seo['keywords']
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
