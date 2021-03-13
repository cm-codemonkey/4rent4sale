<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.core.libraries
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

class Route_vkye_adm
{
    private $path;
    private $user_level;

    public function __construct( $path )
    {
        $this->path = $path;
        $this->user_level = new User_level_vkye_adm;
    }

    public function on_change_start()
    {
        if ( $this->path != '/System/login' && $this->path != '/System/logout' )
        {
            if ( $this->user_level->access($this->path) != true )
                header('Location: index.php');
        }
    }

    public function on_change_end()
    {

    }
}
