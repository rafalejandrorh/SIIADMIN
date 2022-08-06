<?php 
  include '../../controllers/sesion/session.php';
  include '../includes/timezone.php';
  require_once "../../controllers/nomina/nomina_obtener.php";

  $range_to = date('m/d/Y');
  $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
  
  include '../includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include '../includes/navbar.php'; ?>
  <?php include '../includes/menubar.php'; ?>

  <div class="content-wrapper">
 
    <section class="content-header">
    <h1><b>Nómina</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class=""></i> Finanzas</a></li>
        <li class="active"><i class="fa fa-calculator"></i> Nómina</li>
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
                  <button type="button" class="btn btn- btn-sm btn-flat" id="payslip"><span class="glyphicon glyphicon-print"></span> Recibo de Pago</button>
                  <button type="button" class="btn btn-danger btn-sm btn-flat" id="payroll"><span class="fa fa-file-pdf-o"></span> PDF</button>
                  <button type="button" class="btn btn-success btn-sm btn-flat" id="payexcel"><span class="fa fa-file-excel-o"></span> Excel</button>
                  <button type="submit" name="guardar" class="btn btn-primary btn-sm btn-flat"><span class="glyphicon glyphicon-save"></span> Guardar Nómina</button>
                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Cédula de Identidad</th>
                  <th>Nombre Completo</th>
                  <th>Sueldo</th>
                  <th>Deducciones</th>
                  <th>Avance de Efectivo</th>
                  <th>Tasa de Dolar BCV</th>
                  <th>Pago Neto en $</th>
                  <th>Pago Neto en Bs</th>
                </thead>
                <tbody>
                  <?php 
                    
                    foreach($consulta_horas_trabajadas as $row)
                    {
                    $sueldo = $row['sueldo'] * $row['total_horas'];
                    $id_empleado = $row['empid'];   
    
                    //Obtiene el efectivo prestado al empleado
                    $consulta_avancefectivo = $nomina->consulta_avancefectivo($from, $to, $id_empleado);
                    if(!isset($consulta_avancefectivo[0]['efectivo']))
                    {
                      $consulta_avancefectivo[0]['efectivo'] = 0;
                    }  
                    //Realiza el Cálculo de la Nomina. Retorna: El total de las deducciones y el Total del Pago Neto en Bs y Dólares
                    $calculo_nomina = $nomina->calculo_nomina($sueldo, $deduction, $deduction2, $consulta_avancefectivo[0]['efectivo'], $dolar);

                  ?>
                  <tr>   
                    <td><?php echo $row['ci']?></td>         
                    <td><?php echo $row['apellidos']." ".$row['nombres']?></td>
                    <td><?php echo '$ '.number_format($sueldo, 2)?></td>
                    <td><?php echo '$ '.number_format($calculo_nomina['deductionley'], 2)?></td>
                    <td><?php echo '$ '.number_format($consulta_avancefectivo[0]['efectivo'], 2)?></td>
                    <td><?php echo '$ '.number_format(1,2)." = Bs ".number_format($dolar,2)?></td>
                    <td><?php echo '$ '.number_format($calculo_nomina['neto'], 2)?></td>
                    <td><?php echo 'Bs.D '.number_format($calculo_nomina['bs'], 2)?></td> 
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
<?php include '../includes/scripts.php'; ?> 
<script>
$(function(){

  $("#reservation").on('change', function(){
    var range = encodeURI($(this).val());
    window.location = 'index.php?range='+range;
  });

  $('#payroll').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'nomina_generate.php');
    $('#payForm').submit();
  });

  $('#payexcel').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'nomina_xlsx.php');
    $('#payForm').submit();
  });

  $('#payslip').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'recibopago_generate.php');
    $('#payForm').submit();
  });

});

</script>
</body>
</html>
