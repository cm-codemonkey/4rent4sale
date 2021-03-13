<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.layouts.magazine
*
* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
* @since October 03 - 19, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary Módulo de revista.
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$this->dependencies->add(['css', '{$path.plugins}datatables/css/jquery.dataTables.min.css']);
$this->dependencies->add(['css', '{$path.plugins}datatables/css/dataTables.material.min.css']);
$this->dependencies->add(['css', '{$path.plugins}datatables/css/responsive.dataTables.min.css']);
$this->dependencies->add(['css', '{$path.plugins}datatables/css/buttons.dataTables.min.css']);
$this->dependencies->add(['js', '{$path.js}pages/magazine.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/jquery.dataTables.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/dataTables.material.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/dataTables.responsive.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/dataTables.buttons.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/vfs_fonts.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/buttons.html5.min.js']);
$this->dependencies->add(['js', 'https://cloud.tinymce.com/5/tinymce.min.js?apiKey=i79gehzno9orw359aeznpzz3jr34riknglfyf3hkrpz3gzw2']);

?>

%{header}%
<section class="main-container">
    <div class="title">
        <h1>TIPI Magazine</h1>
    </div>
    <div class="buttons">
        {$btn_delete_magazine_articles}
        <a class="btn btn-colored" data-button-modal="magazine_articles">Nuevo</a>
    </div>
    <div class="content">
        <table class="display" data-page-length="100">
            <thead>
                <tr>
                    <th width="20px"></th>
                    <th width="40px"></th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th width="100px">Prioridad</th>
                    <th width="70px"></th>
                </tr>
            </thead>
            <tbody>
                {$lst_magazine_articles}
            </tbody>
        </table>
    </div>
</section>
<section class="modal" data-modal="magazine_articles">
    <div class="content">
        <header>
            <h4>Nuevo</h4>
        </header>
        <main>
            <form name="magazine_articles" data-submit-action="new">
                <fieldset class="input-group">
                    <p class="required-fields"><span class="required-field">*</span> Campos requeridos</p>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Nombre  (ES)</span>
                        <input type="text" name="name_es" autofocus>
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Nombre (EN)</span>
                        <input type="text" name="name_en" autofocus>
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Descripción (ES)</span>
                        <textarea name="description_es" class="tinymce"></textarea>
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Descripción (EN)</span>
                        <textarea name="description_en" class="tinymce"></textarea>
                    </label>
                </fieldset>
                <div class="input-group uploader">
                    <div class="preview" data-preview></div>
                    <a class="btn" data-select>Seleccionar imagen</a>
                    <input id="preview" name="background" type="file" accept="image/*" data-preview />
                </div>
                {$fdt_priority}
            </form>
        </main>
        <footer>
            <a class="btn" button-cancel>Cerrar</a>
            <a class="btn btn-colored" button-success>Aceptar</a>
        </footer>
    </div>
</section>
<section class="modal alert" data-modal="delete_magazine_articles">
    <div class="content">
        <header>
            <h4>Alerta</h4>
        </header>
        <main>
            <p>¿Esta seguro de realizar esta acción?</p>
        </main>
        <footer>
            <a class="btn" button-close>Cancelar</a>
            <a class="btn btn-colored" data-action="delete_magazine_articles">Aceptar</a>
        </footer>
    </div>
</section>
