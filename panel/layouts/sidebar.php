<?php defined('_EXEC') or die; ?>
<nav>
    <div class="open-submenu">
        <a href="" data-target="properties"><i class="material-icons">home</i>Propiedades</a>
        <div class="submenu" data-target="properties">
            <a href="index.php?c=properties" data-target="all"><i class="material-icons">list</i>Todas</a>
            <a href="index.php?c=properties&m=interested" data-target="interested"><i class="material-icons">playlist_add_check</i>Las que interesan</a>
        </div>
    </div>
    <a href="index.php?c=blog" data-target="blog"><i class="material-icons">store</i>Blog</a>
    <div class="open-submenu">
        <a href="" data-target="configurations"><i class="material-icons">settings</i>Configuraciones</a>
        <div class="submenu" data-target="configurations">
            <a href="index.php?c=configurations&m=metadata" data-target="metadata"><i class="material-icons">code</i>Metadata</a>
            <a href="index.php?c=properties&m=locations" data-target="locations"><i class="material-icons">location_on</i>Ubicaciónes</a>
            <!-- <a href="index.php?c=properties&m=categories" data-target="categories"><i class="material-icons">view_module</i>Categorias</a> -->
            <!-- <a href="index.php?c=properties&m=features" data-target="features"><i class="material-icons">dialpad</i>Caract. y Emenidades</a> -->
            <a href="index.php?c=configurations&m=about" data-target="about"><i class="material-icons">insert_emoticon</i>Acerca de Nosotros</a>
            <a href="index.php?c=configurations&m=buy" data-target="buy"><i class="material-icons">card_travel</i>Proceso de Compra</a>
            <a href="index.php?c=configurations&m=contact" data-target="contact"><i class="material-icons">contacts</i>Contacto</a>
            <a href="index.php?c=configurations&m=covers" data-target="covers"><i class="material-icons">insert_photo</i>Portadas</a>
            <a href="index.php?c=configurations&m=sliderHome" data-target="sliderhome"><i class="material-icons">photo_album</i>Home slider</a>
        </div>
    </div>
    <a href="index.php?c=subscriptions" data-target="suscriptions"><i class="material-icons">subscriptions</i>Suscripciones</a>
    <a href="index.php?c=users"><i class="material-icons">people</i>Usuarios</a>
</nav>
