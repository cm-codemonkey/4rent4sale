<?php
defined('_EXEC') or die;

class System_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function login($user, $password)
	{
		$userData = $this->database->select('website_users', '*', [
			'OR' => [
				'username' => $user,
				'email' => $user
			]
		]);

		if(!empty( $userData ))
		{
			$parts = explode(':', $userData[0]['password']);
		    $checkPassword = ($this->security->createHash('sha1', $password . $parts[1]) === $parts[0])? true : false;

			if($checkPassword === true)
			{
				$token = base64_encode($this->security->getIp() . ' - ' . Format::getDateHour() . ' - ' . json_encode($this->security->browser()));

				$media  = json_decode( $userData[0]['media'] );
				$avatar = !empty( $media->avatar ) ? $media->avatar : 'empty_avatar.png';
				$cover  = !empty( $media->cover ) ? $media->cover : 'empty_cover.jpg';

				Session::init();
		        Session::setValue('token', 		 $token);
		        Session::setValue('id_user', 	 $userData[0]['id_website_user']);
		        Session::setValue('user', 		 $userData[0]['username']);
		        Session::setValue('level', 		 $userData[0]['level']);
		        Session::setValue('user_email',  $userData[0]['email']);
		        Session::setValue('lastAccess',	 Format::getDateHour());
		        Session::setValue('user_avatar', $avatar);
		        Session::setValue('user_cover',	 $cover);

				echo json_encode([
					'status' => 'successful'
				]);
			}
			else
			{
				echo json_encode([
					'status' => 'error',
					'field' => 'password',
					'message' => 'Password no coincide'
				]);
			}
		}
		else
		{
			echo json_encode([
				'status' => 'error',
				'field' => 'user',
				'message' => 'Usuario no existe'
			]);
		}
	}
	
}
