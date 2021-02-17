<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}properties.js'
    ],
    'other' => [
        '<script>
            $(document).ready(function()
            {
                menu_view("properties");
                submenu_view("all");
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
        <a class="btn md--btn-circle" href="index.php?c=properties&m=addProperty" data-ripple><i class="material-icons">add</i></a>
        <a class="btn md--btn-circle" data-action="delete" data-modal="delete" data-ripple><i class="material-icons">delete</i></a>
    </div>

    <h4>Preventa</h4>
    <div class="table-responsive-vertical">
        <table class="table table-hover table-mc-light-blue">
            <thead>
                <tr>
                    <th width="30px"></th>
                    <th>Titulo</th>
                    <th width="100px">Tipo</th>
                    <th>Ubicación</th>
                    <!-- <th>Categoría</th> -->
                    <th width="100px">Destacado</th>
                    <th width="120px"></th>
                </tr>
            </thead>
            <tbody>
                {$list1}
            </tbody>
        </table>
    </div>

    <h4>Reventa</h4>
    <div class="table-responsive-vertical">
        <table class="table table-hover table-mc-light-blue">
            <thead>
                <tr>
                    <th width="30px"></th>
                    <th>Titulo</th>
                    <th width="100px">Tipo</th>
                    <th>Ubicación</th>
                    <!-- <th>Categoría</th> -->
                    <th width="100px">Destacado</th>
                    <th width="120px"></th>
                </tr>
            </thead>
            <tbody>
                {$list2}
            </tbody>
        </table>
    </div>

    <h4>Terrenos</h4>
    <div class="table-responsive-vertical">
        <table class="table table-hover table-mc-light-blue">
            <thead>
                <tr>
                    <th width="30px"></th>
                    <th>Titulo</th>
                    <th width="100px">Tipo</th>
                    <th>Ubicación</th>
                    <!-- <th>Categoría</th> -->
                    <th width="100px">Destacado</th>
                    <th width="120px"></th>
                </tr>
            </thead>
            <tbody>
                {$list3}
            </tbody>
        </table>
    </div>
</section>

<div class="modal" data-modal-target-destination="editPopular">
    <section class="content">
        <header class="modal-header">
            <h3><i class="material-icons">add</i> Editar Destacado</h3>
        </header>
        <main class="modal-main">
            <form name="editPopular">
                <div class="row">
                    <div class="span12">
                        <div class="md--group-form">
                            <input type="number" name="popular">
                            <span class="bar-bottom"></span>
                            <label>Nivel de destacado en las propiedades</label>
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
        <a class="btn md--button-flat md--btn-colored" data-action="editPopular" data-ripple>Aceptar</a>
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
