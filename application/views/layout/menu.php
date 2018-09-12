<?php $cdn='http://192.168.1.7/cdn/admin-lte/'; ?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->

      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU DE NAVEGACION</li>



        <?php if($this->session->acceso_menu_12==1){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i>
            <span>Dashboards</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <?php if($this->session->acceso_submenu_31==1){ ?><li><a href="<?php echo base_url() ?>Contrato/dashboard" id='menu_dashboard'><i class="fa fa-circle-o"></i>Resumen estadistico</a></li><?php } ?>

          </ul>
        </li>
        <?php } ?>

        <?php if($this->session->acceso_menu_2==1){ ?>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-cog"></i> <span>Tabla de ayuda</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($this->session->acceso_submenu_4==1){ ?><li><a href="<?php echo base_url() ?>Contrato/maestro-articulo" id='menu_maestro_articulo'><i class="fa fa-circle-o"></i>Maestro articulos</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_5==1){ ?><li><a href="<?php echo base_url() ?>Contrato/serie-documento" id='menu_serie_documentos'><i class="fa fa-circle-o"></i>Series de Documentos</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_6==1){ ?><li><a href="<?php echo base_url() ?>Contrato/correlativos" id='menu_correlativos'><i class="fa fa-circle-o"></i>Correlativo</a></li>
            <?php } ?>
            <?php if($this->session->acceso_submenu_7==1){ ?><li><a href="<?php echo base_url() ?>Contrato/transacciones" id='menu_transacciones'><i class="fa fa-circle-o"></i>Transacciones</a></li>
            <?php } ?>
            <?php if($this->session->acceso_submenu_32==1){ ?><li><a href="<?php echo base_url() ?>Contrato/maquinas" id='menu_maquinas'><i class="fa fa-circle-o"></i>Maquinas</a></li>
            <?php } ?>
            <?php if($this->session->acceso_submenu_33==1){ ?><li><a href="<?php echo base_url() ?>Contrato/solicitantes" id='menu_solicitantes'><i class="fa fa-circle-o"></i>Solicitantes</a></li>
            <?php } ?>
            <?php if($this->session->acceso_submenu_34==1){ ?><li><a href="<?php echo base_url() ?>Contrato/centros_de_costo" id='menu_cc'><i class="fa fa-circle-o"></i>Areas Centros de costo</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>


        <?php if($this->session->acceso_menu_3==1 and $this->session->userdata('alm_id')!=14){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fas fa-truck"></i>
            <span>Lima</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($this->session->acceso_submenu_8==1){ ?><li><a href="<?php echo base_url() ?>Contrato/envios-a-contrato" id='envios-a-contrato'><i class="fa fa-circle-o"></i>Envios a contrato</a></li><?php } ?>

            <?php if($this->session->acceso_submenu_10==1){ ?><li><a href="<?php echo base_url() ?>Contrato/stock-R1" id='stock-r1'><i class="fa fa-circle-o"></i>Stock R1</a></li><?php } ?>
          </ul>
        </li>
        <?php } ?>

          <?php if($this->session->acceso_menu_4==1){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fas fa-truck"></i>
            <span><?php echo ($this->session->userdata('alm_id')!=14)?'Proyecto':'Almacen Lima' ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($this->session->acceso_submenu_15==1){ ?><li><a href="<?php echo base_url() ?>Contrato/carga-inicial" id='menu_carga_inicial'><i class="fa fa-circle-o"></i>Carga Inicial</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_14==1){ ?><li><a href="<?php echo base_url() ?>Contrato/recepcion" id='menu_recepcion'><i class="fa fa-circle-o"></i>Recepcion</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_11==1){ ?><li><a href="<?php echo base_url() ?>Contrato/consumo" id='menu_consumo'><i class="fa fa-circle-o"></i>Consumo</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_12==1){ ?><li><a href="<?php echo base_url() ?>Contrato/devolucion-a-lima" id='menu_devolucion_lima'><i class="fa fa-circle-o"></i>Devolucion a lima</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_13==1){ ?><li><a href="<?php echo base_url() ?>Contrato/transferencias" id='menu_transferencias'><i class="fa fa-circle-o"></i>Transferencia</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_13==1){ ?><li><a href="#" id='menu_compra_local'><i class="fa fa-circle-o"></i>Compra local</a></li><?php } ?>
            <?php if(true){ ?><li><a href="<?php echo base_url() ?>Contrato/requerimiento-materiales" id='menu_requerimiento-materiales'><i class="fa fa-circle-o"></i>Requeriminto de materiales</a></li><?php } ?>
          </ul>
        </li>
        <?php } ?>



        <?php if($this->session->acceso_menu_5==1){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Consultas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($this->session->acceso_submenu_16==1){ ?><li><a href="<?php echo base_url() ?>Contrato/diferencias-activas" id='menu_diferencia_activa'><i class="fa fa-circle-o"></i> Diferencias Activas</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_17==1){ ?><li><a href="<?php echo base_url() ?>Contrato/diferencias-cerradas" id='menu_diferencia_cerrada'><i class="fa fa-circle-o"></i> Diferencias Reportadas</a></li><br><?php } ?>
            <?php if($this->session->acceso_submenu_18==1){ ?><li><a href="<?php echo base_url() ?>Contrato/notas-ingreso" id='menu_nota_ingreso'><i class="fa fa-circle-o"></i> Notas de Ingreso</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_19==1){ ?><li><a href="<?php echo base_url() ?>Contrato/notas-salida" id='menu_nota_salida'><i class="fa fa-circle-o"></i> Notas de Salida</a></li><br><?php } ?>
            <?php if($this->session->acceso_submenu_20==1){ ?><li><a href="<?php echo base_url() ?>Contrato/stock" id='menu_stock'><i class="fa fa-circle-o"></i> Stock Contrato</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_30==1){ ?><li><a href="<?php echo base_url() ?>Contrato/movimientos" id='menu_movimientos'><i class="fa fa-circle-o"></i> Relacion de movimientos</a></li><?php } ?>
          </ul>
        </li>
        <?php } ?>
        <?php if($this->session->acceso_menu_6==1){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fas fa-file-excel"></i>
            <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($this->session->acceso_submenu_21==1){ ?><li><a href="<?php echo base_url() ?>Contrato/costo-almacen" id='menu_kardex_valorizado'><i class="fa fa-circle-o"></i>Costo de almacen</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_22==1){ ?><li><a href="<?php echo base_url() ?>Contrato/kardex-unidad" id='menu_kardex_unidad'><i class="fa fa-circle-o"></i> Kardex en unidades</a></li><?php } ?>

          </ul>
        </li>
        <?php } ?>

        <?php if($this->session->acceso_menu_11==1){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-gears"></i>
            <span>Procesos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <?php if($this->session->acceso_submenu_28==1){ ?><li><a href="<?php echo base_url() ?>Contrato/cierre-mes" id='menu_cierre_mes'><i class="fa fa-circle-o"></i>Cierre de mes</a></li><?php } ?>
            <?php if($this->session->acceso_submenu_29==1){ ?><li><a href="<?php echo base_url() ?>Contrato/aperturar-mes" id='menu_apertura_mes'><i class="fa fa-circle-o"></i>Apertura de mes</a></li><?php } ?>
          </ul>
        </li>
        <?php } ?>









      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
   <div class="content-wrapper" id="home-contenido">
