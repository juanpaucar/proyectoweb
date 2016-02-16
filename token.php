<?php
  include("header_login.php");
  include("vistas/banner.php");
  if (!isset($_GET['success']) || !isset($_GET['message'])) {
    header('Location: canjear.php');
  } else {
    $message = $_GET['message'];
    if ($_GET['success']==="true") {
      include("./vistas/token_exito.php");
    } else {
      include("./vistas/token_fallido.php");
    }
  }
?>
