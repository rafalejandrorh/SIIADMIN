<?php 

  include '../../controllers/sesion/session.php';
  include '../includes/timezone.php'; 
  require_once '../../controllers/home/graficos_administracion.php';
  include '../includes/header.php'; 
  if($_SESSION['perfil'] == 8000 || $_SESSION['perfil'] == 8001 || $_SESSION['perfil'] == 8005 || $_SESSION['perfil'] == 8004)
  {

?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  	<?php include '../includes/navbar.php'; ?>
  	<?php include '../includes/menubar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1><b>Panel de Control</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"> Reportes Gráficos</a></li>
        <li class="active"><i class="fa fa-tachometer-alt"></i> Administración</li>
      </ol>
    </section>

    <section class="content">
      <?php
        if(isset($_SESSION['error']))
        {
          echo "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-warning'></i> Error!</h4>
                ".$_SESSION['error']."
                </div>";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success']))
        {
          echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i>¡Proceso Exitoso!</h4>
                ".$_SESSION['success']."
                </div>";
          unset($_SESSION['success']);
        }
        if(isset($_SESSION['login_exitoso']))
        {
          echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i>¡Inicio de Sesión Exitoso!</h4>
                </div>";
          unset($_SESSION['login_exitoso']);
        }
      ?>
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-blue">
            <div class="inner">
              <?php
                require_once "../../controllers/home/reportes_administracion.php";

                echo "<h3>".$total_empleados->rowCount()."</h3>"
              ?>

              <p>Total de Empleados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="../empleados/index.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-orange">
            <div class="inner">
              <?php

                $total= $asistentes_atiempo->rowCount();


                $early = $asistentes_tarde->rowCount();
                
                $percentage = ($early/$total)*100;

                echo "<h3>".number_format($percentage, 2)."<sup style='font-size: 20px'>%</sup></h3>";
              ?>
          
              <p>Empleados a Tiempo</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="../asistencia/index.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                echo "<h3>".$asistentes_atiempo_hoy->rowCount()."</h3>"
              ?>
              <p>A tiempo hoy</p>
            </div>
            <div class="icon">
              <i class="ion ion-clock"></i>
            </div>
            <a href="../asistencia/index.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                echo "<h3>".$asistentes_tarde_hoy->rowCount()."</h3>"
              ?>
              <p>Tarde hoy</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert-circled"></i>
            </div>
            <a href="../asistencia/index.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Informe de asistencia mensual</b></h3>
              <div class="box-tools pull-right">
                <form class="form-inline">
                  <div class="form-group">
                    <label>Seleccionar Año: </label>
                    <select class="form-control input-sm" id="select_year">
                      <?php
                        for($i=1990; $i<=2070; $i++){
                          $selected = ($i==$year)?'selected':'';
                          echo "
                            <option value='".$i."' ".$selected.">".$i."</option>
                          ";
                        }
                      ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <br>
                <div id="legend" class="text-center"></div>
                <canvas id="barChart" style="height:500px"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border"> 
              <h3 class="box-title"><b>Empleados asistentes Hoy</b></h3>  
              <div class="pull-right">
              <form method="POST" class="form-inline" id="asistForm">
                  <div class="input-group">
                  </div>
                    <button type="button" class="btn btn-danger btn-sm btn-flat" id="asistencia"><span class="fa fa-file-pdf-o"></span> PDF</button>
                    <button type="button" class="btn btn-success btn-sm btn-flat" id="payexcel"><span class="fa fa-file-excel-o"></span> Excel</button>
              </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="">Fecha</th>
                  <th class="">Cédula de Identidad</th>
                  <th class="">Nombre Completo</th>
                  <th class="">Cargo</th>
                  <th class="">Hora de Entrada</th>
                  <th class="">Hora de Salida</th>
                  <th class="">Horas Laboradas</th>
                </thead>
                <tbody>
                  <?php
                    require_once "../../controllers/home/reportes_administracion.php";

                    foreach($asistentes_hoy as $row)
                    {
                      $status = ($row['estatus_llegada'])?'<span class="label label-warning pull-right">A tiempo</span>':'<span class="label label-danger pull-right">Tarde</span>';
                      ?>
                        <tr>
                          <td><?php echo date('d M, Y', strtotime($row['fecha']))?></td>
                          <td><?php echo $row['cedula']?></td>
                          <td><?php echo $row['nombres'].', '.$row['apellidos']?></td>
                          <td><?php echo $row['cargo']?></td>
                          <td><?php echo date('h:i A', strtotime($row['hora_llegada'])).$status?></td>
                          <td><?php 
                          if($row['hora_salida'] != null)
                          { 
                            echo date('h:i A', strtotime($row['hora_salida']));
                          }else{
                            echo '00:00 PM';
                          }
                          ?></td>
                          <td><?php 
                          if($row['horas_laboradas'] != null)
                          {
                            echo number_format($row['horas_laboradas'],1);
                          }else{
                            $hora_llegada = new DateTime($row['hora_llegada']);
                            $hora = date('H:i:s');
                            $hora_actual = new DateTime($hora);
                            $interval = $hora_actual->diff($hora_llegada);
                            $hrs = $interval->format('%h');
                            $mins = $interval->format('%i');
                            $mins = $mins/60;
                            $int = $hrs + $mins;
                            echo number_format($int, 1);
                          }
                          ?></td>
                        </tr>
                      <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

            <div class="row">
              <div class="col-md-12">
                <!-- USERS LIST -->
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title"><b>Empleados Nuevos Ingreso</b></h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">  
                      <?php 
                        foreach($empleados_nuevo_ingreso as $row)
                        {
                      ?>
                      <li>
                        <img src="<?php echo (!empty($row['foto'])) ? '../../images/perfil/'.$row['foto'] : '../../images/perfil/profile.jpg';?>" width="100" height="100" alt="User Image">
                        <a class="users-list-name" href="../asistencia/index.php"><?php echo $row['nombres'].' '.$row['apellidos']?></a>
                        <a class="users-list-name" href="../asistencia/index.php"><?php echo $row['cargo']?></a>
                        <span class="users-list-date">
                          <?php
                            $hoy = date('Y-m-d');
                            $ayer = date('Y-m-d', strtotime('-1 day', strtotime($hoy)));
                            if($row['fecha_ingreso'] == $hoy)
                            {
                              echo 'Hoy';
                            }else if($row['fecha_ingreso'] == $ayer)
                            {
                              echo 'Ayer';
                            }else{
                            echo $row['fecha_ingreso'];
                            }
                          ?>
                        </span>
                      </li>
                      <?php } ?>
                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-12">
                <!-- USERS LIST -->
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title"><b>Empleados Egresados</b></h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">  
                      <?php 
                        foreach($empleados_egreso as $row)
                        {
                      ?>
                      <li>
                        <img src="<?php echo (!empty($row['foto'])) ? '../../images/perfil/'.$row['foto'] : '../../images/perfil/profile.jpg';?>" width="100" height="100" alt="User Image">
                        <a class="users-list-name" href="../asistencia/index.php"><?php echo $row['nombres'].' '.$row['apellidos']?></a>
                        <a class="users-list-name" href="../asistencia/index.php"><?php echo $row['cargo']?></a>
                        <span class="users-list-date">
                          <?php
                            $hoy = date('Y-m-d');
                            $ayer = date('Y-m-d', strtotime('-1 day', strtotime($hoy)));
                            if($row['fecha_ingreso'] == $hoy)
                            {
                              echo 'Hoy';
                            }else if($row['fecha_ingreso'] == $ayer)
                            {
                              echo 'Ayer';
                            }else{
                            echo $row['fecha_ingreso'];
                            }
                          ?>
                        </span>
                      </li>
                      <?php } ?>
                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
              </div>
              <!-- /.col -->
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
$(function(){

  $('#asistencia').click(function(e){
    e.preventDefault();
    $('#asistForm').attr('action', 'asistencia_hoy_print.php');
    $('#asistForm').submit();
  });

  $('#payexcel').click(function(e){
    e.preventDefault();
    $('#asistForm').attr('action', 'asistencia_hoy_xlsx.php');
    $('#asistForm').submit();
  });

});

$(function(){
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var barChartData = {
    labels  : <?php echo $months; ?>,
    datasets: [
      {
        label               : 'Tarde',
        fillColor           : 'rgba(0, 115, 183, 1)',
        strokeColor         : 'rgba(0, 115, 183, 1)',
        pointColor          : 'rgba(0, 115, 183, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(0, 115, 183, 1)',
        data                : <?php echo $late; ?>
      },
      {
        label               : 'A tiempo',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : <?php echo $ontime; ?>
      }
    ]
  }
  barChartData.datasets[1].fillColor   = '#00a65a'
  barChartData.datasets[1].strokeColor = '#00a65a'
  barChartData.datasets[1].pointColor  = '#00a65a'
  var barChartOptions                  = {

    scaleBeginAtZero        : true,

    scaleShowGridLines      : true,

    scaleGridLineColor      : 'rgba(0,0,0,.05)',

    scaleGridLineWidth      : 1,
 
    scaleShowHorizontalLines: true,
 
    scaleShowVerticalLines  : true,
 
    barShowStroke           : true,
 
    barStrokeWidth          : 2,

    barValueSpacing         : 5,
  
    barDatasetSpacing       : 1,
  
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',

    responsive              : true,
    maintainAspectRatio     : true
  }

  barChartOptions.datasetFill = false
  var myChart = barChart.Bar(barChartData, barChartOptions)
  document.getElementById('legend').innerHTML = myChart.generateLegend();
});
</script>
<script>
$(function(){
  $('#select_year').change(function(){
    window.location.href = 'administracion.php?year='+$(this).val();
  });
});
</script>
</body>
</html>
