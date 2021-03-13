<?php defined('_EXEC') or die;

/**
* @package valkyrie.layouts.contact
*
* @author Alejandro <Chief Developer, acabrera@codemonkey.com.mx>
* @since October 15, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
* @since October 25, 2018 <1.0.0> <@update>
* @summary Datos dinámico de titulo y background
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$this->dependencies->add(['css', '']);
$this->dependencies->add(['js', '{$path.js}pages/contact.min.js']);
$this->dependencies->add(['other', '']);

?>

%{header}%
<section class="home white">
    <figure>
        <img src="{$path.images}backgrounds/{$background}" alt="Contact cover">
    </figure>
    <aside>
        <h1>{$title}</h1>
    </aside>
</section>
<section class="subtitle">
    <div class="container">
        <h4>{$lang.message}</h4>
    </div>
</section>
<section class="contact">
    <form name="contact">
        <fieldset class="input-group">
            <p class="required-fields"><span class="required-field">*</span> {$lang.required_fields}</p>
        </fieldset>
        <fieldset class="input-group">
            <label>
                <span><span class="required-field">*</span>{$lang.fullname}</span>
                <input type="text" name="fullname">
            </label>
        </fieldset>
        <fieldset class="input-group">
            <label>
                <span><span class="required-field">*</span>{$lang.email}</span>
                <input type="text" name="email">
            </label>
        </fieldset>
        <fieldset class="input-group">
            <label>
                <span><span class="required-field">*</span>{$lang.phone}</span>
                <input type="text" name="phone">
            </label>
        </fieldset>
        <fieldset class="input-group">
            <label>
                <span>{$lang.message}</span>
                <textarea name="message"></textarea>
            </label>
        </fieldset>
        <a class="btn" data-action="contact">{$lang.send}</a>
    </form>
</section>
<section class="info-contact">
    <div class="container row">
        <div class="span4 padding-right-20 prefix2">
            <div class="info email">
                <div class="icon"><i class="material-icons">email</i></div>
                <h4>{$lang.email}</h4>
                <p>{$email}</p>
            </div>
        </div>
        <div class="span4 suffix2">
            <div class="info">
                <div class="icon"><i class="material-icons">phone</i></div>
                <h4>{$lang.phone}</h4>
                <p>{$phone}</p>
            </div>
        </div>
    </div>
</section>
