<br>

<button type="button" class="btn btn-info" id="btn_retroceder"><i class="glyphicon glyphicon-chevron-left"></i>Atras</button>
<br><br>

<h4>Nota de Ingreso: <span id="doc_ingreso"> <?php echo $notaingreso  ?></span> </h4>
<table class="table table-bordered table-hover" id="tbl_detalle">
  <thead>
    <tr>
      <th>Item</th>
      <th>Código</th>
      <th>Descripción</th>
      <th>Serie</th>
      <th>Cantidad Enviada</th>
      <th>Unidad</th>
      <th>Maquina</th>
      <th>Doc. Ref</th>
      <th>Cantidad Recepcionada</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($detalle as $key): ?>
        <tr>
          <td class='item'><?php echo $key->item; ?></td>
          <td class="codigo"><?php echo $key->codigo; ?></td>
          <td class="descripcion"><?php echo $key->descripcion ?></td>
          <td class="serie"><?php echo ($key->serie=="NULL")?"":$key->serie; ?></td>
          <td class="cantidad"><?php echo $key->cantidad ?></td>
          <td class="unidad"><?php echo $key->unidad; ?></td>
          <td class="maquina"><?php echo $key->maquina ?></td>
          <td class="doc_referencia"><?php echo $key->doc_referencia ?></td>
          <td class="cant_recepcionado"><input type="number" value="<?php echo $key->cantidad ?>" min="0" max="<?php echo $key->cantidad ?>"  class="cant_recepcionada form-control" ></td>
        </tr>
      <?php endforeach; ?>
  </tbody>
</table>
<button type="button" class="btn btn-success pull-right" id="confirmar_nota">
  Confirmar Ingreso
</button>
<br><br>
<div class="msg">

</div>
<script type="text/javascript">
  $('#tbl_detalle').DataTable({
    "paging":   false,
    "ordering": false
  });
</script>
