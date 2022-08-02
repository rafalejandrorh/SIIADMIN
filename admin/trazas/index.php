<?php include '../../controllers/sesion/session.php'; ?>
<?php include '../includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include '../includes/navbar.php'; ?>
  <?php include '../includes/menubar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
    <h1><b>Trazas del Sistema</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"> Seguridad</a></li>
        <li class="active"><i class="fa fa-save"></i> Trazas</li>
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
              <div class="pull-right">
                <a href="trazas_print.php" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
              </div>
              </div>
          <div class="table-responsive">
            <div class="box-body">
              <table id="example2" class="table table-bordered">
                <thead>
                  <th>Fecha</th>
                  <th>Usuario</th>
                  <th>Acción</th>
                  <th>I.P</th>
                  <th>Acciones</th>
                </thead>
                <tbody>
                  <?php
                  print_r($_SESSION);
                  // Variables Globales de Server: ['REMOTE_ADDR'], ['REQUEST_METHOD'], ['REQUEST_URI']
                  //require_once "../../controllers/trazas/trazas_obtener.php";

                  //foreach($obtener as $row)
                    { 
                      ?>
                        <tr>
                          <td><?php ?></td>
                          <td><?php ?></td>
                          <td><?php ?></td>
                          <td><?php ?></td>
                          <td><?php ?></td>
                          <td><?php ?></td>
                          <td><?php ?></td>
                          <td><?php ?></td>
                          <td>
                            <button class="btn btn-sm show btn-flat" data-id="<?php echo $row['id']; ?>"><i class="fa fa-plus-square"></i></button>
                          </td>
                        </tr>
                      <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include '../includes/footer.php'; ?>
  <?php include 'trazas_modal.php'; ?>
</div>
<?php include '../includes/scripts.php'; ?>
<script>
$(function(){

  $('.show').click(function(e){
    e.preventDefault();
    $('#show').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'trazas_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#id').val(response.id);
      $('.del_employee_name').html(response.firstname+' '+response.lastname);
      $('#employee_id').val(response.employee_id);
      $('#del_employee_id').val(response.employee_id);
      $('#photo_employee_id').val(response.employee_id);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#datepicker_edit').val(response.birthdate);
      $('#edit_contact').val(response.contact_info);
      $('#gender_val').html(response.gender);
      $('#position_val').val(response.position_id).html(response.description);
      $('#schedule_val').val(response.schedule_id).html(response.time_in+' - '+response.time_out);
      $('#show_id').val(response.employee_id);
      $('#show_firstname').val(response.firstname);
      $('#show_lastname').val(response.lastname);
      $('#show_address').val(response.address);
      $('#show_birthdate').val(response.birthdate);
      $('#show_contact').val(response.contact_info);
      $('#show_gender').val(response.gender);
      $('#show_position').val(response.description);
      $('#show_schedule').val(response.time_in+' - '+response.time_out);
    }
  });
}
</script>
</body>
</html>
