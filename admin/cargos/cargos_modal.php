<!-- Añadir cargos -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Agregar Cargo</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/cargos/cargos_insertar.php">
          		  <div class="form-group">
                  	<label for="title" class="col-sm-3 control-label">Nombre Cargo</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="cargo" name="cargo" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Pago por Hora</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="sueldo" name="sueldo" required>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="guardar"><i class="fa fa-save"></i> Guardar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Editar cargos -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Actualizar Cargo</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/cargos/cargos_editar.php">
				<div class="form-group">
                  	<div class="col-sm-9">
                    	<input type="hidden" class="form-control" id="edit_id_cargo" name="id" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="edit_title" class="col-sm-3 control-label">Nombre del Cargo</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_cargo" name="cargo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_rate" class="col-sm-3 control-label">Costo por Hora</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_sueldo" name="sueldo">
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-success btn-flat" name="editar"><i class="fa fa-check-square-o"></i> Actualizar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- eliminar cargos -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Eliminando...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/cargos/cargos_eliminar.php">
				<div class="form-group">
                  	<div class="col-sm-9">
                    	<input type="hidden" class="form-control" id="del_id_cargo" name="id" required>
                  	</div>
                </div>
            		<div class="text-center">
	                	<p>ELIMINAR POSICIÓN</p>
	                	<h2 id="del_cargo" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Eliminar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


     