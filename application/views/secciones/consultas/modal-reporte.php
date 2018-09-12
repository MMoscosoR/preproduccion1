<div class="form-group">
  <label for="">Regisrado por:</label>
  <input type="text" class="form-control" id="" placeholder="" readonly value="<?php echo $detallereporte->nombre.' '.$detallereporte->apepat  ?>">

</div>

<div class="form-group">
  <label for="">Detalle del reporte</label>
  <textarea name="name" rows="4"  class="form-control" readonly><?php echo $detallereporte->detalle ?></textarea>

</div>
<div class="form-group">
  <label for="">Fecha:</label>
  <input type="text" class="form-control" id="" placeholder="" readonly value="<?php echo date('d-m-Y H:i:s',strtotime($detallereporte->fecha)) ?>">

</div>

<div class="form-group">
  <label for="">Archivos Adjuntos</label>
  <ul class="list-group">
  <?php foreach ($archivos as $key): ?>
    <li class="list-group-item"><a href="<?php echo $key->url ?>" target="_blank">  <?php echo $key->nombre ?></a></li>
  <?php endforeach; ?>
  </ul>
</div>
