<?php include '../../controllers/sesion/session.php'; ?>
<?php include '../includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include '../includes/navbar.php'; ?>
  <?php include '../includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1><b>Cargos</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class=""></i> Administración</a></li>
        <li class="active"><i class="fa fa-suitcase"></i> Cargos</li>
      </ol>
    </section>
    <!-- Main content -->
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
                <a href="cargos_print.php" class="btn btn-danger btn-sm btn-flat"><span class="fa fa-file-pdf-o"></span> PDF</a>
              </div>
            </div>
            <div class="box-body">
              <table id="example3" class="table table-bordered">
                <thead>
                  <th>Título del Cargo</th>
                  <th>Sueldo por hora</th>
                  <th>Acciones</th>
                </thead>
                <tbody>
                  <?php
                    require_once "../../config/conn.php";
                    require_once "../../controllers/cargos/cargos_obtener.php";

                    foreach($cargos as $row)
                    {
                      ?>
                        <tr>
                          <td><?php echo $row['cargo']?></td>
                          <td><?php echo '$ '.number_format($row['sueldo'], 2)?></td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='<?php echo $row['id_cargo']?>'><i class='fa fa-edit'></i></button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='<?php echo $row['id_cargo']?>'><i class='fa fa-trash'></i></button>
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
  <?php include 'cargos_modal.php'; ?>
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

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'cargos_id.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#edit_cargo').val(response.cargo);
      $('#edit_sueldo').val(response.sueldo);
      $('#edit_id_cargo').val(response.id_cargo);
      $('#del_id_cargo').val(response.id_cargo);
      $('#del_cargo').html(response.cargo);
    }
  });
}
</script>
</body>
</html>
