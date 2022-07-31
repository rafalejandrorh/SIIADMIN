<?php 

  include '../includes/session.php';
  include '../includes/timezone.php'; 
  require_once '../../controllers/home/graficos_empleados.php';
  include '../includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  	<?php include '../includes/navbar.php'; ?>
  	<?php include '../includes/menubar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1><b>Panel de Control</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"> Reportes</a></li>
        <li class="active"><i class="fa fa-dashboard"></i> Panel de Control</li>
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
                require_once "../../controllers/home/reportes_empleados.php";

                echo "<h3>".$total_empleados->rowCount()."</h3>"
              ?>

              <p>Total de Empleados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="empleados/index.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="asistencia/index.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="asistencia/index.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="asistencia/index.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
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

      </section>
    </div>
  	<?php include '../includes/footer.php'; ?>

</div>

<?php include '../includes/scripts.php'; ?>
<script>
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
    window.location.href = 'index.php?year='+$(this).val();
  });
});
</script>
</body>
</html>
