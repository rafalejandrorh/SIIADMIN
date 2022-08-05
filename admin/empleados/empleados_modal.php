
<!-- AÑADIR -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Agregar Empleado</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/empleados/empleados_insertar.php" enctype="multipart/form-data">
              <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Cédula de Identidad</label>

                    <div class="col-sm-9">
                    <input type="text" class="form-control" name="cedula">
                    </div>
                </div>

          		  <div class="form-group">
                  	<label for="nombres" class="col-sm-3 control-label">Nombre</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="nombres" name="nombres" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="apellidos" class="col-sm-3 control-label">Apellido</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="apellidos" name="apellidos" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="direccion" class="col-sm-3 control-label">Dirección</label>

                  	<div class="col-sm-9">
                      <textarea class="form-control" name="direccion" id="direccion"></textarea>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="fecha_nacimiento" class="col-sm-3 control-label">Fecha de Nacimiento</label>

                  	<div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="fecha_nacimiento" placeholder="Formato de Fecha: AAAA/MM/DD" name="fecha_nacimiento">
                      </div>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="numero_contacto" class="col-sm-3 control-label">Información de Contacto</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="numero_contacto" name="numero_contacto">
                    </div>
                </div>
                <div class="form-group">
                    <label for="genero" class="col-sm-3 control-label">Género</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="genero" id="genero" required>
                        <option value="" selected>- Seleccionar -</option>
                        <option value="Masculino">Hombre</option>
                        <option value="Femenino">Mujer</option>
                      </select>
                    </div>
                  </div>
                <div class="form-group">
                  <label for="cargo" class="col-sm-3 control-label">Cargo</label>

                  <div class="col-sm-9">
                    <select class="form-control" name="cargo" id="cargo" required>
                      <option value="" selected>- Seleccionar -</option>
                      <?php
                          foreach($cargos as $qrow)
                          {
                            echo "
                              <option value='".$qrow['id_cargo']."'>".$qrow['cargo']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="horario" class="col-sm-3 control-label">Horario</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="horario" name="horario" required>
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          foreach($horarios as $rrow)
                          {
                            echo "
                              <option value='".$rrow['id_horarios']."'>".$rrow['hora_llegada'].' - '.$rrow['hora_salida']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="foto" class="col-sm-3 control-label">Foto</label>

                    <div class="col-sm-9">
                      <input type="file" name="foto" id="foto">
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

<!-- MOSTRAR -->
<div class="modal fade" id="show">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="employee_id"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/empleados/empleados_editar.php">     		

                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Cédula</label>
                    <div class="col-sm-9">                    
                    <input type="text" class="form-control" id="show_id" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Nombre</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="show_nombres" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Apellido</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="show_apellidos"  readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_address" class="col-sm-3 control-label">Dirección</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="show_direccion" readonly></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Fecha de Nacimiento</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="show_fecha_nacimiento" readonly>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_contact" class="col-sm-3 control-label">Información de Contacto</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="show_contacto" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_gender" class="col-sm-3 control-label">Género</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="show_genero" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_position" class="col-sm-3 control-label">Cargo</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="show_cargo" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_schedule" class="col-sm-3 control-label">Horario</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="show_horario" readonly>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
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
            	<h4 class="modal-title"><b><span class="employee_id"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="../../controllers/empleados/empleados_editar.php">     		

                <div class="form-group">
                    <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="id_empleado" id="edit_id_empleado">
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Cédula</label>
                    <div class="col-sm-9">                    
                    <input type="text" class="form-control" name="cedula" id="edit_cedula">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Nombre</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_nombres" name="nombres">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Apellido</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_apellidos" name="apellidos">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_address" class="col-sm-3 control-label">Dirección</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="direccion" id="edit_direccion"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Fecha de Nacimiento</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="fecha_nacimiento_edit" name="fecha_nacimiento">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_contact" class="col-sm-3 control-label">Información de Contacto</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_contacto" name="numero_contacto">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_genero" class="col-sm-3 control-label">Género</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="genero" id="edit_genero">
                        <option selected id="gender_val"></option>
                        <option value="Masculino">Hombre</option>
                        <option value="Femenino">Mujer</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_cargo" class="col-sm-3 control-label">Cargo</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="cargo" id="">
                        <option selected id="edit_cargo"></option>
                        <?php
      
                          foreach($cargos as $prow)
                          {
                            echo "
                              <option value='".$prow['id_cargo']."'>".$prow['cargo']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_horario" class="col-sm-3 control-label">Horario</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="" name="horario">
                        <option selected id="edit_horario"></option>
                        <?php
      
                          foreach($horarios as $srow)
                          {
                            echo "
                              <option value='".$srow['id_horarios']."'>".$srow['hora_llegada'].' - '.$srow['hora_salida']."</option>
                            ";
                          }
                        ?>
                      </select>
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
            	<form class="form-horizontal" method="POST" action="../../controllers/empleados/empleados_eliminar.php">
            	
              <div class="form-group">
                    <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="id_empleado" id="del_id_empleado">
                    </div>
                </div>

            		<div class="text-center">
	                	<p>ELIMINAR EMPLEADO</p>
	                	<h2 class="bold del_employee_name" id="del_employee_name"></h2>
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

<!-- ACTUALIZAR FOTO -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="del_employee_name"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../../controllers/empleados/empleados_editar_foto.php" enctype="multipart/form-data">
              <div class="form-group">
                    <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="id_empleado" id="foto_id_empleado">
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Foto</label>
                    <div class="col-sm-9">
                      <input type="file" id="edit_foto" name="foto" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
              <button type="submit" class="btn btn-success btn-flat" name="subir"><i class="fa fa-check-square-o"></i> Actualizar</button>
              </form>
            </div>
        </div>
    </div>
</div>    