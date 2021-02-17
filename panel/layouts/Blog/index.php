<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}blog.js'
    ],
    'other' => [
        '<script>
            $(document).ready(function()
            {
                menu_view("blog");
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
        <a class="btn md--btn-circle" href="index.php?c=blog&m=addEntry" data-ripple><i class="material-icons">add</i></a>
        <a class="btn md--btn-circle" data-action="delete" data-modal="delete" data-ripple><i class="material-icons">delete</i></a>
    </div>

    <h4>Destacados (Página de inicio)</h4>
    <div class="table-responsive-vertical">
        <table class="table table-hover table-mc-light-blue">
            <thead>
                <tr>
                    <th width="30px"><input type="checkbox" data-check-all /></th>
                    <th>Titulo</th>
                    <th width="100px">Fecha</th>
                    <th>Autor</th>
                    <th width="100px">Destacado</th>
                    <th>Ubicación</th>
                    <th width="100px"></th>
                </tr>
            </thead>
            <tbody>
                {$list1}
            </tbody>
        </table>
    </div>

    <h4>Todos</h4>
    <div class="table-responsive-vertical">
        <table class="table table-hover table-mc-light-blue">
            <thead>
                <tr>
                    <th width="30px"><input type="checkbox" data-check-all /></th>
                    <th>Titulo</th>
                    <th width="100px">Fecha</th>
                    <th>Autor</th>
                    <th width="100px">Destacado</th>
                    <th>Ubicación</th>
                    <th width="100px"></th>
                </tr>
            </thead>
            <tbody>
                {$list2}
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
                            <input type="number" name="popular_blog">
                            <span class="bar-bottom"></span>
                            <label>Destacado</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span12">
                        <div class="md--group-form">
                            <input type="number" name="popular_home">
                            <span class="bar-bottom"></span>
                            <label>Destacado (Página de inicio)</label>
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
