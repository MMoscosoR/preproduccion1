<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Transferencia</h4>
				</div>

		        <div class="box-body">
              <form class="" method="post" id="form_cargainicial">

              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Contrato destino</label>
                    <select class="form-control" name="contrato_destino">
                      <?php foreach ($almacenes as $key): ?>
                        <?php if ($key->estado!=0 and $key->centrocosto!='000000' and $key->contratoid!=$this->session->userdata('alm_id')): ?>
                          <option value="<?php echo $key->contratoid ?>"><?php echo $key->centrocosto.'-'.$key->nombre ?></option>
                        <?php endif; ?>

                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
		        		<div class="col-md-3" id="select-tipo">
		        			<label for="">Seleccionar serie de documento</label>
		        			<select class="form-control" name="nidocid" id="sel_seriedoc">
										<?php foreach ($series as $key): ?>
												<option value="<?php echo $key->serie_doc_id ?>"><?php echo $key->serie_doc_id.'-'.$key->nombre ?></option>
										<?php endforeach; ?>
                  </select>
		        		</div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Transaccion</label>
                      <select class="form-control" name="form_transaccion" id="sel_seriedoc">
    										<?php foreach ($transacciones as $key): ?>
                          <?php if ($key->transaccionid==7): ?>
                            <option value="<?php echo $key->transaccionid ?>"><?php echo $key->nombre ?></option>
                          <?php endif; ?>

    										<?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Fecha tramite</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" id="" name="nifecha" value="<?php echo date('Y-m-d') ?>">
                      </div>

                    </div>
                  </div>

		        	</div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Comentario</label>
                    <textarea name="nicomentario" rows="3"  class="form-control"></textarea>

                  </div>
                </div>
              </div>

            </form>

            <div class="row">
              <div class="col-md-12">
                <button type="button" name="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">Agregar articulo</button>
                <br><br>
                <div class="table-responsive" id="tbl_detalle">

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <button type="button" name="button" class="btn btn-success btn-flat btn-block" id="btn_confirmar_nota">Confirmar transferencia</button>
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
					<select class="form-control select2" style="width: 100%;" id="sel_codigo" name="codigo">
							<option value="">Seleccionar un codigo</option>
                  <?php foreach ($articulos as $key): ?>
                  	<option value="<?php echo $key->articuloid ?>"><?php echo $key->articuloid ?></option>
                  <?php endforeach; ?>
                </select>
								<p class="help-block" id="descripcion_articulo"></p>
        </div>
        <div class="form-group">
          <label for="">Serie</label>
					<select class="form-control select2" style="width: 100%;" id="sel_serie" name="serie">
							<option value="">Seleccionar serie si es el caso</option>

                </select>

        </div>
        <div class="form-group">
          <label for="">Cantidad</label>
          <input type="number" class="form-control" name="cantidad" id="" placeholder="">
					<p class="help-block" id="stock_disponible"></p>
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
