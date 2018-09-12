<table class="table table-bordered table-condensed table-hover">
  <thead>
    <tr>
      <th>Documento</th>
      <th>Comentario</th>
      <th>Usuario</th>
      <th>Transaccion</th>
      <th>Fecha</th>
      <th>Estado</th>
      <th>Acciones</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($docs_dif as $key): ?>
        <tr>
          <td><?php echo $key->seriedocid.str_pad($key->correlativo, 7, "0", STR_PAD_LEFT) ?></td>
          <td><?php echo $key->comentario; ?></td>
          <td><?php echo $key->nombre.' '.$key->apepat; ?></td>
          <td><?php echo $key->transaccion; ?></td>
          <td><?php echo date('d-m-Y',strtotime($key->fecha_registro)); ?></td>
          <td>
            <?php
              switch ($key->estado) {
                case 1:
                  echo "<span class='label bg-aqua disabled color-palette'>Pendiente recepción</span>";
                  break;
                  case 2:
                    echo "<span class='label bg-green-active color-palette'>Recepcionado</span>";
                    break;
                    case 3:
                      echo "<span class='label bg-yellow-active color-palette'>Con diferencia activa</span>";
                      break;
                      case 4:
                        echo "<span class='label bg-blue-active color-palette'>Con diferencia cerrada</span>";
                        break;
                default:
                  // code...
                  break;
              }
            ?>
          </td>
          <td><a href="#" data-id="<?php echo $key->idmovalmcab ?>" class="btn btn-xs btn-primary verdetalle"><i class="glyphicon glyphicon-zoom-in"></i></a> <a href="<?php echo base_url() ?>Htmltopdf/documentospdf/<?php echo $key->idmovalmcab ?>" target="_blank" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-print"></i></a></td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>
