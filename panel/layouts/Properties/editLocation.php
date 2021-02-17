<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}locations.min.js'
    ],
    'other' => [
        '<script>
            $(document).ready(function()
            {
                menu_view("configurations");
                submenu_view("locations");
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
                    <input name="title" type="text" value="{$title_location}" required>
                    <span class="bar-bottom"></span>
                    <label>Ubicación</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <select name="properties">
                        {$lstPropertiesFlag}
                    </select>
                    <span class="bar-bottom"></span>
                    <label>Usar ubicaciòn para propiedades</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <select name="blog">
                        {$lstBlogFlag}
                    </select>
                    <span class="bar-bottom"></span>
                    <label>Usar ubicaciòn para blog</label>
                    <a>Error</a>
                </div>
            </div>
        </form>
        <div class="text-center" style="display: none;">
          <p class="error"></p>
        </div>
        <div class="text-right">
            <a class="btn md--button-flat" href="index.php?c=properties&m=locations" data-ripple>Cancelar</a>
            <a class="btn md--button-flat md--btn-colored" data-action="edit" data-ripple>Aceptar</a>
        </div>
    </div>
</section>
