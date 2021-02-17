<?php defined('_EXEC') or die;

class Index_controller extends Controller
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
			$name  = isset($_POST['name']) ? $_POST['name'] : '';
			$email = isset($_POST['email']) ? $_POST['email'] : '';

			if (Security::checkMail($email) == false)
				$message = 'This not a email';

			if (empty($email))
				$message = 'Type your email';

			if (empty($name))
				$message = 'Type your name';

			if (!isset($message))
			{
				$checkEmail = $this->model->checkSubscription($email);

				if (isset($checkEmail) AND !empty($checkEmail))
				{
					echo json_encode([
						'status' => 'error',
						'message' => '{$lang.subscribe_already}'
					]);
				}
				else
				{
					$newSubscription = $this->model->newSubscription($name, $email);

					if (!empty($newSubscription))
					{
						$contact = $this->model->getContact();
						$contact = json_decode($contact['contact_us'], true);

						$mail1 = new Mailer(true);

						try {

							if ($this->lang == 'es')
							{
								$subject1 = 'Gracias por suscribirte';
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
								$html1 .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">' . $name . '</p>';
								$html1 .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Gracias por suscribirte. Pronto recibirás las últimas noticias sobre las mejores oportunidades inmobiliarias.</p>';
								$html1 .= '		<p style="font-size:14px;font-weight:600;text-align:center;margin-top:100px;color:#000;">Saludos desde el paraíso - Propiedades Venta Tulum Realty</p>';
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
								$subject1 = 'Thanks for subscribing';
								$html1  = '<div style="width:100%;padding:30px;box-sizing:border-box;background-color:#F1F1F1;">';
								$html1 .= '	<div style="width:100%;padding:50px 0px;box-sizing:border-box;background-color:#f44336;">';
								$html1 .= '		<div style="width:200px;height:auto;display:flex;align-items:center;justify-content:center;margin:auto;">';
								$html1 .= '			<div style="width:auto;height:auto;float:none;box-sizing:border-box;">';
								$html1 .= '				<img src="https://propiedadesventatulum.com/images/logo-living-tulum-white.png" style="border:0;width:auto;height:100px;" />';
							    $html1 .= '			</div>';
							    $html1 .= '			<div style="clear:both;display:block;overflow:hidden;visibility:hidden;width:0;height:0;"></div>';
							    $html1 .= '		</div>';
								$html1 .= 	'</div>';
								$html1 .= '	<div style="width:100%;padding:100px 40px;box-sizing:border-box;background-color:#fff;">';
								$html1 .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">' . $name . '</p>';
								$html1 .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Thanks for subscribing. Soon you will receive the latest news about the best real estate opportunities.</p>';
								$html1 .= '		<p style="font-size:14px;font-weight:600;text-align:center;margin-top:100px;color:#000;">Greetins from paradise - Propiedades Venta Tulum Realty</p>';
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

							$mail1->setFrom('noreply@propiedadesventatulum.com', 'Propiedades Venta Tulum Realty');
							$mail1->addAddress($email, $name);
							$mail1->Subject = $subject1;
							$mail1->Body = $html1;
							$mail1->send();

						} catch (Exception $e) { }

						$mail2 = new Mailer(true);

						try {

							$mail2->setFrom($email, $name . ' ' . $lastname);
							$mail2->addAddress($contact['email'], 'Propiedades Venta Tulum Realty');
							$mail2->Subject = 'Nueva suscripción';
							$mail2->Body  = '<div style="width:100%;padding:30px;box-sizing:border-box;background-color:#F1F1F1;">';
							$mail2->Body .= '	<div style="width:100%;padding:100px 40px;box-sizing:border-box;background-color:#fff;">';
							$mail2->Body .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Cliente: ' . $name . '</p>';
							$mail2->Body .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Correo electrónico: ' . $email . '</p>';
							$mail2->Body .= '		<p style="font-size:14px;font-weight:100;text-align:center;text-transform:uppercase;line-height: 30px;color:#000;">Idioma: ' . (($this->lang == 'es') ? 'Español' : 'Ingles') . '</p>';
							$mail2->Body .= '	</div>';
							$mail2->Body .= '</div>';
							$mail2->send();

						} catch (Exception $e) { }

						echo json_encode([
							'status' => 'success',
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
			define('_title', 'Tulum Real Estate Propiedades Venta Tulum REALTY');

			$template = $this->view->render($this, 'index');
			$template = $this->format->replaceFile($template, 'header');

			$entries	= $this->model->getEntries();
			$comments	= $this->model->getComments();
			$configurations = $this->model->getConfigurations();
			$images = $this->model->getSliderImages();

			$configurations = json_decode($configurations['cover_home'], true);

			$imagesList		= '';
			$entriesList	= '';
			$commentsList	= '';

			if ($this->lang == 'es')
				$discovery_background = '{$path.images}piscina_espanol.jpg';
			else if ($this->lang == 'en')
				$discovery_background = '{$path.images}piscina_ingles.jpg';

			if (!empty($images))
			{
				$imagesList .=
				'<section class="properties-carousel">
					<div id="properties-carousel" class="owl-carousel">';

				foreach ($images as $image)
				{
					$imagesList .=
					'<div class="item" data-image-src="{$path.images}' . $image['title'] . '" alt="" >
						<div class="cover">
							<a href="/properties">{$lang.index_to_all_properties}</a>
						</div>
					</div>';
				}

				$imagesList .=
				'	</div>
						<a href="" id="left"><i class="material-icons">keyboard_arrow_left</i></a>
						<a href="" id="right"><i class="material-icons">keyboard_arrow_right</i></a>
				</section>';
			}

			$bit = 0;

			foreach ($entries as $entry)
			{
				$class = ($bit == 1) ? 'between' : '';

				$author = $this->model->getEntryAuthor($entry['id_website_user']);

				$entriesList .=
				'<article class="span4 ' . $class . '">
					<figure>
						<img src="{$path.images}' . $entry['cover'] . '" alt="" />
					</figure>
					<main>
						<h6>' . json_decode($entry['title'], true)[$this->lang] . '</h6>
						<p class="location">@' . $author['username'] . '</p>
					</main>
					<a href="/blog/view/' . $entry['id_entry'] . '/' . strtolower(str_replace(' ', '', json_decode($entry['title'], true)[$this->lang])) . '">{$lang.btn_read_more}</a>
				</article>';

				if ($bit == 2)
				{
					$bit = 0;
				}
				else
				{
					$bit = $bit + 1;
				}
			}

			foreach ($comments as $comment)
			{
				$commentsList .=
				'<div class="item">
					<div class="cover">
	                    <div class="icon">
	                        <i class="material-icons">format_quote</i>
	                    </div>
	                    <p class="title-people-say">{$lang.index_what_people_say}</p>
	                    <p class="descrtiption-comment">"' . $comment['description'] . '"</p>
	                    <p class="name-comment">- ' . $comment['name'] . '</p>
					</div>
	            </div>';
			}

			$seo = $this->model->getMetadata();

			$replace = [
				'{$imagesList}' => $imagesList,
				'{$entriesList}' => $entriesList,
				'{$commentsList}' => $commentsList,
				'{$background}' => !empty($configurations['background']) ? '{$path.images}' . $configurations['background'] : '{$path.images}empty-image.jpg',
				'{$title}' => $configurations['title_' . $this->lang],
				'{$subtitle}' => $configurations['subtitle_' . $this->lang],
				'{$discovery_background}' => $discovery_background,
				'{$seo_description}' => $seo['description'],
				'{$seo_keywords}' => $seo['keywords']
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
