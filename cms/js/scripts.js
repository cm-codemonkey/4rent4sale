'use strict';

/**
* @package valkyrie.cms.js
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template (This file was created empty)
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$(document).ready(function()
{
    var myDocument = $(this);

    if (typeof tinymce != 'undefined')
    {
        tinymce.init({
            selector: "textarea.tinymce",
            plugins : "image link preview",
            toolbar: false,
            height: 300,
        });
    }
});
