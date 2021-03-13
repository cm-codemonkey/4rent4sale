<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.layouts
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since November 14, 2018 <1.0.0> <@update>
* @version 1.0.0
* @summary Se integraron los permisos de usuarios.
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

 ?>

<header class="topbar">
    <nav class="res-menu">
        <a href="" data-action="open-res-menu"><i class="material-icons logged">menu</i></a>
    </nav>
    <figure class="logotype">
        <img src="../{$path.images}imagotype_black.png" alt="Logotype" />
    </figure>
    <nav class="menu">
        <a class="logged"><i class="material-icons logged">lens</i><?php echo Session::get_value('_vkye_username') ?></a>
        <a href="index.php?c=system&m=logout"><i class="material-icons">lock</i><span>Cerrar sesión</span></a>
    </nav>
    <div class="clear"></div>
</header>
<header class="sidebar">
    <?php if (Functions::check_access_permissions(['{superadministrator}', '{administrator}']) == true) { ?>
    <a href="index.php?c=properties"><i class="material-icons">home</i><span>Propiedades</span></a>
    <div class="submenu">
        <a href="index.php?c=properties"><i class="material-icons">keyboard_arrow_right</i><span>Lista de propiedades</span></a>
        <a href="index.php?c=properties&m=categories"><i class="material-icons">keyboard_arrow_right</i><span>Categorìas</span></a>
        <a href="index.php?c=properties&m=locations"><i class="material-icons">keyboard_arrow_right</i><span>Ubicaciones</span></a>
    </div>
    <?php } ?>
    <a href="index.php?c=magazine"><i class="material-icons">collections_bookmark</i><span>TIPI Magazine</span></a>
    <?php if (Functions::check_access_permissions(['{superadministrator}', '{administrator}']) == true) { ?>
    <a href="index.php?c=contact"><i class="material-icons">contacts</i><span>Contacto</span></a>
    <a href="index.php?c=settings"><i class="material-icons">settings</i><span>Configuraciones</span></a>
    <?php } ?>
    <?php if (Functions::check_access_permissions(['{superadministrator}']) == true) { ?>
    <a href="index.php?c=users"><i class="material-icons">supervisor_account</i><span>Usuarios</span></a>
    <?php } ?>
</header>
