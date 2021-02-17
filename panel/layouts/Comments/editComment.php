<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}comments.js'
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
    <div class="container">
        <form name="edit" class="row">
            <div class="span12">
                <div class="md--group-form">
                    <textarea name="comment">{$comment}</textarea>
                    <span class="bar-bottom"></span>
                    <label></label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input type="text" value="{$name}" disabled>
                    <span class="bar-bottom"></span>
                    <label>Nombre</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input type="text" value="{$date}" disabled>
                    <span class="bar-bottom"></span>
                    <label>Fecha</label>
                    <a>Error</a>
                </div>
            </div>
        </form>
        <div class="text-center" style="display: none;">
          <p class="error"></p>
        </div>
    </div>
    <div class="container">
        <div class="text-right">
            <a class="btn md--button-flat" href="index.php?c=comments" data-ripple>Regresar</a>
            <a class="btn md--button-flat md--btn-colored" data-action="edit" data-ripple>Aceptar</a>
        </div>
    </div>
</section>
