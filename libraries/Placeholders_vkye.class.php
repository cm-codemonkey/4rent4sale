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

class Placeholders_vkye
{
    private $buffer;
    private $format;

    public function __construct( $buffer )
    {
        $this->buffer = $buffer;
        $this->format = new Format();
    }

    public function run()
    {
        $this->buffer = $this->main_header();
        return $this->buffer;
    }

    private function main_header()
    {
        return $this->format->include_file($this->buffer, 'header');
    }
}
