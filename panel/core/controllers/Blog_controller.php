<?php
defined('_EXEC') or die;

class Blog_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if(Session::getValue('level') > 8)
		{
			define('_title', 'LT | Administrador');

			$template = $this->view->render($this, 'index');
			$template = $this->format->replaceFile($template, 'topbar');
			$template = $this->format->replaceFile($template, 'sidebar');

			$entries1 = $this->model->getEntries('home');
			$entries2 = $this->model->getEntries('blog');

			$list1 = '';
			$list2 = '';

			foreach ($entries1 as $entry)
			{
				$location = $this->model->getEntryLocation($entry['id_location']);
				$author	= $this->model->getEntryAuthor($entry['id_website_user']);

				$list1 .=
				'<tr>
				<td><input type="checkbox" data-check value="' . $entry['id_entry'] . '" /></td>
					<td data-title="Titulo">' . json_decode($entry['title'], true)['es'] . '</td>
					<td data-title="Fecha">' . $entry['date'] . '</td>
					<td data-title="Autor">' . $author['username'] . '</td>
					<td data-title="popular_home">' . (empty($entry['popular_home']) ? '<span>No destacado</span>' : $entry['popular_home']) . '</td>
					<td data-title="location">' . $location['title'] . '</td>
					<td class="text-right">
						<a href="" data-action="getPopularToEdit" data-id="' . $entry['id_entry'] . '"><i class="material-icons">flag</i></a>
						<a href="index.php?c=blog&m=editEntry&p=' . $entry['id_entry'] . '"><i class="material-icons">edit</i></a>
					</td>
				</tr>';
			}

			foreach ($entries2 as $entry)
			{
				$location = $this->model->getEntryLocation($entry['id_location']);
				$author	= $this->model->getEntryAuthor($entry['id_website_user']);

				$list2 .=
				'<tr>
				<td><input type="checkbox" data-check value="' . $entry['id_entry'] . '" /></td>
					<td data-title="Titulo">' . json_decode($entry['title'], true)['es'] . '</td>
					<td data-title="Fecha">' . $entry['date'] . '</td>
					<td data-title="Autor">' . $author['username'] . '</td>
					<td data-title="popular_blog">' . (empty($entry['popular_blog']) ? '<span>No destacado</span>' : $entry['popular_blog']) . '</td>
					<td data-title="location">' . $location['title'] . '</td>
					<td class="text-right">
						<a href="" data-action="getPopularToEdit" data-id="' . $entry['id_entry'] . '"><i class="material-icons">flag</i></a>
						<a href="index.php?c=blog&m=editEntry&p=' . $entry['id_entry'] . '"><i class="material-icons">edit</i></a>
					</td>
				</tr>';
			}

			$replace = [
				'{$list1}' => $list1,
				'{$list2}' => $list2,
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}

	/* Obtener destacados de articulo del blog para editar
	--------------------------------------------------------------------------- */
	public function getPopularToEdit($id_entry)
	{
		if (Session::getValue('level') > 8)
		{
			if (Format::existAjaxRequest() == true)
			{
				$entry = $this->model->getEntry($id_entry);

				if (!empty($entry))
	            {
	                echo json_encode([
						'status' => 'success',
						'data' => $entry
					]);
	            }
				else
				{
					echo json_encode([
						'status' => 'error',
						'message' => 'Articulo del blog no encontrada'
					]);
				}
			}
			else
				Errors::http('404');
		}
		else
			header('Location: /');
	}

	public function addEntry()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$seo_keywords		= $_POST['seo-keywords'];
				$seo_description	= $_POST['seo-description'];
				$link				= isset($_POST["link"]) ? $_POST["link"] : "";
				$title['es']		= isset($_POST["title"]) ? $_POST["title"] : "";
				$title['en']		= isset($_POST["title_en"]) ? $_POST["title_en"] : "";
				$description['es']	= isset($_POST["description"]) ? $_POST["description"] : "";
				$description['en']	= isset($_POST["description_en"]) ? $_POST["description_en"] : "";
				$popular_blog		= (isset($_POST["popular_blog"]) AND !empty($_POST["popular_blog"])) ? $_POST["popular_blog"] : null;
				$popular_home		= (isset($_POST["popular_home"]) AND !empty($_POST["popular_home"])) ? $_POST["popular_home"] : null;
				$location			= (isset($_POST["location"]) AND !empty($_POST["location"])) ? $_POST["location"] : null;

				if(empty($location))
					$message = 'Seleccione la zona';

				if (isset($popular_blog) AND !is_numeric($popular_blog))
					$message = 'Dato incorrecto 1';
				else if (isset($popular_blog) AND $popular_blog < 1)
					$message = 'Dato incorrecto 2';

				if (isset($popular_home) AND !is_numeric($popular_home))
					$message = 'Dato incorrecto 1';
				else if (isset($popular_home) AND $popular_home < 1)
					$message = 'Dato incorrecto 2';

				if(empty($description['es']))
					$message = 'Ingrese una descripción';

				if(empty($title['es']))
					$message = 'Ingrese el titulo';

				if(empty($link))
					$message = 'Seleccione la imagen';

				if(!isset($message))
				{
					$link		= $this->model->createImage(str_replace(' ', '+', $link), PATH_IMAGES);
					$newEntry	 = $this->model->newEntry($seo_keywords, $seo_description, $title, $description, $link, $popular_blog, $popular_home, $location);

					if(!empty($newEntry))
					{
						echo json_encode([
							'status' => 'success',
							'path' => 'index.php?c=blog'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'Error al insertar el registro'
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

				$template = $this->view->render($this, 'addEntry');
				$template = $this->format->replaceFile($template, 'topbar');
				$template = $this->format->replaceFile($template, 'sidebar');

				$locations	= $this->model->getLocations();

				$locationsList	= '';

				foreach ($locations as $location)
				{
					$locationsList .=
					'<option value="' . $location['id_location'] . '" />' . $location['title'] . '</option>';
				}

				$replace = [
					'{$locationsList}' => $locationsList
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
	}

	/* editar pupular de cada Articulo
	--------------------------------------------------------------------------- */
	public function editPopular($id_entry)
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$popular_blog = (isset($_POST["popular_blog"]) AND !empty($_POST["popular_blog"])) ? $_POST["popular_blog"] : null;
				$popular_home = (isset($_POST["popular_home"]) AND !empty($_POST["popular_home"])) ? $_POST["popular_home"] : null;

				if (isset($popular_blog) AND !is_numeric($popular_blog))
					$message = 'Ingrese únicamente datos numéricos';
				else if (isset($popular_blog) AND $popular_blog < 1)
					$message = 'Dato no válido';

				if (isset($popular_home) AND !is_numeric($popular_home))
					$message = 'Ingrese únicamente datos numéricos';
				else if (isset($popular_home) AND $popular_home < 1)
					$message = 'Dato no válido';

				if(!isset($message))
				{
					$query = $this->model->editPopular($id_entry, $popular_blog, $popular_home);

					if(!empty($query))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'success',
							'message' => 'Error en la operación a la base de datos'
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
	}

	public function editEntry($id_entry)
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$seo_keywords		= $_POST['seo-keywords'];
				$seo_description	= $_POST['seo-description'];
				$link				= isset($_POST["link"]) ? $_POST["link"] : "";
				$title['es']		= isset($_POST["title"]) ? $_POST["title"] : "";
				$title['en']		= isset($_POST["title_en"]) ? $_POST["title_en"] : "";
				$description['es']	= isset($_POST["description"]) ? $_POST["description"] : "";
				$description['en']	= isset($_POST["description_en"]) ? $_POST["description_en"] : "";
				// $popular_blog		= (isset($_POST["popular_blog"]) AND !empty($_POST["popular_blog"])) ? $_POST["popular_blog"] : null;
				$location			= (isset($_POST["location"]) AND !empty($_POST["location"])) ? $_POST["location"] : null;

				if(empty($location))
					$message = 'Seleccione la zona';

				// if (isset($popular_blog) AND !is_numeric($popular_blog))
				// 	$message = 'Dato incorrecto 1';
				// else if (isset($popular_blog) AND $popular_blog < 1 OR isset($popular_blog) AND $popular_blog > 100)
				// 	$message = 'Dato incorrecto 2';

				if(empty($description['es']))
					$message = 'Ingrese una descripción';

				if(empty($title['es']))
					$message = 'Ingrese el titulo';

				if(!isset($message))
				{
					if(empty($link))
					{
						$entry	= $this->model->getEntry($id_entry);
						$link	= $entry['cover'];
					}
					else
					{
						$link = $this->model->createImage(str_replace(' ', '+', $link), PATH_IMAGES);
					}

					$title = json_encode($title);
					$description = json_encode($description);
					$editEntry	= $this->model->editEntry($seo_keywords, $seo_description, $id_entry, $title, $description, $link, $popular_blog, $location);

					if(!empty($editEntry))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'Error al insertar el registro'
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

				$template = $this->view->render($this, 'editEntry');
				$template = $this->format->replaceFile($template, 'topbar');
				$template = $this->format->replaceFile($template, 'sidebar');

				$entry	= $this->model->getEntry($id_entry);
				$author	= $this->model->getEntryAuthor($entry['id_website_user']);
				$entry['title'] 	  = json_decode($entry['title'], true);
				$entry['description'] = json_decode($entry['description'], true);

				$locations	= $this->model->getLocations();

				$locationsList	= '';

				foreach ($locations as $location)
 				{
 					$locationsList .=
 					'<option value="' . $location['id_location'] . '" ' . (($entry['id_location'] == $location['id_location']) ? 'selected' : '') . ' />' . $location['title'] . '</option>';
 				}

				$replace = [
					'{$cover}' => '{$path.images}' . $entry['cover'],
					'{$title_es}' => $entry['title']['es'],
					'{$title_en}' => $entry['title']['en'],
					'{$description_es}' => $entry['description']['es'],
					'{$description_en}' => $entry['description']['en'],
					'{$date}' => $entry['date'],
					'{$author}' => $author['username'],
					'{$popular}' => $entry['popular_blog'],
					'{$locationsList}' => $locationsList,
					'{$seo_keywords}' => $entry['seo_keywords'],
					'{$seo_description}' => $entry['seo_description']
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
	}

	public function deleteEntries()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$data = (isset($_POST['data']) AND !empty($_POST['data'])) ? $_POST['data'] : '';

				if(empty($data))
					$message = 'Seleccionar las entradas a eliminar';

				if(!isset($message))
				{
					$data = json_decode($data);
					$data = $this->model->deleteEntries($data);

					if(!empty($data))
					{
						echo json_encode([
							'status' => 'success'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'success',
							'message' => 'Error to delete entries'
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
	}
}
