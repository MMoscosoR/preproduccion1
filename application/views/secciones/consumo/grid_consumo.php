
<?php if ($carga!=0): ?>
<div class="callout callout-info">
                <h4>Indicaciones!</h4>

                <p>En el caso de un ingreso las filas de <span style="color:red"><b>ROJO</b></span>('Codigo no existe')
                  no se ingresaran,En el caso de una salida las filas <span style="color:Yellow"><b>AMARILLAS</b></span>(Sin stock suficiente) no se registraran</p>
                <p>Tener cuidado con los errores en maquina,solicitante y area filtrar la palabra 'ERROR' antes de generar el documento</p>
</div>

<table class="table table-bordered table-condensed table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Codigo</th>
      <th>Serie</th>
      <th>Cantidad</th>
      <th>Stock disponible(Salida)</th>
      <th>Maquina</th>
      <th>Solicitante</th>
      <th>Area</th>
      <th>Doc referencia</th>
      <th>Descripcion</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php $item=1; ?>
        <?php foreach ($carga as $key): ?>
            <tr <?php if ($key['descripcion']=='Codigo o serie no existe' ): ?>
                  class="danger"
            <?php endif; ?>
              <?php if (($key['stockactual'] - $key['cantidad'] )< 0 and $this->uri->segment(2)=='listar_consumo'): ?>
                class='warning'
              <?php endif; ?>
            >
              <td><?php echo $item ?></td>
              <td><?php echo $key['codigo'] ?></td>
              <td><?php echo $key['serie'] ?></td>
              <td><?php echo $key['cantidad'] ?></td>
              <td><?php echo $key['stockactual'] ?></td>
              <td <?php if ($key['maquina']==-1):
                          $key['maquina']='ERROR';
                ?>
                style="background-color:rgb(226, 126, 89);"
              <?php endif; ?>><?php echo $key['maquina'] ?>
            </td>

              <td <?php if ($key['idsolicitante']==-1):
                        $key['idsolicitante']='ERROR';
                ?>
                style="background-color:rgb(226, 126, 89);"
              <?php endif; ?>><?php echo $key['idsolicitante'] ?></td>


              <td <?php if ($key['area']==-1):
                        $key['area']='ERROR';
                 ?>
                style="background-color:rgb(226, 126, 89);"
              <?php endif; ?>><?php echo $key['area'] ?></td>


              <td><?php echo $key['docref'] ?></td>
              <td><?php echo  utf8_decode($key['descripcion']) ?></td>
              <td><a href="#" data-id="<?php echo $key['item'] ?>" class="alert-link eliminar btn btn-danger btn-xs">Eliminar</a></td>
            </tr>
            <?php $item++; ?>
        <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>
