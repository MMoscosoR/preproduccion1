<div class="row">
	<div class="table-responsive col-md-12">
		<table class="table table-condensed" id="tabla_accesos">
			<thead>
				<tr>
					<th>#</th>
					<th>Contrato</th>
					<th>Acceso</th>
					
				</tr>
			</thead>
				<tbody>
				<?php foreach ($accesos as $key) {?>
					<tr>
						<td><?php echo $key->contratoid ?></td>
						<td><?php echo $key->nombre ?></td>
						<td>
							<div class="row">
								

								<div class="select_roles col-md-12">
									<select name="cbo_tipo_<?php echo $key->contratoid ?>" id="" class="form-control">
											<option value="0" <?php echo ($key->rolid==null)?'selected':''; ?>>.:Sin acceso</option>
											<?php foreach ($perfiles as $row) { ?>
													<option value="<?php echo $row->rolid ?>" <?php echo ($key->rolid==$row->rolid)?'selected':''; ?>><?php echo $row->rol ?></option>
											<?php 	} ?>					
											
									</select>
								</div>
							</div>
						</td>
						
					</tr>
					
				<?php } ?>
				
					
				</tbody>
		</table>
	</div>
</div>