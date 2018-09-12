<table class="table table-bordered table-condensed table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Descripcion</th>
      <th>Codigo</th>
      <th>Serie</th>
      <th>Cantidad</th>
      <th>Cantidad Disponible</th>

      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; ?>
    <?php if ($detalle!=0): ?>


    <?php foreach ($detalle as $key): ?>
      <tr class="<?php if ($key['stockactual']-$key['cantidad']<0): ?>
                danger
      <?php endif; ?>">
        <td><?php echo $i ?></td>
        <td><?php echo $key['descripcion'] ?></td>
        <td><?php echo $key['codigo'] ?></td>
        <td><?php echo $key['serie'] ?></td>
        <td><?php echo $key['cantidad'] ?></td>
        <td><?php echo $key['stockactual'] ?></td>

        <td><a href="#" data-id="<?php echo $key['item'] ?>" class="alert-link eliminar btn btn-danger btn-xs">Eliminar</a></td>
      </tr>
      <?php $i++; ?>
    <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>
