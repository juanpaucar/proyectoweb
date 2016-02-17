<?php
include(dirname(__DIR__)."/users/User.php");

$name = $_POST["name_lastname"];
$user = $_POST["username"];
$pass = $_POST["password"];
$profile_id = $_POST["profile_id"];

$user_object = new User();
$user_create = $user_object->createUser($user, $pass, $name, $profile_id);
$status = $user_create["success"];
$messagge = $user_create["messagge"];
header("Location: ./create_view.php?status=$status&messagge=$messagge");

?>

