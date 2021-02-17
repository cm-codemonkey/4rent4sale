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
            <li><a href="/about" data-ripple="2">{$lang.header_about_us}</a></li>
            <li>
                <a href="" data-ripple="2"><strong>{$lang.header_properties}</strong></a>
                <div class="dropdown">
                    <a href="/properties?subcategory=presale" data-ripple="2">{$lang.presale}</a>
                    <a href="/properties?subcategory=resale" data-ripple="2">{$lang.resale}</a>
                    <a href="/properties?subcategory=lots" data-ripple="2">{$lang.lots}</a>
                    <a href="/properties" data-ripple="2">{$lang.all}</a>
                </div>
            </li>
            <li><a href="/buy" data-ripple="2">{$lang.header_buy_process}</a></li>
            <li><a href="/blog" data-ripple="2">{$lang.header_tulum_style}</a></li>
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
