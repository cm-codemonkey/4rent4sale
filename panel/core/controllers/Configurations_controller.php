<?php
defined('_EXEC') or die;

class Configurations_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function metadata()
	{
		if(Format::existAjaxRequest() == true)
		{
			$this->model->saveMetadata($_POST);
		}
		else
		{
			$template = $this->view->render($this, 'metadata');
			$template = $this->format->replaceFile($template, 'topbar');
			$template = $this->format->replaceFile($template, 'sidebar');

			$metadata = $this->model->getMetadata();

			$replace = [
				'{description}' => $metadata['description'],
				'{keywords}' => $metadata['keywords']
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}

	public function about()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$about_us['es'] = isset($_POST["description"]) ? $_POST["description"] : "";
				$about_us['en'] = isset($_POST["description_en"]) ? $_POST["description_en"] : "";

				$editAbout	= $this->model->editAbout($about_us);

				if(!empty($editAbout))
				{
					echo json_encode([
						'status' => 'success'
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'Error al actualizar el registro'
					]);
				}
			}
			else
			{
				define('_title', 'LT | Administrador');

				$template = $this->view->render($this, 'about');
				$template = $this->format->replaceFile($template, 'topbar');
				$template = $this->format->replaceFile($template, 'sidebar');

				$about = $this->model->getConfigurations();

				$about['about_us'] = json_decode($about['about_us'], true);

				$replace = [
					'{$about_es}' => $about['about_us']['es'],
					'{$about_en}' => $about['about_us']['en']
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
		else
		{
			header('Location: index.php');
		}
	}

	public function buy()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$buy_process['es'] = isset($_POST["description"]) ? $_POST["description"] : "";
				$buy_process['en'] = isset($_POST["description_en"]) ? $_POST["description_en"] : "";

				$editBuyProcess	= $this->model->editBuyProcess($buy_process);

				if(!empty($editBuyProcess))
				{
					echo json_encode([
						'status' => 'success'
					]);
				}
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'Error al actualizar el registro'
					]);
				}
			}
			else
			{
				define('_title', 'LT | Administrador');

				$template = $this->view->render($this, 'buy');
				$template = $this->format->replaceFile($template, 'topbar');
				$template = $this->format->replaceFile($template, 'sidebar');

				$buy_process = $this->model->getConfigurations();
				$buy_process['buy_process'] = json_decode($buy_process['buy_process'], true);

				$replace = [
					'{$buy_process_es}' => $buy_process['buy_process']['es'],
					'{$buy_process_en}' => $buy_process['buy_process']['en']
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
	}

	public function contact()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$configurations = $this->model->getConfigurations();

				$contact_us_phone = (isset($_POST['contact_us_phone']) AND !empty($_POST['contact_us_phone'])) ? $_POST['contact_us_phone'] : null;
				$contact_us_email = (isset($_POST['contact_us_email']) AND !empty($_POST['contact_us_email'])) ? $_POST['contact_us_email'] : null;
				$contact_us_address = (isset($_POST['contact_us_address']) AND !empty($_POST['contact_us_address'])) ? $_POST['contact_us_address'] : null;

				if (!isset($contact_us_email))
					$message = 'Ingrese el correo electrónico';

				if (!isset($contact_us_phone))
					$message = 'Ingrese el teléfono';

				if(!isset($message))
				{
					$contact_us = json_encode([
						'phone' => $contact_us_phone,
						'email' => $contact_us_email,
						'address' => $contact_us_address
					]);

					$editContact = $this->model->editContact($contact_us);

					if(!empty($editContact))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'Error al actualizar el registro'
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
			else
			{
				define('_title', 'LT | Administrador');

				$template = $this->view->render($this, 'contact');
				$template = $this->format->replaceFile($template, 'topbar');
				$template = $this->format->replaceFile($template, 'sidebar');

				$configurations = $this->model->getConfigurations();
				$contact_us	= json_decode($configurations['contact_us'], true);

				$replace = [
					'{$contact_us_phone}' => $contact_us['phone'],
					'{$contact_us_email}' => $contact_us['email'],
					'{$contact_us_address}' => $contact_us['address']
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
	}

	public function covers()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{

			}
			else
			{
				define('_title', 'LT | Administrador');

				$template = $this->view->render($this, 'covers');
				$template = $this->format->replaceFile($template, 'topbar');
				$template = $this->format->replaceFile($template, 'sidebar');

				$configurations = $this->model->getConfigurations();

				$cover_home = json_decode($configurations['cover_home'], true);
				$cover_about = json_decode($configurations['cover_about'], true);
				$cover_property = json_decode($configurations['cover_property'], true);
				$cover_buy = json_decode($configurations['cover_buy'], true);
				$cover_blog = json_decode($configurations['cover_blog'], true);
				$cover_contact = json_decode($configurations['cover_contact'], true);

				$replace = [
					'{$background}' => '{$path.images}' . $cover_home['background'],
					'{$background_about}' => '{$path.images}' . $cover_about['background_about'],
					'{$background_property_1}' => '{$path.images}' . $cover_property['background_property_1'],
					'{$background_property_2}' => '{$path.images}' . $cover_property['background_property_2'],
					'{$background_property_3}' => '{$path.images}' . $cover_property['background_property_3'],
					'{$background_property}_4' => '{$path.images}' . $cover_property['background_property_4'],
					'{$background_buy}' => '{$path.images}' . $cover_buy['background_buy'],
					'{$background_blog}' => '{$path.images}' . $cover_blog['background_blog'],
					'{$background_contact}' => '{$path.images}' . $cover_contact['background_contact'],
					'{$title_es}' => $cover_home['title_es'],
					'{$title_en}' => $cover_home['title_en'],
					'{$subtitle_es}' => $cover_home['subtitle_es'],
					'{$subtitle_en}' => $cover_home['subtitle_en'],
					'{$title_about_es}' => $cover_about['title_about_es'],
					'{$title_about_en}' => $cover_about['title_about_en'],
					'{$subtitle_about_es}' => $cover_about['subtitle_about_es'],
					'{$subtitle_about_en}' => $cover_about['subtitle_about_en'],
					'{$title_property_es}' => $cover_property['title_property_es'],
					'{$title_property_en}' => $cover_property['title_property_en'],
					'{$subtitle_property_es}' => $cover_property['subtitle_property_es'],
					'{$subtitle_property_en}' => $cover_property['subtitle_property_en'],
					'{$title_buy_es}' => $cover_buy['title_buy_es'],
					'{$title_buy_en}' => $cover_buy['title_buy_en'],
					'{$subtitle_buy_es}' => $cover_buy['subtitle_buy_es'],
					'{$subtitle_buy_en}' => $cover_buy['subtitle_buy_en'],
					'{$title_blog_es}' => $cover_blog['title_blog_es'],
					'{$title_blog_en}' => $cover_blog['title_blog_en'],
					'{$subtitle_blog_es}' => $cover_blog['subtitle_blog_es'],
					'{$subtitle_blog_en}' => $cover_blog['subtitle_blog_en'],
					'{$title_contact_es}' => $cover_contact['title_contact_es'],
					'{$title_contact_en}' => $cover_contact['title_contact_en'],
					'{$subtitle_contact_es}' => $cover_contact['subtitle_contact_es'],
					'{$subtitle_contact_en}' => $cover_contact['subtitle_contact_en']
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
		else
		{
			header('Location: index.php');
		}
	}

	public function edit_cover_home()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$configurations = $this->model->getConfigurations();

				$background	= (isset($_POST['background']) AND !empty($_POST['background'])) ? $_POST['background'] : null;
				$title_es = (isset($_POST['title_es']) AND !empty($_POST['title_es'])) ? $_POST['title_es'] : null;
				$title_en = (isset($_POST['title_en']) AND !empty($_POST['title_en'])) ? $_POST['title_en'] : null;
				$subtitle_es = (isset($_POST['subtitle_es']) AND !empty($_POST['subtitle_es'])) ? $_POST['subtitle_es'] : null;
				$subtitle_en = (isset($_POST['subtitle_en']) AND !empty($_POST['subtitle_en'])) ? $_POST['subtitle_en'] : null;

				if (!isset($title_es))
					$message = 'Ingrese el título en español';

				if (!isset($subtitle_es))
					$message = 'Ingrese el subtítulo en español';

				if(!isset($message))
				{
					if (!isset($background))
						$background = json_decode($configurations['cover_home'], true)['background'];
	                else
						$background = $this->model->uploadBackground(str_replace(' ', '+', $background), PATH_IMAGES);

					$cover_home = json_encode([
						'background' => $background,
						'title_es' => $title_es,
						'title_en' => $title_en,
						'subtitle_es' => $subtitle_es,
						'subtitle_en' => $subtitle_en
					]);

					$edit_cover_home = $this->model->editCoverHome($cover_home);

					if(!empty($edit_cover_home))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'Error al actualizar el registro'
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
			header('Location: index.php');
		}
	}

	public function edit_cover_about()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$configurations = $this->model->getConfigurations();

				$background_about = (isset($_POST['background_about']) AND !empty($_POST['background_about'])) ? $_POST['background_about'] : null;
				$title_about_es = (isset($_POST['title_about_es']) AND !empty($_POST['title_about_es'])) ? $_POST['title_about_es'] : null;
				$title_about_en = (isset($_POST['title_about_en']) AND !empty($_POST['title_about_en'])) ? $_POST['title_about_en'] : null;
				$subtitle_about_es = (isset($_POST['subtitle_about_es']) AND !empty($_POST['subtitle_about_es'])) ? $_POST['subtitle_about_es'] : null;
				$subtitle_about_en = (isset($_POST['subtitle_about_en']) AND !empty($_POST['subtitle_about_en'])) ? $_POST['subtitle_about_en'] : null;

				if (!isset($title_about_es))
					$message = 'Ingrese el título en español';

				if (!isset($subtitle_about_es))
					$message = 'Ingrese el subtítulo en español';

				if(!isset($message))
				{
					if (!isset($background_about))
						$background_about = json_decode($configurations['cover_about'], true)['background_about'];
	                else
						$background_about = $this->model->uploadBackground(str_replace(' ', '+', $background_about), PATH_IMAGES);

					$cover_about = json_encode([
						'background_about' => $background_about,
						'title_about_es' => $title_about_es,
						'title_about_en' => $title_about_en,
						'subtitle_about_es' => $subtitle_about_es,
						'subtitle_about_en' => $subtitle_about_en
					]);

					$edit_cover_about = $this->model->editCoverAbout($cover_about);

					if(!empty($edit_cover_about))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'Error al actualizar el registro'
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
			header('Location: index.php');
		}
	}

	public function edit_cover_property()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$configurations = $this->model->getConfigurations();

				$background_property_1 = (isset($_POST['background_property_1']) AND !empty($_POST['background_property_1'])) ? $_POST['background_property_1'] : null;
				$background_property_2 = (isset($_POST['background_property_2']) AND !empty($_POST['background_property_2'])) ? $_POST['background_property_2'] : null;
				$background_property_3 = (isset($_POST['background_property_3']) AND !empty($_POST['background_property_3'])) ? $_POST['background_property_3'] : null;
				$background_property_4 = (isset($_POST['background_property_4']) AND !empty($_POST['background_property_4'])) ? $_POST['background_property_4'] : null;
				$title_property_es = (isset($_POST['title_property_es']) AND !empty($_POST['title_property_es'])) ? $_POST['title_property_es'] : null;
				$title_property_en = (isset($_POST['title_property_en']) AND !empty($_POST['title_property_en'])) ? $_POST['title_property_en'] : null;
				$subtitle_property_es = (isset($_POST['subtitle_property_es']) AND !empty($_POST['subtitle_property_es'])) ? $_POST['subtitle_property_es'] : null;
				$subtitle_property_en = (isset($_POST['subtitle_property_en']) AND !empty($_POST['subtitle_property_en'])) ? $_POST['subtitle_property_en'] : null;

				if (!isset($title_property_es))
					$message = 'Ingrese el título en español';

				if (!isset($subtitle_property_es))
					$message = 'Ingrese el subtítulo en español';

				if(!isset($message))
				{
					if (!isset($background_property_1))
						$background_property_1 = json_decode($configurations['cover_property'], true)['background_property_1'];
	                else
						$background_property_1 = $this->model->uploadBackground(str_replace(' ', '+', $background_property_1), PATH_IMAGES);

					if (!isset($background_property_2))
						$background_property_2 = json_decode($configurations['cover_property'], true)['background_property_2'];
	                else
						$background_property_2 = $this->model->uploadBackground(str_replace(' ', '+', $background_property_2), PATH_IMAGES);

					if (!isset($background_property_3))
						$background_property_3 = json_decode($configurations['cover_property'], true)['background_property_3'];
	                else
						$background_property_3 = $this->model->uploadBackground(str_replace(' ', '+', $background_property_3), PATH_IMAGES);

					if (!isset($background_property_4))
						$background_property_4 = json_decode($configurations['cover_property'], true)['background_property_4'];
	                else
						$background_property_4 = $this->model->uploadBackground(str_replace(' ', '+', $background_property_4), PATH_IMAGES);

					$cover_property = json_encode([
						'background_property_1' => $background_property_1,
						'background_property_2' => $background_property_2,
						'background_property_3' => $background_property_3,
						'background_property_4' => $background_property_4,
						'title_property_es' => $title_property_es,
						'title_property_en' => $title_property_en,
						'subtitle_property_es' => $subtitle_property_es,
						'subtitle_property_en' => $subtitle_property_en
					]);

					$edit_cover_property = $this->model->editCoverProperty($cover_property);

					if(!empty($edit_cover_property))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'Error al actualizar el registro'
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
			header('Location: index.php');
		}
	}

	public function edit_cover_buy()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$configurations = $this->model->getConfigurations();

				$background_buy = (isset($_POST['background_buy']) AND !empty($_POST['background_buy'])) ? $_POST['background_buy'] : null;
				$title_buy_es = (isset($_POST['title_buy_es']) AND !empty($_POST['title_buy_es'])) ? $_POST['title_buy_es'] : null;
				$title_buy_en = (isset($_POST['title_buy_en']) AND !empty($_POST['title_buy_en'])) ? $_POST['title_buy_en'] : null;
				$subtitle_buy_es = (isset($_POST['subtitle_buy_es']) AND !empty($_POST['subtitle_buy_es'])) ? $_POST['subtitle_buy_es'] : null;
				$subtitle_buy_en = (isset($_POST['subtitle_buy_en']) AND !empty($_POST['subtitle_buy_en'])) ? $_POST['subtitle_buy_en'] : null;

				if (!isset($title_buy_es))
					$message = 'Ingrese el título en español';

				if (!isset($subtitle_buy_es))
					$message = 'Ingrese el subtítulo en español';

				if(!isset($message))
				{
					if (!isset($background_buy))
						$background_buy = json_decode($configurations['cover_buy'], true)['background_buy'];
	                else
						$background_buy = $this->model->uploadBackground(str_replace(' ', '+', $background_buy), PATH_IMAGES);

					$cover_buy = json_encode([
						'background_buy' => $background_buy,
						'title_buy_es' => $title_buy_es,
						'title_buy_en' => $title_buy_en,
						'subtitle_buy_es' => $subtitle_buy_es,
						'subtitle_buy_en' => $subtitle_buy_en
					]);

					$edit_cover_buy = $this->model->editCoverBuy($cover_buy);

					if(!empty($edit_cover_buy))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'Error al actualizar el registro'
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
			header('Location: index.php');
		}
	}

	public function edit_cover_blog()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$configurations = $this->model->getConfigurations();

				$background_blog = (isset($_POST['background_blog']) AND !empty($_POST['background_blog'])) ? $_POST['background_blog'] : null;
				$title_blog_es = (isset($_POST['title_blog_es']) AND !empty($_POST['title_blog_es'])) ? $_POST['title_blog_es'] : null;
				$title_blog_en = (isset($_POST['title_blog_en']) AND !empty($_POST['title_blog_en'])) ? $_POST['title_blog_en'] : null;
				$subtitle_blog_es = (isset($_POST['subtitle_blog_es']) AND !empty($_POST['subtitle_blog_es'])) ? $_POST['subtitle_blog_es'] : null;
				$subtitle_blog_en = (isset($_POST['subtitle_blog_en']) AND !empty($_POST['subtitle_blog_en'])) ? $_POST['subtitle_blog_en'] : null;

				if (!isset($title_blog_es))
					$message = 'Ingrese el título en español';

				if (!isset($subtitle_blog_es))
					$message = 'Ingrese el subtítulo en español';

				if(!isset($message))
				{
					if (!isset($background_blog))
						$background_blog = json_decode($configurations['cover_blog'], true)['background_blog'];
	                else
						$background_blog = $this->model->uploadBackground(str_replace(' ', '+', $background_blog), PATH_IMAGES);

					$cover_blog = json_encode([
						'background_blog' => $background_blog,
						'title_blog_es' => $title_blog_es,
						'title_blog_en' => $title_blog_en,
						'subtitle_blog_es' => $subtitle_blog_es,
						'subtitle_blog_en' => $subtitle_blog_en
					]);

					$edit_cover_blog = $this->model->editCoverBlog($cover_blog);

					if(!empty($edit_cover_blog))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'Error al actualizar el registro'
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
			header('Location: index.php');
		}
	}

	public function edit_cover_contact()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$configurations = $this->model->getConfigurations();

				$background_contact = (isset($_POST['background_contact']) AND !empty($_POST['background_contact'])) ? $_POST['background_contact'] : null;
				$title_contact_es = (isset($_POST['title_contact_es']) AND !empty($_POST['title_contact_es'])) ? $_POST['title_contact_es'] : null;
				$title_contact_en = (isset($_POST['title_contact_en']) AND !empty($_POST['title_contact_en'])) ? $_POST['title_contact_en'] : null;
				$subtitle_contact_es = (isset($_POST['subtitle_contact_es']) AND !empty($_POST['subtitle_contact_es'])) ? $_POST['subtitle_contact_es'] : null;
				$subtitle_contact_en = (isset($_POST['subtitle_contact_en']) AND !empty($_POST['subtitle_contact_en'])) ? $_POST['subtitle_contact_en'] : null;

				if (!isset($title_contact_es))
					$message = 'Ingrese el título en español';

				if (!isset($subtitle_contact_es))
					$message = 'Ingrese el subtítulo en español';

				if(!isset($message))
				{
					if (!isset($background_contact))
						$background_contact = json_decode($configurations['cover_contact'], true)['background_contact'];
	                else
						$background_contact = $this->model->uploadBackground(str_replace(' ', '+', $background_contact), PATH_IMAGES);

					$cover_contact = json_encode([
						'background_contact' => $background_contact,
						'title_contact_es' => $title_contact_es,
						'title_contact_en' => $title_contact_en,
						'subtitle_contact_es' => $subtitle_contact_es,
						'subtitle_contact_en' => $subtitle_contact_en
					]);

					$edit_cover_contact = $this->model->editCoverContact($cover_contact);

					if(!empty($edit_cover_contact))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'Error al actualizar el registro'
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
			header('Location: index.php');
		}
	}

	/* slider-images
	/* ----------------------------------------------------------------------- */
	public function sliderHome()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$image	= (isset($_POST['image']) AND !empty($_POST['image'])) ? $_POST['image'] : '';

				if(empty($image))
					$message = 'empty.image';

				if(!isset($message))
				{
					$link = $this->model->createImage(str_replace(' ', '+', $image), PATH_IMAGES);

					if(!empty($link))
					{
						$addImage = $this->model->addSliderImage($link);

						if(!empty($addImage))
						{
							echo json_encode([
								'status' => 'success'
							]);
						}
						else
						{
							echo json_encode([
								'status' => 'error',
								'message' => 'Error to upload image'
							]);
						}
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'Error to upload image'
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
			else
			{
				define('_title', 'LT | Administrador');

				$template = $this->view->render($this, 'sliderHome');
				$template = $this->format->replaceFile($template, 'topbar');
				$template = $this->format->replaceFile($template, 'sidebar');

				$images = $this->model->getSliderImages();
				$id_image = '';

				$btnAddImage	= '<a href="" data-action="addImage" data-id="' . $id_image . '"><i class="material-icons">add_circle_outline</i></a>';
				$imagesList		= '';

				foreach($images as $image)
				{
					$imagesList .=
					'<figure class="item">
						<img src="{$path.images}' . $image['title'] . '" alt="" />
						<a href="" data-action="deleteImage" data-id="' . $image['id_image'] . '"><i class="material-icons">delete</i></a>
					</figure>';
				}

				$replace = [
					'{$btnAddImage}' => $btnAddImage,
					'{$imagesList}' => $imagesList
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
	}

	public function deleteImage()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$id				= isset($_POST['id']) ? $_POST['id'] : '';
				$deleteImage	= $this->model->deleteSliderImage($id);

				if(!empty($deleteImage))
				{
					echo json_encode([
						'status' => 'success'
					]);
				}
			}
		}
	}
}
