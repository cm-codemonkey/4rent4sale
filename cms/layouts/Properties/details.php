<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.core.controllers
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since October 30 / November 14, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary Submódulo de detalles de una propiedad multiple.
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
        <h1>Subpropiedades | {$name}</h1>
    </div>
    <div class="buttons">
        <a class="btn btn-colored" data-button-modal="details">Nuevo</a>
    </div>
    <div class="content">
        <table class="display" data-page-length="100" data-table-order="1">
            <thead>
                <tr>
                    <th width="40px"></th>
                    <th>Nombre</th>
                    <th>Précio</th>
                    <th>Dimensiones</th>
                    <th>Características</th>
                    <th>Amenidades</th>
                    <th width="100px">Tipo</th>
                    <th width="100px">Estado</th>
                    <th width="70px"></th>
                </tr>
            </thead>
            <tbody>
                {$lst_details}
            </tbody>
        </table>
    </div>
</section>
<section class="modal" data-modal="details">
    <div class="content">
        <header>
            <h4>Nuevo</h4>
        </header>
        <main>
            <form name="details" class="row" data-submit-action="new">
                <fieldset class="input-group">
                    <p class="required-fields"><span class="required-field">*</span> Campos requeridos</p>
                </fieldset>
                <fieldset class="input-group span3">
                    <label>
                        <span><span class="required-field">*</span>Posición</span>
                        <input type="number" name="position" autofocus>
                    </label>
                </fieldset>
                <div class="clear"></div>
                <fieldset class="input-group span6 padding-right-5">
                    <label>
                        <span><span class="required-field">*</span>Nombre (ES)</span>
                        <input type="text" name="name_es">
                    </label>
                </fieldset>
                <fieldset class="input-group span6">
                    <label>
                        <span><span class="required-field">*</span>Nombre (EN)</span>
                        <input type="text" name="name_en">
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Precio (USD)</span>
                        <input type="number" name="price">
                    </label>
                </fieldset>
                <fieldset class="input-group span6 padding-right-5">
                    <label>
                        <span><span class="required-field">*</span>Dimensiones (ES)</span>
                        <input type="text" name="dimensions_es">
                    </label>
                </fieldset>
                <fieldset class="input-group span6">
                    <label>
                        <span><span class="required-field">*</span>Dimensiones (EN)</span>
                        <input type="text" name="dimensions_en">
                    </label>
                </fieldset>
                <fieldset class="input-group reload-group">
                    <label>
                        <span>Caracteristicas</span>
                        <input type="text" name="characteristic_es" class="span6" placeholder="Español">
                        <input type="text" name="characteristic_en" class="span6" placeholder="Ingles">
                    </label>
                    <a data-action="add_characteristic"><i class="material-icons">add</i><span></a>
                    <div class="clear"></div>
                    <aside id="characteristics">
                        <span>No se han ingresado características a la lista</span>
                    </aside>
                </fieldset>
                <fieldset class="input-group reload-group">
                    <label>
                        <span>Amenidades</span>
                        <input type="text" name="amenity_es" class="span6" placeholder="Español">
                        <input type="text" name="amenity_en" class="span6" placeholder="Ingles">
                    </label>
                    <a data-action="add_amenity"><i class="material-icons">add</i><span></a>
                    <div class="clear"></div>
                    <aside id="amenities">
                        <span>No se han ingresado amenidades a la lista</span>
                    </aside>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Tipo</span>
                        <select name="dtype">
                            <option value="sale">Venta</option>
                            <option value="rent">Renta</option>
                        </select>
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Estado</span>
                        <select name="status">
                            <option value="1">Disponible</option>
                            <option value="0">No disponible</option>
                        </select>
                    </label>
                </fieldset>
                <div class="input-group uploader">
                    <div class="preview" data-preview></div>
                    <a class="btn" data-select>Seleccionar imagen</a>
                    <input id="preview" name="background" type="file" accept="image/*" data-preview />
                </div>
            </form>
        </main>
        <footer>
            <a class="btn" button-cancel>Cerrar</a>
            <a class="btn btn-colored" button-success>Aceptar</a>
        </footer>
    </div>
</section>
<section class="modal alert" data-modal="delete_details">
    <div class="content">
        <header>
            <h4>Eliminar</h4>
        </header>
        <main>
            <p>¿Esta seguro de realizar esta acción?</p>
        </main>
        <footer>
            <a class="btn" button-close>Cancelar</a>
            <a class="btn btn-colored" data-action="delete_details">Aceptar</a>
        </footer>
    </div>
</section>
