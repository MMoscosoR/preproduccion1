<table class="table table-bordered table-condensed table-hover">
  <thead>
    <tr>
      <th>Codigo</th>
      <th>Descripcion</th>
      <th>Und</th>
      <th>Fam</th>
      <th>Serie</th>
      <th>Cantidad</th>
      <?php if ($this->session->acceso_submenu_26==1): ?>
        <th>Costo</th>
      <?php endif; ?>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($stock as $key): ?>
        <tr>
          <td><?php echo $key->articuloid ?></td>
          <td><?php echo $key->descripcion ?></td>
          <td><?php echo $key->unidad ?></td>
          <td><?php echo $key->familia ?></td>
          <td><?php echo ($key->seriearticulo=='NULL')?'':$key->seriearticulo ?></td>
          <td><?php echo $key->stock ?></td>
          <?php if ($this->session->acceso_submenu_26==1): ?>
            <td><?php echo $key->costo ?></td>
          <?php endif; ?>

        </tr>
    <?php endforeach; ?>
  </tbody>
</table>
