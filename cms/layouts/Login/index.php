<?php defined('_EXEC') or die; ?>
<main class="login">
    <form id="login" name="login" autocomplete="off">
        <figure>
            <img src="../{$path.images}logotype_black.png" alt="logotype">
        </figure>
        <div class="label">
            <label>
                <p>Usuario</p>
                <input type="text" name="username" autofocus />
            </label>
        </div>
        <div class="label">
            <label>
                <p>Contraseña</p>
                <input type="password" name="password" />
            </label>
        </div>
        <button type="submit" class="btn btn-colored">Iniciar Sesion</button>
        <p>Desarrollado por <a href="https://codemonkey.com.mx/" target="_blank">Code Monkey</a></p>
        <p>Copyright (C) Todos los derechos reservados</p>
    </form>
</main>
