<?php session_start(); ?>
<?php include 'header.php'; ?>


</body>
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

    	<form id="attendance">
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
		<div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
		<div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>
  		
</div>
	
<?php include 'scripts.php' ?>
<script type="text/javascript">
$(function() {
  var interval = setInterval(function() {
    var momentNow = moment();
    $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);

  $('#attendance').submit(function(e){
    e.preventDefault();
    var attendance = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'asistencia.php',
      data: attendance,
      dataType: 'json',
      success: function(response){
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message);
          $('#employee').val('');
          
        }
      }
    });
  });
    
});
</script>
</body>
</html>