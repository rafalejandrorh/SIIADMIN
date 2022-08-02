<!-- Añadir deducciones -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Agregar Deducciones</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/deducciones/deducciones_insertar.php">
          		  <div class="form-group">
                  	<label for="descripcion" class="col-sm-3 control-label">Descripción</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="descripcion" name="descripcion" required>
						<input type="hidden" name="tabla" value="deducciones">
                  	</div>
                </div>
                <div class="form-group">
                    <label for="monto" class="col-sm-3 control-label">Monto</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="monto" name="monto" required>
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

<!-- Añadir deducciones 2-->
<div class="modal fade" id="addnew2">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Agregar Deducciones</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/deducciones/deducciones_insertar.php">
          		  <div class="form-group">
                  	<label for="descripcion" class="col-sm-3 control-label">Descripción</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="descripcion" name="descripcion" required>
						<input type="hidden" name="tabla" value="deducciones2">
                  	</div>
                </div>
                <div class="form-group">
                    <label for="monto" class="col-sm-3 control-label">Monto</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="monto" name="monto" required>
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

<!-- Editar deducciones -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Actualizar Deducción</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/deducciones/deducciones_editar.php">
				<div class="form-group">
                  	<div class="col-sm-9">
                    	<input type="hidden" class="form-control" id="edit_decid" name="id" required>
						<input type="hidden" name="tabla" value="deducciones">
                  	</div>
                </div>
                <div class="form-group">
                    <label for="edit_descripcion" class="col-sm-3 control-label">Descripción</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_descripcion" name="descripcion">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_monto" class="col-sm-3 control-label">Monto</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_monto" name="monto">
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

<!-- Editar deducciones 2-->
<div class="modal fade" id="edit2">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Actualizar Deducción</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/deducciones/deducciones_editar.php">
				<div class="form-group">
                  	<div class="col-sm-9">
                    	<input type="hidden" class="form-control" id="edit_decid2" name="id" required>
						<input type="hidden" name="tabla" value="deducciones2">
                  	</div>
                </div>
                <div class="form-group">
                    <label for="edit_descripcion" class="col-sm-3 control-label">Descripción</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_descripcion2" name="descripcion">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_monto" class="col-sm-3 control-label">Monto</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_monto2" name="monto">
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

<!-- eliminar deducciones -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Eliminando...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/deducciones/deducciones_eliminar.php">
				<div class="form-group">
                  	<div class="col-sm-9">
                    	<input type="hidden" class="form-control" id="del_decid" name="id" required>
						<input type="hidden" name="tabla" value="deducciones">
                  	</div>
                </div>
            		<div class="text-center">
	                	<p>Eliminar Deducción</p>
	                	<h2 id="del_deduction" class="bold"></h2>
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

<!-- eliminar deducciones 2 -->
<div class="modal fade" id="delete2">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Eliminando...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/deducciones/deducciones_eliminar.php">
				<div class="form-group">
                  	<div class="col-sm-9">
                    	<input type="hidden" class="form-control" id="del_decid2" name="id" required>
						<input type="hidden" name="tabla" value="deducciones2">
                  	</div>
                </div>
            		<div class="text-center">
	                	<p>Eliminar Deducción</p>
	                	<h2 id="del_deduction2" class="bold"></h2>
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
     