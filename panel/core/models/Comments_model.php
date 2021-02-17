<?php
defined('_EXEC') or die;

class Comments_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function getComments()
	{
		$query = $this->database->select('comments', '*', ['ORDER' => 'id_comment DESC']);
		return $query;
	}

	public function getComment($id_comment)
	{
		$query = $this->database->select('comments', '*', ['id_comment' => $id_comment]);
		return $query[0];
	}

	public function editComment($id_comment, $comment)
	{
		$query = $this->database->update('comments', [
			'description' => htmlentities($comment, ENT_QUOTES | ENT_IGNORE, 'UTF-8')
		], ['id_comment' => $id_comment]);

		return $query;
	}

	public function visibleComment($id_comment)
	{
		$comment = $this->database->select('comments', '*', ['id_comment' => $id_comment]);
		$comment = $comment[0];

		$visible = ($comment['visible'] == false) ? true : false;

		$query = $this->database->update('comments', [
			'visible' => $visible
		], ['id_comment' => $id_comment]);

		return $query;
	}

	public function deleteComments($data)
	{
		$query = $this->database->delete('comments', [
			'id_comment' => $data
		]);

		return $query;
	}
}
