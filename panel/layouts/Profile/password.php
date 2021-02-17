<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}profile.min.js'
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
            <div class="span6">
                <div class="md--group-form">
                    <input name="password" type="password" required>
                    <span class="bar-bottom"></span>
                    <label>Nueva contraseña</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span6">
                <div class="md--group-form">
                    <input name="password_repeat" type="password" required>
                    <span class="bar-bottom"></span>
                    <label>Repita su nueva contraseña</label>
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
            <a class="btn md--button-flat md--btn-colored" data-action="edit" data-ripple>Aceptar</a>
        </div>
    </div>
</section>
