<?php
//include("../config.php");
include_once("./bdd/Connection.php");

class Token{
  public function listAllTokens() {
    $tokens = array();
    $connection = Connection::getConnection();
    $sql_query = "SELECT * FROM token";
    $result = $connection->query($sql_query);
    if($result->num_rows > 0 ){
      while($row = $result->fetch_object()) {
        $tokens[] = $row;
      }
    }
    return $tokens;
  }

  public function createToken($valor) {
    $success = false;
    $connection = Connection::getConnection();
    if($connection) {
      $sql_query = "INSERT INTO token(codigo) VALUES ('$valor');";
      if ($connection->query($sql_query)) {
        $success = true;
        $message = "El ingreso se realizo con éxito";
      } else {
        $message = "Existieron errores al crear el token" . $connection->error;
      }
      $connection->close();
    } else {
      $message = "Existieron errores al conectarse con la BDD: ".$connection->connect_error;
    }
    return array("success" => $success, "messagge" => $message);
  }

  public function deleteToken($valor) {
    $connection = Connection::getConnection();
    if($connection) {
      $sql_query = "DELETE FROM token WHERE codigo = $valor";
      if($connection->query($sql_query)) {
        return array("success" => true, "messagge" => "El token fue eliminado exitosamente");
      } else {
        return array("success" => false, "messagge" => "Existieron errores al eliminar al token" . $connection->error);
      }
      $connection->close();
    }
  }

  public function canjearToken($valor, $user_id) {
    //Un administrador no puede canjear un codigo
    //debemos verificar que ese id de usuario sea de un invitado
    $allowed_profile = 3;
    $user_id = (int)$user_id;
    $success = false;
    $connection = Connection::getConnection();
    if ($connection) {
      $sql_query = "SELECT id FROM user WHERE id = $user_id AND profile_id = $allowed_profile;";
      $result = $connection->query($sql_query);
      if($result->num_rows > 0 ) {
        $sql_query = "SELECT codigo FROM token WHERE codigo='$valor' AND canjeado=0;";
        $result = $connection->query($sql_query);
        if($result->num_rows > 0 ) {
          $sql_query = "UPDATE token SET canjeado=1,user_id=$user_id WHERE codigo='$valor';";
          if ($connection->query($sql_query)){
            $success=true;
            $message="El token fue canjeado con éxito";
          } else {
            $message = "Hubo errores al canjear el token " . $connection->error;
          }
        } else {
          $message = "Revisa que el token que ingresaste exista o no haya sido usado";
        }
      } else {
        $message = "Un administrador no puede canjear tokens";
      }
    }
    return array("success" => $success, "message" => $message);
  }
}
