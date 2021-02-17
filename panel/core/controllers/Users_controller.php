<?php defined('_EXEC') or die;

class Users_controller extends Controller
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

			$users = $this->model->getUsersList();

			$list = '';

			foreach ($users as $user)
			{
				$list .=
				'<tr>
	                <td><input type="checkbox" data-check value="' . $user['id_website_user'] . '" /></td>
	                <td data-title="Username">' . $user['username'] . '</td>
	                <td data-title="Email">' . $user['email'] . '</td>
					<td data-title="Level">' . $user['level'] . '</td>
					<td class="text-right">
						<a href="index.php?c=users&m=editPassword&p=' . $user['id_website_user'] . '" class="btn md--btn-icon md--btn-flat"><i class="material-icons">lock</i></a>
						<a href="index.php?c=users&m=edit&p=' . $user['id_website_user'] . '" class="btn md--btn-icon md--btn-flat"><i class="material-icons">edit</i></a>
					</td>
	            </tr>';
			}

			$replace = [
				'{$list}' => $list
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
		else
		{
			header("Location: /administrator");
		}
	}

    public function add()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$name	        = isset($_POST["name"]) ? $_POST["name"] : "";
				$description	= isset($_POST["description"]) ? $_POST["description"] : "";
				$username		= isset($_POST["username"]) ? $_POST["username"] : "";
				$password 		= isset($_POST["password"]) ? $_POST["password"] : "";
				$email 			= isset($_POST["email"]) ? $_POST["email"] : "";
				$level 			= isset($_POST["level"]) ? $_POST["level"] : "";

				if($level < 1 OR $level > 10)
					$message = 'Nivel de acceso incorrecto';

	            if(empty($level))
	                $message = 'Seleccione un nivel de acceso';

				if(Security::checkMail($email) == false)
					$message = 'Email incorrecto';

	            if(strlen($email) > 100)
	                $message = 'Email muy largo. Máximo 100 caracteres';

	            if(empty($email))
	                $message = 'Ingrese un Email';

				if(strlen($password) < 6)
					$message = 'Contraseña muy corta. Mínimo 6 caracteres';

	            if(empty($password))
	                $message = 'Ingrese una contraseña';

				if(strlen($username) < 4)
					$message = 'Usuario muy corto. Mínimo 4 caracteres';

	            if(strlen($username) > 15)
	                $message = 'Usuario muy largo. Máximo 15 caracteres';

	            if(empty($username))
	                $message = 'Ingrese un nombre de usuario';

				if(!isset($message))
				{
					$password = $this->security->createPassword($password);

					$user = $this->model->newUser($name, $description, $username, $password, $email, $level);

					if(!empty($user))
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
		}
		else
		{
			header("Location: /administrator");
		}
	}

	public function edit($id)
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				$name			= isset($_POST["name"]) ? $_POST["name"] : "";
				$description	= isset($_POST["description"]) ? $_POST["description"] : "";
				$username		= isset($_POST["username"]) ? $_POST["username"] : "";
				$email 			= isset($_POST["email"]) ? $_POST["email"] : "";
				$level 			= isset($_POST["level"]) ? $_POST["level"] : "";

	            if($level < 1 OR $level > 10)
					$message = 'Nivel de acceso incorrecto';

	            if(empty($level))
	                $message = 'Seleccione un nivel de acceso';

				if(Security::checkMail($email) == false)
					$message = 'Email incorrecto';

	            if(strlen($email) > 100)
	                $message = 'Email muy largo. Máximo 100 caracteres';

	            if(empty($email))
	                $message = 'Ingrese un Email';

				if(strlen($username) < 4)
					$message = 'Usuario muy corto. Mínimo 4 caracteres';

	            if(strlen($username) > 15)
	                $message = 'Usuario muy largo. Máximo 15 caracteres';

	            if(empty($username))
	                $message = 'Ingrese un nombre de usuario';

				if(!isset($message))
				{
					$user = $this->model->editUser($id, $name, $description, $username, $email, $level);

					if(!empty($user))
					{
						echo json_encode([
							'status' => 'success',
							'path' => 'index.php?c=users'
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

	    		$template = $this->view->render($this, 'edit');
				$template = $this->format->replaceFile($template, 'topbar');
	    		$template = $this->format->replaceFile($template, 'sidebar');

	    		$user = $this->model->getUser($id);

	            $level = '';

				for ($i = 1; $i <= 10; $i++)
				{
					if ($i == $user['level'])
					{
						$level .=
						'<option value="' . $i . '" selected="selected">' . $i . '</option>';
					}
					else
					{
						$level .=
						'<option value="' . $i . '">' . $i . '</option>';
					}
				}

	    		$replace = [
	    			'{$name}' => ( isset($user['name']) ) ? $user['name'] : '',
	    			'{$description}' => ( isset($user['description']) ) ? $user['description'] : '',
	    			'{$username}' => $user['username'],
	    			'{$email}' => $user['email'],
	    			'{$level}' => $level
	    		];

	    		$template = $this->format->replace($replace, $template);

	    		echo $template;
	        }
		}
		else
		{
			header("Location: /administrator");
		}
	}

	public function editPassword($id)
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
	            $id         = isset($_POST["id"]) ? $_POST["id"] : "";
				$password 	= isset($_POST["password"]) ? $_POST["password"] : "";

	            if(empty($id))
	                $message = 'Error. Intente nuevamente';

	            if(strlen($password) < 6)
					$message = 'Contraseña muy corta. Mínimo 6 caracteres';

	            if(empty($password))
	                $message = 'Ingrese una contraseña';

				if(!isset($message))
				{
					$password = $this->security->createPassword($password);

	                $user = $this->model->editPassword($id, $password);

					if(!empty($user))
					{
						echo json_encode([
							'status' => 'success',
							'path' => 'index.php?c=users'
						]);
					}
					else
					{
						echo json_encode([
							'status' => 'error',
							'message' => 'Error al actulizar el registro'
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

	    		$template = $this->view->render($this, 'editPassword');
				$template = $this->format->replaceFile($template, 'topbar');
	    		$template = $this->format->replaceFile($template, 'sidebar');

	            $user = $this->model->getUser($id);

	            $replace = [
	                '{$id}' => $id
	            ];

	            $template = $this->format->replace($replace, $template);

	    		echo $template;
	        }
		}
		else
		{
			header("Location: /administrator");
		}
	}

	public function delete()
	{
		if(Session::getValue('level') > 8)
		{
			if(Format::existAjaxRequest() == true)
			{
				if(isset($_POST['data']) && !empty($_POST['data']))
				{
					$data = json_decode($_POST['data']);

					$this->model->deleteUser($data);

					echo json_encode([
						'status' => 'success'
					]);
				}
			}
		}
		else
		{
			header("Location: /administrator");
		}
	}
}
