<!-- AÑADIR -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Perfil</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/perfiles/perfiles_insertar.php" enctype="multipart/form-data">

          		  <div class="form-group">
                  	<label for="usuario" class="col-sm-3 control-label">ID de Perfil</label>
                    <input type="hidden" name="id_usuario_administrador" value="<?php echo $_SESSION['id_usuario']?>">
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="" name="id_perfil" required>
                  	</div>
                </div>

                <div class="form-group">
                    <label for="contraseña" class="col-sm-3 control-label">Perfil</label>

                    <div class="col-sm-9"> 
                      <input type="text" class="form-control" id="" name="perfil" required>
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <label for="curr_contraseña" class="col-sm-3 control-label">Contraseña Administrador:</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="contraseña_administrador" name="contraseña_administrador" placeholder="Ingrese su contraseña actual para guardar los cambios" required>
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

<!-- EDITAR -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Perfil</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/perfiles/perfiles_editar.php" enctype="multipart/form-data">

          		  <div class="form-group">
                  	<label for="usuario" class="col-sm-3 control-label">ID de Perfil</label>
                    <input type="hidden" name="id_perfil_antiguo" id="edit_id_perfil_antiguo">
                    <input type="hidden" name="id_usuario_administrador" value="<?php echo $_SESSION['id_usuario']?>">
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_id_perfil" name="id_perfil_nuevo">
                  	</div>
                </div>

                <div class="form-group">
                    <label for="contraseña" class="col-sm-3 control-label">Perfil</label>

                    <div class="col-sm-9"> 
                      <input type="text" class="form-control" id="edit_perfil" name="perfil" required>
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <label for="curr_contraseña" class="col-sm-3 control-label">Contraseña Administrador:</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="" name="contraseña_administrador" placeholder="Ingrese su contraseña actual para guardar los cambios" required>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-success btn-flat" name="editar"><i class="fa fa-check-square-o"></i> Guardar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- ELIMINAR -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="employee_id"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/perfiles/perfiles_eliminar.php">
            	
              <div class="form-group">
                    <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="id_perfil" id="del_id_perfil">
                    </div>
                </div>

            		<div class="text-center">
	                	<p>ELIMINAR PERFIL</p>
	                	<h2 class="bold del_employee_name" id="del_perfil"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="eliminar"><i class="fa fa-trash"></i> Eliminar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>  