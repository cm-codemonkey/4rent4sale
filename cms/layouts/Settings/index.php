<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.layouts.settings
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
* @since October 09, 2018 <1.0.0> <@update>
* @version 1.0.0
* @summary
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$this->dependencies->add(['js', '{$path.js}pages/settings.js']);

?>

%{header}%
<section class="main-container">
    <div class="title">
        <h1>Configuraciones | Títulos</h1>
    </div>
    <div class="buttons">
        <a class="btn btn-colored" data-button-modal="titles">Editar</a>
    </div>
    <div class="content row">
        <fieldset class="input-group span6 padding-right-10">
            <label>
                <span>Título página de inicio</span>
                <input type="text" value="Español: {$title_home_es}. Ingles: {$title_home_en}." disabled>
            </label>
        </fieldset>
        <fieldset class="input-group span6">
            <label>
                <span>Subtítulo página de inicio</span>
                <input type="text" value="Español: {$subtitle_home_es}. Ingles: {$subtitle_home_en}." disabled>
            </label>
        </fieldset>
        <fieldset class="input-group span6 padding-right-10">
            <label>
                <span>Título página de propiedades</span>
                <input type="text" value="Español: {$title_properties_es}. Ingles: {$title_properties_en}." disabled>
            </label>
        </fieldset>
        <fieldset class="input-group span6">
            <label>
                <span>Título página TIPI Magazine</span>
                <input type="text" value="Español: {$title_magazines_es}. Ingles: {$title_magazines_en}." disabled>
            </label>
        </fieldset>
        <fieldset class="input-group span6 padding-right-10">
            <label>
                <span>Título página de contacto</span>
                <input type="text" value="Español: {$title_contact_es}. Ingles: {$title_contact_en}." disabled>
            </label>
        </fieldset>
    </div>
    <div class="title margin-top-40">
        <h1>Configuraciones | Portadas</h1>
    </div>
    <div class="content">
        <span>Portada página de inicio</span>
        <div class="cm-gallery-style-1">
            <div class="new">
                <input id="file" type="file" class="hidden" />
                <a href="" data-action="new"><i class="material-icons">add_circle_outline</i></a>
            </div>
            {$lst_slideshow}
            <div class="clear"></div>
        </div>
        <span>Portada página de propiedades</span>
        <div class="cm-ft-stle-1">
            <figure>
                <img src="../{$path.images}backgrounds/{$properties}" alt="background properties">
                <input id="file_background_1" type="file" class="hidden" />
                <a data-action="new_background_1"><i class="material-icons">edit</i></a>
            </figure>
        </div>
        <span>Portada página TIPI Magazine</span>
        <div class="cm-ft-stle-1">
            <figure>
                <img src="../{$path.images}backgrounds/{$magazine}" alt="background magazine">
                <input id="file_background_2" type="file" class="hidden" />
                <a data-action="new_background_2"><i class="material-icons">edit</i></a>
            </figure>
        </div>
        <span>Portada página de contacto</span>
        <div class="cm-ft-stle-1">
            <figure>
                <img src="../{$path.images}backgrounds/{$contact_us}" alt="background contact us">
                <input id="file_background_3" type="file" class="hidden" />
                <a data-action="new_background_3"><i class="material-icons">edit</i></a>
            </figure>
        </div>
        <span>Fondo sección de suscripción</span>
        <div class="cm-ft-stle-1">
            <figure>
                <img src="../{$path.images}backgrounds/{$subscribe}" alt="background subscribe">
                <input id="file_background_4" type="file" class="hidden" />
                <a data-action="new_background_4"><i class="material-icons">edit</i></a>
            </figure>
        </div>
    </div>
</section>
<section class="modal" data-modal="titles">
    <div class="content">
        <header>
            <h4>Editar</h4>
        </header>
        <main>
            <form name="titles" class="row">
                <fieldset class="input-group">
                    <p class="required-fields"><span class="required-field">*</span> Campos requeridos</p>
                </fieldset>
                <fieldset class="input-group span6 padding-right-5">
                    <label>
                        <span><span class="required-field">*</span>Título página de inicio (ES)</span>
                        <input type="text" name="title_home_es" value="{$title_home_es}">
                    </label>
                </fieldset>
                <fieldset class="input-group span6">
                    <label>
                        <span><span class="required-field">*</span>Título página de inicio (EN)</span>
                        <input type="text" name="title_home_en" value="{$title_home_en}">
                    </label>
                </fieldset>
                <fieldset class="input-group span6 padding-right-5">
                    <label>
                        <span><span class="required-field">*</span>Subtítulo página de inicio (ES)</span>
                        <input type="text" name="subtitle_home_es" value="{$subtitle_home_es}">
                    </label>
                </fieldset>
                <fieldset class="input-group span6">
                    <label>
                        <span><span class="required-field">*</span>Subtítulo página de inicio (EN)</span>
                        <input type="text" name="subtitle_home_en" value="{$subtitle_home_en}">
                    </label>
                </fieldset>
                <fieldset class="input-group span6 padding-right-5">
                    <label>
                        <span><span class="required-field">*</span>Título página de propiedades (ES)</span>
                        <input type="text" name="title_properties_es" value="{$title_properties_es}">
                    </label>
                </fieldset>
                <fieldset class="input-group span6">
                    <label>
                        <span><span class="required-field">*</span>Título página de propiedades (EN)</span>
                        <input type="text" name="title_properties_en" value="{$title_properties_en}">
                    </label>
                </fieldset>
                <fieldset class="input-group span6 padding-right-5">
                    <label>
                        <span><span class="required-field">*</span>Título página TIPI Magazine (ES)</span>
                        <input type="text" name="title_magazines_es" value="{$title_magazines_es}">
                    </label>
                </fieldset>
                <fieldset class="input-group span6">
                    <label>
                        <span><span class="required-field">*</span>Título página TIPI Magazine (EN)</span>
                        <input type="text" name="title_magazines_en" value="{$title_magazines_en}">
                    </label>
                </fieldset>
                <fieldset class="input-group span6 padding-right-5">
                    <label>
                        <span><span class="required-field">*</span>Título página de contacto (ES)</span>
                        <input type="text" name="title_contact_es" value="{$title_contact_es}">
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Título página de contacto (EN)</span>
                        <input type="text" name="title_contact_en" value="{$title_contact_en}">
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
