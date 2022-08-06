<?php include '../../controllers/sesion/session.php';?>
<?php
  include '../includes/timezone.php';
  $range_to = date('m/d/Y');
  $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
?>
<?php include '../includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include '../includes/navbar.php'; ?>
  <?php include '../includes/menubar.php'; ?>

  <div class="content-wrapper">
 
    <section class="content-header">
    <h1><b>Histórico de Nómina</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class=""></i> Finanzas</a></li>
        <li class="active"><i class="fa fa-calculator"></i> Histórico de Nómina</li>
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
                <form method="POST" class="form-inline" id="payForm">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range" value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.' - '.$range_to; ?>">
                  </div> 
                  <button type="button" class="btn btn-danger btn-sm btn-flat" id="payroll"><span class="fa fa-file-pdf-o"></span> PDF</button>
                  <button type="button" class="btn btn-success btn-sm btn-flat" id="payexcel"><span class="fa fa-file-excel-o"></span> Excel</button>
                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Fecha Emisión</th>
                  <th>C.I</th>
                  <th>Nombre Completo</th>
                  <th>Sueldo</th>
                  <th>Total Deducciones</th>
                  <th>Tasa Dolar</th>
                  <th>Pago Neto en $</th>
                  <th>Pago Neto en Bs</th>
                  <th>Fecha de Nómina</th>
                </thead>
                <tbody>
                  <?php 
                    require_once "../../controllers/nomina/historico_nomina_obtener.php";
                    foreach($obtener_historico_nomina as $row)
                    {
                  ?>
                  <tr>
                    <td><?php echo date('d-m-Y', strtotime($row['fecha_emision']))?></td>      
                    <td><?php echo $row['ci']?></td>         
                    <td><?php echo $row['apellidos']." ".$row['nombres']?></td>
                    <td><?php echo '$ '.number_format($row['sueldo'], 2)?></td>
                    <td><?php echo '$ '.number_format($row['total_deducciones'], 2)?></td>
                    <td><?php echo '$ '.number_format($row['tasa_dolar'],2)?></td>
                    <td><?php echo '$ '.number_format($row['sueldo_neto'], 2)?></td>
                    <td><?php echo 'Bs.D '.number_format($row['sueldo_bolivares'], 2)?></td> 
                    <td><?php echo date('d-m-y', strtotime($row['fecha_inicio_nomina'])).' | '.date('d-m-y', strtotime($row['fecha_final_nomina']))?></td>   
                    <td>
                        <button class="btn btn btn-sm show btn-flat" data-id="<?php echo $row['id_nomina']; ?>"><i class="fa fa-plus"></i></button>
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
</div>
<?php 
  include 'historico_nomina_modal.php';
  include '../includes/scripts.php'; 
?> 
<script>
$(function(){
  $('.show').click(function(e){
    e.preventDefault();
    $('#show').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $("#reservation").on('change', function(){
    var range = encodeURI($(this).val());
    window.location = 'index.php?range='+range;
  });

  $('#payroll').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'nomina_historico_generate.php');
    $('#payForm').submit();
  });

  $('#payexcel').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'historico_nomina_xlsx.php');
    $('#payForm').submit();
  });

  $('#payslip').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'recibopago_generate.php');
    $('#payForm').submit();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'historico_nomina_id.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#show_cedula').val(response.cedula);
      $('#show_nombres').val(response.nombres+' '+response.apellidos);
      $('#show_sueldo').val('$ '+response.sueldo);
      $('#show_deducciones_ley').val('$ '+response.deducciones_ley);
      $('#show_avance_efectivo').val('$ '+response.avance_efectivo);
      $('#show_total_deducciones').val('$ '+response.total_deducciones);
      $('#show_tasa_dolar').val('$ '+response.tasa_dolar);
      $('#show_sueldo_neto').val('$ '+response.sueldo_neto);
      $('#show_sueldo_bolivares').val('Bs.D '+response.sueldo_bolivares);
      $('#show_fecha_emision').val(response.fecha_emision);
      $('#show_fecha_nomina').val(response.fecha_inicio_nomina+' | '+response.fecha_final_nomina);
    }
  });
}
</script>
</body>
</html>
