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

<div class="col-md-8 col-md-offset-2">
  <h3 class="text-center" style="color: white">Administración de Usuarios&nbsp;</h3>

<?php
$users = User::getAllUsers();
if(!empty($users)){?>
    <table class="table" id="table_user">
        <thead>
        <tr>
            <th style="color: white">Nombres y Apellidos</th>
            <th style="color: white">Nombre de usuario</th>
            <th style="color: white">Perfil</th>
            <th style="color: white">Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($users as $user){ ?>
        <tr>
            <td><?php echo utf8_encode($user->name) ?></td>
            <td><?php echo $user->username ?></td>
            <td><?php echo Profile::getProfileById($user->profile_id)->name; ?></td>
            <td>
                <?php 
                //Solo permite borrar y actualizar a administradores, y no permite borrar el superadmin
                if(!($user->id == 1) && $_SESSION["user_data"]["profile_id"] == 1 || $_SESSION["user_data"]["profile_id"] == 2){ ?>
                    <a class= "btn btn-warning" href= "update_view.php?user_id=<?php echo $user->id; ?>">Editar <span class="glyphicon glyphicon-pencil"></span></a>
                    <a class= "btn btn-danger" href= "delete_pro.php?user_id=<?php echo $user->id; ?>">Eliminar <span class="glyphicon glyphicon-trash"></span></a>                    
                <?php } ?>
            </td>
       </tr>
        <?php }?>
        </tbody>
    </table>    
<?php }else{ ?>

<div class="col-md-offset-2 col-md-8 text-center alert">
    No se encontraron usuarios
</div>

<?php } ?>

</div>
<script>
    $(function(){
        if($('#table_user tbody tr').length>0){
            $('#table_user').DataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bInfo": true,
                "sPaginationType": "full_numbers",
                "oLanguage": {
                    "oPaginate": {
                        "sFirst": "Primera",
                        "sLast": "&Uacute;ltima",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "sZeroRecords": "No se encontraron resultados",
                    "sInfo": "_START_ - _END_ de _TOTAL_",
                    "sInfoEmpty": "0 - 0 de 0",
                    "sInfoFiltered": "(de _MAX_ en total)",
                    "sSearch": "Buscar:",
                    "sProcessing": "Filtrando.."
                }
            });
        }
        $('#table_user')
            .removeClass( 'display' )
            .addClass('table table-bordered');
    });
</script>
