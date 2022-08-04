<?php include '../../controllers/sesion/session.php'; ?>
<?php include '../includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include '../includes/navbar.php'; ?>
  <?php include '../includes/menubar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1><b>Tasa del Dolar</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class=""></i> Finanzas</a></li>
        <li class="active"><i class="fa fa-dollar"></i> Tasa del Dólar</li>
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
        <div class="table-responsive">
          <div class="box">
            <div class="box-body">
              <table id="example2" class="table table-bordered">
                <thead>
                    <th>Dólar a Bolívar</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                  <?php
                    require_once "../../controllers/tasadolar/tasadolar_obtener.php";

                    foreach($obtener as $row){
                  ?>
                      <tr>
                        <td><?php echo '$ 1.00'." = ".'Bs '.$row['tasa_dolar']?></td>
                        <td><?php echo $row['observaciones']?></td> 
                        <td><button class='btn btn-success btn-sm edit btn-flat' data-id="<?php echo $row['id'] ?>"><i class='fa fa-edit'></i></button></td>
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
<?php include 'tasa_dolar_modal.php'; ?>
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


function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'tasa_dolar_id.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
    $('#attid').val(response.id);
    $('#tasa_dolar').val(response.tasa_dolar);
  }});
}})
</script>
</body>
</html>
