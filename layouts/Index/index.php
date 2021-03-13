<?php defined('_EXEC') or die;

/**
* @package valkyrie.layouts.index
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
* @since October 15, 2018 <1.0.0> <@update>
* @summary Integración de la maquetación del sitio Web.
*
* @author Julian Alberto Canche Dzib <Development, jcanche@codemonkey.com.mx>
* @since October 16, 2018 <1.0.0> <@update>
* @summary Integración de la sección de magazine.
*
* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
* @since October 24, 2018 - October 25, 2018 <1.0.0> <@update>
* @version 1.0.0
* @summary Datos dinámico de categories. Datos dinámico de titulo y background.
*
* @author Gersón Aarón Gómez Macías <, ggomez@codemonkey.com.mx>
* @since October 30, 2018 <1.0.0> <@update>
* @version 1.0.0
* @summary La sección del mapa se paso abajo de la sección de categorías. Se corrigieron errores de estructura y prorgramación.
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$this->dependencies->add(['css', '{$path.plugins}owlcarousel/assets/owl.carousel.min.css']);
$this->dependencies->add(['css', '{$path.plugins}owlcarousel/assets/owl.theme.default.min.css']);
$this->dependencies->add(['js', '{$path.js}pages/index.min.js']);
$this->dependencies->add(['js', '{$path.plugins}owlcarousel/owl.carousel.min.js']);
$this->dependencies->add(['other', '
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLCea8Q6BtcTHwY3YFCiB0EoHE5KnsMUE&callback=initMap"></script>
<script type="text/javascript">


</script>
']);

?>

%{header}%
<section class="home">
    <div id="slideshow" class="owl-carousel owl-theme">
        {$lst_slideshow}
    </div>
    <aside>
        <h1>{$title} <span>{$subtitle}</span></h1>
    </aside>
</section>
<section class="categories">
    <div class="container">
        {$lst_categories}
        <div class="clear"></div>
    </div>
</section>
<section class="map">
    <form name="filter" class="row">
        <fieldset class="input-group">
            <label data-important>
                <span>{$lang.location}</span>
                <select name="location">
                    <option value="all">{$lang.all}</option>
                    {$lst_f_locations}
                </select>
            </label>
        </fieldset>
        <fieldset class="input-group">
            <label data-important>
                <span>{$lang.category}</span>
                <select name="category">
                    <option value="all">{$lang.all}</option>
                    {$lst_f_categories}
                </select>
            </label>
        </fieldset>
        <fieldset class="input-group">
            <label data-important>
                <span>{$lang.price}</span>
                <select name="price">
                    <option value="all">{$lang.all}</option>
                    <option value="rank">{$lang.price_rank}</option>
                </select>
            </label>
        </fieldset>
        <fieldset class="input-group span6 padding-right-5 hidden">
            <label data-important>
                <input type="number" name="price_from" placeholder="$ {$lang.from}">
            </label>
        </fieldset>
        <fieldset class="input-group span6 hidden">
            <label data-important>
                <input type="number" name="price_to" placeholder="$ {$lang.to}">
            </label>
        </fieldset>
        <fieldset class="input-group">
            <label data-important>
                <span>{$lang.type}</span>
                <select name="type">
                    <option value="all">{$lang.all}</option>
                    <option value="sale">{$lang.sale}</option>
                    <option value="rent">{$lang.rent}</option>
                </select>
            </label>
        </fieldset>
        <fieldset class="input-group">
            <a href="" class="btn btn-colored" data-action="filter">{$lang.filter}</a>
        </fieldset>
    </form>
    <div id="map"></div>
</section>
<section class="magazine home">
    <div class="container">
        {$lst_magazine_articles}
        <div class="clear"></div>
    </div>
</section>
<section class="subscription" data-image-src="{$path.images}backgrounds/{$background}">
    <form name="subscription">
        <h4><strong>¡{$lang.subscribe}!</strong></h4>
        <p>{$lang.to_receive_information}</p>
        <fieldset class="input-group">
            <label>
                <span>{$lang.fullname}</span>
                <input type="text" name="fullname">
            </label>
        </fieldset>
        <fieldset class="input-group">
            <label>
                <span>{$lang.email}</span>
                <input type="text" name="email">
            </label>
        </fieldset>
        <a class="btn btn-colored" data-action="subscription">{$lang.subscribe}</a>
    </form>
</section>
