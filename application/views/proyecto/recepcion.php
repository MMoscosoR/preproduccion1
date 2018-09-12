<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Recepcion de Ingresos</h4>
				</div>

		        <div class="box-body">
              <form class="" method="post" id="form_cargainicial">
              <div class="row">
		        		<div class="col-md-4" id="select-tipo">
		        			<label for="">Seleccionar serie de documento</label>
		        			<select class="form-control" name="sel_seriedoc" id="sel_seriedoc">
										<?php foreach ($series as $key): ?>
												<option value="<?php echo $key->serie_doc_id ?>"><?php echo $key->serie_doc_id.'-'.$key->nombre ?></option>
										<?php endforeach; ?>
                  </select>
		        		</div>


		        	</div>

            </form>
							<div class="row">
							  <div class="col-md-12">
										<div id="pendientes_por_aprobar">

										</div>






							  </div>
							</div>
		        </div>

			</div>
		</div>
	</div>
</section>

<div class="modal fade" role="dialog" aria-labelledby="myModalLabel" id="modal_resumen">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nota de Ingreso</h4>
      </div>
      <div class="modal-body">

				<form method="post" id="registro_carga_form">
					<input type="hidden" name="nguiasalida" value="">
				<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								<label for="">Proyecto</label>
								<input type="text" value="<?php echo $this->session->userdata('alm_nombre'); ?>" readonly="" class="form-control">
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
								<label for="">serie</label>
									<select class="form-control" name="nidocid" id="form_seriedoc" >
											<option value="">.:Seleccionar serie de documento</option>
											<option value="027">027</option>
											<option value="022">022</option>
											<option value="000">000</option>
									</select>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
								<label for="">Correlativo</label>
									<input type="text" name="form_correlativo" value="" class="form-control" id="form_numdoc" readonly>
									<input type="hidden" name="nicorrelativo" value="" id="form_correlativo">
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
								<label for="">Transacción</label>
								<select  name="form_transaccion" class="form-control" id="form_transaccion">
									  <option value="">.:Seleccionar transacciones</option>

								</select>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
								<label for="">Comentario</label>
								<input type="text" value=""  class="form-control" name="nicomentario">
								</div>
							</div>
						</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
							<label for="">Fecha</label>
							<input type="date" value="<?php echo date('Y-m-d') ?>" name="nifecha" class="form-control">
							</div>
						</div>
						<div class="col-md-12" id="msg">

						</div>
					</div>
				</div>
				</form>
			</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_confirmar_nota">Confirmar</button>
      </div>
</div>
</div>
</div>
