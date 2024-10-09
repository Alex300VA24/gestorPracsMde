<?php
session_start();
$_SESSION['user'] = false;
$_SESSION['autenticado'] = false;
unset($_SESSION['autenticado']);
unset($_SESSION['user']);

$response = !(isset($_SESSION['user'], $_SESSION['autenticado']) && !empty($_SESSION['user']) && $_SESSION['autenticado'] === true);

print json_encode($response);