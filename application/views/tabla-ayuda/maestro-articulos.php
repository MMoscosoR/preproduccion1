

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Maestro de articulos activos STARSOFT</h4>
				</div>

		        <div class="box-body">
		        	<div class="table-responsive">
								<a type="button" href="<?php echo base_url() ?>Articulo/exportar" class="btn btn-info btn-md"><i class="fas fa-file-excel"></i> Exportar</a> <br><br>
		        		<table class="table table-bordered table-hover" id="tbl_maestro_articulos">
		        			<thead>
		        				<tr>
		        					<th>#</th>
											<th>Codigo</th>
		        					<th>Descripcion</th>
											<th>Unidad</th>
											<th>Familia</th>
											<th>Ficha Tecnica</th>
		        					
		        				</tr>
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


<div class="modal fade" role="dialog" id="fichatecnica">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
        		<textarea name="name" rows="8" class="form-control" id="txtFicha"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
