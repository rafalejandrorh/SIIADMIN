<?php include '../includes/session.php'; ?>
<?php include '../includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include '../includes/navbar.php'; ?>
  <?php include '../includes/menubar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1><b>Deducciones</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class=""></i> Finanzas</a></li>
        <li class="active"><i class="fa fa-percent"></i> Deducciones</li>
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
              <h4><b>IVSS</b></h4>
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Nuevo</a>
            </div>
            <div class="box-body">
              <table id="" class="table table-bordered">
                <thead>
                  <th>Descripción</th>
                  <th>Monto</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  <?php
                    require_once "../../controllers/deducciones/deducciones_obtener.php";

                    foreach($obtener_ivss as $row)
                    {
                      ?>
                        <tr>
                          <td><?php echo $row['description'] ?></td>
                          <td><?php echo $row['amount'] ?></td>
                          <td>
                            <button class='btn btn-success btn-sm edit1 btn-flat' data-id="<?php echo $row['id'] ?>"><i class='fa fa-edit'></i></button>
                            <button class='btn btn-danger btn-sm delete1 btn-flat' data-id="<?php echo $row['id'] ?>"><i class='fa fa-trash'></i></button>
                          </td>
                        </tr>
                      <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h4><b>FAOV</b></h4>
              <a href="#addnew2" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Nuevo</a>
            </div>
            <div class="box-body">
              <table id="" class="table table-bordered">
                <thead>
                  <th>Descripción</th>
                  <th>Monto</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  <?php
                    foreach($obtener_faov as $row)
                    {
                      ?>
                        <tr>
                          <td><?php echo $row['description']?></td>
                          <td><?php echo $row['amount']?></td>
                          <td>
                            <button class='btn btn-success btn-sm edit2 btn-flat' data-id="<?php echo $row['id']?>"><i class='fa fa-edit'></i></button>
                            <button class='btn btn-danger btn-sm delete2 btn-flat' data-id="<?php echo $row['id']?>"><i class='fa fa-trash'></i></button>
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
  <?php include 'deducciones_modal.php'; ?>
</div>
<?php include '../includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit1').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete1').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

$(function(){
  $('.edit2').click(function(e){
    e.preventDefault();
    $('#edit2').modal('show');
    var id = $(this).data('id');
    getRow2(id);
  });

  $('.delete2').click(function(e){
    e.preventDefault();
    $('#delete2').modal('show');
    var id = $(this).data('id');
    getRow2(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'deducciones_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.decid').val(response.id);
      $('#edit_decid').val(response.id);
      $('#edit_description').val(response.description);
      $('#edit_amount').val(response.amount);
      $('#del_deduction').html(response.description);
      $('#del_decid').val(response.id);
    }
  });
}

function getRow2(id){
  $.ajax({
    type: 'POST',
    url: 'deducciones_row2.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.decid2').val(response.id);
      $('#edit_decid2').val(response.id);
      $('#edit_description2').val(response.description);
      $('#edit_amount2').val(response.amount);
      $('#del_deduction2').html(response.description);
      $('#del_decid2').val(response.id);
    }
  });
}
</script>
</body>
</html>
