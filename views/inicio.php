<?php
if (!isset($_SESSION)){
    session_start();
}
?>

<div class="inicio">
    <div>
        <h1>Bienvenido(a), <?= $_SESSION['user']['nombresApellidos']?></h1>
        <p>Has ingresado al sistema de gestión de Provale</p>
    </div>
    <img src="<?= $_SESSION['base_url']?>assets/vacaHome.svg">
</div>