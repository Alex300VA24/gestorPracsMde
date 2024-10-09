<?php
session_start();
$_SESSION['user'] = $_POST['data'];
$_SESSION['autenticado'] = true;

$response = (isset($_SESSION['user'], $_SESSION['autenticado']) && !empty($_SESSION['user']) && $_SESSION['autenticado'] === true);

print json_encode($response);