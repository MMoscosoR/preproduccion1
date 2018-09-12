<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Notas de Ingreso</title>
</head>
<body>
  <section class="content">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="box box-primary">
  				<div class="box-header with-border">
  					<h4>Notas de Ingresos</h4>
  				</div>

  		        <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Serie documento</label>
                      <select class="form-control" id="serie_doc" style="width:25%">
                        <?php foreach ($series as $key): ?>
                            <option value="<?php echo $key->serie_doc_id ?>"><?php echo $key->serie_doc_id.'-'.$key->nombre ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                  <div class="row">
                      <div class="col-md-12 table-responsive" id="tbl_stock">

                      </div>

                  </div>

  		        </div>

  			</div>
  		</div>
  	</div>
  </section>
</body>
</html>
