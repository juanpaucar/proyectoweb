<?php
include(__DIR__."/config.php");
include($basepath."verified_session.php");
include("./tokens/Token.php");

if (!empty($_POST) && !isset($_POST['token'])) {
  header("Location: " . $basepath . "main.php");
} else {
  session_start();
  $token = New Token();
  $result = $token->canjearToken($_POST['token'], $_SESSION["user_data"]["id"]);
  $message = $result['message'];
  if($result['success'] ) {
    header("Location: ./token.php?success=true&message=$message");
  } else {
    header("Location: ./token.php?success=false&message=$message");
  }
}

?>
