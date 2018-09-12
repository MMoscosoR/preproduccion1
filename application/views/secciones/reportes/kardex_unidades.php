<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kardex Unidad</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <center><h3>Kardex de articulos</h3></center>
            <table>
              <thead>
                <tr>
                  <th>Periodo consultado: </th>
                  <td><?php echo $periodo ?></td>
                  <td style="width:200px"></td>
                  <th>Articulo:</th>
                  <td><?php echo $codigo?></td>
                </tr>
                <tr>
                  <th>Kardex del almacen:</th>
                  <td><?php echo $this->session->userdata('alm_nombre').' Guias: '.$seriedoc ?></td>
                  <td style="width:100px"></td>
                  <th>Descripcion/UND</th>
                  <td><?php echo $descripcion.'/'.$unidad ?></td>
                </tr>
              </thead>
            </table>

            <table class="table">
              <thead>
                <tr>

                  <th>FECHA</th>
                  <th>DOCUMENTO</th>
                  <th>TRANSACCION</th>
                  <th>STOCK INCIAL</th>

                  <th>INGRESOS</th>
                  <th>SALIDAS</th>
                  <th>STOCK FINAL</th>

                </tr>
              </thead>

              <tr>

                <td></td>
                <td></td>

                <td></td>
                <td><?php echo $saldo_inicial ?></td>
                <td></td>
                <td></td>
              </tr>
              <?php
                  $totalingreso=0;
                  $totalsalida=0;
               ?>
              <?php foreach ($movimientos as $key): ?>
                <tr>
                  <td><?php echo $key->fecha ?></td>
                  <td><?php echo  $key->seriedocid.str_pad($key->correlativo, 7, "0", STR_PAD_LEFT);  ?></td>
                  <td><?php echo $key->nombre ?></td>
                  <td></td>

                  <td><?php echo ($key->tipo=='NI')?$key->cantidad:'' ?></td>
                  <td><?php echo ($key->tipo=='NS')?$key->cantidad:'' ?></td>
                  <td></td>
                </tr>
                <?php
                    if($key->tipo=='NI'){$totalingreso=$totalingreso+$key->cantidad;}
                    if($key->tipo=='NS'){$totalsalida=$totalsalida+$key->cantidad;}
                 ?>
              <?php endforeach; ?>
                <tr>
                  <td></td>
                  <td></td>
                  <th>Totales</th>
                  <th><?php echo $saldo_inicial ?></th>

                  <th><?php echo $totalingreso ?></th>
                  <th><?php echo $totalsalida ?></th>
                  <th ><?php echo $saldo_inicial+$totalingreso-$totalsalida ?></th>
                </tr>
            </table>
          </div>
      </div>
    </div>
</body>
</html>
