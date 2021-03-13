<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.core.models
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

class Users_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Selects
	------------------------------------------------------------------------------- */
	public function get_users()
	{
		$query = $this->database->select('users', [
			'[>]users_levels' => [
				'id_user_level' => 'id_user_level'
			]
		], [
			'users.id_user',
			'users.fullname',
			'users.username',
			'users_levels.name(level)',
			'users.avatar',
			'users.status'
		], [
			'ORDER' => [
				'id_user' => 'DESC'
			]
		]);

		return $query;
	}

	public function get_user_by_id($id_user)
	{
		$query = $this->database->select('users', '*', [
			'id_user' => $id_user
		]);

		return !empty($query) ? $query[0] : null;
	}

	public function get_if_exist_user($id_user, $username, $action)
	{
        $users = $this->database->select('users', ['id_user', 'username'], ['username' => $username]);

		if (!empty($users))
		{
			$username_error = false;

			foreach ($users as $user)
			{
				if ($action == 'new' AND $username == $user['username'])
					$username_error = true;
				else if ($action == 'edit' AND $username == $user['username'] AND $id_user != $user['id_user'])
					$username_error = true;
			}

			if ($username_error == true)
				return ['status' => true, 'errors' => ['username_error' => $username_error]];
			else
				return ['status' => false];
		}
		else
			return ['status' => false];
	}

	public function get_users_levels()
	{
		$query = $this->database->select('users_levels', [
			'id_user_level',
			'name'
		]);

		return $query;
	}

	/* Inserts
    ------------------------------------------------------------------------------- */
	public function new_user($user)
	{
		$avatar = $user['avatar'];

		if (isset($avatar))
		{
			$this->component->load_component('uploader');

			$_com_uploader = new Upload;
			$_com_uploader->SetFileName($avatar['name']);
			$_com_uploader->SetTempName($avatar['tmp_name']);
			$_com_uploader->SetFileType($avatar['type']);
			$_com_uploader->SetFileSize($avatar['size']);
			$_com_uploader->SetUploadDirectory(PATH_IMAGES . 'users');
			$_com_uploader->SetValidExtensions(['png', 'jpg', 'jpeg']);
			$_com_uploader->SetMaximumFileSize('unlimited');

			$avatar = $_com_uploader->UploadFile();
		}

        if ($avatar['status'] == 'success' OR !isset($avatar))
		{
			if ($avatar['status'] == 'success')
				$avatar = $avatar['file'];

			$query = $this->database->insert('users', [
				'fullname' => $user['fullname'],
				'email' => $user['email'],
				'username' => $user['username'],
				'password' => $user['password'],
				'id_user_level' => $user['level'],
				'avatar' => $avatar,
				'status' => $user['status']
			]);

            return $query;
		}
		else
			return null;
	}

	/* Updates
    ------------------------------------------------------------------------------- */
	public function edit_user($user)
	{
		$avatar = $user['avatar'];

		if (isset($avatar))
		{
			$this->component->load_component('uploader');

			$_com_uploader = new Upload;
			$_com_uploader->SetFileName($avatar['name']);
			$_com_uploader->SetTempName($avatar['tmp_name']);
			$_com_uploader->SetFileType($avatar['type']);
			$_com_uploader->SetFileSize($avatar['size']);
			$_com_uploader->SetUploadDirectory(PATH_IMAGES . 'users');
			$_com_uploader->SetValidExtensions(['png', 'jpg', 'jpeg']);
			$_com_uploader->SetMaximumFileSize('unlimited');

			$avatar = $_com_uploader->UploadFile();
		}

        if ($avatar['status'] == 'success' OR !isset($avatar))
		{
			if (!isset($avatar))
			{
				$avatar = $this->database->select('users', ['avatar'], ['id_user' => $user['id_user']]);
				$avatar = !empty($avatar[0]['avatar']) ? $avatar[0]['avatar'] : null;
			}
			else if ($avatar['status'] == 'success')
				$avatar = $avatar['file'];

			$query = $this->database->update('users', [
				'fullname' => $user['fullname'],
				'email' => $user['email'],
				'username' => $user['username'],
				'id_user_level' => $user['level'],
				'avatar' => $avatar,
				'status' => $user['status']
			], [
				'id_user' => $user['id_user']
			]);

            return $query;
		}
		else
			return null;
	}

	public function restore_user_password($user)
	{
		$query = $this->database->update('users', [
			'password' => $user['password']
		], [
			'id_user' => $user['id_user']
		]);

		return $query;
	}

	public function deactivate_users($users)
    {
		foreach ($users as $user)
		{
			$query = $this->database->select('users', ['status'], ['id_user' => $user])[0];
			$query = $this->database->update('users', ['status' => ($query['status'] == true) ? false : true], ['id_user' => $user]);
		}

        return true;
    }

	/* Deletes
    ------------------------------------------------------------------------------- */
	public function delete_users($users)
    {
		$query = $this->database->delete('users', [
            'id_user' => $users
        ]);

        return $query;
    }

	/* Others
    ------------------------------------------------------------------------------- */

}
