<?php

defined('_EXEC') or die;

/**
* @package valkyrie.core.models
*
* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
* @since October 17, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary create magazines model
*
* @author Julian Alberto Canche Dzib <Software Development, jcanche@codemonkey.com.mx>
* @since October 24, 2018 <1.0.0> <@update>
* @summary Create function get_magazines, get_user_by_id, get_gallery_by_magazine.
*
* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
* @since October 25 - October 29, 2018 <1.0.0> <@update>
* @summary Datos dinámico de titulo y background,
* Crear funcion de get_contact
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

class Magazine_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Selects
	------------------------------------------------------------------------------- */
	public function get_magazine_articles()
	{
		$array = [];

		$query1 = $this->database->select('magazine', [
			'id_magazine_article',
			'name',
			'date',
			'background'
		], [
			'priority[>=]' => 1,
			'ORDER' => ['priority' => 'ASC']
		]);

		$query2 = $this->database->select('magazine', [
			'id_magazine_article',
			'name',
			'date',
			'background'
		], [
			'priority[=]' => null
		]);

		foreach ($query1 as $row)
			array_push($array, $row);

		foreach ($query2 as $row)
			array_push($array, $row);

		return $array;
	}

	public function get_magazine_by_id($id_magazine_article)
	{
		$query = $this->database->select('magazine', '*', ['id_magazine_article' => $id_magazine_article]);
		return !empty($query) ? $query[0] : '';
	}

	public function get_user_by_id($id_user)
	{
		$query = $this->database->select('users', '*', [
			'id_user' => $id_user
		]);

		return $query[0];
	}

	public function get_gallery_by_magazine($id_magazine_article)
	{
		$query = $this->database->select('gallery', '*', [
			'id_magazine_article' => $id_magazine_article
		]);

		return $query;
	}

	public function get_settings()
	{
		$query = $this->database->select('settings', [
			'titles',
			'backgrounds'
		]);

		return !empty($query[0]) ? $query[0] : null;
	}

	public function get_contact()
	{
		$query = $this->database->select('contact', '*');
		return !empty($query) ? $query[0] : null;
	}

	/* Inserts
	------------------------------------------------------------------------------- */

	/* Updates
	------------------------------------------------------------------------------- */

	/* Deletes
	------------------------------------------------------------------------------- */

	/* Others
	------------------------------------------------------------------------------- */

}
