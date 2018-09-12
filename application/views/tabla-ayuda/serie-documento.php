<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Series de Documentos</h4>
				</div>

		        <div class="box-body">
							<button type="button" name="button" class="btn btn-info push-right" data-toggle="modal" data-target="#modal_solicitud">Solicitar nueva serie</button> <br>
							<br>
							<div class="table-responsive">
		        		<table class="table table-bordered table-hover" id="tbl_seriedocs">
		        			<thead>
		        				<tr>
		        					<th>#</th>
		        					<th>Serie</th>
		        					<th>Descripcion</th>
		        				</tr>
		        			</thead>
		        			<tbody>
											<?php $i=1;  foreach ($series as $key) { ?>
													<tr>
														<td><?php echo $i ?></td>
														<td><?php echo $key->serie_doc_id ?></td>
														<td><?php echo $key->nombre ?></td>
													</tr>
											<?php $i++;	} ?>
		        			</tbody>
		        		</table>
		        	</div>
		        </div>

			</div>
		</div>
	</div>
</section>

<div class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_solicitud">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
			<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Formulario de solicitud para la creacion de nueva serie</h4>
      </div>
      <div class="modal-body">
				<div class="form-group">
					<label for="txtLugar">Detalle la solicitud(*):</label>
		            <textarea name="descripcion" id="txtDescripcion" class="form-control" rows="3"></textarea>
				</div>
				<div class="form-group">
					<div id="msg"></div>
				</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_enviar">Enviar</button>
      </div>
    </div>
  </div>
</div>
