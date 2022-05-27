<?php include '../includes/session.php'; ?>
<?php include '../includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include '../includes/navbar.php'; ?>
  <?php include '../includes/menubar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
    <h1><b>Lista de Empleados</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Empleados</a></li>
        <li class="active">Lista de Empleados</li>
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
               <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Nuevo</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>C.I</th>
                  <th>Nombres</th>
                  <th>Residencia</th>
                  <th>Teléfonos</th>
                  <th>Cargo</th>
                  <th>Horarios</th>
                  <th>Foto</th>
                  <th>Acción</th>
                  <th>Más</th>
                </thead>
                <tbody>
                  <?php
                  require_once "../../config/conn.php";
                  require_once "../../controllers/empleados/empleados_obtener.php";
                  require_once "../../controllers/empleados/empleados_modal.php";

                  foreach($obtener as $row)
                    { 
                      ?>
                        <tr>
                          <td><?php echo $row['employee_id']; ?></td>
                          <td><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
                          <td><?php echo $row['address']?></td>
                          <td><?php echo $row['contact_info']?></td>
                          <td><?php echo $row['description']; ?></td>
                          <td><?php echo date('h:i A', strtotime($row['time_in'])).' - '.date('h:i A', strtotime($row['time_out'])); ?></td>
                          <td><img src="<?php echo (!empty($row['photo']))? '../../images/'.$row['photo']:'../../images/profile.jpg'; ?>" width="30px" height="30px"> <a href="#edit_photo" data-toggle="modal" class="pull-right photo" data-id="<?php echo $row['id']; ?>"><span class="fa fa-edit"></span></a></td>
                          <td>
                            <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $row['id']; ?>"><i class="fa fa-trash"></i></button>
                          </td>
                          <td>
                            <button class="btn btn-sm show btn-flat" data-id="<?php echo $row['id']; ?>"><i class="fa fa-plus"></i></button>
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
    
  <?php include '../includes/footer.php'; ?>
  <?php include 'empleados_modal.php'; ?>
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

  $('.photo').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'empleados_row.php',
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
