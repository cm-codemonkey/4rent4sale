<?php
defined('_EXEC') or die;

class Configuration
{
	/**
	* @static string $domain "localhost"
	* @static string $webPage "Valkyrie"
	* @static string(2) $langDefault "es|en|fr|ru.."
	* @static int|string $error_reporting default|-1, none|0, simple, maximum, development
	* @static boolean $debug true|false
	* @static boolean $debugLang true|false
	* @static boolean $urlFriendly true|false
	* @static boolean $compressHtml true|false
	* @static string $timeZone GMT ZONE
	* @static string $secret key secure
	* @static string $helpurl Help from master
	*/

	public static $domain 			= '4rent4salerivieramaya.com';
	public static $webPage 			= '4Rent 4Sale';
	public static $langDefault 		= 'en';
	public static $error_reporting 	= 'development';
	public static $debug 			= false;
	public static $debugLang 		= false;
	public static $urlFriendly 		= true;
	public static $compressHtml 	= true;
	public static $timeZone 		= 'America/Mexico_City';
	public static $secret 			= '#StEfJZe~)R112>Y';
	public static $helpurl 			= 'https://help.codemonkey.com.mx/index.php';

	/**
	*
	* @static string $db_state state use database
	* @static string $db_type type database MySQL, MariaDB, MSSQL, PostgreSQL, Oracle, Sybase
	* @static string $db_host server host database
	* @static string $db_name name of your database
	* @static string $db_user username use of your database
	* @static string $db_pass password use of your database
	* @static string $db_prefix prefix use of tables
	* @static int $db_port port stablish on connect
	* @tutorial http://medoo.in/doc
	*/

	public static $db_state			= true;
	public static $db_type 			= 'mysql';
	public static $db_host 			= '149.56.81.137';
	public static $db_name 			= '4rent4sale';
	public static $db_user 			= '4rent4sale';
	public static $db_pass 			= 'g8#rN2c8';
	public static $db_prefix 		= 'vkye_';
	public static $db_port 			= 3306;

	/**
	* @static bolean $smtp_auth true|false
	* @static string $smtp_host host of your smtp
	* @static string $smtp_user user use of your smtp
	* @static string $smtp_pass password use of your smtp
	* @static string $smtp_secure tls|ssl
	* @static int $smtp_port use port of your smtp
	*/

	public static $smtp_auth 		= false;
	public static $smtp_host 		= '';
	public static $smtp_user 		= '';
	public static $smtp_pass 		= '';
	public static $smtp_secure 		= 'tls';
	public static $smtp_port 		= 587;
}
