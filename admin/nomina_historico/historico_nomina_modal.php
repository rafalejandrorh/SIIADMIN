
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
                    <label for="edit_firstname" class="col-sm-3 control-label">Fecha de Emisión</label>
                    <div class="col-sm-9">                    
                    <input type="text" class="form-control" id="show_fecha_emision" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Cédula</label>
                    <div class="col-sm-9">                    
                    <input type="text" class="form-control" id="show_cedula" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Nombre Completo</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="show_nombres" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Sueldo</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="show_sueldo" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_address" class="col-sm-3 control-label">Deducciones de Ley</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="show_deducciones_ley" readonly></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Avance de Efectivo</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="show_avance_efectivo" readonly>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Total Deducciones</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="show_total_deducciones" readonly>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_contact" class="col-sm-3 control-label">Tasa del Dólar</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="show_tasa_dolar" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_gender" class="col-sm-3 control-label">Sueldo Neto en Dólares</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="show_sueldo_neto" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_position" class="col-sm-3 control-label">Sueldo Neto en Bolivares</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="show_sueldo_bolivares" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_schedule" class="col-sm-3 control-label">Fecha de Nómina</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="show_fecha_nomina" readonly>
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