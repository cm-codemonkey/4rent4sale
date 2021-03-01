<?php defined('_EXEC') or die; ?>
<div class="container">
    <figure id="logotype">
        <a href="/">
            <img src="{$path.images}logo_type_1_white.svg" alt="logotype"/>
        </a>
    </figure>
    <nav class="main-menu">
        <div class="trigger-main-menu" data-ripple>
          <i class="material-icons">menu</i>
        </div>
        <ul>
            <li><a href="/" data-ripple="2">{$lang.header_home}</a></li>
            <li>
                <a href="" data-ripple="2"><strong>{$lang.header_properties}</strong></a>
                <div class="dropdown">
                    <a href="/properties?locations=playa_del_carmen" data-ripple="2">Playa del Carmen</a>
                    <a href="/properties?locations=tulum" data-ripple="2">Tulum</a>
                    <a href="/properties?locations=puerto_aventuras" data-ripple="2">Puerto Aventuras</a>
                    <a href="/properties?locations=mahahual" data-ripple="2">Mahahual</a>
                    <a href="/properties" data-ripple="2">{$lang.all}</a>
                </div>
            </li>
            <li><a href="/buy" data-ripple="2">{$lang.header_buy_process}</a></li>
            <li><a href="/blog" data-ripple="2">{$lang.header_tulum_style}</a></li>
            <li><a href="/about" data-ripple="2">{$lang.header_about_us}</a></li>
            <li><a href="/contact" data-ripple="2">{$lang.header_contact}</a></li>
            <li>
                <a href="" data-ripple="2">{$lang.language}</a>
                <div class="dropdown">
                    <a href="?<?php echo Language:: getLanUrl('es'); ?> " data-ripple="2">Español</a>
                    <a href="?<?php echo Language:: getLanUrl('en'); ?> " data-ripple="2">English</a>
                </div>
            </li>
        </ul>
    </nav>
</div>
