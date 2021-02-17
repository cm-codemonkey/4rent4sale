<?php defined('_EXEC') or die;

class Users_model extends Model
{
    public function __construct()
	{
		parent::__construct();
	}

  public function getUsersList()
  {
    $query = $this->database->select('website_users', '*');
    return $query;
  }

  public function getUser($id)
  {
	$query = $this->database->select('website_users', '*', ['id_website_user' => $id]);
	return $query[0];
  }

  public function newUser($name, $description, $username, $password, $email, $level)
  {
	$query = $this->database->insert('website_users', [
		'name' => $name,
		'description' => $description,
		'username' => $username,
		'password' => $password,
		'email' => $email,
		'level' => $level
	]);
    return $query;
  }

  public function editUser($id, $name, $description, $username, $email, $level)
	{
	$query = $this->database->update('website_users', [
        'name' => $name,
		'description' => $description,
		'username' => $username,
		'email' => $email,
		'level' => $level
	], ['id_website_user' => $id]);
    return $query;
	}

  public function editPassword($id, $password)
  {
  $query = $this->database->update('website_users', [
		'password' => $password
	], ['id_website_user' => $id]);
    return $query;
    }

  public function deleteUser($data)
  {
  $query = $this->database->delete("website_users", [
    'id_website_user' => $data
  ]);
    return $query;
  }

}
