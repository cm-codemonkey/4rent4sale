<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.core.controllers
*
* @author Julian Alberto Canche Dzib <Developer, jcanche@codemonkey.com.mx>
* @since October 22 / October 30, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary Módulo de propiedades.
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since October 30 / November 14, 2018 <1.0.0> <@update>
* @version 1.0.0
* @summary Se integraron el campo de tipo de propiedad (multiple/sencilla) en el formulario y ne la lista de propiedades.
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
$this->dependencies->add(['js', 'https://cloud.tinymce.com/5/tinymce.min.js?apiKey=i79gehzno9orw359aeznpzz3jr34riknglfyf3hkrpz3gzw2']);

?>

%{header}%
<section class="main-container">
    <div class="title">
        <h1>Lista de propiedades</h1>
    </div>
    <div class="buttons">
        <a class="btn btn-alert" data-button-modal="delete_properties">Eliminar</a>
        <a class="btn btn-colored" data-button-modal="properties">Nuevo</a>
    </div>
    <div class="content">
        <table class="display" data-page-length="100" data-table-order="5">
            <thead>
                <tr>
                    <th width="20px"></th>
                    <th width="40px"></th>
                    <th>Nombre</th>
                    <th>Précio</th>
                    <th>Categoría</th>
                    <th>Ubicación</th>
                    <th width="100px">Tipo</th>
                    <th width="100px">Destacado</th>
                    <th width="110px"></th>
                </tr>
            </thead>
            <tbody>
                {$lst_properties}
            </tbody>
        </table>
    </div>
</section>
<section class="modal" data-modal="properties">
    <div class="content">
        <header>
            <h4>Nuevo</h4>
        </header>
        <main>
            <form name="properties" class="row" data-submit-action="new">
                <fieldset class="input-group">
                    <p class="required-fields"><span class="required-field">*</span> Campos requeridos</p>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Nombre (ES)</span>
                        <input type="text" name="name_es" autofocus>
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Nombre (EN)</span>
                        <input type="text" name="name_en">
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span>Descripción (ES)</span>
                        <textarea name="description_es" class="tinymce"></textarea>
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span>Descripción (EN)</span>
                        <textarea name="description_en" class="tinymce"></textarea>
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Tipo</span>
                        <select name="type">
                            <option value="simple">Sencilla</option>
                            <option value="multiple">Multiple / Compuesta</option>
                        </select>
                        <span class="legend hidden">* Para agregar los detalles usted deberá ir a la opción detalles en la lista principal.</span>
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
                <fieldset class="input-group span6 padding-right-5">
                    <label>
                        <span>Latitud (Mapa)</span>
                        <input type="text" name="lat">
                    </label>
                </fieldset>
                <fieldset class="input-group span6">
                    <label>
                        <span>Longitud (Mapa)</span>
                        <input type="text" name="lng">
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Categoría</span>
                        <select name="category">
                            {$lst_categories}
                        </select>
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Ubicación</span>
                        <select name="location">
                            {$lst_locations}
                        </select>
                    </label>
                </fieldset>
                <div class="input-group uploader">
                    <div class="preview" data-preview></div>
                    <a class="btn" data-select>Seleccionar imagen</a>
                    <input id="preview" name="background" type="file" accept="image/*" data-preview />
                </div>
                <fieldset class="input-group">
                    <label>
                        <span>PDF</span>
                        <input id="pdf" type="file" accept="application/pdf">
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span>Prioridad</span>
                        <input type="number" name="priority" value="0" min="0">
                        <span class="legend">* Para no poner prioridad, únicamente deje el campo vacío o escriba el número 0.</span>
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
<section class="modal alert" data-modal="delete_properties">
    <div class="content">
        <header>
            <h4>Eliminar</h4>
        </header>
        <main>
            <p>¿Esta seguro de realizar esta acción?</p>
        </main>
        <footer>
            <a class="btn" button-close>Cancelar</a>
            <a class="btn btn-colored" data-action="delete_properties">Aceptar</a>
        </footer>
    </div>
</section>
