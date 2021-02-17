<?php defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'js' => [
        '{$path.js}users.js'
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
        <!-- <a class="btn md--btn-circle" data-modal="new" data-ripple><i class="material-icons">person_add</i></a> -->
        <a class="btn md--btn-circle" data-action="delete" data-modal="delete" data-ripple><i class="material-icons">delete</i></a>
    </div>
    <div class="table-responsive-vertical">
        <table class="table table-hover table-mc-light-blue">
            <thead>
                <tr>
                    <th><input type="checkbox" data-check-all /></th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {$list}
            </tbody>
        </table>
    </div>
</section>

<div class="modal" data-modal-target-destination="new">
    <section class="content">
        <header class="modal-header">
            <h3><i class="material-icons">add</i> Nuevo usuario</h3>
        </header>
        <main class="modal-main">
            <form name="new">
                <div class="row">
                    <div class="span12">
                        <div class="md--group-form">
                            <input name="name" type="text" placeholder="Escriba su nombre" maxlength="15"  required>
                            <span class="bar-bottom"></span>
                            <label>Nombre</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span12">
                        <div class="md--group-form">
                            <textarea name="description" placeholder="Descripción del usuario" required></textarea>
                            <span class="bar-bottom"></span>
                            <label>Descripción</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="username" type="text" placeholder="Nombre de usuario" maxlength="15"  required>
                            <span class="bar-bottom"></span>
                            <label>Usuario</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="md--group-form">
                            <input name="password" type="password" placeholder="Contraseña" maxlength="200" required>
                            <span class="bar-bottom"></span>
                            <label>Contraseña</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span12">
                        <div class="md--group-form">
                            <input name="email" type="email" placeholder="Correo electronico" maxlength="100" required>
                            <span class="bar-bottom"></span>
                            <label>Email</label>
                            <a>Error</a>
                        </div>
                    </div>
                    <div class="span12">
                        <div class="md--group-form md--select">
                            <input name="level" type="hidden" required>
                            <p></p>
                            <span class="bar-bottom"></span>
                            <label>Nivel de acceso</label>
                            <div class="dropdown">
                                <span data-value="1">1</span>
                                <span data-value="2">2</span>
                                <span data-value="3">3</span>
                                <span data-value="4">4</span>
                                <span data-value="5">5</span>
                                <span data-value="6">6</span>
                                <span data-value="7">7</span>
                                <span data-value="8">8</span>
                                <span data-value="9">9</span>
                                <span data-value="10">10</span>
                            </div>
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
