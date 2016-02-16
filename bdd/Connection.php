<?php
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
class Connection {
    public static function getConnection(){
            $server = "localhost";
            $user = "root";
            $pass = "";
            $dbname = "login_perfiles";
            
            $connection = new mysqli($server,$user,$pass,$dbname);
            if($connection->connect_error){
                echo $connection->connect_error;
                die;
            }else{
                return $connection;
            }          
    }
}




