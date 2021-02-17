<?php
defined('_EXEC') or die;
$this->dependencies->getDependencies([
    'css' => ['{$path.css}login.css'],
    'js' => ['{$path.js}login.min.js'],
    'other' => [
        '<script type="text/javascript">
            login.initialize();
        </script>'
    ]
]);
?>
<section class="login">
    <h1>Bienvenido</h1>

    <form id="login--cpanel" autocomplete="off">
        <div class="message"></div>

        <div class="login-input-group">
            <div class="icon">
                <i><i class="material-icons">person</i></i>
            </div>
            <input name="user" type="text" placeholder="Username" />
        </div>
        <div class="login-input-group">
            <div class="icon">
                <i><i class="material-icons">vpn_key</i></i>
            </div>
            <input name="password" type="password" placeholder="Password" />
        </div>

        <button type="submit" data-ripple="true">Login</button>
    </form>

    <div class="content-bubbles">
        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
    	</ul>
    </div>
</section>
