<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.core.controllers
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

class Users_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Ajax 1: Create or edit user and restore password
	** Ajax 2: Get user
	** Ajax 3: Deactivate or activate user
	** Ajax 4: Delete users selection
	** Render: Users page
    ------------------------------------------------------------------------------- */
	public function index()
	{
		if (Format::exist_ajax_request() == true)
		{
			$action	= $_POST['action'];

			if ($action == 'new' OR $action == 'edit' OR $action == 'restore')
			{
				$id_user = ($action == 'edit' OR $action == 'restore') ? $_POST['id_user'] : null;

				$fullname = (isset($_POST['fullname']) AND !empty($_POST['fullname'])) ? $_POST['fullname'] : null;
				$email = (isset($_POST['email']) AND !empty($_POST['email'])) ? $_POST['email'] : null;
				$username = (isset($_POST['username']) AND !empty($_POST['username'])) ? $_POST['username'] : null;
				$password = (isset($_POST['password']) AND !empty($_POST['password'])) ? $_POST['password'] : null;
				$level = (isset($_POST['level']) AND !empty($_POST['level'])) ? $_POST['level'] : null;
				$avatar = (isset($_FILES['avatar']['name']) AND !empty($_FILES['avatar']['name'])) ? $_FILES['avatar'] : null;
				$status = (isset($_POST['status']) AND !empty($_POST['status'])) ? true : false;

				$errors = [];

				if ($action == 'new' AND !isset($fullname) OR $action == 'edit' AND !isset($fullname))
					array_push($errors, ['fullname', 'No deje este campo vacío']);

				if ($action == 'new' AND isset($email) AND Functions::check_email($email) == false)
					array_push($errors, ['email', 'Dato inválido']);
				else if ($action == 'edit' AND isset($email) AND Functions::check_email($email) == false)
					array_push($errors, ['email', 'Dato inválido']);

				if ($action == 'new' AND !isset($username) OR $action == 'edit' AND !isset($username))
					array_push($errors, ['username', 'No deje este campo vacío']);
				else if ($action == 'new' AND strlen($username) < 4 OR $action == 'edit' AND strlen($username) < 4)
					array_push($errors, ['username', 'Ingrese mínimo 4 carácteres']);

				if ($action == 'new' AND !isset($password) OR $action == 'restore' AND !isset($password))
					array_push($errors, ['password', 'No deje este campo vacío']);
				else if ($action == 'new' AND strlen($password) < 4 OR $action == 'restore' AND strlen($password) < 4)
					array_push($errors, ['password', 'Ingrese mínimo 4 caracteres']);

				if ($action == 'new' AND !isset($level) OR $action == 'edit' AND !isset($level))
					array_push($errors, ['level', 'No deje este campo vacío']);

				if (empty($errors))
				{
					$user = [
						'id_user' => $id_user,
						'fullname' => $fullname,
						'email' => strtolower($email),
						'username' => strtolower($username),
						'password' => $this->security->create_password($password),
						'level' => $level,
						'avatar' => $avatar,
						'status' => $status
					];

					$exist = $this->model->get_if_exist_user($id_user, $user['username'], $action);

					if ($action == 'new' AND $exist['status'] == true OR $action == 'edit' AND $exist['status'] == true)
					{
						if ($exist['errors']['username_error'] == true)
							array_push($errors, ['username', 'Este registro ya existe']);

						echo json_encode([
							'status' => 'error',
							'labels' => $errors
						]);
					}
					else
					{
						if ($action == 'new')
							$query = $this->model->new_user($user);
						else if ($action == 'edit')
							$query = $this->model->edit_user($user);
						else if ($action == 'restore')
							$query = $this->model->restore_user_password($user);

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
					echo json_encode([
						'status' => 'error',
						'labels' => $errors
					]);
				}
			}

			if ($action == 'get')
			{
				$user = $this->model->get_user_by_id($_POST['id_user']);

				if (!empty($user))
				{
					echo json_encode([
						'status' => 'success',
						'data' => $user
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

			if ($action == 'deactivate')
			{
				$query = $this->model->deactivate_users(json_decode($_POST['data']));

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

			if ($action == 'delete')
			{
				$query = $this->model->delete_users(json_decode($_POST['data']));

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

			$users = $this->model->get_users();
			$users_levels = $this->model->get_users_levels();

			$lst_users = '';
			$lst_users_levels = '';

			foreach ($users as $user)
			{
				$lst_users .=
				'<tr>
					<td><input type="checkbox" data-check value="' . $user['id_user'] . '" /></td>
					<td><figure>' .((!empty($user['avatar'])) ? '<img src="../{$path.images}users/' . $user['avatar'] . '" />' : '<img src="../{$path.images}users/avatar.png" />') . '</figure></td>
					<td>' . $user['fullname'] . '</td>
					<td>' . $user['username'] . '</td>
					<td>' . $user['level'] . '</td>
					<td>' . (($user['status'] == true) ? '<span class="success">Activado</span>' : '<span class="alert">Desactivado</span>') . '</td>
					<td>
						<a data-action="get_user_to_edit" data-id="' . $user['id_user'] . '"><i class="material-icons">menu</i><span>Detalles / Editar</span></a>
						<a data-action="get_user_to_edit" data-id="' . $user['id_user'] . '" data-restore><i class="material-icons">lock</i><span>Restablecer contraseña</span></a>
						<div class="clear"></div>
					</td>
				</tr>';
			}

			foreach ($users_levels as $user_level)
			{
				$lst_users_levels .=
				'<option value="' . $user_level['id_user_level'] . '">' . $user_level['name'] . '</option>';
			}

			$replace = [
				'{$lst_users}' => $lst_users,
				'{$lst_users_levels}' => $lst_users_levels
			];

			$template = $this->format->replace($replace, $template);

			echo $template;
		}
	}
}
