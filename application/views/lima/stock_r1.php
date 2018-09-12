<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Stock R1</title>
</head>
<body>
  <section class="content">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="box box-primary">
  				<div class="box-header with-border">
  					<h4>Stock almacen R1</h4>
  				</div>

  		        <div class="box-body">
                  <div class="row">
                      <div class="col-md-12 table-responsive">
                          <table class="table table-condensed table-bordered table-hover" id="tbl_stockr1">
                              <thead>
                                  <tr>
                                    <th>Código</th>
                                    <th>Serie</th>
                                    <th>Descripción</th>
                                    <th>Und</th>
                                    <th>Fam</th>
                                    <th>Canidad</th>
                                    <th>Costo</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($stockr1 as $key): ?>
                                    <tr>
                                        <td><?php echo $key->articuloid; ?></td>
                                        <td><?php echo ($key->seriearticulo=='NULL')?'':$key->seriearticulo; ?></td>
                                        <td><?php echo ($key->descripcion); ?></td>
                                        <td><?php echo $key->unidad; ?></td>
                                        <td><?php echo $key->familia; ?></td>
                                        <td><?php echo $key->stock; ?></td>
                                        <td><?php echo $key->costo; ?></td>
                                    </tr>
                                  <?php endforeach; ?>
                              </tbody>
                          </table>
                      </div>
                  </div>

  		        </div>

  			</div>
  		</div>
  	</div>
  </section>
</body>
</html>
