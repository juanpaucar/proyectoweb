<?php
include('../config.php');
include(dirname(__DIR__)."/tokens/Token.php");

$valor = $_POST['valor'];

$token_object = new Token();
$token_create = $token_object->createToken($valor);
$status = $token_create['success'];
$message = $token_create['messagge'];
header("Location: ./create_view.php?status=$status&message=$message");
?>
