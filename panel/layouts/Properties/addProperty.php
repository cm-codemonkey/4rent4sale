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
                    height: 500,
                    menubar: false,
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
    <form name="new" class="row">
        <figure class="file">
            <img id="imgLink" src="" alt="" />
            <div class="upload">
                <input id="link" type="file" name="link" accept="image/*">
            </div>
        </figure>
        <div class="container">
            <div class="span12">
                <div class="md--group-form">
                    <input name="seo-keywords" type="text" required>
                    <span class="bar-bottom"></span>
                    <label>Keyword (SEO)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <input name="seo-description" type="text" required>
                    <span class="bar-bottom"></span>
                    <label>Descripción (SEO)</label>
                    <a>Error</a>
                </div>
            </div>
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
                    <textarea id="description" name="description"></textarea>
                    <span class="bar-bottom"></span>
                    <label>Descripción (ES)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <textarea id="description_en" name="description_en"></textarea>
                    <span class="bar-bottom"></span>
                    <label>Descripción (EN)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <select name="location" required />
                        <option></option>
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
                        <option></option>
                        {$categoriesList}
                    </select>
                    <span class="bar-bottom"></span>
                    <label>Categoria</label>
                    <a>Error</a>
                </div>
            </div> -->
            <div class="span6">
                <div class="md--group-form">
                    <select name="subcategory" required />
                        <option></option>
                        <option value="1">Preventa</option>
                        <option value="2">Reventa</option>
                        <option value="3">Terrenos</option>
                    </select>
                    <span class="bar-bottom"></span>
                    <label>Categoría</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input name="price" type="number" required>
                    <span class="bar-bottom"></span>
                    <label>Precio (Desde) $</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <select name="coin" required />
                        <option></option>
                        <option value="usd">USD</option>
                        <option value="mxn">MXN</option>
                    </select>
                    <span class="bar-bottom"></span>
                    <label>Moneda</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <input name="delivery" type="text" required>
                    <span class="bar-bottom"></span>
                    <label>Entrega (ES)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <input name="delivery_en" type="text" required>
                    <span class="bar-bottom"></span>
                    <label>Entrega (EN)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input name="teaser" required>
                    <span class="bar-bottom"></span>
                    <label>Teaser (ES)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input name="teaser_en" required>
                    <span class="bar-bottom"></span>
                    <label>Teaser (EN)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12 text-right">
                <label class="display-block">Venta <input name="sell" type="checkbox" checked></label>
                <label class="display-block">Renta <input name="rent" type="checkbox"></label>
                <!-- <label class="display-block">Propiedad multiple <input name="multiple" type="checkbox" data-action="hidden"></label> -->
            </div>
            <!-- <div class="span6" data-hidden>
                <div class="md--group-form">
                    <input name="rooms" type="text" required>
                    <span class="bar-bottom"></span>
                    <label>Habitaciones (ES)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6" data-hidden>
                <div class="md--group-form">
                    <input name="rooms_en" type="text" required>
                    <span class="bar-bottom"></span>
                    <label>Habitaciones (EN)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input name="rooms_number_min" type="number" required>
                    <span class="bar-bottom"></span>
                    <label>N. de habitaciones (Min)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input name="rooms_number_max" type="number" required>
                    <span class="bar-bottom"></span>
                    <label>N. de habitaciones (Max)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6" data-hidden>
                <div class="md--group-form">
                    <input name="m2" type="text" required>
                    <span class="bar-bottom"></span>
                    <label>M2 (ES)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6" data-hidden>
                <div class="md--group-form">
                    <input name="m2_en" type="text" required>
                    <span class="bar-bottom"></span>
                    <label>M2 (EN)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6" data-hidden>
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
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input type="number" name="popular" required>
                    <span class="bar-bottom"></span>
                    <label>Nivel de destacado en las propiedades</label>
                    <a>Error</a>
                </div>
            </div>
        </div>
    </form>
    <div class="container">
        <div class="text-center" style="display: none;">
            <p class="error"></p>
        </div>
        <div class="text-right">
            <a class="btn md--button-flat" href="index.php?c=properties" data-ripple>Cancelar</a>
            <a class="btn md--button-flat md--btn-colored" data-action="new" data-ripple>Aceptar</a>
        </div>
    </div>
</section>
