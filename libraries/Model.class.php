<?php
defined('_EXEC') or die;

class Model
{
	public $database;
	public $security;
	public $module;
	public $component;

	public function __construct()
	{
		if(Configuration::$db_state === true)
			$this->database  = new Medoo;
		$this->security  = new Security;
		$this->module 	 = new Modules;
		$this->component = new Components;
	}

}
