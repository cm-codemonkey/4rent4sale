<?php
defined('_EXEC') or die;

class Components
{
    private $security;
    private $format;

    public function __construct()
    {
        $this->security = new Security();
        $this->format = new Format();
    }

    public function loadComponent($component = false)
    {
        $component = 'com_' . $component;

        $route = $this->security->directorySeparator($this->format->checkAdmin(PATH_ADMINISTRATOR_COMPONENTS, PATH_COMPONENTS) . $component . '/handler.php');

        if(!file_exists($route))
            Errors::system('component_not_valid', ' - ' . $component);
        else
        {
            ob_start();

            require_once $route;

            $buffer = ob_get_contents();

            ob_end_clean();

            return $buffer;
        }
    }
}
