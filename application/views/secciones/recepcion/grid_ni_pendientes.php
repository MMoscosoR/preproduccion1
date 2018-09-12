<br>
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Enviado desde Contrato</th>
      <th>Documento</th>
      <th>Comentario</th>
      <th>Usuario</th>
      <th>Transaccion</th>
      <th>Fecha</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($nipendientes as $key): ?>
        <tr>
          <td><?php echo ($key->contrato=='')?'Lima Starsoft':$key->contrato ?></td>
          <td><?php echo $key->seriedocid.str_pad($key->correlativo, 7, "0", STR_PAD_LEFT) ?></td>
          <td><?php echo $key->comentario; ?></td>
          <td><?php echo $key->nombre.' '.$key->apepat; ?></td>
          <td><?php echo $key->transaccion; ?></td>
          <td><?php echo date('d-m-Y',strtotime($key->fecha_registro)); ?></td>
          <td><a href="#" data-id="<?php echo $key->idmovalmcab ?>" class="btn btn-xs btn-primary verdetalle"><i class="glyphicon glyphicon-zoom-in"></i></a> <a target="_blank" href="<?php echo base_url() ?>Htmltopdf/documentospdf/<?php echo $key->idmovalmcab ?>" class="btn btn-xs btn-primary" > <i class="glyphicon glyphicon-print"></i></a></td>
        </tr>
      <?php endforeach; ?>
  </tbody>
</table>
<script type="text/javascript">
  $('table').DataTable();
</script>
