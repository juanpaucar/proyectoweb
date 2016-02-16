<?php

/* 
 * Código para redireccionar a un usuario logueado que quisiera volver acceder a la URL del login directamente
 */

//Abrimos la sesión
session_start();

//Validamos si la variable de sesión de usuario existe y si el se realizó el logueo exitosamente
if(isset($_SESSION["user_data"]["id"]) && $_SESSION["login"] == true){
    header("Location:main.php");
}
