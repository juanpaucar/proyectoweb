<?php include("../header_main.php"); ?>
<?php include_once("./Sorteo.php"); ?>


<div class="col-md-8 col-md-offset-2">
  <h3 class="text-center" style="color: white">Sorteos realizados&nbsp;<span class="glyphicon glyphicon-th-list"></span></h3>

<?php
$sorteos = Sorteo::listarSorteos();
if (!empty($sorteos)) { ?>
  <table class="table" id="table_sorteos">
    <thead>
      <tr>
        <th style="color:white">Id</th>
        <th style="color:white">Fecha del Sorteo</th>
        <th style="color:white">Codigo Ganador</th>
        <th style="color:white">Nombre del Ganador</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($sorteos as $sorteo) { ?>
        <tr>
          <td><?php echo $sorteo->id; ?></td>
          <td><?php echo $sorteo->fecha; ?></td>
          <td><?php echo $sorteo->ganador; ?></td>
          <td><?php echo $sorteo->nombre; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } else { ?>
  <div class="col-md-offset-2 col-md-8 text-center alert">
      No se encontraron sorteos anteriores
  </div>
<?php } ?>


<script>
    $(function(){
        if($('#table_sorteos tbody tr').length>0){
            $('#table_sorteos').DataTable({
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
