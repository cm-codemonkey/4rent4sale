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

?>

%{header}%
<section class="main-container">
    <div class="title">
        <h1>TIPI Magazine | Galería</h1>
    </div>
    <div class="buttons">
        <a class="btn" href="index.php?c=magazine">Regresar</a>
    </div>
    <div class="content cm-gallery-style-1">
        <div class="new">
            <input id="file" type="file" class="hidden" />
            <a href="" data-action="new_gallery_image"><i class="material-icons">add_circle_outline</i></a>
        </div>
        {$lst_gallery_images}
        <div class="clear"></div>
    </div>
</section>
