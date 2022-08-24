<?php 

  include '../../controllers/sesion/session.php'; 
  include '../includes/header.php'; 

  if($_SESSION['perfil'] == 8000 || $_SESSION['perfil'] == 8001 || $_SESSION['perfil'] == 8005)
  {

?>
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
                <form method="POST" class="form-inline" id="payForm">
                  <div class="input-group">
                  </div> 
                  <button type="button" class="btn btn-danger btn-sm btn-flat" id="payroll"><span class="fa fa-file-pdf-o"></span> PDF</button>
                  <button type="button" class="btn btn-success btn-sm btn-flat" id="payexcel"><span class="fa fa-file-excel-o"></span> Excel</button>
                </form>
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

  <?php 
  }else{
    require_once '../index.php';
  } 
  ?>
    
  <?php include '../includes/footer.php'; ?>
  
</div>
<?php include '../includes/scripts.php'; ?>
<script>

</script>
</body>
</html>
