<!-- Añadir Avance de Efectivo -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Agregar Adelanto de Efectivo</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="http://localhost/Sistema-MVC/controllers/avancefectivo/avancefectivo_insertar.php">
          		  <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Cédula de Identidad</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="employee" name="employee" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="amount" class="col-sm-3 control-label">Monto</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="amount" name="amount" required>
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

<!-- Editar Avance de Efectivo -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="date"></span> - <span class="employee_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="http://localhost/Sistema-MVC/controllers/avancefectivo/avancefectivo_editar.php">

				<div class="form-group">
                    <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="id" id="caid">
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit_amount" class="col-sm-3 control-label">Monto</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_amount" name="amount" required>
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

<!-- Eliminar Avance de Efectivo -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="date"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="http://localhost/Sistema-MVC/controllers/avancefectivo/avancefectivo_eliminar.php">
				<div class="form-group">
                    <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="id" id="del_caid">
                    </div>
                </div>
            		<div class="text-center">
	                	<p>Eliminar Adelanto de Efectivo</p>
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


     