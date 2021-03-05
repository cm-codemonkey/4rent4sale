<?php
defined('_EXEC') or die;

class Format
{
	private $security;

	public function __construct()
	{
		$this->security = new Security();
	}

	public static function getDateHour()
	{
		date_default_timezone_set(Configuration::$timeZone);

		return date('Y-m-d h:i:s', time());
	}

	public function checkAdmin($urlAdmin, $url)
	{
		return ( $this->adminPath() === true ) ? $this->security->directorySeparator($urlAdmin) : $this->security->directorySeparator($url);
	}

	public function adminPath()
	{
		$cwd = $this->security->directorySeparator(getcwd());
		$pathAdministrator = $this->security->directorySeparator(PATH_ADMINISTRATOR);

		if($cwd === $pathAdministrator)
			return true;
		else
			return false;
	}

    public function imagesBase64($image)
    {
        $type = pathinfo($image, PATHINFO_EXTENSION);
        return 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($image));
    }

    public static function elapsed($hour, $compare)
    {
        $start_date = new DateTime($hour);
        $since_start = $start_date->diff(new DateTime($compare));

        if($since_start->d == 1)
            return Language::getLang('{$lang.state_time}', 'System') . ' ' . $since_start->d . ' ' . Language::getLang('{$lang.day_ago}', 'System');
        if($since_start->d > 1)
            return Language::getLang('{$lang.state_time}', 'System') . ' ' . $since_start->d . ' ' . Language::getLang('{$lang.days_ago}', 'System');

        if($since_start->h == 1)
            return Language::getLang('{$lang.state_time}', 'System') . ' ' . $since_start->h . ' ' . Language::getLang('{$lang.hour_ago}', 'System');
        if($since_start->h > 1)
            return Language::getLang('{$lang.state_time}', 'System') . ' ' . $since_start->h . ' ' . Language::getLang('{$lang.hours_ago}', 'System');

        if($since_start->i == 1)
            return Language::getLang('{$lang.state_time}', 'System') . ' ' . $since_start->i . ' ' . Language::getLang('{$lang.minute_ago}', 'System');
        if($since_start->i > 1)
            return Language::getLang('{$lang.state_time}', 'System') . ' ' . $since_start->i . ' ' . Language::getLang('{$lang.minutes_ago}', 'System');

        if($since_start->s == 1)
            return Language::getLang('{$lang.state_time}', 'System') . ' ' . $since_start->s . ' ' . Language::getLang('{$lang.second_ago}', 'System');
        if($since_start->s > 1)
            return Language::getLang('{$lang.state_time}', 'System') . ' ' . $since_start->s . ' ' . Language::getLang('{$lang.seconds_ago}', 'System');
    }

	public static function existAjaxRequest()
	{
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
		    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
			return true;
		return false;
	}

	public static function dieAjax()
	{
		if (self::existAjaxRequest() == TRUE)
			die();
	}

	public function replace($arr, $string)
    {
        return str_replace(array_keys($arr), array_values($arr), $string);
    }

	public function replaceFile($data, $file, $path = false)
	{
		if($path === FALSE)
			$path = $this->checkAdmin(PATH_ADMINISTRATOR_LAYOUTS, PATH_LAYOUTS);

		$route = $path . $file . '.php';

		if(file_exists($route))
		{
			ob_start();

			require_once $route;

			$buffer = ob_get_contents();

			ob_end_clean();

			return str_replace('%{' . $file . '}%', $buffer, $data);
		}
	}

	public function shortenText($text, $length)
	{
		$shortenText = substr(strip_tags($text), 0, $length);

		if(strlen(strip_tags($text)) > $length)
			$shortenText .= '...';

		return $shortenText;
    }

	/**
	* Verifica si el path es del administrador.
	*
	* @static
	*
	* @return  boolean
	*/
	public static function check_path_admin()
	{
		$cwd = Security::DS(getcwd());
		$path_administrator = Security::DS(PATH_ADMINISTRATOR);

		return ( $cwd == $path_administrator ) ? true : false;
	}

	/**
	* Obtiene un fichero.
	*
	* @param	string    $file    Fichero
	*
	* @return  mixed
	*/
	public function get_file( $file = false, $arr = null )
	{
		if ( $file == false ) return null;

		$file = Security::DS($file);

		if ( file_exists($file) )
		{
			if ( !is_null($arr) )
			{
				foreach ( $arr as $key => $value ) global ${$key};
			}

			ob_start();

			require $file;

			$buffer = ob_get_contents();

			ob_end_clean();

			return $buffer;
		}
	}

	/**
	* Obtiene un fichero.
	*
	* @param	string    $path       Directorio del fichero.
	* @param	string	  $file_name  Nombre del fichero.
	* @param	string	  $file_type  Tipo de fichero.
	*
	* @return  mixed
	*/
	public function import_file( $path, $file_name, $file_type )
	{
		$supported_file_type = ['ini','php','html','json'];

		if ( in_array($file_type, $supported_file_type) )
		{
			$file = Security::DS("{$path}/{$file_name}.{$file_type}");

			if ( file_exists($file) )
			{
				switch ( $file_type )
				{
					case 'ini':
					return parse_ini_file($file, true);
					break;

					case 'php':
					require $file;
					break;

					case 'html':
					return $this->get_file($file);
					break;

					case 'json':
					return json_decode(file_get_contents($file), true);
					break;
				}
			}
		}
	}
}
