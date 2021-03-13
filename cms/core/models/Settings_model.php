<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.core.models
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
* @since October 09, 2018 <1.0.0> <@update>
* @version 1.0.0
* @summary Se integraron las funciones edit_titles, edit_backgrounds y uploader.
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

class Settings_model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* Selects
	------------------------------------------------------------------------------- */
	public function get_settings()
	{
        $query = $this->database->select('settings', '*');
		return !empty($query) ? $query[0] : null;
	}

	/* Inserts
	------------------------------------------------------------------------------- */

	/* Updates
	------------------------------------------------------------------------------- */
	public function edit_titles($titles)
	{
		$query = $this->database->update('settings', [
			'titles' => $titles
		]);

		return $query;
	}

	public function edit_backgrounds($backgrounds)
	{
		$query = $this->database->update('settings', [
			'backgrounds' => $backgrounds
		]);

		return $query;
	}

	/* Deletes
	------------------------------------------------------------------------------- */

	/* Others
	------------------------------------------------------------------------------- */
	public function uploader($src, $path = PATH_IMAGES)
	{
		list($type, $src)	= explode(';', $src);
		list(, $src)		= explode(',', $src);
		$src				= base64_decode($src);
		$name				= $this->security->random_string(32) . '.png';
		$file				= $path . $name;
		$success			= file_put_contents($file, $src);

		return $name;
	}
}
