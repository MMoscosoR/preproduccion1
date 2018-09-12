<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Relacion de maquinas</h4>
				</div>

		        <div class="box-body">

							<div class="table-responsive">
		        		<table class="table table-bordered table-hover" id="tbl_maquinas">
		        			<thead>
                    <tr>
                      <th>#</th>
                      <th>Maquina</th>
                      <th>Acciones</th>
                    </tr>

		        			</thead>
		        			<tbody>
                      <?php foreach ($maquinas as $key): ?>
                        <tr>
                          <td><?php echo $key->idmaquina ?></td>
                          <td><?php echo $key->descripcion ?></td>
                          <td><a href="" class="btn btn-primary btn-xs editar-maquina" data-id="<?php echo $key->idmaquina ?>" data-nombre="<?php echo $key->descripcion ?>">Editar</a></td>
                        </tr>
                      <?php endforeach; ?>
		        			</tbody>
		        		</table>
		        	</div>
		        </div>

			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="nueva_maquina"  role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="" id="form_maquina" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Nueva Maquina</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="">Maquina:</label>
          <input type="text" class="form-control" id="maquina" placeholder="" name="maquina" required>
        </div>
        <input type="hidden" name="idmaquina" value="" id="idmaquina">
        <input type="hidden" name="contrato" value="<?php echo $this->session->userdata('alm_id') ?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
