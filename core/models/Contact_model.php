<?php

defined('_EXEC') or die;

/**
* @package valkyrie.core.models
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
* @since October 24, 2018 <1.0.0> <@update>
* @summary Datos dinámico de titulo y background
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

class Contact_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Selects
	------------------------------------------------------------------------------- */
	public function get_contact()
	{
		$query = $this->database->select('contact', '*');
		return !empty($query) ? $query[0] : null;
	}

	public function get_settings()
	{
		$query = $this->database->select('settings', [
			'titles',
			'backgrounds'
		]);

		return !empty($query[0]) ? $query[0] : null;
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
