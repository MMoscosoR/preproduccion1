<table class="table table-bordered table-condensed table-hover">
  <thead>
    <th>#</th>
    <th>Descripcion</th>
    <th>Codigo</th>
    <th>Serie</th>
    <th>Cantidad</th>
    <th>Unidad</th>
  </thead>
  <tbody>
      <?php foreach ($detalles as $key): ?>

        <tr>
          <td><?php echo $key['item']; ?></td>
          <td><?php echo $key['descripcion']; ?></td>
          <td><?php echo $key['codigo']; ?></td>
          <td><?php echo $key['serie']; ?></td>
          <td><?php echo $key['cantidad']; ?></td>
          <td><?php echo $key['unidad']; ?></td>
        </tr>
      <?php endforeach; ?>
  </tbody>
</table>
