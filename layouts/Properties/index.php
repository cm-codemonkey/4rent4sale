<?php defined('_EXEC') or die;

/**
* @package valkyrie.layouts.properties
*
* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
* @since October 17, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary create layout properties
*
* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
* @since October 29, 2018 <1.0.0> <@update>
* @version 1.0.0
* @summary Uso de multilenguaje
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$this->dependencies->add(['css', '']);
$this->dependencies->add(['js', '{$path.js}pages/properties.min.js']);
$this->dependencies->add(['other', '']);

?>

%{header}%
<section class="home white">
    <figure>
        <img src="{$path.images}backgrounds/{$background}" alt="Properties cover">
    </figure>
    <aside>
        <h1>{$title}</h1>
    </aside>
</section>
<section class="properties">
    <div class="container">
        <form name="filter" class="row">
            <fieldset class="input-group">
                <label data-important>
                    <span>{$lang.location}</span>
                    <select name="location">
                        <option value="all">{$lang.all}</option>
                        {$lst_locations}
                    </select>
                </label>
            </fieldset>
            <fieldset class="input-group">
                <label data-important>
                    <span>{$lang.category}</span>
                    <select name="category">
                        <option value="all">{$lang.all}</option>
                        {$lst_categories}
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
        <aside id="filter">
            {$lst_properties}
            <div class="clear"></div>
        </aside>
        <div class="clear"></div>
    </div>
</section>
