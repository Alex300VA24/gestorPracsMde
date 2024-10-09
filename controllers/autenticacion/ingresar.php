<?php
session_start();
require_once "../../config/parameters.php";

$_SESSION['user'] = $_POST['data'];
$_SESSION['autenticado'] = true;
$_SESSION['base_url'] = base_url;

$response = (isset($_SESSION['user'], $_SESSION['autenticado']) && !empty($_SESSION['user']) && $_SESSION['autenticado'] === true);

print json_encode($response);