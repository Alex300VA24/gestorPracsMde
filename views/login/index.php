<div class="login-container">
        <div class="login-left">
            <img class="logo-login" src="<?=base_url?>assets/logosigeprol.png" alt="logo">
        </div>
        <div class="login-right">
            <h2 class="login-title">sistema de sigeprol</h2>
            <p>Ingresa tus datos para iniciar sesionn</p>
            <form id="formLogin" action="" method="post">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" autocomplete="off" placeholder="ejemplo: alopezv">

                <label for="password">Contrase&ntilde;a:</label>
                <input type="password" id="password" name="password" placeholder="******"> </br>

                <button id="btnLogin">Ingresar</button>
            </form>
        </div>
</div>

<?php require_once "validarCUI.php"?>
<script src="<?= base_url?>/ajax/login.js"></script>