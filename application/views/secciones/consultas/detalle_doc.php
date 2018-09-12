<br>

<button type="button" class="btn btn-info" id="btn_retroceder"><i class="glyphicon glyphicon-chevron-left"></i>Atras</button>
<br><br>

<h4>Documento: <span id="doc_ingreso"> <?php echo $notaingreso  ?></span> </h4>
<table class="table table-bordered table-hover" id="tbl_detalle">
  <thead>
    <tr>
      <th>Item</th>
      <th>Código</th>
      <th>Descripción</th>
      <th>Serie</th>
      <?php if ($tipovista=='diferencia' or $tipovista=='cerrada'): ?>
        <th>Cantidad Enviada</th>
        <th>Cantidad Recepcionada</th>
      <?php endif; ?>
      <?php if ($tipovista=='consulta'): ?>
        <th>Cantidad</th>

      <?php endif; ?>
      <th>Unidad</th>
      <th>Maquina</th>
      <th>Doc. Ref</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($detalle as $key): ?>



          <tr <?php if ($key->cantidad_enviada!=$key->cantidad and $tipovista=='diferencia' ): ?>
                class="warning"
              <?php endif; ?>
            >
            <td class='item'><?php echo $key->item; ?></td>
            <td class="codigo"><?php echo $key->codigo; ?></td>
            <td class="descripcion"><?php echo utf8_decode($key->descripcion) ?></td>
            <td class="serie"><?php echo ($key->serie=="NULL")?"":$key->serie; ?></td>
            <?php if ($tipovista=='diferencia' or $tipovista=='cerrada'): ?>
              <td class="cantidad"><?php echo $key->cantidad_enviada ?></td>
              <td class="cant_recepcionado"><?php echo $key->cantidad ?></td>
            <?php endif; ?>
            <?php if ($tipovista=='consulta'): ?>
              <td class="cant_recepcionado"><?php echo $key->cantidad ?></td>
            <?php endif; ?>

            <td class="unidad"><?php echo $key->unidad; ?></td>
            <td class="maquina"><?php echo $key->maquina ?></td>
            <td class="doc_referencia"><?php echo $key->doc_referencia ?></td>
          </tr>

      <?php endforeach; ?>
  </tbody>
</table>

<?php if ($tipovista=='diferencia'): ?>
  <button type="button" class="btn btn-success pull-right" id="emitir-reporte" data-toggle="modal" data-target="#reporte">
    Emitir reporte
  </button>
<?php endif; ?>

<?php if ($tipovista=='cerrada'): ?>
  <button type="button" class="btn btn-success pull-right" id="mostrar_reporte" data-id="<?php echo $idcabecera ?>">
    Ver reporte
  </button>
<?php endif; ?>

<script type="text/javascript">
  $('#tbl_detalle').DataTable({
    "paging":   false,
    "ordering": false
  });
</script>


<div class="modal fade" id="reporte" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Reporte de diferencia</h4>
      </div>
      <div class="modal-body">
        <form class="" method="post" id="form_reporte" enctype="multipart/form-data">
          <input type="hidden" name="idcabecera" value="<?php echo $idcabecera ?>">

          <div class="form-group">
								<label for="filefotos">Adjuntar evidencias</label>
								<div class="file-loading">
								    <input type="file" id="filevidencia" multiple name="filevicendia[]"   class="file">
								</div>
							</div>

          <div class="form-group">
            <label for="">Detalles de la observacion</label>
            <textarea name="detalle" rows="7"  class="form-control"></textarea>
          </div>
          <div class="form-group">
            <div id="msg">

            </div>
          </div>


        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_registrar_reporte">Registrar reporte</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="detalle-reporte" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Detalle del reporte</h4>
      </div>
      <div class="modal-body">
          <div id="resumen">

          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

      </div>
    </div>
  </div>
</div>



<script>
	$("#filevidencia").fileinput({
    language: 'es',
		showUpload:false,
    uploadAsync: false,
    hideThumbnailContent: false,
		maxFileCount: 5

	});

</script>
