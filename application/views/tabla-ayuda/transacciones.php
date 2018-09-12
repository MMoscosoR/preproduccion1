<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Transacciones</h4>
				</div>

		        <div class="box-body">

							<div class="table-responsive">
		        		<table class="table table-bordered table-hover" id="tbl_transacciones">
		        			<thead>

		        			</thead>
		        			<tbody>

		        			</tbody>
		        		</table>
		        	</div>
		        </div>

			</div>
		</div>
	</div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="modal_transaccion">
  <div class="modal-dialog" role="document">

    <div class="modal-content">
			<form method="post" id="form_transaccion">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
			<input type="hidden" name="txtIdtransac" id="txtIdtransac">
			<input type="hidden" name="accion" id="accion">
      <div class="modal-body">
        <div class="form-group">
        	<label for="">Código</label>
					<input type="text" name="txtCodigo" id="txtCodigo" class="form-control">
        </div>
				<div class="form-group">
        	<label for="">Descripción</label>
					<input type="text" name="txtDescripcion" id="txtDescripcion" class="form-control">
        </div>
				<div class="form-group">
        	<label for="">Tipo</label>
					<select class="form-control" name="sel_tipo" id="sel_tipo">
						<option value="Ingreso">Ingreso</option>
						<option value="Salida">Salida</option>
						<option value="Transferencia">Transferencia</option>
					</select>
        </div>


				<div class="form-group">
        	<label for="">Estado:</label>
					<input type="checkbox" name="estado"  data-toggle="toggle" data-size="normal" id="estado">
        </div>

				<div class="form-group">
					<div class="msg">

					</div>
				</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_submit">Guardar</button>
      </div>
			</form>
    </div> <!-- /.modal-content -->

  </div><!-- /.modal-dialog -->
</div>
