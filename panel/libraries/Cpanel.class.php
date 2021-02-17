<?php
defined('_EXEC') or die;

class Cpanel
{
    private $framework;
    private $security;
    private $render;
    private $language;
    private $format;
    private $system;
    private $controller;
    private $method;
    private $params;

    public function __construct()
    {
        Session::init();

        $this->framework = new Framework();
        $this->security = new Security();
        $this->render = new Render();
        $this->language = new Language();
        $this->format = new Format();
        $this->system = new System();
        $this->loadPage();
    }

    public function execute()
    {
        ob_start("ob_gzhandler");

		// Load template
		$this->loadController();

		if(!defined('_title'))
			define('_title', Configuration::$domain . ' - Valkyrie Platform');

		if(!defined('_lang'))
			define('_lang', Configuration::$langDefault);

		$buffer = ob_get_contents();

		// Rendering
		$buffer = $this->render($buffer);

		ob_end_clean();
		return $buffer;
    }

    private function loadPage()
    {
        if($this->system->existsSession() === true)
        {
            $this->controller   = isset ($_GET['c']) ? ucwords ( $this->security->cleanUrl( $_GET['c'] ) ) : 'Index';
            $this->method       = isset ($_GET['m']) ? strtolower ( $this->security->cleanUrl( $_GET['m'] ) ) : 'index';
            $this->params       = isset ($_GET['p']) ? $this->security->cleanUrl( $_GET['p'] ) : '' ;
        }
        else
        {
            $this->controller   = 'System';
            $this->method       = 'login';
            $this->params       = '';
        }
    }

    private function loadController()
	{
        $path = $this->security->directorySeparator(PATH_ADMINISTRATOR_CONTROLLERS . $this->controller . CONTROLLER_PHP . '.php');

		if(file_exists($path))
		{
			require_once $path;
            $controller = $this->controller . CONTROLLER_PHP;
			$controller = new $controller();

			if (isset($this->method))
			{
				if (method_exists($controller, $this->method))
				{
					if (isset($this->params))
						$controller->{$this->method}($this->params);
					else
						$controller->{$this->method}();
				}
				else
                    Errors::http('404', '{method_does_exists}');
			}
			else
                $controller->index();
		}
		else
            Errors::http('404', '{controller_does_exists}');
	}

    private function render($buffer)
    {
        $buffer = $this->language->getLang($buffer);
        $buffer = $this->render->placeholders($buffer);
        $buffer = $this->render->paths($buffer);

        $replace = [
			'{$username}' 	=> Session::getValue( 'user' ),
			'{$level}' 		=> $this->system->getLevel( Session::getValue( 'level' ) ),
            '{$useravatar}' => Session::getValue( 'user_avatar' ),
			'{$usercover}'  => Session::getValue( 'user_cover' ),
            '{$useremail}'  => Session::getValue( 'user_email' )
		];

        $buffer = $this->format->replace( $replace, $buffer );

        if(Configuration::$compressHtml === TRUE)
			$buffer = preg_replace(array('//Uis', "/[[:blank:]]+/"), array('', ' '), str_replace(array("\n", "\r", "\t"), '', $buffer));

		return $buffer;
    }
}
