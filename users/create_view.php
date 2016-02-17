<?php include("../header_main.php");?>
<?php
/*
 * Control y muestra de mensajes. NO BORRAR
 */
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
            <h1 class="text-info text-center">Crear usuario</h1>
            <div class="text-center">Los campos con asterisco (*) son obligatorios</div>           
            
            <form id="frmRegister" method="post" action="create_pro.php" >
            <fieldset>
                <legend class="text-center"></legend>
                <div class="row form-group">
                    <label class="control-label">Nombres y Apellidos*</label>
                    <input name="name_lastname" id="name_lastname" type="text" class="form-control" placeholder="Nombres y Apellidos" >
                </div>
                <div class="row form-group">
                    <label class="control-label">Nombre de usuario*</label>
                    <input name="username" type="username" class="form-control" placeholder="Usuario" >
                </div>
                <div class="row form-group">
                    <label class="control-label">Contraseña*</label>
                    <input name="password" id="password" type="password" class="form-control" placeholder="Contraseña" >
                </div>
                <div class="row form-group">
                    <label class="control-label">Repetir Contraseña*</label>
                    <input name="re_password" id="re_password" type="password" class="form-control" placeholder="Repita Contraseña" >
                </div>
                <div class="row form-group">
                    <label class="control-label">Perfil de Usuario*</label>
                    <select name="profile_id" id="profile_id" class="form-control" placeholder="Seleccione">
                    <?php
                        //Obtenemos las opciones de perfiles de usuario de la base de datos. 
                        //Esto lo hacemos para no quemar datos
                    
                        $profile = new Profile();
                        echo $profile->getComboBoxOptionsOfProfiles();
                    ?>
                    </select>
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
                name_lastname:{
                    required: true
                },    
                username: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                re_password:{
                    equalTo: "#password"
                },
                profile_id:{
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

