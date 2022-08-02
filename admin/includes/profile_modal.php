<!-- Actualizar perfil -->
<div class="modal fade" id="profile">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Perfil Administrador</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/sesion/perfil_editar.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
          		  <div class="form-group">
                  	<label for="usuario" class="col-sm-3 control-label">Usuario</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $_SESSION['usuario']; ?>">
                  	</div>
                </div>
                <div class="form-group">
                    <label for="contraseña" class="col-sm-3 control-label">Contraseña</label>

                    <div class="col-sm-9"> 
                      <input type="password" class="form-control" id="contraseña" name="contraseña" value="<?php echo $_SESSION['contraseña']; ?>">
                    </div>
                </div>
                <div class="form-group">
                  	<label for="nombres" class="col-sm-3 control-label">Nombre</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $_SESSION['nombres']; ?>">
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="apellidos" class="col-sm-3 control-label">Apellido</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $_SESSION['apellidos']; ?>">
                  	</div>
                </div>
                <div class="form-group">
                    <label for="foto" class="col-sm-3 control-label">Foto:</label>

                    <div class="col-sm-9">
                      <input type="file" id="foto" name="foto">
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="curr_contraseña" class="col-sm-3 control-label">Contraseña Actual:</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="curr_contraseña" name="curr_contraseña" placeholder="Ingrese su contraseña actual para guardar los cambios" required>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-success btn-flat" name="guardar"><i class="fa fa-check-square-o"></i> Guardar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>