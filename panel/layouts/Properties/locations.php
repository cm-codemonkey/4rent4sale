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
    <div class="buttons-actions">
        <a class="btn md--btn-circle" data-modal="new" data-ripple><i class="material-icons">add</i></a>
        <a class="btn md--btn-circle" data-action="delete" data-modal="delete" data-ripple><i class="material-icons">delete</i></a>
    </div>
    <div class="table-responsive-vertical">
        <table class="table table-hover table-mc-light-blue">
            <thead>
                <tr>
                    <th width="30px"><input type="checkbox" data-check-all /></th>
                    <th>Ubicación</th>
                    <th>Utilizar en propiedades</th>
                    <th>Utilizar en blog</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {$locationsList}
            </tbody>
        </table>
    </div>
</section>

<div class="modal" data-modal-target-destination="new">
    <section class="content">
      <header class="modal-header">
        <h3><i class="material-icons">add</i> Nueva ubicación</h3>
      </header>
      <main class="modal-main">
        <form name="new">
          <div class="row">
            <div class="span12">
              <div class="md--group-form">
                <input name="title" type="text" required>
                <span class="bar-bottom"></span>
                <label>Ubicación</label>
                <a>Error</a>
              </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <select name="properties">
                        <option value="0">No</option>
                        <option value="1">Si</option>
                    </select>
                    <span class="bar-bottom"></span>
                    <label>Usar ubicaciòn para propiedades</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12">
                <div class="md--group-form">
                    <select name="blog">
                        <option value="0">No</option>
                        <option value="1">Si</option>
                    </select>
                    <span class="bar-bottom"></span>
                    <label>Usar ubicaciòn para blog</label>
                    <a>Error</a>
                </div>
            </div>
            <div class="span12" style="display: none;">
              <p class="error"></p>
            </div>
          </div>
        </form>
      </main>
      <footer class="modal-footer">
        <a class="btn md--button-flat" data-action-modal="cancel" data-ripple>Cancelar</a>
        <a class="btn md--button-flat md--btn-colored" data-action-modal="new" data-ripple>Aceptar</a>
      </footer>
    </section>
</div>

<div class="modal" data-modal-target-destination="delete">
    <section class="content">
        <header class="modal-header">
            <h3><i class="material-icons">warning</i> Aviso</h3>
        </header>
        <main class="modal-main">
            <p>¿Esta seguro que desea eliminar esta selección?</p>
        </main>
        <footer class="modal-footer">
            <a class="btn md--button-flat" data-action-modal="cancel" data-ripple>Cancelar</a>
            <a class="btn md--button-flat md--btn-colored" data-action-modal="delete" data-ripple>Aceptar</a>
        </footer>
    </section>
</div>
