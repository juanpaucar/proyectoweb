<?php
  include("header_login.php");
?>

<div class="col-md-offset-3 col-md-6">
<?php
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

</div>

<?php
  include("vistas/banner.php");
  include("vistas/ingreso_token.php");
?>
