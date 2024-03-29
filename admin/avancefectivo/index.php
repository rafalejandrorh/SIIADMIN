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
    <h1><b>Avance Efectivo</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class=""></i> Finanzas</a></li>
        <li class="active"><i class="fa fa-money"></i> Avance de Efectivo</li>
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
                  <th>Fecha del Avance</th>
                  <th>Cédula de Identidad</th>
                  <th>Nombre Completo</th>
                  <th>Monto del Avance</th>
                  <th>Acciones</th>
                </thead>
                <tbody>
                  <?php
                    require_once "../../controllers/avancefectivo/avancefectivo_obtener.php";

                    foreach($obtener as $row){
                      ?>
                        <tr>
                          <td class='hidden'></td>
                          <td><?php echo date('d M, Y', strtotime($row['fecha']))?></td>
                          <td><?php echo $row['ci']?></td>
                          <td><?php echo $row['nombres'].' '.$row['apellidos']?></td>
                          <td><?php echo '$ '.number_format($row['monto'], 2)?></td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='<?php echo $row['caid']?>'><i class='fa fa-edit'></i></button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='<?php echo $row['caid']?>'><i class='fa fa-trash'></i></button>
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

  <?php 
  }else{
    require_once '../index.php';
  } 
  ?>
    
  <?php include '../includes/footer.php'; ?>
  <?php include 'avancefectivo_modal.php'; ?>
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
    $('#payForm').attr('action', 'avancefectivo_print.php');
    $('#payForm').submit();
  });

  $('#payexcel').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'avancefectivo_xlsx.php');
    $('#payForm').submit();
  });

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'avancefectivo_id.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      console.log(response);
      $('#fecha').html(response.fecha);
      $('#nombres').html(response.nombres+' '+response.apellidos);
      $('#edit_monto').val(response.monto);
      $('#caid').val(response.caid);
      $('#del_caid').val(response.caid);
      $('#del_nombres').html(response.nombres+' '+response.apellidos); 
    }
  });
}
</script>
</body>
</html>
