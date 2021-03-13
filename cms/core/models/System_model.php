<?php
defined('_EXEC') or die;

class System_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function login( $data )
	{
		$user = $this->database->select("users", [
			"[>]users_levels" => [
				"id_user_level" => "id_user_level"
			]
		], [
			"users.id_user",
			"users.username",
			"users.password",
			"users_levels.code"
		], [
			"users.username" => $data['username']
		]);

		if ( isset($user[0]) && !empty($user[0]) )
		{
			$crypto = explode(':', $user[0]['password']);
			$check_password = ( $this->security->create_hash('sha1', $data['password'] . $crypto[1]) === $crypto[0] ) ? true : false;

			if ( $check_password == true )
			{
				$token = $this->security->random_string(16);

				Session::create_session_login([
					'token' => $token,
					'id_user' => $user[0]['id_user'],
					'username' => $user[0]['username'],
					'level' => $user[0]['code'],
					'last_access' => Format::get_date_hour()
				]);

				echo json_encode([
					"status" => "success",
					"redirect" => User_level_vkye_adm::login_redirect($user[0]['code'])
				]);
			}
			else
			{
				echo json_encode([
					'status' => 'error',
					'labels' => [
						['password', 'La contraseña es incorrecta.']
					]
				]);
			}
		}
		else
		{
			echo json_encode([
				'status' => 'error',
				'labels' => [
					['username', 'El usuario no existe.']
				]
			]);
		}
	}
}
