<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.core.controllers
*
* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
* @since October 03 - 19, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary Módulo de revista.
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

class Magazine_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Ajax 1: Create or edit magazine article
	** Ajax 2: Get magazine articles
	** Ajax 3: Delete magazine articles selection
	** Render: Magazine articles page
	------------------------------------------------------------------------------- */
	public function index()
	{
		if (Format::exist_ajax_request() == true)
		{
			$action	= $_POST['action'];

			if ($action == 'new' OR $action == 'edit')
			{
				$id_magazine_article = ($action == 'edit') ? $_POST['id_magazine_article'] : null;

				$name_es = (isset($_POST['name_es']) AND !empty($_POST['name_es'])) ? $_POST['name_es'] : null;
				$name_en = (isset($_POST['name_en']) AND !empty($_POST['name_en'])) ? $_POST['name_en'] : null;
				$description_es = (isset($_POST['description_es']) AND !empty($_POST['description_es'])) ? $_POST['description_es'] : null;
				$description_en = (isset($_POST['description_en']) AND !empty($_POST['description_en'])) ? $_POST['description_en'] : null;
				$background = (isset($_FILES['background']['name']) AND !empty($_FILES['background']['name'])) ? $_FILES['background'] : null;
				$priority = (isset($_POST['priority']) AND !empty($_POST['priority'])) ? $_POST['priority'] : null;

				$errors = [];

				if (!isset($name_es))
					array_push($errors, ['name_es', 'No deje este campo vacío']);

				if (!isset($name_en))
					array_push($errors, ['name_en', 'No deje este campo vacío']);

				if (!isset($description_es))
					array_push($errors, ['description_es', 'No deje este campo vacío']);

				if (!isset($description_en))
					array_push($errors, ['description_en', 'No deje este campo vacío']);

				if ($action == 'new' AND !isset($background))
					array_push($errors, ['background', 'No deje este campo vacío']);

				if (empty($errors))
				{
					$magazine_article = [
						'id_magazine_article' => $id_magazine_article,
						'name' => json_encode([
							'es' => $name_es,
							'en' => $name_en
						]),
						'description' => json_encode([
							'es' => $description_es,
							'en' => $description_en
						]),
						'background' => $background,
						'priority' => $priority
					];

					if ($action == 'new')
						$query = $this->model->new_magazine_article($magazine_article);
					else if ($action == 'edit')
						$query = $this->model->edit_magazine_article($magazine_article);

					if (!empty($query))
					{
						if ($action == 'new')
						{
							$subscriptions = $this->model->get_subscriptions();
							$contact = $this->model->get_contact();

							$header_mail  = 'MIME-Version: 1.0' . "\r\n";
						    $header_mail .= 'Content-type: text/html; charset=utf-8' . "\r\n";
						    $header_mail .= 'From: Tierra Pitaya <' . $contact['email'] . '>' . "\r\n";

							$subject_mail = '¡Leé nuestro nuevo articulo en nuestra revista!';

							$body_mail =
							'<html>
								<head>
									<title>' . $subject_mail . '</title>
								</head>
								<body>
									<article style="width:600px;padding:20px;box-sizing:border-box;background-color:#eee;">
										<header style="width:100%;padding:40px;box-sizing:border-box;border-bottom:1px solid #eee;background-color:#fff;">
											<figure style="width:520px;padding:0px;margin:0px;overflow:hidden;text-align:center;">
												<img style="height:50px;" src="https://tierrapitaya.com/images/logotype_black.png" />
											</figure>
										</header>
										<aside style="width:100%;padding:40px;box-sizing:border-box;background-color:#fff;">
											<figure style="width:100%;padding:0px;margin:0px;margin-bottom:10px;overflow:hidden;text-align:center;">
												<img style="width:100%;" src="https://tierrapitaya.com/images/magazine/' . $magazine_article['background'] . '" />
											</figure>
											<h6 style="margin:0px;margin-bottom:30px;padding:0px;font-size:14px;font-weight:300;color:#757575;">' . json_decode($magazine_article['name'], true)['es'] . ' | <a href="https://tierrapitaya.com/magazine/more/' . $query  . '/' . json_decode($magazine_article['name'], true)['es']  . '">Leer articulo</a></h6>
											<p style="margin:0px;padding:0px;font-size:14px;font-weight:300;text-align:center;color:#757575;">' . $subject_mail . '</p>
										</aside>
										<footer style="width:100%;padding:40px;box-sizing:border-box;border-top:1px solid #eee;background-color:#fff;">
											<a href="https://tierrapitaya.com/" style="margin:0px;padding:0px;font-size:14px;font-weight:300;text-align:center;color:#757575;">www.tierrapitaya.com</a>
										</footer>
									 </article>
								 </body>
							</html>';

							foreach ($subscriptions as $subscription)
								mail($subscription['email'], $subject_mail, $body_mail, $header_mail);
						}

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

			if ($action == 'get')
			{
				$query = $this->model->get_magazine_article_by_id($_POST['id_magazine_article']);

				if (!empty($query))
				{
					echo json_encode([
						'status' => 'success',
						'data' => $query
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

			if ($action == 'delete')
			{
				$query = $this->model->delete_magazine_articles(json_decode($_POST['data']));

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
		}
		else
		{
			define('_title', '{$lang.title}');

			$template = $this->view->render($this, 'index');

			if (Functions::check_access_permissions(['{superadministrator}', '{administrator}']) == true)
				$magazine_articles = $this->model->get_magazine_articles();
			else
				$magazine_articles = $this->model->get_magazine_articles(Session::get_value('_vkye_id_user'));

			$btn_delete_magazine_articles = '';
			$lst_magazine_articles = '';
			$fdt_priority = '';

			if (Functions::check_access_permissions(['{superadministrator}', '{administrator}']) == true)
			{
				$btn_delete_magazine_articles = '<a class="btn btn-alert" data-button-modal="delete_magazine_articles">Eliminar</a>';

				$fdt_priority =
				'<fieldset class="input-group">
                    <label>
                        <span>Prioridad</span>
                        <input type="number" name="priority" autofocus>
                        <span class="legend">* Para no poner prioridad, únicamente deje el campo vacío.</span>
                    </label>
                </fieldset>';
			}

			foreach ($magazine_articles as $magazine_article)
			{
				$gallery = $this->model->get_magazine_article_gallery($magazine_article['id_magazine_article']);

				$lst_magazine_articles .=
				'<tr>
					<td><input type="checkbox" data-check value="' . $magazine_article['id_magazine_article'] . '" /></td>
					<td><figure>' .((!empty($magazine_article['background'])) ? '<img src="../{$path.images}magazine/' . $magazine_article['background'] . '" />' : '<img src="../{$path.images}empty.png" />') . '</figure></td>
					<td>' . json_decode($magazine_article['name'], true)['es'] . '</td>
					<td>' . $magazine_article['date'] . '</td>
					<td>'. $magazine_article['author'] .'</td>
					<td>' . (($magazine_article['priority'] >= 1) ? '<span class="busy">Prioridad '. $magazine_article['priority'] .'</span>' : '<span class="empty">Sin Prioridad</span>') . '</td>
					<td>
						<a data-action="get_magazine_article_to_edit" data-id="' . $magazine_article['id_magazine_article'] . '"><i class="material-icons">menu</i><span>Detalles / Editar</span></a>
						<a href="index.php?c=magazine&m=gallery&p=' . $magazine_article['id_magazine_article'] . '"><i class="material-icons">image</i><span>Galería | ' . count($gallery) . ' Imagenes</span></a>
						<div class="clear"></div>
					</td>
				</tr>';
			}

			$replace = [
				'{$btn_delete_magazine_articles}' => $btn_delete_magazine_articles,
				'{$lst_magazine_articles}' => $lst_magazine_articles,
				'{$fdt_priority}' => $fdt_priority
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}

	/* Ajax 1: Upload image to gallery
	** Ajax 2: Delete image to gallery
	** Render: Magazine article gallery page
	------------------------------------------------------------------------------- */
	public function gallery($id_magazine_article)
	{
		if (Format::exist_ajax_request() == true)
		{
			$action	= $_POST['action'];

			if ($action == 'new')
			{
				$name = $this->model->uploader(str_replace(' ', '+', $_POST['image']), PATH_IMAGES . 'magazine/gallery/');

				if (!empty($name))
				{
					$query = $this->model->new_gallery_image($name, $id_magazine_article);

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
				$query = $this->model->delete_gallery_image($_POST['id_gallery_image']);

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
		}
		else
		{
			define('_title', '{$lang.title}');

			$template = $this->view->render($this, 'gallery');

			$gallery = $this->model->get_magazine_article_gallery($id_magazine_article);

			$lst_gallery_images	= '';

			foreach($gallery as $image)
			{
				$lst_gallery_images .=
				'<figure class="item">
					<img src="../{$path.images}magazine/gallery/' . $image['name'] . '" alt="Gallery image" />
					<a href="" data-action="delete_gallery_image" data-id="' . $image['id_gallery_image'] . '"><i class="material-icons">delete</i></a>
				</figure>';
			}

			$replace = [
				'{$lst_gallery_images}' => $lst_gallery_images
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
