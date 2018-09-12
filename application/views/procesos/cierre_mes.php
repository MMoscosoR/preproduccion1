<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Cierre de mes</h4>
				</div>

		        <div class="box-body">
              <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Tener en cuenta!</h4>
                  El cierre muestra el mes despues del ultimo cierre.
              </div>
                <form id="form_cierre">
                  <input type="hidden" name="periodo" value="<?php echo $periodo ?>">
									<?php if ($periodo!='NULL'){ ?>
										<button type="button" class="btn btn-primary btn-block" id="btn_cierre_mes">

	                      Cerrar periodo <?php echo $periodo; ?>
	                  </button>
									<?php }else{ ?>
								
									<div class="callout callout-danger">
										<h4>Sin registros!</h4>

										<p>Aun no se ha realizado movimientos en el almacen</p>
									</div>

								<?php } ?>
                </form>

                <div id="msg">

                </div>

		        </div>

			</div>
		</div>
	</div>
</section>
