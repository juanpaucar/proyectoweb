<?php include("../header_main.php"); ?>

<?php
if(isset($_GET['message']) && isset($_GET['status'])) {

  $alert = ($_GET['status'] == true ? 'success' : 'warning');
?>
  <div class="col-md-offset-4 col-md-4"><br>
    <div class="alert alert-<?php echo $alert; ?>">
          <a href="#" class="close" data-dismiss="alert">&times;</a>
          <strong align="center"><?php echo $_GET["message"]; ?></strong>
      </div>
  </div>   
<?php
} ?>

<div class="container">
    <div class="col-md-12">
        <div class="col-md-offset-4 col-md-4">
            <h1 class="text-info text-center">Crear nuevo sorteo</h1>

              <h4 align="center">Recuerda que para crear un sorteo debes tener tokens.</h4>
              <h4 align="center">Estos se reiniciaran una vez realizado el sorteo</h4>
            
            <form id="frmRegister" method="post" action="./create_sorteo.php" >
            <fieldset>

                <div class="row"><br>
                    <button type="submit" class="btn btn-lg btn-block btn-primary ">Crear</button>
                </div><br>
            </fieldset>
            </form>
        </div>
    </div>
</div>

