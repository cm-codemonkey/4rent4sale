<?php
defined('_EXEC') or die;

class Subscriptions_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function getSubscriptions()
	{
		$query = $this->database->select('subscriptions', '*', ['ORDER' => 'id_subscription DESC']);
		return $query;
	}
}
