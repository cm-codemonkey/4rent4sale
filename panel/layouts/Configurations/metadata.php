<?php
defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}configurations.js'
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
        <form id="form-metadata" name="metadata" class="row">
            <div class="span12">
                <div class="md--group-form">
                    <textarea id="description" name="description">{description}</textarea>
                    <span class="bar-bottom"></span>
                    <label>Descripción</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <textarea id="description_en" name="keywords">{keywords}</textarea>
                    <span class="bar-bottom"></span>
                    <label>Keywords</label>
                    <a>Error</a>
                </div>
            </div>
        </form>
        <div class="text-center" style="display: none;">
            <p class="error"></p>
        </div>
        <div class="text-right">
            <a class="btn md--button-flat md--btn-colored" data-action="send-metadata" data-ripple>Guardar</a>
        </div>
    </div>
</section>
