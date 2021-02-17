<?php
defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}properties.js',
        '{$path.plugins}tinymce/tinymce.min.js'
    ],
    'other' => [
        '<script>
            $(document).ready(function()
            {
                tinymce.init({
                  selector: "textarea",
                  height: 200,
                  menubar: true,
                  plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste code"
                  ],
                  toolbar: "undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                  content_css: "//www.tinymce.com/css/codepen.min.css"
                });
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
    <form name="edit" class="row">
        <figure class="file">
            <img id="imgLink" src="{$cover}" alt="" />
            <div class="upload">
                <input id="link" type="file" name="link" accept="image/*">
            </div>
        </figure>
        <div class="container">
            <div class="span12">
                <div class="md--group-form">
                    <input name="seo-keywords" type="text" value="{$seo_keywords}" required>
                    <span class="bar-bottom"></span>
                    <label>Keyword (SEO)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <input name="seo-description" type="text" value="{$seo_description}" required>
                    <span class="bar-bottom"></span>
                    <label>Descripción (SEO)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <input name="title" type="text" value="{$title}" required>
                    <span class="bar-bottom"></span>
                    <label>Titulo</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <textarea id="description" name="description">{$description}</textarea>
                    <span class="bar-bottom"></span>
                    <label>Descripción (ES)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <textarea id="description_en" name="description_en">{$description_en}</textarea>
                    <span class="bar-bottom"></span>
                    <label>Descripción (EN)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <select name="location" required />
                        {$locationsList}
                    </select>
                    <span class="bar-bottom"></span>
                    <label>Ubicación</label>
                    <a>Error</a>
                </div>
            </div>
            <!-- <div class="span4">
                <div class="md--group-form">
                    <select name="category" required />
                        {$categoriesList}
                    </select>
                    <span class="bar-bottom"></span>
                    <label>Categoría</label>
                    <a>Error</a>
                </div>
            </div> -->
            <div class="span6">
                <div class="md--group-form">
                    <select name="subcategory" required />
                        {$subcategoryList}
                    </select>
                    <span class="bar-bottom"></span>
                    <label>Categoría</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input name="price" type="text" placeholder="Desde:" value="{$price}" required>
                    <span class="bar-bottom"></span>
                    <label>Precio</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <select name="coin" required />
                        {$coinList}
                    </select>
                    <span class="bar-bottom"></span>
                    <label>Moneda</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <input name="delivery" type="text" value="{$delivery}" required>
                    <span class="bar-bottom"></span>
                    <label>Entrega</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <input name="delivery_en" type="text" value="{$delivery_en}" required>
                    <span class="bar-bottom"></span>
                    <label>Entrega</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input name="teaser" value="{$teaser}" required>
                    <span class="bar-bottom"></span>
                    <label>Teaser (ES)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input name="teaser_en" value="{$teaser_en}" required>
                    <span class="bar-bottom"></span>
                    <label>Teaser (EN)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12 text-right">
                {$typeMultipleList}
            </div>
            <!-- <div class="span6 {$hidden}" data-hidden>
                <div class="md--group-form">
                    <input name="rooms" type="text" value="{$rooms}" required>
                    <span class="bar-bottom"></span>
                    <label>Habitaciones (ES)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6 {$hidden}" data-hidden>
                <div class="md--group-form">
                    <input name="rooms_en" type="text" value="{$rooms_en}" required>
                    <span class="bar-bottom"></span>
                    <label>Habitaciones (EN)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input name="rooms_number_min" type="number" value="{$rooms_number_min}" required>
                    <span class="bar-bottom"></span>
                    <label>N. de habitaciones (Min)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input name="rooms_number_max" type="number" value="{$rooms_number_max}" required>
                    <span class="bar-bottom"></span>
                    <label>N. de habitaciones (Max)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6 {$hidden}" data-hidden>
                <div class="md--group-form">
                    <input name="m2" type="text" value="{$m2}" required>
                    <span class="bar-bottom"></span>
                    <label>M2 (ES)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6 {$hidden}" data-hidden>
                <div class="md--group-form">
                    <input name="m2_en" type="text" value="{$m2_en}" required>
                    <span class="bar-bottom"></span>
                    <label>M2 (EN)</label>
                    <a>Error</a>
                </div>
            </div> -->
            <div class="span12 {$hidden}" data-hidden>
                <div class="md--group-form">
                    <select name="status" required />
                        {$statusList}
                    </select>
                    <span class="bar-bottom"></span>
                    <label>Status</label>
                    <a>Error</a>
                </div>
            </div>
            <!-- <div class="span6 {$hidden}" data-hidden>
                <h6 class="title">Caracteristicas</h6>
                {$characteristicsList}
            </div>
            <div class="span6">
                <h6 class="title">Amenidades</h6>
                {$amenitiesList}
            </div> -->
            <div class="span6">
                <h6 class="title">PDF</h6>
                <input id="pdf" type="file" name="link" accept="application/pdf">
                {$pdfList}
            </div>
            <!-- <div class="span6">
                <div class="md--group-form">
                    <input type="number" name="popular" required value="{$popular}">
                    <span class="bar-bottom"></span>
                    <label>Nivel de destacado en las propiedades</label>
                    <a>Error</a>
                </div>
            </div> -->
        </div>
    </form>
    <div class="container">
        <div class="text-center" style="display: none;">
            <p class="error"></p>
        </div>
        <div class="text-right">
            <a class="btn md--button-flat" href="index.php?c=properties" data-ripple>Regresar</a>
            <a class="btn md--button-flat md--btn-colored" data-action="edit" data-ripple>Aceptar</a>
            {$sendArray}
        </div>
    </div>
</section>
