<br>

<div class="row table-responsive">
  <div class="col-md-12">
        <table class="table table-bordered table-hover" id="valorizado">
          <thead>
            <tr>
              <th>Código</th>
              <th>Descripción</th>
              <th>Serie</th>
              <th>Unidad</th>
              <th>Stock</th>
              <th>Costo Promedio</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php $total=0; ?>
              <?php foreach ($moremes as $key): ?>
                <tr>
                  <td><?php echo $key->codigoarticulo ?></td>
                  <td><?php echo $key->descripcion ?></td>
                  <td><?php echo ($key->seriearticulo!='NULL')?$key->seriearticulo:'' ?></td>
                  <td><?php echo $key->unidad ?></td>
                  <td><?php echo $key->cantidad ?></td>
                  <td><?php echo $key->costo ?></td>
                  <td><?php echo $key->cantidad*$key->costo; ?></td>
                </tr>
                <?php $total=$total+($key->cantidad*$key->costo) ?>
              <?php endforeach; ?>

          </tbody>
          <footer>
            <tr>

              <td colspan="5"></td>
              <th>Total:</th>
              <th><?php echo $total ?></th>
            </tr>
          </footer>
        </table>
  </div>
</div>
