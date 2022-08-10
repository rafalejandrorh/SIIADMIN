<?php 

  include '../../controllers/sesion/session.php';
  include '../includes/header.php'; 
  if($_SESSION['perfil'] == 8000 || $_SESSION['perfil'] == 8001 || $_SESSION['perfil'] == 8003)
  {

?>
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
              </div>
          <div class="table-responsive">
            <div class="box-body">
              <table id="example2" class="table table-bordered">
                <thead>
                  <th>ID de Perfil</th>
                  <th>Perfil</th>
                  <th>Acciones</th>
                </thead>
                <tbody>
                  <?php
                  require_once "../../controllers/perfiles/perfiles_obtener.php";

                  foreach($obtener as $row)
                    { 
                      ?>
                        <tr>
                          <td><?php echo $row['id_perfil']; ?></td>
                          <td><?php echo $row['perfil']; ?></td>
                          <td>
                            <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $row['id_perfil']; ?>"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $row['id_perfil']; ?>"><i class="fa fa-trash"></i></button>
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
  <?php include 'perfiles_modal.php'; ?>
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
    url: 'perfiles_id.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#del_perfil').html(response.perfil);
      $('#del_id_perfil').val(response.id_perfil);
      $('#edit_id_perfil_antiguo').val(response.id_perfil_antiguo);
      $('#edit_id_perfil').val(response.id_perfil);
      $('#edit_perfil').val(response.perfil);
    }
  });
}
</script>
</body>
</html>
