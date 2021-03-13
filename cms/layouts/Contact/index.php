<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.layouts.contact
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
* @since October 22, 2018 <1.0.0> <@update>
* @version 1.0.0
* @summary Se elimino campo de twitter en social media.
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$this->dependencies->add(['js', '{$path.js}pages/contact.js']);

?>

%{header}%
<section class="main-container">
    <div class="title">
        <h1>Informaciòn de contacto</h1>
    </div>
    <div class="buttons">
        <a class="btn btn-colored" data-button-modal="contact">Editar</a>
    </div>
    <div class="content row">
        <fieldset class="input-group span4 padding-right-5">
            <label>
                <span>Correo electrónico</span>
                <input type="text" value="{$email}" disabled>
            </label>
        </fieldset>
        <fieldset class="input-group span4 padding-right-5">
            <label>
                <span>Teléfono</span>
                <input type="text" value="{$phone}" disabled>
            </label>
        </fieldset>
        <fieldset class="input-group span4">
            <label>
                <span>Facebook</span>
                <input type="text" value="{$facebook}" disabled>
            </label>
        </fieldset>
        <fieldset class="input-group span4 padding-right-5">
            <label>
                <span>Instagram</span>
                <input type="text" value="{$instagram}" disabled>
            </label>
        </fieldset>
    </div>
</section>
<section class="modal" data-modal="contact">
    <div class="content">
        <header>
            <h4>Editar</h4>
        </header>
        <main>
            <form name="contact">
                <fieldset class="input-group">
                    <p class="required-fields"><span class="required-field">*</span> Campos requeridos</p>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Correo electrónico</span>
                        <input type="text" name="email" value="{$email}">
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Teléfono</span>
                        <input type="text" name="phone" value="{$phone}">
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span>Facebook</span>
                        <input type="text" name="facebook" value="{$facebook}">
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span>Instagram</span>
                        <input type="text" name="instagram" value="{$instagram}">
                    </label>
                </fieldset>
            </form>
        </main>
        <footer>
            <a class="btn" button-close>Cerrar</a>
            <a class="btn btn-colored" button-success>Aceptar</a>
        </footer>
    </div>
</section>
