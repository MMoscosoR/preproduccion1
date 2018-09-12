<br>
<table class="table table-bordered table-condensed table-hover">
  <thead>
    <tr>
      <th>FECHA</th>
      <th>PROYECTO</th>
      <th>MES</th>
      <th>CODIGO TRANS</th>
      <th>TIP DOC</th>
      <th>NUM GUIA</th>
      <th>FAMILIA</th>
      <th>COMENTARIO</th>

      <th>CODIGO</th>
      <th>SERIE</th>
      <th>MONEDA</th>
      <th>DESCRIPCIÓN</th>
      <th>CANTIDAD</th>
      <th>PRECIO UNIT</th>
      <th>TOTAL</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($movimientos as $key): ?>
        <tr>
          <td><?php echo date('d-m-Y',strtotime($key->fecha)) ?></td>
          <td><?php echo $key->centrocosto ?></td>
          <td><?php echo date('m',strtotime($key->fecha))  ?></td>
          <td><?php echo $key->codigotrans ?></td>
          <td><?php echo $key->tipo ?></td>
          <td><?php echo $key->seriedocid.str_pad($key->correlativo, 7, "0", STR_PAD_LEFT) ?></td>
          <td><?php echo $key->familia ?></td>
          <td><?php echo $key->comentario ?></td>

          <td><?php echo $key->codigo ?></td>
          <td><?php echo ($key->serie=='NULL')?'':$key->serie ?></td>
          <td><?php echo $key->descripcion ?></td>
          <td>MN</td>
          <td><?php echo ($key->tipo=='NI')?$key->cantidad:$key->cantidad*-1 ?></td>
          <td><?php echo $key->costo ?></td>
          <td><?php echo ($key->tipo=='NI')?$key->cantidad*$key->costo :$key->cantidad*$key->costo*-1 ?></td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>
