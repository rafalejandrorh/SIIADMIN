<?php include '../../controllers/sesion/session.php'; ?>
<?php include '../includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include '../includes/navbar.php'; ?>
  <?php include '../includes/menubar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
    <h1><b>Usuarios del Sistema</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"> Seguridad</a></li>
        <li class="active"><i class="fa fa-user"></i> Usuarios del Sistema</li>
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
                <a href="usuarios_print.php" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
              </div>
              </div>
          <div class="table-responsive">
            <div class="box-body">
              <table id="example2" class="table table-bordered">
                <thead>
                  <th>Cédula de Identidad</th>
                  <th>Nombre Completo</th>
                  <th>Cargo</th>
                  <th>Usuario</th>
                  <th>Estatus</th>
                  <th>Foto</th>
                  <th>Fecha de Creación</th>
                  <th>Acciones</th>
                </thead>
                <tbody>
                  <?php
                  require_once "../../controllers/usuarios/usuarios_obtener.php";

                  foreach($obtener as $row)
                    { 
                      ?>
                        <tr>
                          <td><?php echo $row['cedula']; ?></td>
                          <td><?php echo $row['nombres'].' '.$row['apellidos']; ?></td>
                          <td><?php echo $row['cargo']; ?></td>
                          <td><?php echo $row['usuario']; ?></td>
                          <td><?php if($row['habilitado'] == 1){echo '<span class="label label-success pull-right">Habilitado</span>';} else if($row['habilitado'] == null){echo '<span class="label label-danger pull-right">Deshabilitado</span>';}?></td>
                          <td><img src="<?php echo (!empty($row['foto']))? '../../images/perfil/'.$row['foto']:'../../images/perfil/profile.jpg'; ?>" width="30px" height="30px"></td>
                          <td><?php echo $row['fecha_creacion']; ?></td>
                          <td>
                            <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $row['id_usuario']; ?>"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $row['id_usuario']; ?>"><i class="fa fa-trash"></i></button>
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
  <?php include 'usuarios_modal.php'; ?>
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
    url: 'usuarios_id.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#del_nombres').html(response.nombres+' '+response.apellidos);
      $('#del_id_usuario').val(response.id_usuario);
      $('#edit_id_usuario').val(response.id_usuario);
      $('#edit_cedula').val(response.cedula);
      $('#edit_nombres').val(response.nombres+' '+response.apellidos);
      $('#edit_usuario').val(response.usuario);
      $('#edit_contraseña').val(response.contraseña);
      $('#edit_habilitado').val(response.habilitado_val).html(response.habilitado);
    }
  });
}
</script>
</body>
</html>
