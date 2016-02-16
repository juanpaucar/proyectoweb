<?php
include(__DIR__."/profiles/Profile.php");

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Abrimos la sesión
session_start();

//Validamos si la variable de sesión de usuario existe y si el se realizó el logueo exitosamente
if(isset($_SESSION["user_data"]["id"]) && $_SESSION["login"] == true){
    /*
     * Verificar permisos en acceso directo mediante URL
     */
    
    //Verificamos si es que la página actual no es el main.php 
    $actual_page = basename($_SERVER['PHP_SELF']);
      
    if($actual_page == "main.php"){
        return true;
    }else{
        //URL actual
        $url_actual = $_SERVER["PHP_SELF"];
        
        //Verificamos si la URL actual, está dentro de las URLs de las acciones que tiene permisos el perfil del usuario actual 
        $profile_id = $_SESSION["user_data"]["profile_id"];
        $profile_object = new Profile();
        $URLverified = $profile_object->verifiedURLActionPermission($profile_id,$url_actual);

        if($URLverified == true){
            return true;
        }else{
            header("Location:../denied_profile.php");                            
        }    
    }

}else{
    header("Location:../denied.php");              
}

// Validamos si la sesión todavía no ha expirado. Podemos realizar automaticamente esto mediante php.ini 

if(time() > $_SESSION["expirate"]){
    session_destroy();
    echo "Su sesión ha expirado vuelva a loguearse";
    die;
}

