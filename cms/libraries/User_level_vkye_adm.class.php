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

class User_level_vkye_adm
{
    static public function login_redirect( $level )
    {
        switch ( $level )
        {
            case '{superadministrator}': return 'index.php?c=properties'; break;
            case '{administrator}': return 'index.php?c=properties'; break;
            case '{editor}': return 'index.php?c=magazine'; break;
            default: return 'index.php'; break;
        }
    }

    public function access ( $path )
    {
        $level = Session::get_value('_vkye_level');

        switch ( $level )
        {
            case '{superadministrator}': return true; break;

            case '{administrator}':
                return $this->check_path($path, [
                    '/Contact/index',
                    '/Index/index',
                    '/Index/unavailable',
                    '/Magazine/index',
                    '/Magazine/gallery',
                    '/Properties/index',
                    '/Properties/subproperties',
                    '/Properties/gallery',
                    '/Properties/categories',
                    '/Properties/locations',
                    '/Settings/index'
                ]);
            break;

            case '{editor}':
                return $this->check_path($path, [
                    '/Index/index',
                    '/Index/unavailable',
                    '/Magazine/index',
                    '/Magazine/gallery'
                ]);
            break;

            default: return false; break;
        }
    }

    private function check_path( $path, $permission )
    {
        if ( in_array($path, $permission) )
            return true;
        else
            return false;
    }
}
