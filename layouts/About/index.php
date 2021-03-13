<?php defined('_EXEC') or die;

/**
* @package valkyrie.layouts.about
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$this->dependencies->add(['css', '']);
$this->dependencies->add(['js', '{$path.js}pages/about.min.js']);
$this->dependencies->add(['other', '']);

?>

%{header}%
<section class="home-background" data-image-src="{$path.images}backgrounds/background_about.png">
    <div class="title">
        <div class="container">
            <h1>{$lang.about_us}</h1>
        </div>
    </div>
</section>
<section class="about-us">
    <div class="container">
        <p>{$description}</p>
    </div>
</section>
