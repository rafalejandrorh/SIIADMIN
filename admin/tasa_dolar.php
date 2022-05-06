<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1><b>Tasa del Dolar</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class=""></i> Administración</a></li>
        <li class="active">Tasa del Dolar</li>
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
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Tasa del Dolar</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM tasa_dolar";
                    $query = $conn->query($sql);

                    //$string = file_get_contents("https://s3.amazonaws.com/dolartoday/data.json");
                    //$dolarbcv = json_decode($string, true);
                    //$dolarbcv[USD][promedio_real]//

                    while($dolarbcv = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".'$ 1.00'." = ".'Bs '.$dolarbcv["rate_dolar"]."</td> 
                          <td><button class='btn btn-success btn-sm edit btn-flat' data-id='".$dolarbcv['id']."'><i class='fa fa-edit'></i> Editar</button></td>
                        </tr>
                      ";
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
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/tasa_dolar_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
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
    url: 'tasa_dolar_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#attid').val(response.id);
      $('#rate_dolar').val(response.rate_dolar);

  }});
}})
</script>
</body>
</html>
