<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Cierre de mes</h4>
				</div>

		        <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Periodo</th>
                    <th>Dia cerrrado</th>
                    <th>Acciones</th>
                  </tr>

                </thead>
                <tbody>
                  <?php foreach ($periodo as $key): ?>
                    <tr>
                      <td><?php echo $key->periodo ?></td>
                      <td><?php echo $key->fecha_cierre ?></td>
                      <td><a class="btn btn-danger btn-xs eliminar_cierre" href="#" data-id="<?php echo $key->periodo; ?>">Aperturar periodo</a></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>

		        </div>

			</div>
		</div>
	</div>
</section>
