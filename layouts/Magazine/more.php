<?php defined('_EXEC') or die;

/**
* @package valkyrie.layouts.more
*
* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
* @since October 17, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary create layout magazines/more
*
* @author Julian Alberto Canche Dzib <Software Development, jcanche@codemonkey.com.mx>
* @since October 24, 2018 <1.0.0> <@update>
* @summary Cargar los datos de la tabla magazines.
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$this->dependencies->add(['css', '{$path.plugins}fancybox/source/jquery.fancybox.css']);
$this->dependencies->add(['js', '{$path.js}pages/magazine.min.js']);
$this->dependencies->add(['js', '{$path.plugins}fancybox/source/jquery.fancybox.js']);
$this->dependencies->add(['js', '{$path.plugins}fancybox/source/jquery.fancybox.pack.js']);
$this->dependencies->add(['other', '
<script type="text/javascript">
    $(".fancybox-thumb").fancybox({
        prevEffect	: "none",
        nextEffect	: "none",
        helpers	:
        {
            thumbs	:
            {
                width	: 50,
                height	: 50
            }
        }
   });

    $(".fancybox-media").fancybox({
        openEffect  : "elastic",
        closeEffect : "none",
        helpers :
        {
            media : {}
        }
    });
</script>'
]);

?>

%{header}%
<section class="home white">
    <figure>
        <img src="{$path.images}magazine/{$background}" alt="Magazine article cover">
    </figure>
    <aside>
        <h1>{$name}</h1>
    </aside>
</section>
<section class="magazine-description">
    <div class="container">
        <div class="date">
            <p>{$date}</p>
        </div>
        <div class="author">
            <img src="{$path.images}users/{$avatar}" alt="Author profile image">
            <p>{$username}</p>
        </div>
        <div class="clear"></div>
        <div class="description">
            {$description}
        </div>
        <div class="cm-gallery-style-1">
            {$lst_images}
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</section>
