<?php
include("../config.php");
include_once($basepath."bdd/Connection.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cliente
 *
 * @author DELL
 */

class User{
    
    public function getUserById($user_id){
        $connection = Connection::getConnection();
        $sql_query = "SELECT * FROM user WHERE id = ".$user_id;
        $result = $connection->query($sql_query);
        if($result->num_rows > 0){
             return $result->fetch_object();   
        }else{
            return false;
        }            
    }

    public function verifiedUserCredentials($user,$pass){       
        $connection = Connection::getConnection();
        if($connection){
            $sql_query = "SELECT * FROM user WHERE username = '".$user."' AND password = '".md5($pass)."'";   
            $result = $connection->query($sql_query);
            if($result->num_rows > 0){
                 return $result->fetch_array();   
            }else{
                return false;
            }
            $connection->close();            
        }
    }
    
    
    public function createUser($username, $pass, $name, $profile_id){ 
        $success = false;
        $connection = Connection::getConnection();
        if($connection){
            $sql_query = "INSERT INTO user(username,password,name,profile_id) "
                    . "VALUES ('".$username."','".md5($pass)."','".$name."',".$profile_id.")";   
            if($connection->query($sql_query)){
                //Se realizó el ingreso
                $success = true;
                $message = "El ingreso de usuario se realizó con éxito";
            }else{
                $message = "Existieron errores al crear el usuario: ".$connection->error;
            }
            $connection->close();            
        }else{
            $message = "Existieron errores al conectarse con la BDD: ".$connection->connect_error;
        }
        
        return array("success" => $success,"messagge" => $message);
    }
    
    
    public function updateUser($user_id, $username, $pass, $name, $profile_id){ 
        $success = false;
        $connection = Connection::getConnection();
        if($connection){
            $sql_query = "UPDATE user SET name = '".$name."',username = '"
                .$username."',password='".md5($pass)."',profile_id=".$profile_id." WHERE id=".$user_id;   
            if($connection->query($sql_query)){
                //Se realizó el ingreso
                $success = true;
                $message = "La actualización se realizó con éxito";
            }else{
                $message = "Existieron errores al actualizar el usuario: ".$connection->error;
            }
            $connection->close();            
        }else{
            $message = "Existieron errores al conectarse con la BDD: ".$connection->connect_error;
        }
        
        return array("success" => $success,"messagge" => $message);
    }    
    

    /*
     * Consigue todos los usuarios de la base de datos
     */
    public static function getAllUsers(){
        $users = array();
        $connection = Connection::getConnection();
        $sql_query = "SELECT * FROM user";
        $result = $connection->query($sql_query);
        if($result->num_rows > 0){
            while($row = $result->fetch_object()) {
                $users[] = $row;  
            }
        }
        
        return $users;
    }
    
    public function deleteUserByID($user_id){       
        $connection = Connection::getConnection();
        $user_id = (int)$user_id;
        if($connection){
            $sql_query = "DELETE FROM user WHERE id = $user_id";   
            if($connection->query($sql_query)){
                return array("success" => true,"messagge" => "El usuario se eliminó correctamente");
            }else{
                return array("success" => false,"messagge" => "Existieron errores al crear el usuario: ".$connection->error);
            }
            $connection->close();            
        }
    }
}
