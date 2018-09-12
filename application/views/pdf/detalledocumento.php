<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Nota de Salida  </title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


  <style media="screen">
      .cabeceratds{
        margin-top: :0;
        margin-bottom: 0;
      }
      body{
        font-size: 8pt;
        color:#000;
      }
      .cabecera{
        font-size: 8pt;
        color:#000;
      }
  </style>

</head>
<body>
  <div class="cabecera">
  <table class="table table-condensed">
    <thead>
      <tr>
        <th colspan="2" style="border: #fff 1px solid">
          <img src="<?php echo base_url() ?>assets/img/rocklogo.png" height="25px">
        </th>
      </tr>
      <tr>
        <th style="border: #fff 1px solid" class="cabeceratds"><?php echo ($cabecera->tipo=='NI')?'NOTA DE INGRESO:':'NOTA DE SALIDA:' ?></th>
        <td style="border: #fff 1px solid" class="cabeceratds"><?php echo ($cabecera->seriedocid.str_pad($cabecera->correlativo, 7, "0", STR_PAD_LEFT) ) ?></td>
      </tr>
      <tr>
        <th style="border: #fff 1px solid">CONTRATO:</th>
        <td style="border: #fff 1px solid"><?php echo $cabecera->centrocosto.'-'.$cabecera->nombre ?></td>
      </tr>
      <tr>
        <th style="border: #fff 1px solid">CLIENTE:</th>
        <td style="border: #fff 1px solid">20469962246 - ROCK DRILL CONT. CIV. Y MIN. SAC</td>
      </tr>
      <tr>
        <th style="border: #fff 1px solid">USUARIO:</th>
        <td style="border: #fff 1px solid"><?php echo $cabecera->fullname ?></td>
      </tr>
      <tr>
        <th style="border: #fff 1px solid">COMENTARIO:</th>
        <td style="border: #fff 1px solid"><?php echo $cabecera->comentario ?></td>
      </tr>
      <tr>
        <th style="border: #fff 1px solid">FECHA:</th>
        <td style="border: #fff 1px solid"><?php echo date('d-m-Y',strtotime($cabecera->fecha));?></td>
      </tr>
    </thead>
  </table>
  </div>
  <table class="table table-bordered table-condensed">
      <thead>
        <tr >
          <th style="border: #000 1px solid">ITEM</th>
          <th style="border: #000 1px solid">CÓDIGO</th>
          <th style="border: #000 1px solid">DESCRIPCIÓN</th>
          <th style="border: #000 1px solid">SERIE</th>
          <th style="border: #000 1px solid">CANTIDAD</th>
          <th style="border: #000 1px solid">UNIDAD</th>
          <th style="border: #000 1px solid">MAQUINA</th>

        </tr>
      </thead>
      <tbody>
        <?php foreach ($detalle as $key): ?>
        <tr>
          <td style="border: #000 1px solid"><?php echo $key->item ?></td>
          <td style="border: #000 1px solid"><?php echo $key->codigo ?></td>
          <td style="border: #000 1px solid"><?php echo utf8_decode($key->descripcion) ?></td>
          <td style="border: #000 1px solid"><?php echo ($key->serie=='NULL')?'':$key->serie ?></td>
          <td style="border: #000 1px solid"><?php echo $key->cantidad ?></td>
          <td style="border: #000 1px solid"><?php echo $key->unidad ?></td>
          <td style="border: #000 1px solid"><?php echo $key->maquina ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
  </table>
</body>
</html>
