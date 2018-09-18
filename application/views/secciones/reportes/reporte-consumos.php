<table class="table table-bordered table-condensed table-hover" id="relacion_reporte">
  <thead>
    <tr>
      <th>Documento</th>
      <th>Codigo</th>
      <th>Descripcion</th>
      <th>Serie</th>
      <th>Cantidad</th>
      <th>Unidad</th>
      <th>Transaccion</th>
      <th>Fecha</th>


    </tr>
  </thead>
  <tbody>
    <?php foreach ($consumos as $key): ?>
        <tr>
          <td><?php echo $key->seriedocid.str_pad($key->correlativo, 7, "0", STR_PAD_LEFT) ?></td>
          <td><?php echo $key->codigo ?></td>
          <td><?php echo utf8_decode($key->descripcion); ?></td>
          <td><?php echo ($key->serie=='NULL')?'':$key->serie ?></td>
          <td><?php echo $key->cantidad ?></td>

          <td><?php echo $key->unidad ?></td>

          <td><?php echo $key->nombre; ?></td>
          <td><?php echo date('d-m-Y',strtotime($key->fecha)); ?></td>




        </tr>
    <?php endforeach; ?>
  </tbody>
</table>
