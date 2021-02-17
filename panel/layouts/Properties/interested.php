<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'other' => [
        '<script>
            $(document).ready(function()
            {
                menu_view("properties");
                submenu_view("interested");
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
    <div class="table-responsive-vertical">
        <table class="table table-hover table-mc-light-blue">
            <thead>
                <tr>
                    <th>Propiedad</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>País / Clave</th>
                    <th>Teléfono</th>
                    <th>Fecha</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                {$interestedList}
            </tbody>
        </table>
    </div>
</section>
