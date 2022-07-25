<!-- Añadir Horas Extra -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Agregar Tiempo Extra</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/tiempoextra/tiempoextra_insertar.php">
          		  <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Cédula de Identidad</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="employee" name="employee" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Fecha</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="date" placeholder="Formato de Fecha: AAAA/MM/DD" required>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="hours" class="col-sm-3 control-label">No. de Horas</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="hours" name="hours">
                  	</div>
                </div>
                 <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Pago por hora</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="rate" name="rate" required>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Guardar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Editar Horas Extra -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="employee_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/tiempoextra/tiempoextra_editar.php">
				<div class="form-group">
                  	<div class="col-sm-9">
                    	<input type="hidden" class="form-control" id="edit_otid" name="id" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Fecha</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="date" required>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="hours_edit" class="col-sm-3 control-label">No. de Horas</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="hours_edit" name="hours">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="rate_edit" class="col-sm-3 control-label">Pago por hora</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="rate_edit" name="rate" required>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Actualizar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Eliminar Horas extra -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="overtime_date"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/tiempoextra/tiempoextra_eliminar.php">
				<div class="form-group">
                  	<div class="col-sm-9">
                    	<input type="hidden" class="form-control" id="del_otid" name="id">
                  	</div>
                </div>
            		<div class="text-center">
	                	<p>Eliminar Tiempo Extra</p>
	                	<h2 class="employee_name bold"></h2>
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


     