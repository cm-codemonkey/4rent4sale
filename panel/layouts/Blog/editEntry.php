<?php
defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}blog.js',
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
                    <textarea id="description" name="description">{$description_es}</textarea>
                    <span class="bar-bottom"></span>
                    <label>Descripcion (ES)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <textarea id="description_en" name="description_en">{$description_en}</textarea>
                    <span class="bar-bottom"></span>
                    <label>Descripcion (EN)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input type="text" placeholder="Fecha" value="{$date}" disabled>
                    <span class="bar-bottom"></span>
                    <label>Fecha</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input type="text" placeholder="Autor" value="{$author}" disabled>
                    <span class="bar-bottom"></span>
                    <label>Autor</label>
                    <a>Error</a>
                </div>
            </div>
            <!-- <div class="span6">
                <div class="md--group-form">
                    <input type="number" name="popular_blog" required>
                    <span class="bar-bottom"></span>
                    <label>Destacado</label>
                    <a>Error</a>
                </div>
            </div> -->
            <div class="span6">
                <div class="md--group-form">
                    <select name="location" required />
                        {$locationsList}
                    </select>
                    <span class="bar-bottom"></span>
                    <label>Ubicación / Zona</label>
                    <a>Error</a>
                </div>
            </div>
        </div>
    </form>
    <div class="container">
        <div class="span12" style="display: none;">
            <p class="error"></p>
        </div>
        <div class="text-right">
            <a class="btn md--button-flat" href="index.php?c=blog" data-ripple>Regresar</a>
            <a class="btn md--button-flat md--btn-colored" data-action="edit" data-ripple>Aceptar</a>
        </div>
    </div>
</section>
