<?php include("../header_main.php");?>
<?php include_once("User.php");?>

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

<?php
//Get user data
$user_id = $_GET["user_id"];
$user_object = new User();
$user_data = $user_object->getUserByID($user_id);

if($user_data != false){ ?>

<div class="container">
    <div class="col-md-12">
        <div class="col-md-offset-4 col-md-4">
            <h1 class="text-info text-center">Actualizar usuario</h1>
            <div class="text-center">Los campos con asterisco (*) son obligatorios. No modifique el password si es que no desea cambiarlo</div>           
            
            <form id="frmUpdate" method="post" action="update_pro.php" >
            <fieldset>
                <legend class="text-center"></legend>
                <div class="row form-group">
                    <label class="control-label">Nombres y Apellidos*</label>
                    <input value="<?php echo $user_data->name; ?>" name="name_lastname" id="name_lastname" type="text" class="form-control" placeholder="Nombres y Apellidos" >
                </div>
                <div class="row form-group">
                    <label class="control-label">Nombre de usuario*</label>
                    <input value="<?php echo $user_data->username; ?>" name="username" type="username" class="form-control" placeholder="Usuario" >
                </div>
                <div class="row form-group">
                    <label class="control-label">Contraseña*</label>
                    <input value="no_change" name="password" id="password" type="password" class="form-control" placeholder="Contraseña" >
                </div>
                <div class="row form-group">
                    <label class="control-label">Repetir Contraseña*</label>
                    <input value="no_change" name="re_password" id="re_password" type="password" class="form-control" placeholder="Repita Contraseña" >
                </div>
                <div class="row form-group">
                    <label class="control-label">Perfil de Usuario*</label>
                    <select name="profile_id" id="profile_id" class="form-control" placeholder="Seleccione">
                    <?php
                        //Obtenemos las opciones de perfiles de usuario de la base de datos. 
                        //Esto lo hacemos para no quemar datos
                    
                        $profile = new Profile();
                        echo $profile->getComboBoxOptionsOfProfiles($user_data->profile_id);
                    ?>
                    </select>
                </div>
                <div class="row"><br>
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_data->id; ?>">
                    <button type="submit" class="btn btn-lg btn-block btn-primary ">Actualizar</button>
                </div><br>
            </fieldset>
            </form>
        </div>
    </div>
</div> 
<?php }else{ ?>
    No existe el usuario que se desea actualizar
<?php } ?>

<script type="text/javascript">
        $('#frmUpdate').validate({
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

