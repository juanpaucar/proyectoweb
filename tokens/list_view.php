<?php include("../header_main.php"); ?>
<?php include_once("./Token.php"); ?>

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


<div class="col-md-8 col-md-offset-2">
  <h3 class="text-center" style="color: white">Administración de Tokens&nbsp;<span class="glyphicon glyphicon-qrcode"></span></h3>

<?php
$tokens = Token::listAllTokens();
if(!empty($tokens)) {?>
  <table class="table" id="table_token">
    <thead>
      <tr>
        <th style="color:white">Código</th>
        <th style="color:white">Canjeado</th>
        <th style="color:white">Usuario</th>
        <th style="color:white">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($tokens as $token) { ?>
      <tr>
        <td><?php echo utf8_encode($token->codigo); ?></td>
        <td><?php echo ($token->canjeado == false? 'NO' : 'SI'); ?></td>
        <td><?php echo (int)($token->user_id); ?></td>
        <td>
          <a href="./delete_token.php?valor=<?php echo $token->codigo; ?>">
            <span class="glyphicon glyphicon-remove"></span>
          </a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } else { ?>

  <div class="col-md-offset-2 col-md-8 text-center alert">
      No se encontraron tokens
  </div>

<?php } ?>


<script>
    $(function(){
        if($('#table_token tbody tr').length>0){
            $('#table_token').DataTable({
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
            .addClass('table table-striped table-bordered');
    });
</script>
