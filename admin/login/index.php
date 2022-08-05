<?php
  session_start();
  if(isset($_SESSION['id_usuario'])){
    header('location:../home/administracion.php');
  }
  include '../../controllers/sesion/login.php';
  include '../includes/header.php'; ?>
<html>
<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo">
	  	<p id="date"></p>
      	<p id="time"></p>
  		<b>Administrador</b>
  	</div>
  
  	<div class="login-box-body">
    	<h4 class="login-box-msg">Ingresa tus credenciales para iniciar sesión</h4>

    	<form action="#" method="POST">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="username" placeholder="Ingresa Usuario de Administrador" required autofocus>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Ingresa tu contraseña" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row">
    			<div class="col-xs-5">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Ingresar</button>
        		</div>

				  <div class="col-xs-7">
                <a href="../../empleado/asistencia/index.php"><button type="button" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-calendar"></i> Registrar Asistencia</button></a>
        		</div>
      		</div>
    	</form>
  	</div>
  	<?php
  		if(isset($_SESSION['error']))
		{
  			echo "<div class='callout callout-danger text-center mt20'>
			  	  <p>".$_SESSION['error']."</p> 
			  	  </div>";
  			unset($_SESSION['error']);
  		}
  	?>
</div>
	
<?php include '../includes/scripts.php' ?>
</body>
</html>

<script type="text/javascript">

$(function() {
  var interval = setInterval(function() {
  var momentNow = moment();
    $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);
    
});
</script>