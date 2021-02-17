<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}categories.min.js'
    ],
    'other' => [
        '<script>
            $(document).ready(function()
            {
                menu_view("configurations");
                submenu_view("categories");
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
                <input id="link" type="file" name="link">
            </div>
        </figure>
        <div class="container">
            <div class="span6">
              <div class="md--group-form">
                <input name="title" type="text" value="{$title_es}" required>
                <span class="bar-bottom"></span>
                <label>Categoría (ES)</label>
                <a>Error</a>
              </div>
            </div>
            <div class="span6">
              <div class="md--group-form">
                <input name="title_en" type="text" value="{$title_en}" required>
                <span class="bar-bottom"></span>
                <label>Categoría (EN)</label>
                <a>Error</a>
              </div>
            </div>
        </div>
    </form>
    <div class="text-center" style="display: none;">
      <p class="error"></p>
    </div>
    <div class="container">
        <div class="text-right">
            <a class="btn md--button-flat" href="index.php?c=properties&m=categories" data-ripple>Cancelar</a>
            <a class="btn md--button-flat md--btn-colored" data-action="edit" data-ripple>Aceptar</a>
        </div>
    </div>
</section>
