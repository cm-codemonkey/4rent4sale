<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}features.min.js'
    ],
    'other' => [
        '<script>
            $(document).ready(function()
            {
                menu_view("configurations");
                submenu_view("features");
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
    <div class="container space-top50">
        <form name="edit" class="row">
            <div class="span6">
                <div class="md--group-form">
                    <input name="title" type="text" placeholder="Titulo" value="{$title_es}" required>
                    <span class="bar-bottom"></span>
                    <label>Titulo (ES)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input name="title_en" type="text" placeholder="Titulo" value="{$title_en}" required>
                    <span class="bar-bottom"></span>
                    <label>Titulo (EN)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <select name="type" required />
                        {$typeList}
                    </select>
                    <span class="bar-bottom"></span>
                    <label>Tipo</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <input name="icon" type="text" placeholder="Si desea actualizar el icono, únicamente ingrese el nuevo código." value="" required>
                    <span class="bar-bottom"></span>
                    <label>{$icon}</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <a href="https://design.google.com/icons/" class="btn md--btn-colored" target="_blank">Material design icons</a>
                <a href="http://fontawesome.io/icons/" class="btn md--btn-colored" target="_blank">Font Awenson Icons</a>
            </div>
        </form>
        <div class="text-center" style="display: none;">
            <p class="error"></p>
        </div>
        <div class="text-right">
            <a class="btn md--button-flat" href="index.php?c=properties&m=features" data-ripple>Cancelar</a>
            <a class="btn md--button-flat md--btn-colored" data-action="edit" data-ripple>Aceptar</a>
        </div>
    </div>
</section>
