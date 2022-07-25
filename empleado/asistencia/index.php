<?php 
include '../includes/header.php';
session_start();
$buscarempleado = [];
?>

</html>
<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo">
  		<p id="date"></p>
      <p id="time"></p>
      <b>Empleado</b>
  	</div>
  
  	<div class="login-box-body">
    	<h4 class="login-box-msg">Ingresa tu hora de entrada/salida</h4>

    	<form action="../../controllers/asistencia/asistencia_empleado_insertar.php" method="POST">
          <div class="form-group">
            <select class="form-control" name="status">
              <option value="in">Hora de Entrada</option>
              <option value="out">Hora de Salida</option>
            </select>
          </div>

      		<div class="form-group has-feedback">
        		<input type="text" class="form-control input-lg" id="employee" name="employee" required placeholder="Ingresa tu Cédula de Identidad">
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>

      		<div class="row">
    			  <div class="col-xs-6">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="signin"><i class="fa fa-sign-in"></i> Registrar</button>
        		</div>

            <div class="col-xs-6">
            <a href="../../admin/login/index.php"><button type="button" class="btn btn-primary btn-block btn-flat"><i class="fa fa-user"></i> Administrador</button></a>
        		</div>
          </div>
            </form>		
        </div>
      <?php
          if(isset($_SESSION['error'])){
            echo "
              <div class='alert alert-danger alert-dismissible mt20 text-center'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-warning'></i>¡Error!</h4>
                ".$_SESSION['error']."
              </div>
            ";
            unset($_SESSION['error']);
          }
          if(isset($_SESSION['success'])){
            echo "
              <div class='alert alert-success alert-dismissible mt20 text-center'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i>¡Proceso Exitoso!</h4>
                ".$_SESSION['success']."
              </div>
            ";
            unset($_SESSION['success']);
          }
        ?>

        <!--<div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
		<div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>-->
      
	
<?php include '../includes/scripts.php' ?>

<script type="text/javascript">
$(function() {
  var interval = setInterval(function() {
    var momentNow = moment();
    $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);

});
</script>

</body>
</html>