<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Administrador de Perfiles</h4>
				</div>

		        <div class="box-body">
		        	<div class="table-responsive">
		        		<table class="table table-bordered table-hover" id="tbl_perfiles">
		        			<thead>
		        				<tr>
		        					<th>#</th>
		        					<th>Nombre Perfil</th>

		        				</tr>
		        			</thead>
		        			<tbody>

		        			</tbody>
		        		</table>
		        	</div>
		        </div>

			</div>
		</div>
	</div>
</section>

<div class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" id="modal_perfiles">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="post" id="accesos">
      	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><div id="modal_titulo"></div></h4>
      </div>
      <div class="modal-body">
	      	<input type="hidden" id="txtAccion" name="txtAccion">
	        <input type="hidden"  id="txtIdperfil" name="txtIdperfil">
        	<div class="form-group">
					<label for="txtLugar">Nombre(*):</label>
		            <input type="text" class="form-control" id="txtNombre" name="txtNombre" required="">
			</div>

			<style>
				.list-group-item {
					border: 0 solid #ddd;
				}
			</style>
			<div class="form-group">
				<label for="txtLugar">Accesos a vistas(*):</label>
				<ul class="list-group">

					<?php foreach ($menus as $key) { ?>
							<label for="" class="info"><?php echo $key->menu ?></label>
							<?php foreach ($submenus as $key2): ?>
										<?php if ($key2->menuid==$key->menuid): ?>
											<li class="list-group-item">
												<div class="row">
													<div class="col-md-10">
														<?php echo $key2->submenu; ?>
													</div>
													<div class="col-md-2">
														<input type="checkbox" name="<?php echo $key2->submenuid ?>"  data-toggle="toggle" data-size="mini" class="form_accesos" id="<?php echo $key2->submenuid; ?>">
													</div>
												</div>

											</li>
										<?php endif; ?>
							<?php endforeach; ?>
					<?php } ?>

				</ul>
			</div>
				<div id="msg"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_guardar">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
