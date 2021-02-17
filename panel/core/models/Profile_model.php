<?php
defined('_EXEC') or die;

class Profile_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getProfile()
	{
		$query = $this->database->select('website_users', '*', ['id_website_user' => Session::getValue("id_user")]);
		return $query[0];
	}

	public function editProfile($username)
	{
		$query = $this->database->update('website_users', [
			'username' => $username
		], ['id_website_user' => Session::getValue("id_user")]);

		return $query;
	}

    public function resetPassword($password)
	{
		$query = $this->database->update('website_users', [
			'password' => $password
		], ['id_website_user' => Session::getValue("id_user")]);

		return $query;
	}
}
