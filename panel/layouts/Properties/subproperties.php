<?php
defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}properties.min.js'
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
        <h6 style="float:left;text-transform: uppercase;">{$title}</h6>
        {$btnAdd}
        <a class="btn md--btn-circle" data-action="delete" data-modal="delete" data-ripple><i class="material-icons">delete</i></a>
    </div>
    <div class="property-items">
        {$subpropertiesList}
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
