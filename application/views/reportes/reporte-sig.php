
  <style media="screen">
  .input-group { width: 100%; }
  .input-group-addon {
  width:25%;
  text-align:left;
    }


  </style>

  <section class="content">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="box box-primary">
  				<div class="box-header with-border">
  					<h4>Reporte de consumo SIG</h4>
  				</div>

  		        <div class="box-body">
                <form id="form_reportesig" method="post">
                <div class="row">

                  <div class="col-md-6">
          						<div class="input-group form-group">
                        <label class="input-group-addon">ALMACEN</label>
                        <input type="text" class="form-control" placeholder="" value="<?php echo 'CTR '.strtoupper($this->session->userdata('alm_nombre')); ?>" name="sig_almacen" required>

                      </div>
          				</div>
                  <div class="col-md-6">
                    <div class="input-group form-group">
                      <label class="input-group-addon"># NOTA DE SALIDA</label>
                      <input type="text" class="form-control" placeholder="" name="sig_ns" required>

                    </div>
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-6">
          						<div class="input-group form-group">
                        <label class="input-group-addon">FECHA DOC</label>
                        <input type="text" class="form-control" placeholder="" name="sig_fecha" value="<?php echo date('d-m-Y') ?>" required>

                      </div>
          				</div>
                  <div class="col-md-6">
                    <div class="input-group form-group">
                      <label class="input-group-addon">TRANSACCION</label>
                      <input type="text" class="form-control" placeholder="" name="sig_transaccion" value="SALIDA A OBRA POR CONSUMO" required>

                    </div>
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-6">
          						<div class="input-group form-group">
                        <label class="input-group-addon">CLIENTE</label>
                        <input type="text" class="form-control" placeholder="" name="sig_cliente" required>

                      </div>
          				</div>
                  <div class="col-md-6">
                    <div class="input-group form-group">
                      <label class="input-group-addon">RUC</label>
                      <input type="text" class="form-control" placeholder="" name="sig_ruc" value="20469962246" required>

                    </div>
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-6">
          						<div class="input-group form-group">
                        <label class="input-group-addon">USUARIO</label>
                        <input type="text" class="form-control" placeholder="" name="sig_usuario" value="<?php echo $this->session->user_nombre.' '.$this->session->user_apepat.' '.$this->session->user_apemat; ?>" required >

                      </div>
          				</div>
                  <div class="col-md-6">
                    <div class="input-group form-group">
                      <label class="input-group-addon">DNI</label>
                      <input type="text" class="form-control" placeholder="" name="sig_dni" value="<?php echo $this->session->user_dni ?>" required>

                    </div>
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-6">
          						<div class="input-group form-group">
                        <label class="input-group-addon">COMENTARIO</label>
                        <input type="text" class="form-control" placeholder="" name="sig_comentario" required>

                      </div>
          				</div>
                  <div class="col-md-6">
                    <div class="input-group form-group">
                      <label class="input-group-addon">#DOC. REF</label>
                      <input type="text" class="form-control" placeholder="" name="sig_docref" id="txt_docref" required readonly>

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                  <div class="input-group form-group">
                    <span class="input-group-addon">Vales</span>
                    <select class="form-control select2" name="" id="sel_vales">
                        <option value="">.:Sleccionar vale</option>
                        <?php foreach ($vales as $key): ?>
                            <option value="<?php echo $key->doc_referencia ?>"><?php echo $key->doc_referencia ?></option>
                        <?php endforeach; ?>
                    </select>

                  </div>
                  </div>
                  <div class="col-md-3">
                    <div class="input-group form-group">
                      <button type="button" name="button" class="btn btn-flat btn-success pull-right" id="btn_importar">Importar vale</button>

                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group form-group">
                      <button type="button" name="button" class="btn btn-flat btn-danger pull-right" id="btn_borrar">Borrar carga</button>

                    </div>
                  </div>
                </div>

                  <div class="row">
                      <div class="col-md-12 table-responsive" id="tbl_reporte">
                            <table class="table table-condensed table-bordered" id="tbl_detalle">
                              <thead>
                                <tr>
                                  <th>ITEM</th>
                                  <th>CODIGO</th>
                                  <th>DESCRIPCION</th>
                                  <th>UNIDAD</th>
                                  <th>SERIE</th>
                                  <th>CANTIDAD</th>
                                  <th>MAQUINA</th>
                                  <th>GUIA</th>
                                </tr>
                              </thead>
                              <tbody>

                              </tbody>
                            </table>
                      </div>

                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-success btn-flat pull-right" id="btn_guardar">Guardar documento</button>
                    </div>
                  </div>
                </form>
  		        </div>
          <!-- din de body -->
  			</div>
  		</div>
  	</div>
  </section>
