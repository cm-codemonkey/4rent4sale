<?php
defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}services.min.js'
    ],
    'other' => [
        '<script>
            $(document).ready(function()
            {
                menu_view("services");
            });
        </script>'
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
        <form name="new" class="row">
            <div class="span12">
                <div class="md--group-form">
                    <input name="title" type="text" required>
                    <span class="bar-bottom"></span>
                    <label>Titulo</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <input name="description" type="text" required>
                    <span class="bar-bottom"></span>
                    <label>Descripción</label>
                    <a>Error</a>
                </div>
            </div>
        </form>
        <div class="text-center" style="display: none;">
            <p class="error"></p>
        </div>
        <div class="text-right">
            <a class="btn md--button-flat" href="index.php?c=services" data-ripple>Cancelar</a>
            <a class="btn md--button-flat md--btn-colored" data-action="new" data-ripple>Aceptar</a>
        </div>
    </div>
</section>
