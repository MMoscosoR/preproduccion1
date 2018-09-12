<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Correlativos de documentos</h4>
				</div>

		        <div class="box-body">

							<div class="table-responsive">
		        		<table class="table table-bordered table-hover" id="tbl_correlativos">
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

<div class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel" id="editar_modal">
  <div class="modal-dialog modal-sm" role="document">
		<form method="post" id="form_correlativo">
    <div class="modal-content">
			<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
				<div class="form-group">
					<div id="msg"></div>
				</div>
				<input type="hidden" name="txtSeriedoc" id="txtSeriedoc">
				<input type="hidden" name="txtTipo" id="txtTipo">

        <div class="form-group">
        	<label for="">Correlativo:</label>
					<input type="text" name="correlativo" value="" class="form-control" id="correlativo">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_submit">Guardar</button>
      </div>
    </div>
		</form>
  </div>
</div>
