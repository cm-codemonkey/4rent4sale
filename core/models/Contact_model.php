<?php defined('_EXEC') or die;

class Contact_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getMetadata()
	{
		$response = $this->database->select('metadata', [
			'description',
			'keywords'
		], [
			'ORDER' => 'id_metadata DESC',
			'LIMIT' => 1
		]);

		if ( isset($response[0]) && !empty($response[0]) )
			return $response[0];
		else
			return null;
	}

	public function getConfigurations()
    {
      $query = $this->database->select('general_configurations', '*', ['id_configuration' => 1]);
      return $query[0];
    }

	public function getContact()
	{
		$query = $this->database->select('general_configurations', '*');
		return $query[0];
	}

	public function sendEmail($subject, $html, $to, $from)
	{
		$this->component->loadComponent('phpmailer');

		send_email(
			[
				$to[0] => $to[1]
			],
			[
				$from[0],
				$from[1]
			],
			FALSE,
			FALSE,
			FALSE,
			FALSE,
			$subject,
			$html,
			FALSE
		);
	}

	/*
	/* --------------------------------------------------------------------------- */
	public function getLocations()
	{
		$query = $this->database->select('properties_locations', '*');
		return $query;
	}
}
