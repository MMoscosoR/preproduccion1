

  <section class="content">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="box box-primary">
  				<div class="box-header with-border">
  					<h4>Reporte de salida para el SIG</h4>
  				</div>

  		        <div class="box-body">
                <!--
                <div class="row">
                    <div class="col-md-4">
          						<label>Fecha:</label>
          						<div class="input-group date">
          						<div class="input-group-addon">
          						<i class="fa fa-calendar"></i>
          						</div>
          						 <input type="text" class="form-control pull-right datepicker flat form_consumo" id="periodo" >
          						 </div>
          				</div>

                </div>
                 -->
                <br>
                  <div class="row">
                      <div class="col-md-12 table-responsive" id="tbl_reporte">

                        <table class="table-bordered table table-condensed">
                          <thead>
                            <tr>
                              <th>#Doc Salida</th>
                              <th>Fecha</th>
                              <th>Cliente</th>
                              <th>RUC</th>
                              <th>Usuario</th>
                              <th>DNI</th>
                              <th>Comentario</th>
                              <th>Doc Referencia</th>
                              <th>Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($reportessig as $key): ?>
                                <tr>
                                  <td><?php echo $key->n_salida ?></td>
                                  <td><?php echo $key->fecha_doc ?></td>
                                  <td><?php echo $key->cliente ?></td>
                                  <td><?php echo $key->ruc ?></td>
                                  <td><?php echo $key->usuario ?></td>
                                  <td><?php echo $key->dni ?></td>
                                  <td><?php echo $key->comentario ?></td>
                                  <td><?php echo $key->doc_ref ?></td>
                                  <td>
                                    <a href="<?php echo base_url() ?>Reporte/generar_reporte_sig/<?php echo $key->idreportesig ?>" target="_blank" class="btn btn-xs btn-primary">Imprimir</a>
                                    <a href="#" data-id="<?php echo $key->idreportesig ?>" data-codigo="<?php echo $key->n_salida ?>" class=" btn btn-danger btn-xs btn_eliminar">Eliminar</a>
                                  </td>
                                </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>

                  </div>

  		        </div>

  			</div>
  		</div>
  	</div>
  </section>
