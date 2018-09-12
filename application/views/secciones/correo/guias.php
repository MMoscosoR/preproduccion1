


<table>
  <thead>
    <tr>
      <td><b>Guia de referencia Starsoft:</b></td>
      <td><?php echo $cabecera->comentario ?></td>
    </tr>
    <tr>
      <td><b>Documento generado:</b></td>
      <td><?php echo $cabecera->tipo.' - '.$cabecera->seriedocid.str_pad($cabecera->correlativo, 7, "0", STR_PAD_LEFT) ?></td>
    </tr>
    <tr>
      <td><b>Fecha del consumo:</b></td>
      <td><?php echo date('d-m-Y',strtotime($cabecera->fecha)); ?></td>
    </tr>
  </thead>
</table>

<table style="border-collapse: collapse;border: 1px solid black;">
  <thead>
    <tr>
      <th style="border: 1px solid black;">Item</th>
      <th style="border: 1px solid black;">Codigo</th>
      <th style="border: 1px solid black;">Descripción</th>
      <th style="border: 1px solid black;">Serie</th>
      <th style="border: 1px solid black;">Cantidad</th>
      <th style="border: 1px solid black;">Unidad</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($detalle as $key): ?>
      <tr>
        <td style="border: 1px solid black;"><?php echo $key->item ?></td>
        <td style="border: 1px solid black;"><?php echo $key->codigo ?></td>
        <td style="border: 1px solid black;"><?php echo $key->descripcion ?></td>
        <td style="border: 1px solid black;"><?php echo ($key->serie=='NULL')?'':$key->serie ?></td>
        <td style="border: 1px solid black;"><?php echo $key->cantidad ?></td>
        <td style="border: 1px solid black;"><?php echo $key->unidad ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
