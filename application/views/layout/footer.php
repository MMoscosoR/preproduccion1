</div>
  <!-- /.content-wrapper -->




</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<?php $cdn=base_url().'assets/cdn/'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo $cdn; ?>bower_components/jquery-ui/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $cdn; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->

<!-- Sparkline -->
<script src="<?php echo $cdn; ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo $cdn; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo $cdn; ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo $cdn; ?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo $cdn; ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo $cdn; ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo $cdn; ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->

<script src="<?php echo $cdn; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo $cdn; ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $cdn; ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $cdn; ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo $cdn; ?>dist/js/demo.js"></script>
<script src="<?php echo $cdn; ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="<?php echo $cdn; ?>bower_components/alertify/alertify.min.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/file-input/fileinput.min.js"></script>
<!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
<script src="<?php echo base_url()?>/assets/plugins/file-input/theme.js"></script>
<!-- optionally if you need translation for your language then include  locale file as mentioned below -->
<script src="<?php echo base_url()?>/assets/plugins/file-input/es.js"></script>
<!-- AdminLTE for demo purposes -->



<script>
	var baseurl="<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url() ?>js/contratos.js"></script>

<?php if($this->uri->segment(2)=='maestro-articulo'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/maestro-articulo.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='serie-documento'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/serie-documentos.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='correlativos'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/correlativo.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='transacciones'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/transacciones.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='maquinas'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/maquinas.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='solicitantes'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/solicitantes.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='centros_de_costo'){ ?>
	<script src="<?php echo base_url() ?>js/tabla-de-ayuda/centros_de_costo.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='Usuarios'){ ?>
	<script src="<?php echo base_url() ?>js/usuario.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='Almacenes'){ ?>
	<script src="<?php echo base_url() ?>js/almacenes.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='Perfiles'){ ?>
	<script src="<?php echo base_url() ?>js/perfil.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='envios-a-contrato'){ ?>
	<script src="<?php echo base_url() ?>js/lima/envios-a-contrato.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='recepcion-de-contratos'){ ?>
	<script src="<?php echo base_url() ?>js/lima/recepcion_de_contratos.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='carga-inicial'){ ?>
	<script src="<?php echo base_url() ?>js/proyecto/carga-inicial.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='stock-R1'){ ?>
	<script src="<?php echo base_url() ?>js/lima/stock-r1.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='recepcion'){ ?>
	<script src="<?php echo base_url() ?>js/proyecto/recepcion.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='consumo'){ ?>
	<script src="<?php echo base_url() ?>js/proyecto/consumo.js"></script>
<?php } ?>
<?php if($this->uri->segment(2)=='transferencias'){ ?>
	<script src="<?php echo base_url() ?>js/proyecto/transferencias.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='devolucion-a-lima'){ ?>
	<script src="<?php echo base_url() ?>js/proyecto/devolucion.js"></script>
<?php } ?>

<!-- consultas -->
<?php if($this->uri->segment(2)=='diferencias-activas'){ ?>


	<script src="<?php echo base_url() ?>js/consultas/diferencias-activas.js"></script>

<?php } ?>

<?php if($this->uri->segment(2)=='diferencias-cerradas'){ ?>
	<script src="<?php echo base_url() ?>js/consultas/diferencias-cerradas.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='notas-ingreso'){ ?>
	<script src="<?php echo base_url() ?>js/consultas/notas-ingreso.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='notas-salida'){ ?>
	<script src="<?php echo base_url() ?>js/consultas/notas-salida.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='stock'){ ?>
  <script>
    var contrato="<?php echo $this->session->userdata('alm_nombre'); ?>";
    var current="<?php echo date('d-m-Y H:i:s'); ?>";
  </script>
	<script src="<?php echo base_url() ?>js/consultas/stock.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='movimientos'){ ?>

  <script type="text/javascript">
    var contrato="<?php echo $this->session->userdata('alm_nombre'); ?>";
    var current="<?php echo date('d-m-Y H:i:s'); ?>";
  </script>
	<script src="<?php echo base_url() ?>js/consultas/movimientos.js"></script>
<?php } ?>
<!-- fin consultas -->
<!-- reportes -->
<?php if($this->uri->segment(2)=='kardex-unidad'){ ?>
	<script src="<?php echo base_url() ?>js/reporte/kardex_unidad.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='costo-almacen'){ ?>
	<script src="<?php echo base_url() ?>js/reporte/kardex-valorizado.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='consumo-maquina'){ ?>
	<script src="<?php echo base_url() ?>js/reporte/consumo-maquina.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='consumo-personal'){ ?>
	<script src="<?php echo base_url() ?>js/reporte/consumo-solicitante.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='consumo-area'){ ?>
	<script src="<?php echo base_url() ?>js/reporte/consumo-area.js"></script>
<?php } ?>
<!-- fin reportes -->

<!-- procesos -->
<?php if($this->uri->segment(2)=='recalculo-mes'){ ?>
	<script src="<?php echo base_url() ?>js/procesos/recalculo_mes.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='cierre-mes'){ ?>
	<script src="<?php echo base_url() ?>js/procesos/cierre_mes.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='aperturar-mes'){ ?>
	<script src="<?php echo base_url() ?>js/procesos/aperturar_mes.js"></script>
<?php } ?>

<!-- fin procesos -->

<?php if($this->uri->segment(2)=='requerimiento-materiales'){ ?>
	<script src="<?php echo base_url() ?>js/proyecto/reqerimiento-materiales.js"></script>
<?php } ?>

<?php if($this->uri->segment(2)=='dashboard'){ ?>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script src="<?php echo base_url() ?>js/dashboard/dashboard1.js"></script>
<?php } ?>


</body>
</html>
