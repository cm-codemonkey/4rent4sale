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
}
