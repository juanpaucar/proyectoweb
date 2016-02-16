<?php
include(dirname(__DIR__)."/users/User.php");

$user_id = $_GET["user_id"];

$user_object = new User();
$user_delete = $user_object->deleteUserByID($user_id);


$status = $user_delete["success"];
$messagge = $user_delete["messagge"];
header("Location: list_view.php?status=$status&messagge=$messagge");

?>

