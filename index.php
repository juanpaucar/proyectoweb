<?php include("login_redirect.php"); ?>
<?php include("header_login.php"); ?>

<?php
//Si es que se redireccionó a esta página se verifica el estado y mensaje de la petición
if(isset($_GET["messagge"]) && isset($_GET["status"])){
    if($_GET["status"] == true){ ?>
        <div class="col-md-offset-4 col-md-4"><br>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong><?php echo $_GET["messagge"]; ?></strong>
            </div>
        </div>   
    <?php }else{ ?> 
        <div class="col-md-offset-4 col-md-4"><br>
            <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong><?php echo $_GET["messagge"]; ?></strong>
            </div>
        </div>  
<?php } }?>



<div class="container">
    <div class="col-md-12">
        <div class="col-md-offset-4 col-md-4">
            <h1 class="text-info text-center">Login de Usuarios</h1>
            <form id="frmLogin" method="post" action="login.php" >
            <fieldset>
                <legend class="text-center"></legend>
                <div class="row form-group">
                    <label class="control-label">Usuario</label>
                    <input name="username"  type="text" class="form-control" placeholder="Usuario" >
                </div>
                <div class="row form-group">
                    <label class="control-label">Contrase&ntilde;a</label>
                    <input name="password" type="password" class="form-control" placeholder="Contrase&ntilde;a" >
                </div>
                <div class="row"><br>
                    <button type="submit" class="btn btn-lg btn-block btn-primary ">Ingresar</button>
                </div><br>
            </fieldset>
            </form>
            <div class="text-center">
                Si no tienes cuenta puedes <b><a href="register_view.php">REGISTRARTE AQUÍ</a></b> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        $('#frmLogin').validate({
            rules: {
                username: {
                    required: true
                },
                password: {
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

