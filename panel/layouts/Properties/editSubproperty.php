<?php
defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}properties.min.js'
    ],
    'other' => [
        '<script>
            $(document).ready(function()
            {
                menu_view("properties");
                submenu_view("all");
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
    <form name="editSubproperty" class="row">
        <figure class="file">
            <img id="imgLink" src="{$cover}" alt="" />
            <div class="upload">
                <input id="link" type="file" name="link" accept="image/*">
            </div>
        </figure>
        <div class="container">
            <div class="span12">
                <div class="md--group-form">
                    <input name="title" type="text" value="{$title}" required>
                    <span class="bar-bottom"></span>
                    <label>Titulo</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6" data-hidden>
                <div class="md--group-form">
                    <input name="rooms" type="text"  value="{$rooms}" required>
                    <span class="bar-bottom"></span>
                    <label>Habitaciones (ES)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6" data-hidden>
                <div class="md--group-form">
                    <input name="m2" type="text"  value="{$m2}" required>
                    <span class="bar-bottom"></span>
                    <label>M2 (ES)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6" data-hidden>
                <div class="md--group-form">
                    <input name="rooms_en" type="text"  value="{$rooms_en}" required>
                    <span class="bar-bottom"></span>
                    <label>Habitaciones (EN)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6" data-hidden>
                <div class="md--group-form">
                    <input name="m2_en" type="text"  value="{$m2_en}" required>
                    <span class="bar-bottom"></span>
                    <label>M2 (EN)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12" data-hidden>
                <div class="md--group-form">
                    <select name="status" required />
                        {$statusList}
                    </select>
                    <span class="bar-bottom"></span>
                    <label>Status</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12" data-hidden>
                <h6 class="title">Caracteristicas</h6>
                {$characteristicsList}
            </div>
        </div>
    </form>
    <div class="container">
        <div class="text-center" style="display: none;">
            <p class="error"></p>
        </div>
        <div class="text-right">
            {$btnReturn}
            <a class="btn md--button-flat md--btn-colored" data-action="editSubproperty" data-ripple>Aceptar</a>
            {$sendArray}
        </div>
    </div>
</section>
