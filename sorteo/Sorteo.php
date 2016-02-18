<?php
include ("../config.php");
include_once($basepath."bdd/Connection.php");

class Sorteo{

  public function createSorteo(){
    $success = false;
    $winner = 'NO CANJEADO';
    $connection = Connection::getConnection();
    $sql_query = "SELECT codigo FROM token WHERE canjeado=1 ORDER BY RAND() LIMIT 1 ;";
    $result = $connection->query($sql_query);
    if ($result->num_rows > 0){
      $data = $result->fetch_assoc();
      $codigo = $data['codigo'];
      $sql_query = "SELECT user.name as nombre FROM user join token on user.id=token.user_id where token.codigo='$codigo';";
      $result = $connection->query($sql_query);
      if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $winner = $data['nombre'];
      }
      $sql_query = "UPDATE token SET canjeado=0, user_id=NULL;";
      if ($connection->query($sql_query)) {
        $sql_query = "INSERT INTO sorteo (ganador, nombre) VALUES ('$codigo', '$winner');";
        if ($connection->query($sql_query)) {
          $success = true;
          $message = "El ganador del sorteo es el token: $codigo".
            "<br>canjeado por '$winner'"; 
        } else {
          $message = "No se pudo reiniciar los tokens del sorteo";
        }
      } else {
        $message = 'Hubo un error al momento de almacenar el sorteo';
      }
    } else {
      $message = 'No se puede crear un sorteo sin tokens entre los que sortear';
    }
    return array("success" => $success, "message" =>$message, "winner" => $winner);
  }

  public static function listarSorteos(){
    $sorteos = array();
    $connection = Connection::getConnection();
    $sql_query = "SELECT id, fecha, ganador, nombre FROM sorteo;";
    $result = $connection->query($sql_query);
    if ($result->num_rows > 0){
      while($row = $result->fetch_object()) {
        $sorteos[] = $row;
      }
    }
    return $sorteos;
  }
}
