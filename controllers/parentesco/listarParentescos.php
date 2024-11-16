<?php
require_once "../../config/DataBase.php";
include_once "../../models/Parentesco.php";

$parentescoOjb = new Parentesco();

$response = $parentescoOjb->listarParentescos();

print json_encode($response);