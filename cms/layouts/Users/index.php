<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.layouts.users
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

$this->dependencies->add(['css', '{$path.plugins}datatables/css/jquery.dataTables.min.css']);
$this->dependencies->add(['css', '{$path.plugins}datatables/css/dataTables.material.min.css']);
$this->dependencies->add(['css', '{$path.plugins}datatables/css/responsive.dataTables.min.css']);
$this->dependencies->add(['css', '{$path.plugins}datatables/css/buttons.dataTables.min.css']);
$this->dependencies->add(['js', '{$path.js}pages/users.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/jquery.dataTables.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/dataTables.material.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/dataTables.responsive.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/dataTables.buttons.min.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/vfs_fonts.js']);
$this->dependencies->add(['js', '{$path.plugins}datatables/js/buttons.html5.min.js']);
$this->dependencies->add(['other', '']);

?>

%{header}%
<section class="main-container">
    <div class="title">
        <h1>Usuarios</h1>
    </div>
    <div class="buttons">
        <a class="btn btn-colored" data-button-modal="users">Nuevo</a>
        <a class="btn btn-warning" data-button-modal="deactivate">Activar / Desactivar</a>
        <a class="btn btn-alert" data-button-modal="delete_user">Eliminar</a>
    </div>
    <div class="content">
        <table class="display" data-page-length="100">
            <thead>
                <tr>
                    <th width="20px"></th>
                    <th width="40px"></th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Nivel</th>
                    <th width="100px">Estado</th>
                    <th width="70px"></th>
                </tr>
            </thead>
            <tbody>
                {$lst_users}
            </tbody>
        </table>
    </div>
</section>
<section class="modal" data-modal="users">
    <div class="content">
        <header>
            <h4>Nuevo</h4>
        </header>
        <main>
            <form name="users" data-submit-action="new">
                <fieldset class="input-group">
                    <p class="required-fields"><span class="required-field">*</span> Campos requeridos</p>
                </fieldset>

                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Nombre completo</span>
                        <input type="text" name="fullname" autofocus>
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span>Email</span>
                        <input type="email" name="email">
                    </label>
                </fieldset>

                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Nombre de usuario</span>
                        <input type="text" name="username">
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Password</span>
                        <input type="password" name="password">
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" data-action="show"><span>Ver contraseña</span></input>
                    </label>
                </fieldset>
                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Nivel de acceso</span>
                        <select name="level">
                            {$lst_users_levels}
                        </select>
                    </label>
                </fieldset>

                <div class="input-group uploader">
                    <div class="preview" data-preview></div>
                    <a class="btn" data-select>Seleccionar imagen</a>
                    <input id="preview" name="avatar" type="file" accept="image/*" data-preview />
                </div>

                <fieldset class="input-group">
                    <label>
                        <span><span class="required-field">*</span>Estado</span>
                        <select name="status">
                            <option value="1">Activado</option>
                            <option value="0">Desactivado</option>
                        </select>
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
<section class="modal alert" data-modal="deactivate">
    <div class="content">
        <header>
            <h4>Alerta</h4>
        </header>
        <main>
            <p>¿Esta seguro de realizar esta acción?</p>
        </main>
        <footer>
            <a class="btn" button-close>Cerrar</a>
            <a class="btn btn-colored" data-action="deactivate">Aceptar</a>
        </footer>
    </div>
</section>
<section class="modal alert" data-modal="delete_user">
    <div class="content">
        <header>
            <h4>Alerta</h4>
        </header>
        <main>
            <p>¿Esta seguro de realizar esta acción?</p>
        </main>
        <footer>
            <a class="btn" button-close>Cancelar</a>
            <a class="btn btn-colored" data-action="delete_user">Aceptar</a>
        </footer>
    </div>
</section>
