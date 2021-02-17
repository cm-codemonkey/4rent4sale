<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}users.min.js'
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
        <form name="pwd" class="row">
            <div class="span12">
                <div class="md--group-form">
                    <input name="password" type="password" placeholder="Escriba su nueva contraseña" maxlength="200" required>
                    <span class="bar-bottom"></span>
                    <label>Contraseña</label>
                    <a>Error</a>
                </div>
            </div>
            <input name="id" type="hidden" value="{$id}">
            <div class="span12" style="display: none;">
                <p class="error"></p>
            </div>
        </form>
        <div class="text-right">
            <a href="index.php?c=users" class="btn md--button-flat" data-ripple>Regresar</a>
            <a class="btn md--button-flat md--btn-colored" data-action="pwd" data-ripple>Aceptar</a>
        </div>
    </div>
</section>
