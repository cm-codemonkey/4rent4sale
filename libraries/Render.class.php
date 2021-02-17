<?php
defined('_EXEC') or die;

class Render
{
    private $format;

    public function __construct()
	{
        $this->format = new Format();
	}

    public function placeholders($string)
    {
        $replace = [
            '{$lang}' => $_COOKIE['lang'],
            '{$vkye_title}' => Language::getLang(_title, 'Titles'),
            '{$webpage}' => Configuration::$webPage,
            '{$domain}' => Security::protocol() . Configuration::$domain,
            '{$base}' => ( Configuration::$urlFriendly === true ) ? '/' : ''
        ];

        return $this->replace($replace, $string);
    }

    public function paths($string)
    {
        $ini = parse_ini_file($this->format->checkAdmin(PATH_ADMINISTRATOR_INCLUDES, PATH_INCLUDES) . 'paths.ini');

        foreach ($ini as $key => $value)
            $string = str_replace('{$path.' . $key . '}', $value, $string);

        return $string;
    }

    public function replace($arr, $string)
	{
		return $this->format->replace($arr, $string);
	}
}
