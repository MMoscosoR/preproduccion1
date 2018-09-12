

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Administrador de accesos de usuarios</h4>
				</div>		
				
		        <div class="box-body">
		        	<div class="table-responsive">
		        		<table class="table table-bordered table-hover" id="tbl_usuarios">
		        			<thead>
		        				<tr>
		        					<th>#</th>
		        					<th>Nombre</th>
		        					<th>Ap. Paterno</th>
		        					<th>Ap. Materno</th>
		        					<th>DNI</th>
		        					<th>Cargo</th>
		        					<th>Correo</th>
		        					<th>Tipo de usuario</th>
		        					
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
	<!--modal editar-->
	<div class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" id="m_user_edit">
	  <div class="modal-dialog modal-lg" role="document">
	  	<form method="post" id="usuario_form">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h3 class="modal-title"><div id="modal_titulo"></div></h3>
	      </div>

	      <div class="modal-body">
	      		<div class="form-group">
					<div id="msg-error"></div>
				</div>

	      		<input type="hidden" name="txtIdusuario" id="txtIdUsuario">	
				<input type="hidden" name="txtAccion" id="txtAccion">
				<div class="form-group">
					<label for="txtLugar">Nombres(*):</label>
		            <input type="text" class="form-control" id="txtNombres" name="txtNombres" required="">
				</div>
				<div class="form-group">
					<label for="txtLugar">Apellido Paterno(*):</label>
		            <input type="text" class="form-control" id="txtApepat"  name="txtApepat" required="">
				</div>
				<div class="form-group">
					<label for="txtLugar">Apellido Materno:</label>
		            <input type="text" class="form-control" id="txtApemat"  name="txtApemat">
				</div>
				<div class="form-group">
					<label for="txtLugar">DNI(*):</label>
		            <input type="text" class="form-control" id="txtDni"  name="txtDni" maxlength="8">
				</div>
				<div class="form-group">
					<label for="txtLugar">Cargo(*):</label>
		            <input type="email" class="form-control" id="txtCargo"  name="txtCargo">
				</div>
				<div class="form-group">
					<label for="txtLugar">Correo(*):</label>
		            <input type="email" class="form-control" id="txtCorreo"  name="txtCorreo">
				</div>
				<?php if($this->session->rol_id!=1){ ?>
	       		<div class="form-group">
					<label for="cboTipo">Tipo de usuario:</label>
		                <select name="cbotipo" id="cboTipo" class="form-control">
		                  	<option value="0">::Sin acceso</option>
							
							<?php foreach ($perfiles_creados as $row) { ?>
								<option value="<?php echo $row->rolid ?>"><?php echo $row->rol ?></option>
							<?php 	} ?>	
							<!--
		                  	<option value="3">Usuario</option>
		                  	<option value="2">Administrador</option>						
							-->
		                </select>
				</div>
				<?php } else{ ?>
				<div class="form-group">
					<label for="txtLugar">Control de accesos:</label>
		           
				</div>
				<div class="form-group" id="tbl_accesos">
					
				</div>
				<?php } ?>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <button type="button" class="btn btn-primary" id="enviar_form" >Guardar</button>
	      </div>
	    </div>
	    </form>
	  </div>
	</div>
<!--fin modal editar-->

</section>