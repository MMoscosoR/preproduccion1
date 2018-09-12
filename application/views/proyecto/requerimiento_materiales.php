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
                    <label for="">Solicitante</label>
                    <input type="text" name="nombre" value="<?php echo $this->session->user_nombre.' '.$this->session->user_apepat.' '.$this->session->user_apemat ?> " class="form-control" readonly>
                  </div>
                </div>
		        		<div class="col-md-3" id="select-tipo">
		        			<label for="">Centro de costo</label>
		        			<input type="text" name="centrocosto" value="<?php echo substr($this->session->alm_cc,-4)?>" class="form-control" readonly>
		        		</div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Fecha emision</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" id="" name="nifecha" value="<?php echo date('Y-m-d') ?>" readonly>
                      </div>

                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Fecha entrega</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" id="" name="nifecha" value="<?php echo date('Y-m-d') ?>" >
                      </div>

                    </div>
                  </div>

		        	</div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Glosa</label>
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
