<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Administrador de Proyectos</h4>
				</div>		
				
		        <div class="box-body">
		        	<div class="table-responsive">
		        		<table class="table table-bordered table-hover" id="tbl_almacenes">
		        			<thead>
		        				<tr>
		        					<th>#</th>
		        					<th>Nombre Almacen</th>
		        					<th>Centro de costo</th>
		        					<th>Provincia</th>
		        					<th>Direccion</th>
		        					<th>Telefono</th>
		        					<th>Administrador</th>
		        					<th>Estado</th>
		        					
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



<div class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" id="modal_almacenes">
  <div class="modal-dialog modal-lg" role="document">
  	<form action="" method="post" id="form_almacen">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="myModalLabel"><div id="modal_titulo"></div></h4>
      	</div>
      	<div class="modal-body">
        	<div class="form-group">
					<div id="msg-error"></div>
				</div>

	      		<input type="hidden" name="txtIdalmacen" id="txtIdalmacen">	
				<input type="hidden" name="txtAccion" id="txtAccion">
				<div class="form-group">
					<label for="txtLugar">Nombre(*):</label>
		            <input type="text" class="form-control" id="txtNombre" name="txtNombre" required="">
				</div>
				<div class="form-group">
					<label for="txtLugar">Centro de Costo(*):</label>
		            <input type="text" class="form-control" id="txtcentrocosto" name="txtcentrocosto" required="">
				</div>
				<div class="form-group">
					<label for="txtLugar">Provincia:</label>
		            <input type="text" class="form-control" id="txtProvincia" name="txtProvincia" required="">
				</div>
				<div class="form-group">
					<label for="txtLugar">Direccion:</label>
		            <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" required="">
				</div>
				<div class="form-group">
					<label for="txtLugar">Telefono:</label>
		            <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" required="">
				</div>
				<div class="form-group">
					<label for="txtLugar">Administrador:</label>
		            <input type="text" class="form-control" id="txtAdministrador" name="txtAdministrador" required="">
				</div>
				<div class="form-group">
					<label for="txtLugar">Notificaciones a:</label>

					<textarea name="textCorreo_para" id="textCorreo_para" rows="3" class="form-control" placeholder="Escribir los correos separados por comas ejm.(nombre.apellido@rockdrillgroup.com,admin.casapalca@rockdrillgroup.com,...,ultimo.correo@rockdrillgroup.com)"></textarea>
		            
				</div>
				<div class="form-group">
					<label for="txtLugar">Copiando a:</label>
					<textarea name="textCorreo_cc" id="textCorreo_cc" rows="3" class="form-control" placeholder="Escribir los correos separados por comas ejm.(nombre.apellido@rockdrillgroup.com,admin.casapalca@rockdrillgroup.com,...,ultimo.correo@rockdrillgroup.com)"></textarea>
		            
				</div>

				<div class="form-group">
					<label for="txtLugar">Estado:</label>
		            <input type="checkbox" checked data-toggle="toggle" data-on="Activo" data-off="Inactivo" data-onstyle="success" data-width="100" data-offstyle="label bg-black color-palette" id="cbo_estado" name='cbo_estado' >
				</div>

      	</div>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        	<button type="button" class="btn btn-primary" id="enviar_formulario">Guardar</button>
      	</div>
    </div>
    </form>
  </div>
</div>