<?php defined('_EXEC') or die; ?>
<div class="topbar-content">
    <div class="float-right align-items-center">
        <span>{$username}</span>
        <a id="open-swipemenu" href=""><i class="material-icons">menu</i></a>
    </div>
</div>
<div id="swipemenu">
    <div class="overlay"></div>
    <div class="swipe">
        <div class="item">
            <a href="index.php?c=profile"><i class="material-icons">person</i>Perfil</a>
            <a href="index.php?c=profile&m=password"><i class="material-icons">lock</i>Cambiar Contraseña</a>
            <a href="index.php?c=system&m=logout"><i class="material-icons">power_settings_new</i>Cerrar Sesión</a>
        </div>
    </div>
</div>
