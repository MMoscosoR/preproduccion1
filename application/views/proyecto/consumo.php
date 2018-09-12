<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Consumo</h4>
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
                <div class="col-md-4">
                  <label for="">&nbsp;</label><br>
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Agregar articulo</button>
                </div>


		        	</div>

            </form>
						<br><br>
							<div class="row">
							  <div class="col-md-12">
										<div id="relacion_consumo" class="table-responsive">

										</div>






							  </div>
							</div>
							<div class="row" id="divenvio">
								<div class="col-md-12">
							  <button type="button" name="button" id="btn_preenvio" class="btn btn-info" data-target="#modal_resumen" data-toggle="modal">Crear consumo</button>
								</div>
							</div>
		        </div>

			</div>
		</div>
	</div>
</section>


<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo articulo</h4>
      </div>

      <div class="modal-body">
        <form id="form_carga_manual" method="post">
        <div class="form-group">
          <label for="">Codigo</label>
					<select class="form-control select2 sel_codigo" style="width: 100%;" id="sel_codigo" name="codigo">
							<option value="">Seleccionar un codigo</option>
                  <?php foreach ($codigos as $key): ?>
                  	<option value="<?php echo $key->articuloid ?>"><?php echo $key->articuloid.' - '.$key->descripcion ?></option>
                  <?php endforeach; ?>
                </select>
						<p class="help-block" id="descripcion_articulo"></p>
        </div>



        <div class="form-group">
          <label for="">Serie</label>
					<select class="form-control select2 sel_codigo" style="width: 100%;" id="sel_serie" name="serie">
							<option value="">Seleccionar serie si es el caso</option>

                </select>

        </div>
        <div class="form-group">
          <label for="">Cantidad</label>
          <input type="number" class="form-control" name="cantidad" id="" placeholder="">
					<p class="help-block" id="stock_disponible"></p>
        </div>

				<div class="form-group">
          <label for="">Maquina</label>
					<select class="form-control select2" name="maquina" id="sel_maquina" style="width: 100%;">
						<option value="">.:Selección opcional</option>
						<?php foreach ($maquinas as $key): ?>
								<option value="<?php echo $key->descripcion ?>"><?php echo $key->descripcion ?></option>
						<?php endforeach; ?>
					</select>


        </div>
				<div class="form-group">
          <label for="">Solicitante</label>
					<select class="form-control select2" name="solicitante" id="sel_solicitante" style="width: 100%;">
						<option value="">.:Selección opcional</option>
						<?php foreach ($solicitantes as $key): ?>
								<option value="<?php echo $key->idsolicitante ?>"><?php echo $key->fullname ?></option>
						<?php endforeach; ?>
					</select>


        </div>
				<div class="form-group">
          <label for="">Area solicitante</label>
					<select class="form-control select2" name="areacencos" id="sel_solicitante" style="width: 100%;">
						<option value="">.:Selección opcional</option>
						<?php foreach ($areas as $key): ?>
								<option value="<?php echo $key->idcentrocosto ?>"><?php echo $key->descripcion ?></option>
						<?php endforeach; ?>
					</select>


        </div>


        <div class="form-group">
          <label for="">Documento referencia</label>
          <input type="text" class="form-control" name="doc_ref" placeholder="">

        </div>

        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_agregar_codigo">Agregar</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="confirmar-consumo"  role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id=""></h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>

<!-- modal confirmacion -->
<div class="modal fade" role="dialog" aria-labelledby="myModalLabel" id="modal_resumen">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Salida por consumo</h4>
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
								<label for="">Correlativo</label>
									<input type="text" name="form_correlativo" value="" class="form-control" id="form_numdoc" readonly>
									<input type="hidden" name="nicorrelativo" value="" id="form_correlativo">
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
								<label for="">Transacción</label>
								<select  name="form_transaccion" class="form-control" id="form_transaccion">
									  <option value="1">SCS-Consumo</option>

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
<!-- fin -->
