<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.layouts.gallery
*
* @author Julian Alberto Canche Dzib <Developer, jcanche@codemonkey.com.mx>
* @since October 22 / October 30, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary Submódulo de ubicaciones de propiedades.
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$this->dependencies->add(['css', '{$path.plugins}datatables/css/jquery.dataTables.min.css']);
$this->dependencies->add(['css', '{$path.plugins}datatables/css/dataTables.material.min.css']);
$this->dependencies->add(['css', '{$path.plugins}datatables/css/responsive.dataTables.min.css']);
$this->dependencies->add(['css', '{$path.plugins}datatables/css/buttons.dataTables.min.css']);

$this->dependencies->add(['js', '{$path.js}pages/properties.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/jquery.dataTables.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/dataTables.material.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/dataTables.responsive.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/dataTables.buttons.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/vfs_fonts.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/buttons.html5.min.js']);

?>

%{header}%
<section class="main-container">
    <div class="title">
        <h1>Propiedades | Lugares</h1>
    </div>
    <div class="buttons">
        <a class="btn btn-alert" data-button-modal="delete_locations">Eliminar</a>
        <a class="btn btn-colored" data-button-modal="locations">Nuevo</a>
    </div>
    <div class="content">
        <table class="display" data-page-length="100" data-table-order="1">
            <thead>
                <tr>
                    <th width="20px"></th>
                    <th>Nombre</th>
                    <th width="35px"></th>
                </tr>
            </thead>
            <tbody>
                {$lst_locations}
            </tbody>
        </table>
    </div>
</section>
<section class="modal" data-modal="locations">
    <div class="content">
        <header>
            <h4>Nuevo</h4>
        </header>
        <main>
            <form name="locations" data-submit-action="new">
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
                        <span><span class="required-field">*</span>Nombre  (EN)</span>
                        <input type="text" name="name_en" autofocus>
                    </label>
                </fieldset>
            </form>
        </main>
        <footer>
            <a class="btn" button-cancel>Cerrar</a>
            <a class="btn btn-colored" button-success>Aceptar</a>
        </footer>
    </div>
</section>
<section class="modal alert" data-modal="delete_locations">
    <div class="content">
        <header>
            <h4>Alerta</h4>
        </header>
        <main>
            <p>¿Esta seguro de realizar esta acción?</p>
        </main>
        <footer>
            <a class="btn" button-close>Cancelar</a>
            <a class="btn btn-colored" data-action="delete_locations">Aceptar</a>
        </footer>
    </div>
</section>
