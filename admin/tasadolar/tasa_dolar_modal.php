
<!-- Editar tasa del dolar -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="employee_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="http://localhost/Sistema-MVC/controllers/tasadolar/tasadolar_editar.php">
            		
                <div class="form-group">
                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="hidden" class="form-control" id="attid" name="id">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="datepicker_edit" class="col-sm-3 control-label">Tasa del Dólar</label>

                  	<div class="col-sm-9">
                  		<div class="bootstrap-timepicker">
                    		<input type="text" class="form-control" id="rate_dolar" name="rate_dolar">
                    	</div>
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



     