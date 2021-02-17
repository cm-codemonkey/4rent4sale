<?php defined('_EXEC') or die;

class Services_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getServices()
	{
		$query = $this->database->select('services', '*');
		return $query;
	}

	public function getService($id_service)
	{
		$query = $this->database->select('services', '*', ['id_service' => $id_service]);
		return $query[0];
	}

	public function newService($title, $description)
	{
		$query = $this->database->insert('services', [
			'title' => $title,
			'description' => $description
		]);

		return $query;
	}

	public function editService($id_service, $title, $description)
	{
		$query = $this->database->update('services', [
			'title' => $title,
			'description' => $description
		], ['id_service' => $id_service]);

		return $query;
	}

	public function deleteServices($data)
	{
		$query = $this->database->delete('services', [
			'id_service' => $data
		]);

		return $query;
	}
}
