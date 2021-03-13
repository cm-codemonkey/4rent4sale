<?php

defined('_EXEC') or die;

/**
* @package valkyrie.libraries
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

class Functions
{
    public static function check_access_permissions($levels = [])
    {
		$access = false;

		foreach ($levels as $level)
		{
			if (Session::get_value('_vkye_level') == $level)
				$access = true;
		}

        return $access;
    }

    public static function check_email($email)
    {
        return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
    }

    public static function check_number($number, $checker)
    {
        $return = null;

        if ($checker == 'is_float')
        {
            $explode = explode('.', $number);
            $return = (count($explode) > 1) ? true : false;
        }

        if ($checker == 'exists_spaces')
        {
            $explode = explode(' ', $number);
            $return = (count($explode) > 1) ? true : false;
        }

        return $return;
    }

    public static function shorten_text($text, $length)
	{
		$shorten_text = substr(strip_tags($text), 0, $length);

		if(strlen(strip_tags($text)) > $length)
			$shorten_text .= '...';

		return $shorten_text;
    }

    public static function currency_exchange($currency = 'USD', $amount = 0)
    {
        $database = new Medoo();
        $exchange = $database->select('settings', ['currency_exchange']);

        if ( isset($exchange[0]) && !empty($exchange[0]) )
        {
            $exchange = json_decode($exchange[0]['currency_exchange']);

            if ( $exchange->{$currency} )
            {
                $exchange = $exchange->{$currency};
                $response = $amount * $exchange;

                return $response;
            }
            else
                return null;
        }
        else
            return null;
    }
}
