<?php include '../../controllers/sesion/session.php'; ?>
<?php include '../includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include '../includes/navbar.php'; ?>
  <?php include '../includes/menubar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
    <h1><b>Lista de Empleados</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"> Administración</a></li>
        <li class="active"><i class="fa fa-users"></i> Empleados</li>
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
              <div class="pull-right">
                <a href="empleados_print.php" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
              </div>
              </div>
          <div class="table-responsive">
            <div class="box-body">
              <table id="example2" class="table table-bordered">
                <thead>
                  <th>Cédula de Identidad</th>
                  <th>Nombre Completo</th>
                  <th>Cargo</th>
                  <th>Sueldo por Hora</th>
                  <th>Horario</th>
                  <th>Residencia</th>
                  <th>Teléfono</th>
                  <th>Foto</th>
                  <th>Acciones</th>
                </thead>
                <tbody>
                  <?php
                  require_once "../../controllers/empleados/empleados_obtener.php";
                  require_once "../../controllers/cargos/cargos_obtener.php";
                  require_once "../../controllers/horarios/horarios_obtener.php";

                  foreach($obtener as $row)
                    { 
                      ?>
                        <tr>
                          <td><?php echo $row['cedula']; ?></td>
                          <td><?php echo $row['nombres'].' '.$row['apellidos']; ?></td>
                          <td><?php echo $row['cargo']; ?></td>
                          <td><?php echo '$'.number_format($row['sueldo'], 2)?></td>
                          <td><?php echo date('h:i A', strtotime($row['hora_llegada'])).' - '.date('h:i A', strtotime($row['hora_salida'])); ?></td>
                          <td><?php echo $row['direccion']; ?></td>
                          <td><?php echo $row['numero_contacto']; ?></td>
                          <td><img src="<?php echo (!empty($row['foto']))? '../../images/perfil/'.$row['foto']:'../../images/perfil/profile.jpg'; ?>" width="30px" height="30px"> <a href="#edit_photo" data-toggle="modal" class="pull-right photo" data-id="<?php echo $row['id']; ?>"><span class="fa fa-edit"></span></a></td>
                          <td>
                            <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $row['id']; ?>"><i class="fa fa-trash"></i></button>
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
    url: 'empleados_id.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#del_employee_name').html(response.nombres+' '+response.apellidos);
      $('#del_id_empleado').val(response.id_empleado);
      $('#edit_id_empleado').val(response.id_empleado);
      $('#edit_cedula').val(response.cedula);
      $('#edit_nombres').val(response.nombres);
      $('#edit_apellidos').val(response.apellidos);
      $('#edit_direccion').val(response.direccion);
      $('#fecha_nacimiento_edit').val(response.fecha_nacimiento);
      $('#edit_contacto').val(response.numero_contacto);
      $('#edit_genero').val(response.genero);
      $('#edit_cargo').val(response.id_cargo).html(response.cargo);
      $('#edit_horario').val(response.id_horarios).html(response.hora_llegada+' - '+response.hora_salida);
      $('#edit_foto').val(response.foto);
      $('#foto_id_empleado').val(response.id_empleado);
      $('#show_cedula').val(response.cedula);
      $('#show_nombres').val(response.nombres);
      $('#show_apellidos').val(response.apellidos);
      $('#show_direccion').val(response.direccion);
      $('#show_fecha_nacimiento').val(response.fecha_nacimiento);
      $('#show_contacto').val(response.numero_contacto);
      $('#show_genero').val(response.genero);
      $('#show_cargo').val(response.cargo);
      $('#show_horario').val(response.hora_llegada+' - '+response.hora_salida);
    }
  });
}
</script>
</body>
</html>
