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
            <div class="span6">
                <div class="md--group-form">
                    <input name="title" type="text" placeholder="Titulo" required>
                    <span class="bar-bottom"></span>
                    <label>Título (ES)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input name="title_en" type="text" placeholder="Titulo" required>
                    <span class="bar-bottom"></span>
                    <label>Título (EN)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <textarea id="description" placeholder="Descripción general" name="description"></textarea>
                    <span class="bar-bottom"></span>
                    <label>Descripción (ES)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <textarea id="description_en" placeholder="Descripción general" name="description_en"></textarea>
                    <span class="bar-bottom"></span>
                    <label>Descripción (EN)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span4">
                <div class="md--group-form">
                    <input type="number" name="popular_blog" required>
                    <span class="bar-bottom"></span>
                    <label>Destacado</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span4">
                <div class="md--group-form">
                    <input type="number" name="popular_home" required>
                    <span class="bar-bottom"></span>
                    <label>Destacado (Página de inicio)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span4">
                <div class="md--group-form">
                    <select name="location" required />
                        <option></option>
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
        <div class="text-center" style="display: none;">
            <p class="error"></p>
        </div>
        <div class="text-right">
            <a class="btn md--button-flat" href="index.php?c=blog" data-ripple>Cancelar</a>
            <a class="btn md--button-flat md--btn-colored" data-action="new" data-ripple>Aceptar</a>
        </div>
    </div>
</section>
