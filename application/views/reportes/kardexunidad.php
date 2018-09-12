<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Kardex por unidades</h4>
				</div>

		        <div class="box-body">
              <form class="" method="post" id="form_consulta">

              <div class="row">

		        		<div class="col-md-3" id="select-tipo">
		        			<label for="">Seleccionar serie de documento</label>
		        			<select class="form-control" name="form_seriedoc" id="sel_seriedoc">
										<?php foreach ($series as $key): ?>
												<option value="<?php echo $key->serie_doc_id ?>"><?php echo $key->serie_doc_id.'-'.$key->nombre ?></option>
										<?php endforeach; ?>
                  </select>
		        		</div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Código de artículo</label>
                      <select class="form-control select2" name="form_codigo" id="sel_codigo">
    										<?php foreach ($articulos as $key): ?>

                            <option value="<?php echo $key->articuloid ?>"><?php echo $key->articuloid ?></option>


    										<?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Serie de Artículo</label>
                      <select class="form-control" name="form_seriearticulo" id="sel_serie">
                            <option value="NULL">.:Seleccionar</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3"><label>Fecha:</label><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right datepicker fecha_guias flat" id="fecha-guia-salida" name="form_periodo"></div></div>


		        	</div>

              <div class="row">
                <div class="col-md-12">
                  <button type="button" name="button" class="btn btn-success btn-flat btn-block" id="btn_consultar">Consultar</button>
                </div>
              </div>

            </form>

            <div id="reporte" class="table-responsive">

            </div>


		        </div>

			</div>
		</div>
	</div>
</section>
