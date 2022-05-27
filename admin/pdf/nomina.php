<?php include '../includes/session.php'; ?>
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
    <h1><b>Nómina</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class=""></i> PDF</a></li>
        <li class="active">Nómina</li>
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
      <!--<div class="row">
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
                  <button type="button" class="btn btn-success btn-sm btn-flat" id="payroll"><span class="glyphicon glyphicon-print"></span> Nómina</button>
                  <button type="button" class="btn btn-primary btn-sm btn-flat" id="payslip"><span class="glyphicon glyphicon-print"></span> Recibo de Pago</button>
                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Nombre Empleado</th>
                  <th>Cédula de Identidad</th>
                  <th>Sueldo</th>
                  <th>Deducciones</th>
                  <th>Avance de Efectivo</th>
                  <th>Tasa de Dolar BCV</th>
                  <th>Pago Neto en $</th>
                  <th>Pago Neto en Bs</th>
                </thead>
                <tbody>
                  <?php
                    /*$sql = "SELECT *, SUM(amount) as total_amount FROM deducciones";
                    $query = $conn->query($sql);
                    $drow = $query->fetch_assoc();
                  **$deduction = $drow['total_amount'];

                    $sql2 = "SELECT *, SUM(amount) as total_amount2 FROM deducciones2";
                    $query2 = $conn->query($sql2);
                    $drow2 = $query2->fetch_assoc();
                  **$deduction2 = $drow2['total_amount2']; 
                    
                    $to = date('Y-m-d');
                    $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));

                    if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode(' - ', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));
                    }

                    LISTO $sql = "SELECT *, SUM(num_hr) AS total_hr, asistencia.employee_id AS empid FROM asistencia LEFT JOIN empleados ON empleados.id=asistencia.employee_id LEFT JOIN cargos ON cargos.position_id=empleados.position_id WHERE asistencia.date BETWEEN '$from' AND '$to' GROUP BY asistencia.employee_id ORDER BY empleados.lastname ASC, empleados.firstname ASC";

                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $empid = $row['empid'];
                      
                      $casql = "SELECT *, SUM(amount) AS cashamount FROM avancefectivo WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";
                      
                      $rsql = "SELECT *, rate_dolar FROM tasa_dolar";
                      $rquery = $conn->query($rsql);
                      $rate_dolar = $rquery->fetch_assoc();
                    **$dolarbcv = $rate_dolar['rate_dolar'];


                      $string = file_get_contents("https://s3.amazonaws.com/dolartoday/data.json");
                      $json = json_decode($string, true);
                      $dolarbcv = $json["USD"]["promedio_real"];

                      
                      $caquery = $conn->query($casql);
      LISTO HASTA ACA $carow = $caquery->fetch_assoc();
                  **  $cashadvance = $carow['cashamount'];

                      $gross = $row['rate'] * $row['total_hr'];
                      $mensualgross = ($gross * 12)/52;
                      $percentdeduction = $deduction * $mensualgross;
                      $faovsso = $percentdeduction * 5;

                      $gross2 = $row['rate'] * $row['total_hr'];
                      $paroforzoso = $gross2 * $deduction2;

                      $deductionley = $faovsso + $paroforzoso;

                      $total_deduction =  $deductionley + $cashadvance;
                      $net = $gross - $total_deduction;
                      $bs = $dolarbcv * $net; */


                      // $row = Nombres, apellidos y cédula de empleado
                      // $gross = Valor del Sueldo calculado (Horas laboradas x pago por hora)
                      // $deductionley = Sumatoria de las deducciones por FAOV e IVSS
                      // $cashadvance = Avance de Efectivo realizado y se descontará del sueldo al empleado
                      // $dolarbcv = Tasa del Dolar con respecto al Bolivar por el cual se calculará la nómina en dólares
                      // $net = Representación del monto neto a pagar para cada empleado en $
                      // $bs = Representación del monto neto a pagar para cada empleado en Bs.D

                      //Prueba
                      require_once "../../controllers/pdf/nomina_obtener.php";

                      echo "
                        <tr>
                          <td>".$row['lastname'].", ".$row['firstname']."</td>
                          <td>".$row['employee_id']."</td>
                          <td>".'$ '.number_format($gross, 2)."</td>
                          <td>".'$ '.number_format($deductionley, 2)."</td>
                          <td>".'$ '.number_format($deductionefectivo, 2)."</td>
                          <td>".'$ '.number_format(1,2)." = ".'Bs '.number_format($dolarbcv,2)."</td>
                          <td>".'$ '.number_format($net, 2)."</td>
                          <td>".'Bs.D '.number_format($bs, 2)."</td> 
                        </tr>
                      ";
                    
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

  $("#reservation").on('change', function(){
    var range = encodeURI($(this).val());
    window.location = 'nomina.php?range='+range;
  });

  $('#payroll').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'nomina_generate.php');
    $('#payForm').submit();
  });

  $('#payslip').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'recibosueldo_generate.php');
    $('#payForm').submit();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'cargos_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#posid').val(response.id);
      $('#edit_title').val(response.description);
      $('#edit_rate').val(response.rate);
      $('#del_posid').val(response.id);
      $('#del_position').html(response.description);
    }
  });
}


</script>
</body>
</html>
