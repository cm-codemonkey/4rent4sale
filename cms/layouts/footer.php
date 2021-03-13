<?php

defined('_EXEC') or die;

/**
* @package valkyrie.cms.layouts
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 18, 2018 <1.0.0> <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template (only the <footer class"lowbar"></footer>)
*
* @copyright Copyright (C) Code Monkey S de RL <contact@codemonkey.com.mx, wwww.codemonkey.com.mx>. Todos los derechos reservados.
*/

?>

        <footer class="lowbar">
            <p>Desarrollado por <a href="https://codemonkey.com.mx/" target="_blank">Code Monkey</a> Copyright (C) Todos los derechos reservados</p>
        </footer>

        <!-- Load scripts -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="{$path.js}jquery-2.1.4.min.js"></script>
        <script src="{$path.js}valkyrie.js"></script>
        <script src="{$path.js}cm-scripts.js"></script>
        <script src="{$path.js}scripts.js"></script>

        <!-- Font awenson icons -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

        {$dependencies.js}

        {$dependencies.other}
    </body>
</html>
