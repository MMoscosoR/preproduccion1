
<form method="post" id="registro_envio_form">
<div class="panel-body">
  <div class="row">
    <div class="col-md-12">
    <div class="form-group">
       <h3>Se emitira el siguiente documento: NI <?php echo $seriedoc.str_pad($correlativo, 7, "0", STR_PAD_LEFT) ?></h3>
       <h5>Los productos entrarán en un estado de transito hasta la recepción en CTR</h5>
    </div>
    </div>
  </div>
<input type="hidden" name="nicorrelativo" value="<?php  echo $correlativo?>">
<input type="hidden" name="nitipo" value="NI">
<input type="hidden" name="nguiasalida" value="<?php echo $guiasalida ?>">

    <div class="row">

      <div class="col-md-12">
        <div class="form-group">
        <label for="">Transacción</label>
            <?php echo $transaccionnombre; ?>
        
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
        <label for="">Proyecto</label>
        <input type="text" value="<?php echo $this->session->userdata('alm_nombre'); ?>" readonly="" class="form-control">
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
        <label for="">serie</label>
        <input type="text" value="<?php echo $seriedoc ?>" readonly="" class="form-control" name="nidocid">
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
        <label for="">Comentario</label>
        <input type="text" value="<?php echo $guiasalida ?>"  class="form-control" name="nicomentario" id="nicomentario">
        </div>
      </div>
    </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
      <label for="">Fecha</label>
      <input type="date" value="<?php echo date('Y-m-d') ?>" name="nifecha" class="form-control">
      </div>
    </div>
    <div class="col-md-12" id="msg">

    </div>
  </div>
</div>
</form>
