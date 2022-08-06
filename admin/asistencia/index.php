<?php 
    include '../includes/header.php'; 
    include '../../controllers/sesion/session.php';
?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include '../includes/navbar.php'; 
      include '../includes/menubar.php'; 
      include '../includes/timezone.php';
  $range_to = date('d/m/Y');
  $range_from = date('d/m/Y', strtotime('-30 day', strtotime($range_to)));
?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1><b>Asistencia</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class=""></i> Administración</a></li>
        <li class="active"><i class="fa fa-calendar"></i> Asistencia</li>
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
                    <button type="button" class="btn btn-danger btn-sm btn-flat" id="asistencia"><span class="fa fa-file-pdf-o"></span> PDF</button>
                    <button type="button" class="btn btn-success btn-sm btn-flat" id="payexcel"><span class="fa fa-file-excel-o"></span> Excel</button>
              </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="">Fecha</th>
                  <th class="">Cédula de Identidad</th>
                  <th class="">Nombre Completo</th>
                  <th class="">Cargo</th>
                  <th class="">Hora de Entrada</th>
                  <th class="">Hora de Salida</th>
                  <th class="">Horas Laboradas</th>
                  <th class="">Acciones</th>
                </thead>
                <tbody>
                  <?php
                    require_once "../../controllers/asistencia/asistencia_obtener.php";

                    foreach($obtener as $row)
                    {
                      $status = ($row['estatus_llegada'])?'<span class="label label-warning pull-right">A tiempo</span>':'<span class="label label-danger pull-right">Tarde</span>';
                      ?>
                        <tr>
                          <td><?php echo date('d M, Y', strtotime($row['fecha']))?></td>
                          <td><?php echo $row['cedula']?></td>
                          <td><?php echo $row['nombres'].', '.$row['apellidos']?></td>
                          <td><?php echo $row['cargo']?></td>
                          <td><?php echo date('h:i A', strtotime($row['hora_llegada'])).$status?></td>
                          <td><?php echo date('h:i A', strtotime($row['hora_salida']))?></td>
                          <td><?php echo number_format($row['horas_laboradas'],1)?></td>
                          <td class='text-center'>
                            <button class='btn btn-success btn-sm btn-flat edit' data-id='<?php echo $row['attid']?>'><i class='fa fa-edit'></i></button>
                            <button class='btn btn-danger btn-sm btn-flat delete' data-id='<?php echo $row['attid']?>'><i class='fa fa-trash'></i></button>
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

  $('#payexcel').click(function(e){
    e.preventDefault();
    $('#asistForm').attr('action', 'asistencia_xlsx.php');
    $('#asistForm').submit();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'asistencia_id.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#attendance_fecha').val(response.fecha);
      $('#edit_fecha').val(response.fecha);
      $('#edit_hora_llegada').html(response.hora_llegada).val(response.hora_llegada);
      $('#edit_hora_salida').html(response.hora_salida).val(response.hora_salida);
      $('#attid').val(response.attid);
      $('#nombres').html(response.nombres+' '+response.apellidos);
      $('#del_attid').val(response.attid);
      $('#del_nombres').html(response.nombres+' '+response.apellidos);
    }
  });
}
</script>
</body>
</html>
