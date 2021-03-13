'use strict';

/**
* @package valkyrie.js
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
* @since October 15, 2018 <1.0.0> <@update>
* @summary Se agrego la funcion de scroll down
* @summary Se agrego la funcion para el slideshow
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$(document).ready(function()
{
    var myDocument = $(this);

    /* Nav scroll down
    ------------------------------------------------------------------------------- */
    navScrollDown('header.main-header', 'down', 0);

    /* Open responsive menu
    ------------------------------------------------------------------------------- */
    $('[data-action="open-res-menu"]').on('click', function()
    {
        $('header.main-header nav.menu').toggleClass('open');
    });
});
