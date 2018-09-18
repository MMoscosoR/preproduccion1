<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Consumo por maquina</title>
</head>
<body>
  <section class="content">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="box box-primary">
  				<div class="box-header with-border">
  					<h4>Relacion de consumos</h4>
  				</div>

  		        <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Maquina</label>
                      <select class="form-control select2 form_consumo" id="filtro" >

                        <?php foreach ($areas as $key): ?>
                            <option value="<?php echo $key->idcentrocosto ?>"><?php echo $key->descripcion?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
          						<label>Fecha:</label>
          						<div class="input-group date">
          						<div class="input-group-addon">
          						<i class="fa fa-calendar"></i>
          						</div>
          						 <input type="text" class="form-control pull-right datepicker flat form_consumo" id="periodo" >
          						 </div>
          				</div>
                </div>
                  <div class="row">
                      <div class="col-md-12 table-responsive" id="tbl_reporte">

                      </div>

                  </div>

  		        </div>

  			</div>
  		</div>
  	</div>
  </section>
</body>
</html>
