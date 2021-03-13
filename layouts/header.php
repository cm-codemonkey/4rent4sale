<?php defined('_EXEC') or die;

/**
* @package valkyrie.layouts
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
* @since October 15, 2018 <1.0.0> <@update>
* @summary Se actualizo el header con las paginas que pidio el cliente.
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

?>

<header class="main-header">
    <div class="container">
        <figure class="logotype">
            <a href="/"><img src="{$path.images}logotype_white.png" alt="logotype"></a>
        </figure>
        <nav class="menu">
            <a href="/">{$lang.home}</a>
            <a href="/properties">{$lang.properties}</a>
            <a href="/magazine">{$lang.magazine}</a>
            <a href="/contact">{$lang.contact}</a>
            <a href="?<?php if (Session::get_value('lang') == 'es') { $lang = 'en'; } else if (Session::get_value('lang') == 'en') { $lang = 'es'; } echo Language::get_lang_url($lang); ?>"><img src="{$path.images}<?php echo $lang ?>.png" alt="es_flag" /></a>
        </nav>
        <nav class="res-menu">
            <a href="" data-action="open-res-menu"><i class="material-icons">menu</i></a>
        </nav>
    </div>
</header>
