<?php session_start();
include 'header.php'; ?>

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

    	<form action="http://localhost/Sistema-MVC/controllers/asistencia/asistencia_empleado_insertar.php">
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
            <a href="admin/index.php"><button type="button" class="btn btn-primary btn-block btn-flat" name="signin"><i class="fa fa-user"></i> Administrador</button></a>
        		</div>
          </div>
            </form>		
        </div>
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='callout callout-danger text-center mt20'>
              <p>".$_SESSION['error']."</p>
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['messages'])){
          echo "
            <div class='callout callout-success text-center mt20'>
                <p>".$_SESSION['messages']."</p>
            </div>
          ";
          unset($_SESSION['messages']);
        }
      ?>
	
<?php include 'scripts.php' ?>

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