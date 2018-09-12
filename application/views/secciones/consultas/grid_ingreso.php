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
    <?php foreach ($ingresos as $key): ?>
        <tr>
          <td><?php echo $key->seriedocid.str_pad($key->correlativo, 7, "0", STR_PAD_LEFT) ?></td>
          <td><?php echo $key->comentario; ?></td>
          <td><?php echo $key->nombre.' '.$key->apepat; ?></td>
          <td><?php echo $key->transaccion; ?></td>
          <td><?php echo date('d-m-Y',strtotime($key->fecha)); ?></td>
          <td><?php
            switch ($key->estado) {
              case 1:
                echo "<span class='label bg-aqua disabled color-palette'>Pendiente recepción</span>";
                break;
                case 2:
                  echo "<span class='label bg-light-blue-active color-palette'>Recepcionado</span>";
                  break;
                  case 3:
                    echo "<span class='label bg-yellow-active color-palette'>Con diferencia activa</span>";
                    break;
                    case 4:
                      echo "<span class='label bg-yellow-active color-palette'>Con diferencia reportada</span>";
                      break;
              default:
                // code...
                break;
            }
          ?></td>


            <td><a href="#" data-id="<?php echo $key->idmovalmcab ?>" class="btn btn-xs btn-primary verdetalle"><i class="glyphicon glyphicon-zoom-in"></i></a>
            <a href="<?php echo base_url() ?>Htmltopdf/documentospdf/<?php echo $key->idmovalmcab ?>" target="_blank" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-print"></i></a>
            <?php if ($this->session->acceso_submenu_25==1): ?>


            <a href="#" class="btn btn-xs btn-danger eliminar_ni" data-toggle="modal" data-target="#modal_confirmacion" data-id="<?php echo $key->idmovalmcab ?>"><i class="glyphicon glyphicon-trash"></i></a>
            <?php endif; ?>
          </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="modal fade" id="modal_confirmacion" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Confirmar eliminacion del documento <span id=""></span></h4>
      </div>
      <div class="modal-body">
        <form method="post" id="form_eliminar_doc">
          <input type="hidden" name="movalmcabid" value="" id="form_id_movalmcab">
          <div class="alert alert-warning" id="alert_msg">

          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn_confirmar_eliminacion">Eliminar</button>
      </div>
    </div>
  </div>
</div>
