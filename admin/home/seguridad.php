<?php 

  include '../../controllers/sesion/session.php';
  include '../includes/timezone.php'; 
  require_once '../../controllers/home/graficos_seguridad.php';
  include '../includes/header.php'; 
  if($_SESSION['perfil'] == 8000 || $_SESSION['perfil'] == 8001 || $_SESSION['perfil'] == 8003 || $_SESSION['perfil'] == 8004)
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
        <li class="active"><i class="fa fa-lock"></i> Seguridad</li>
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
      ?>
      <div class="row">
        <div class="col-lg-3 col-xs-4">
          <div class="small-box bg-blue">
            <div class="inner">
              <?php
                require_once "../../controllers/home/reportes_seguridad.php";

                echo "<h3>".$usuarios_sistema->rowCount()."</h3>"
              ?>

              <p>Usuarios</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="../usuarios/index.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                echo "<h3>".$usuarios_habilitados->rowCount()."</h3>"
              ?>
              <p>Habilitados</p>
            </div>
            <div class="icon">
              <i class="ion ion-clock"></i>
            </div>
            <a href="../usuarios/index.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                echo "<h3>".$usuarios_deshabilitados->rowCount()."</h3>"
              ?>
              <p>Deshabilitados</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert-circled"></i>
            </div>
            <a href="../usuarios/index.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-orange">
            <div class="inner">
              <?php
                echo "<h3>".$sesiones_abiertas->rowCount()."</h3>";
              ?>
          
              <p>Sesiones Abiertas</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="../usuarios/index.php" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Informe de Conexiones al Sistema</b></h3>
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
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var barChartData = {
    labels  : <?php echo $months; ?>,
    datasets: [
      {
        label               : 'Conexiones Finalizadas',
        fillColor           : 'rgba(0, 115, 183, 1)',
        strokeColor         : 'rgba(0, 115, 183, 1)',
        pointColor          : 'rgba(0, 115, 183, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(0, 115, 183, 1)',
        data                : <?php echo $conexion_finalizadas; ?>
      },
      {
        label               : 'Conexiones Iniciadas',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : <?php echo $conexion_iniciadas; ?>
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
    window.location.href = 'seguridad.php?year='+$(this).val();
  });
});
</script>
</body>
</html>
