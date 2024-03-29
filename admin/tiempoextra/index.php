<?php 

  include '../../controllers/sesion/session.php'; 
  include '../includes/header.php'; 
  if($_SESSION['perfil'] == 8000 || $_SESSION['perfil'] == 8001 || $_SESSION['perfil'] == 8002)
  {

?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include '../includes/navbar.php'; ?>
  <?php include '../includes/menubar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
    <h1><b>Tiempo Extra</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class=""></i> Finanzas</a></li>
        <li class="active"><i class="fa fa-hourglass-1"></i> Tiempo Extra</li>
      </ol>
    </section>

    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Éxito!</h4>
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
                <form method="POST" class="form-inline" id="payForm">
                  <button type="button" class="btn btn-danger btn-sm btn-flat" id="payroll"><span class="fa fa-file-pdf-o"></span> PDF</button>
                  <button type="button" class="btn btn-success btn-sm btn-flat" id="payexcel"><span class="fa fa-file-excel-o"></span> Excel</button>
                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Fecha</th>
                  <th>Cédula de Identidad</th>
                  <th>Nombre Completo</th>
                  <th>Número de Horas</th>
                  <th>Monto de Hora</th>
                  <th>Pago Total de Horas extra</th>
                  <th>Acciones</th>
                </thead>
                <tbody>
                  <?php
                    require_once "../../controllers/tiempoextra/tiempoextra_obtener.php";

                    foreach($obtener as $row)
                    {
                      $gross = $row['monto'] * $row['horas'];?>
                        <tr>
                          <td class='hidden'></td>
                          <td><?php echo date('d M, Y', strtotime($row['fecha']))?></td>
                          <td><?php echo $row['cedula']?></td>
                          <td><?php echo $row['nombres'].' '.$row['apellidos']?></td>
                          <td><?php echo $row['horas']?></td>
                          <td><?php echo '$ '.$row['monto']?></td>
                          <td><?php echo '$ '.number_format($gross, 2)?></td>
                          <td>
                            <button class='btn btn-success btn-sm btn-flat edit' data-id='<?php echo $row['otid']?>'><i class='fa fa-edit'></i></button>
                            <button class='btn btn-danger btn-sm btn-flat delete' data-id='<?php echo $row['otid']?>'><i class='fa fa-trash'></i></button>
                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>

  <?php 
  }else{
    require_once '../index.php';
  } 
  ?>
    
  <?php include '../includes/footer.php'; ?>
  <?php include 'tiempoextra_modal.php'; ?>
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
});

$('#payroll').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'tiempoextra_print.php');
    $('#payForm').submit();
  });

  $('#payexcel').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'tiempoextra_xlsx.php');
    $('#payForm').submit();
  });

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'tiempoextra_id.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){

      $('#nombres').html(response.nombres+' '+response.apellidos);
      $('#del_otid').val(response.otid);
      $('#edit_otid').val(response.otid);
      $('#fecha_edit').val(response.fecha);
      $('#fecha').html(response.fecha);
      $('#horas_edit').val(response.horas);
      $('#monto_edit').val(response.monto);
    }
  });
}
</script>
</body>
</html>
