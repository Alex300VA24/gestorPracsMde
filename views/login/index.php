<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de PROVALE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body>

<div class="login-container">
    <div class="login-left">
        <img class="logo-login" src="<?=base_url?>assets/logo.png" alt="logo">
    </div>
    <div class="login-right">
        <h2 class="login-title">sistema de PROVALE</h2>
        <p>Ingresa tus datos para iniciar sesi&oacute;n</p>
        <form id="formLogin" action="" method="post">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" autocomplete="off" placeholder="ejemplo: alopezv">

            <label for="password">Contrase&ntilde;a:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="******">
                <i id="togglePassword" class="fas fa-eye-slash"></i>
            </div>
            <br>

            <button id="btnLogin" type="submit">Ingresar</button>
        </form>
    </div>
</div>

<?php require_once "validarCUI.php"?>
<script src="<?= base_url?>/ajax/login.js"></script>
<script>
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');

    togglePassword.addEventListener('click', function () {
        const passwordType = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', passwordType);
        
        // Cambiar el ícono de ojo
        this.classList.toggle('fa-eye-slash');
        this.classList.toggle('fa-eye');
    });

    // Mostrar contraseña al pasar el mouse
    togglePassword.addEventListener('mouseover', function () {
        passwordInput.setAttribute('type', 'text');
    });

    // Ocultar contraseña al sacar el mouse
    togglePassword.addEventListener('mouseout', function () {
        passwordInput.setAttribute('type', 'password');
    });
</script>

</body>
</html>