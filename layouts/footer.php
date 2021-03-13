<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.layouts
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template (only the <footer class"main-footer"></footer>)
*
* @author Irving Martinez Santiago <Chief Software Development Officer, imartinez@codemonkey.com.mx>
* @since October 15, 2018 <1.0.0> <@update>
* @summary Integración del diseño del footer
*
* @author Alejandro Fernando Cabrera Contreras <Developer, acabrera@codemonkey.com.mx>
* @since October 29, 2018 <1.0.0> <@update>
* @summary Uso de variables de Facebook e instagram
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

?>

        <footer class="main-footer">
            <figure>
                <img src="{$path.images}logotype_black.png" alt="logotype">
            </figure>
            <div class="social-media">
                <a href="{$facebook}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="{$instagram}" target="_blank"><i class="fab fa-instagram"></i></a>
                <div class="clear"></div>
            </div>
            <span>Copyright (C) Tierra Pitaya | {$lang.all_rights_reserved}</span>
            <span>{$lang.developed_by} <a href="https://codemonkey.com.mx/" target="_blank">Code Monkey</a></span>
        </footer>

        <!-- Load scripts -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="{$path.js}jquery-2.1.4.min.js"></script>
        <script src="{$path.js}valkyrie.min.js"></script>
        <script src="{$path.js}cm-scripts.min.js"></script>
        <script src="{$path.js}scripts.min.js"></script>

         <!-- Font awenson icons -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

        {$dependencies.js}
        {$dependencies.other}
    </body>
</html>
