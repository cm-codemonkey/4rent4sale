<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}properties.min.js',
        '{$path.plugins}ckeditor/ckeditor.js'
    ],
    'other' => [
        '<script>
            $(document).ready(function()
            {
                menu_view("suscriptions");
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
                    <th>Nombre</th>
                    <th>Subscripción</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                {$subscriptionsList}
            </tbody>
        </table>
    </div>
</section>
