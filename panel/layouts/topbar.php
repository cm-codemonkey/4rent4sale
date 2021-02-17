<?php defined('_EXEC') or die; ?>
<div class="topbar-content">
    <div class="float-left align-items-center">
        <div class="logo-content">
            <figure>
                <img src="{$path.images}logo_type_1_black.svg" alt="">
            </figure>
            <div class="clear"></div>
        </div>
    </div>
    <div class="float-right align-items-center">
        <span>{$username}</span>
        <a id="open-swipemenu" href=""><i class="material-icons">menu</i></a>
    </div>
</div>

<div id="swipemenu">
    <div class="overlay"></div>
    <div class="swipe">
        <!-- <div class="item">
            <a href="index.php?c=settings"><i class="material-icons">settings</i>Configuraciones</a>
        </div> -->
        <div class="item">
            <a href="index.php?c=profile"><i class="material-icons">person</i>Perfil</a>
            <a href="index.php?c=profile&m=password"><i class="material-icons">lock</i>Cambiar Contraseña</a>
            <a href="index.php?c=system&m=logout"><i class="material-icons">power_settings_new</i>Cerrar Sesión</a>
        </div>
    </div>
</div>
