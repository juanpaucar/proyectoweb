<?php
include("config.php");
include($basepath."users/User.php");

$name = $_POST["name_lastname"];
$user = $_POST["username"];
$pass = $_POST["password"];
$profile_id = 3;

$user_object = new User();
$user_create = $user_object->createUser($user, $pass, $name, $profile_id);
$status = $user_create["success"];
$messagge = $user_create["messagge"];
header("Location: register_view.php?status=$status&messagge=$messagge");

?>

