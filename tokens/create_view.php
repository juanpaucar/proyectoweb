<?php include("../header_main.php"); ?>

<?php
if(isset($_GET['message']) && isset($_GET['status'])) {

  $alert = ($_GET['status'] == true ? 'success' : 'warning');
?>
  <div class="col-md-offset-4 col-md-4"><br>
    <div class="alert alert-<?php echo $alert; ?>">
          <a href="#" class="close" data-dismiss="alert">&times;</a>
          <strong><?php echo $_GET["message"]; ?></strong>
      </div>
  </div>   
<?php
} ?>

<div class="container">
    <div class="col-md-12">
        <div class="col-md-offset-4 col-md-4">
            <h1 class="text-info text-center">Crear nuevo token</h1>
            
            <form id="frmRegister" method="post" action="./create_token.php" >
            <fieldset>
                <div class="row form-group">
                    <label class="control-label">Código</label>
                    <input name="valor" id="valor" type="texto" class="form-control" placeholder="Ingresa tu código aquí" >
                </div>

                <div class="row"><br>
                    <button type="submit" class="btn btn-lg btn-block btn-primary ">Crear</button>
                </div><br>
            </fieldset>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
        $('#frmRegister').validate({
            rules: {
                valor:{
                    required: true
                }    
            },
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error').removeClass('has-success');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorElement: 'span',
            errorClass: 'help-block'
        });

</script>

