<?php
include('../config.php');
include(dirname(__DIR__)."/tokens/Token.php");

$valor = $_GET["valor"];

$token_object = new Token();
$token_delete = $token_object->deleteToken($valor);

$status = $token_delete['success'];
$message = $token_delete['messagge'];
header("Location: ./list_view.php?status=$status&message=$message");
?>
