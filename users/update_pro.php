<?php
include(dirname(__DIR__)."/users/User.php");

$name = $_POST["name_lastname"];
$user = $_POST["username"];
$pass = $_POST["password"];
$profile_id = $_POST["profile_id"];
$user_id = $_POST["user_id"];


$user_object = new User();
$user_data = $user_object->getUserById($user_id);
if($pass == "no_change"){
    $pass = $user_data->password;
}

$user_update = $user_object->updateUser($user_id, $user, $pass, $name, $profile_id);
$status = $user_update["success"];
$messagge = $user_update["messagge"];
header("Location: list_view.php?status=$status&messagge=$messagge");

?>

