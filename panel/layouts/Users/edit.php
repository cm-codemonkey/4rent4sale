<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}users.min.js',
        '{$path.plugins}ckeditor/ckeditor.js'
    ]
]);
?>
<header class="topbar">
    %{topbar}%
</header>
<section class="sidebar">
    %{sidebar}%
</section>
<section class="main-content">
    <div class="container">
        <div class="space100"></div>
        <form name="edit" class="row">
            <div class="span12">
                <div class="md--group-form">
                    <input name="name" type="text" placeholder="Escriba su nombre" maxlength="15"  value="{$name}" required>
                    <span class="bar-bottom"></span>
                    <label>Nombre</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <textarea id="description" placeholder="" required>{$description}</textarea>
                    <span class="bar-bottom"></span>
                    <label>Descripción</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <input name="username" type="text" placeholder="Nombre de usuario" maxlength="15" value="{$username}"  required>
                    <span class="bar-bottom"></span>
                    <label>Usuario</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <input name="email" type="email" placeholder="Correo electronico" maxlength="100" value="{$email}" required>
                    <span class="bar-bottom"></span>
                    <label>Email</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <select name="level" required>
                        {$level}
                    </select>
                    <span class="bar-bottom"></span>
                    <label>Level</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12" style="display: none;">
                <p class="error"></p>
            </div>
        </form>
        <div class="text-right">
            <a href="index.php?c=users" class="btn md--button-flat" data-ripple>Regresar</a>
            <a class="btn md--button-flat md--btn-colored" data-action="edit" data-ripple>Aceptar</a>
        </div>
    </div>
</section>
