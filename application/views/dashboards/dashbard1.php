<section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

<section class="content">
  <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $ingresostotales ?></h3>
              <p>Notas de ingreso</p>
            </div>
            <div class="icon">
              <i class="fas fa-plus"></i>

            </div>
            <a href="#" class="small-box-footer">Ingresos totales del contrato</i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $salidastotales ?><sup style="font-size: 20px"></sup></h3>

              <p>Notas de salida</p>
            </div>
            <div class="icon">
              <i class="fas fa-minus"></i>
            </div>
            <a href="#" class="small-box-footer">Salidas totales del contrato</i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $nmaquinas ?><sup style="font-size: 20px"></sup></h3>

              <p>Maquinas</p>
            </div>
            <div class="icon">
              <i class="fas fa-truck-loading"></i>
            </div>
            <a href="<?php echo base_url() ?>Contrato/maquinas" class="small-box-footer">Maquinas activas en mina</i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $codigotop->cantidad.' '.$codigotop->unidad ?></h3>

              <p><?php echo $codigotop->descripcion ?></p>

            </div>
            <div class="icon">
              <i class="fas fa-people-carry"></i>
            </div>
            <a href="#" class="small-box-footer">Articulo con mas movimientos</a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><sup style="font-size: 20px">S/.</sup><?php echo $valoralmacen ?></h3>

              <p>&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Valor actual del almacen</a>
          </div>
        </div>
        <!-- ./col -->
      </div>



<div class="row">
  <div class="col-sm-12">
    <div class="nav-tabs-custom" style="cursor: move;">
          <!-- Tabs within a box -->
          <ul class="nav nav-tabs pull-right ui-sortable-handle">
            <li class=""><a href="#pormovimientos" data-toggle="tab" aria-expanded="true" class="cambiodegrafica">Top mayor movimiento en cantidades</a></li>
            <li class="active"><a href="#porcostos" data-toggle="tab" aria-expanded="false" class="cambiodegrafica">Top mayor movimientos en S/.</a></li>
            <li class="pull-left header"><i class="fa fa-inbox"></i>Top de movimientos</li>
          </ul>
          <div class="tab-content">
            <!-- Morris chart - Sales -->

              <div class="chart tab-pane " id="pormovimientos" style="position: relative; height: 300px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                </div>



              <div class="chart tab-pane active  " id="porcostos" style="position: relative; height: 300px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">

              </div>

          </div>
        </div>
  </div>
</div>







</section>
<script type="text/javascript">
  var data=<?php echo $topcodigos; ?>;
  var data2=<?php echo $topcodigosvalor;  ?>
</script>
