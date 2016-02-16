<?php
include("config.php");
include($basepath."users/User.php");

$user = $_POST["username"];
$pass = $_POST["password"];

$user_object = new User();
$user_data = $user_object->verifiedUserCredentials($user,$pass);
if($user_data){
    //Abrimos la sesión
    session_start();

    /*
     * Creamos nuevas variables de sesión para el id del usuario
     * la fecha de inicio y la fecha de expiración
     */

    $_SESSION["user_data"] = $user_data;
    $_SESSION["login"] = true;
    $_SESSION["start"] = time();
    $_SESSION["expirate"] = $_SESSION["start"]+(60*10);
    header("Location: main.php");
     
}else{  
    $status = false;
    $messagge = "El usuario o password son incorrectos";
    header("Location: index.php?status=$status&messagge=$messagge");
}

?>

