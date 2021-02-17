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
        <form name="edit_contact_us" class="row">
            <div class="span12">
                <div class="md--group-form">
                    <input name="contact_us_phone" type="text" required value="{$contact_us_phone}" />
                    <span class="bar-bottom"></span>
                    <label>Teléfono</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <input name="contact_us_email" type="email" required value="{$contact_us_email}" />
                    <span class="bar-bottom"></span>
                    <label>Email</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <input name="contact_us_address" type="text" required value="{$contact_us_address}" />
                    <span class="bar-bottom"></span>
                    <label>Dirección</label>
                    <a>Error</a>
                </div>
            </div>
        </form>
        <div class="text-center" style="display: none;">
            <p class="error"></p>
        </div>
        <div class="text-right">
            <a class="btn md--button-flat md--btn-colored" data-action="edit_contact_us" data-ripple>Guardar</a>
        </div>
    </div>
</section>
