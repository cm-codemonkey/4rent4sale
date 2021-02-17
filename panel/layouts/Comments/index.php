<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}comments.js'
    ],
    'other' => [
        '<script>
            $(document).ready(function()
            {
                menu_view("comments");
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
        <a class="btn md--btn-circle" data-action="delete" data-modal="delete" data-ripple><i class="material-icons">delete</i></a>
    </div>
    <div class="table-responsive-vertical">
        <table class="table table-hover table-mc-light-blue">
            <thead>
                <tr>
                    <th width="30px"><input type="checkbox" data-check-all /></th>
                    <th>Nombre</th>
                    <th>Comentario</th>
                    <th width="100px">Fecha</th>
                    <th width="30px">Visible</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {$commentsList}
            </tbody>
        </table>
    </div>
</section>

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
