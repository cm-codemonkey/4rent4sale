<?php defined('_EXEC') or die;

class Services_controller extends Controller
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

			$services = $this->model->getServices();

			$servicesList = '';

			foreach ($services as $service)
			{
				$servicesList .=
				'<tr>
				<td><input type="checkbox" data-check value="' . $service['id_service'] . '" /></td>
					<td data-title="Titulo">' . $service['title'] . '</td>
					<td class="text-right">
						<a href="index.php?c=services&m=editService&p=' . $service['id_service'] . '"><i class="material-icons">edit</i></a>
					</td>
				</tr>';
			}

			$replace = [
				'{$servicesList}' => $servicesList
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}

	public function addService()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$title				= isset($_POST["title"]) ? $_POST["title"] : "";
				$description		= isset($_POST["description"]) ? $_POST["description"] : "";

				if(empty($description))
					$message = 'Ingrese una descripción';

				if(empty($title))
					$message = 'Ingrese el titulo';

				if(!isset($message))
				{
					$newService = $this->model->newService($title, $description);

					if(!empty($newService))
					{
						echo json_encode([
							'status' => 'success',
							'path' => 'index.php?c=services'
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

				$template = $this->view->render($this, 'addService');
				$template = $this->format->replaceFile($template, 'topbar');
				$template = $this->format->replaceFile($template, 'sidebar');

				echo $template;
			}
		}
	}

	public function editService($id_service)
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$title		    = isset($_POST["title"]) ? $_POST["title"] : "";
				$description    = isset($_POST["description"]) ? $_POST["description"] : "";

				if(empty($description))
					$message = 'Ingrese una descripción';

				if(empty($title))
					$message = 'Ingrese el titulo';

				if(!isset($message))
				{
					$editService = $this->model->editService($id_service, $title, $description);

					if(!empty($editService))
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

				$template = $this->view->render($this, 'editService');
				$template = $this->format->replaceFile($template, 'topbar');
				$template = $this->format->replaceFile($template, 'sidebar');

				$service = $this->model->getService($id_service);

				$replace = [
					'{$title}' => $service['title'],
					'{$description}' => $service['description']
				];

				$template = $this->format->replace($replace, $template);

				echo $template;
			}
		}
	}

	public function deleteServices()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$data = (isset($_POST['data']) AND !empty($_POST['data'])) ? $_POST['data'] : '';

				if(empty($data))
					$message = 'Seleccionar los servicios a eliminar';

				if(!isset($message))
				{
					$data = json_decode($data);
					$data = $this->model->deleteServices($data);

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
							'message' => 'Error to delete services'
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
