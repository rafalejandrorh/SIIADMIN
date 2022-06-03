<?php include '../includes/session.php'; 
      include '../includes/header.php'; 
?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include '../includes/navbar.php'; 
      include '../includes/menubar.php'; 
      include '../includes/timezone.php';
  $range_to = date('m/d/Y');
  $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1><b>Asistencia</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class=""></i> Administración</a></li>
        <li class="active">Asistencia</li>
      </ol>
    </section>

    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i>¡Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i>¡Proceso Exitoso!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">   
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Nuevo</a>
              <div class="pull-right">
              <form method="POST" class="form-inline" id="asistForm">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range" value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.' - '.$range_to; ?>">
                  </div>
                    <button type="button" class="btn btn-success btn-sm btn-flat" id="asistencia"><span class="glyphicon glyphicon-print"></span> Imprimir</button>
              </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th class="">Fecha</th>
                  <th class="">C.I</th>
                  <th class="">Nombre</th>
                  <th class="">Cargo</th>
                  <th class="">Hora Entrada</th>
                  <th class="">Hora Salida</th>
                  <th class="">Horas Trabajadas</th>
                  <th class="text-center">Acción</th>
                </thead>
                <tbody>
                  <?php
                    require_once "../../controllers/asistencia/asistencia_obtener.php";

                    foreach($obtener as $row)
                    {
                      $status = ($row['status'])?'<span class="label label-warning pull-right">a tiempo</span>':'<span class="label label-danger pull-right">tarde</span>';
                      ?>
                        <tr>
                          <td class='hidden'></td>
                          <td><?php echo date('M d, Y', strtotime($row['date']))?></td>
                          <td><?php echo $row['empid']?></td>
                          <td><?php echo $row['firstname'].' '.$row['lastname']?></td>
                          <td><?php echo $row['description']?></td>
                          <td><?php echo date('h:i A', strtotime($row['time_in'])).$status?></td>
                          <td><?php echo date('h:i A', strtotime($row['time_out']))?></td>
                          <td><?php echo number_format($row['num_hr'],1)?></td>
                          <td class='text-center'>
                            <button class='btn btn-success btn-sm btn-flat edit' data-id='<?php echo $row['attid']?>'><i class='fa fa-edit'></i> Editar</button>
                            <button class='btn btn-danger btn-sm btn-flat delete' data-id='<?php echo $row['attid']?>'><i class='fa fa-trash'></i> Eliminar</button>
                          </td>
                        </tr>
                      <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include '../includes/footer.php'; ?>
  <?php include 'asistencia_modal.php'; ?>
</div>
<?php include '../includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $("#reservation").on('change', function(){
    var range = encodeURI($(this).val());
    window.location = 'index.php?range='+range;
  });

  $('#asistencia').click(function(e){
    e.preventDefault();
    $('#asistForm').attr('action', 'asistencia_print.php');
    $('#asistForm').submit();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'asistencia_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.date);
      $('#attendance_date').html(response.date);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out);
      $('#attid').val(response.attid);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
