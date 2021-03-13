<?php defined('_EXEC') or die;

/**
* @package valkyrie.layouts.magazines
*
* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
* @since October 17, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary create layout magazines
*
* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
* @since October 25, 2018 <1.0.0> <@update>
* @summary Datos dinámico de titulo y background
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$this->dependencies->add(['css', '']);
$this->dependencies->add(['js', '{$path.js}pages/magazine.min.js']);
$this->dependencies->add(['other', '']);

?>

%{header}%
<section class="home white">
    <figure>
        <img src="{$path.images}backgrounds/{$background}" alt="Magazine cover">
    </figure>
    <aside>
        <h1>{$title}</h1>
    </aside>
</section>
<section class="magazine">
    <div class="container">
        {$lst_magazine_articles}
        <div class="clear"></div>
    </div>
</section>
