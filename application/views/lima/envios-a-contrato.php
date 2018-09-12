<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Envios a contrato</h4>

				</div>

		        <div class="box-body">
		        	<div class="row">
		        		<div class="col-md-4" id="select-tipo">
		        			<label for="">Seleccionar el tipo de envio: </label>
		        			<select name="lima-tipo-envio" id="lima-tipo-envio" class="form-control">
		        				<option value="">.:Seleccionar</option>
		        				<?php foreach ($series as $key): ?>
		        						<option value="<?php echo $key->serie_doc_id ?>"><?php echo $key->serie_doc_id.'-'.$key->nombre ?></option>
		        				<?php endforeach; ?>
		        			</select>
		        		</div>
		        		<div class="col-md-4" id="formulario_carga">

		        		</div>
                <div class="col-md-4" id="guiassalida">

		        		</div>
		        	</div>
		        	<br>
		        	<div class="row">
								<div class="col-md-12" id="detalle-carga">

								</div>
		        	</div>

							<div class="row" id="divenvio">
								<div class="col-md-12">
							  <button type="button" name="button" id="btn_preenvio" class="btn btn-info">Enviar a contrato</button>
								</div>
							</div>

		        </div>

			</div>
		</div>
	</div>
</section>
<input type="hidden"  value="<?php echo "14"; ?>" id="almacen_salida">

<div class="modal fade" role="dialog" aria-labelledby="myModalLabel" id="modal_resumen">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Los productos serán enviados a contrato, en espera de la recepción</h4>
      </div>
      <div class="modal-body">
				<div class="panel panel-default" id="modal_body">


	      </div>
			</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_confirmar_nota">Confirmar</button>
      </div>
</div>
</div>
</div>
<!--modal carga de excel-->

<div class="modal fade" id="cargardesdeexcel"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cargar excel <a href="<?php echo base_url();?>assets/files/plantilla_de_carga_NI.xlsx" class="btn btn-info btn-xs"><i class="far fa-file-excel"></i>Plantilla</a></h4>
      </div>
      <div class="modal-body">
				<div class="modal-body">
						<form  method="post" enctype="multipart/form-data" id=form_envio_excel>
						<div class="form-group">
						  <label for="">Excel</label>
						  <input type="file" class="form-control" id="excel" name="excelfile" accept=".xls, .xlsx">
						  <p class="help-block">Acomodar la información en la plantilla.</p>
						</div>
						</form>
	      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_cargaexcel">Cargar códigos</button>
      </div>
    </div>
  </div>
</div>

<!-- Carga manual-->

<div class="modal fade" id="cargamanual"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cargar manual</h4>
      </div>
				<div class="modal-body">
					<form id="form_carga_manual" method="post">
					<div class="form-group">
					  <label for="">Codigo</label>
					  <input type="text" class="form-control" name="codigo" placeholder="Codigo de articulo">
					</div>
					<div class="form-group">
					  <label for="">Serie</label>
					  <input type="text" class="form-control" name="serie" placeholder="Dejar en blanco en caso no tenga serie">

					</div>
					<div class="form-group">
					  <label for="">Cantidad</label>
					  <input type="number" class="form-control" name="cantidad" id="" placeholder="">
					</div>

					<div class="form-group">
					  <label for="">Maquina</label>
					  <input type="text" class="form-control" name="maquina" id="" placeholder="">

					</div>
					<div class="form-group">
					  <label for="">Documento referencia</label>
					  <input type="text" class="form-control" name="doc_ref" placeholder="">

					</div>

					</form>
				</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_agregar_manual">Cargar artículo</button>
      </div>
    </div>
  </div>
</div>
