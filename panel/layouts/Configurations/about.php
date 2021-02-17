<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}configurations.js',
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
    <div class="container space-top50">
        <form name="edit" class="row">
            <div class="span12">
                <div class="md--group-form">
                    <textarea id="description" name="description">{$about_es}</textarea>
                    <span class="bar-bottom"></span>
                    <label>Descripción (ES)</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <textarea id="description_en" name="description_en">{$about_en}</textarea>
                    <span class="bar-bottom"></span>
                    <label>Descripción (EN)</label>
                    <a>Error</a>
                </div>
            </div>
        </form>
        <div class="text-center" style="display: none;">
            <p class="error"></p>
        </div>
        <div class="text-right">
            <a class="btn md--button-flat md--btn-colored" data-action="edit" data-ripple>Guardar</a>
        </div>
    </div>
</section>
