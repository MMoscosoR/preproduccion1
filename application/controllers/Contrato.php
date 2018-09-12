<?php
	/**
	 *
	 */
	class Contrato extends CI_Controller
	{

		function __construct()
		{
			parent::__construct();
			$this->load->model('Mcontrato');
			$this->load->model('Mperfil');
		}

		public function index(){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('layout/contenido');
			$this->load->view('layout/footer');
		}

		public function get(){
			$usuario=$this->input->post('usuario');
			$contratos=$this->Mcontrato->gettogin(1,$usuario);
			echo json_encode($contratos);
		}
		public function Usuarios(){
			if(!$this->session->acceso_submenu_1==1){
				redirect(base_url().'Contrato');
			}else{
				$data['perfiles_creados']=$this->Mperfil->getperfiles();
				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->view('usuarios/grid_usuarios',$data);
				$this->load->view('layout/footer');
			}
		}
		public function maestro_articulo(){
			if(!$this->session->acceso_submenu_4==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->view('tabla-ayuda/maestro-articulos');
				$this->load->view('layout/footer');
			}
		}
		public function serie_documento(){
			if(!$this->session->acceso_submenu_5==1){
				redirect(base_url().'Contrato');
			}else{
			$this->load->model('Mseriedoc');
			$data['series']=$this->Mseriedoc->getseries();
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('tabla-ayuda/serie-documento',$data);
			$this->load->view('layout/footer');
			}
		}
		public function correlativos(){
			if(!$this->session->acceso_submenu_6==1){
				redirect(base_url().'Contrato');
			}else{

				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->view('tabla-ayuda/correlativos');
				$this->load->view('layout/footer');
			}
		}
		public function transacciones(){
			if(!$this->session->acceso_submenu_7==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->view('tabla-ayuda/transacciones');
				$this->load->view('layout/footer');
			}
		}
		public function Almacenes(){
			if(!$this->session->acceso_submenu_2==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->view('almacenes/grid_almacenes');
				$this->load->view('layout/footer');
			}
		}
		public function Perfiles(){
			if(!$this->session->acceso_submenu_3==1){
				redirect(base_url().'Contrato');
			}else{

				$this->load->model('Mperfil');
				$data['menus']=$this->Mperfil->getmenus();
				$data['submenus']=$this->Mperfil->getsubmenus();

				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->view('perfiles/grid_perfiles',$data);
				$this->load->view('layout/footer');
			}
		}

		public function envios_a_contrato(){
			if(!$this->session->acceso_submenu_8==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->model(array('Mserie'));
				$series['series']=$this->Mserie->listar_series();
				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->view('lima/envios-a-contrato',$series);
				$this->load->view('layout/footer');
			}
		}

		public function recepcion_de_contratos(){
			if(!$this->session->acceso_submenu_9==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->model(array('Mserie'));
				$series['series']=$this->Mserie->listar_series();
				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->view('lima/recepcion_de_contratos',$series);
				$this->load->view('layout/footer');
			}
		}

		public function carga_inicial(){
			if(!$this->session->acceso_submenu_15==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->model(array('Mserie'));
				$series['series']=$this->Mserie->listar_series();
				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->view('proyecto/carga-inicial',$series);
				$this->load->view('layout/footer');
			}
		}

		public function stock_R1(){
			if(!$this->session->acceso_submenu_10==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->model(array('Mcontrato'));

				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$data['stockr1']=$this->Mcontrato->get_stocks(14,'031');
				$this->load->view('lima/stock_r1',$data);
				$this->load->view('layout/footer');
			}
		}
	//-----------------------
	public function consumo(){
		if(!$this->session->acceso_submenu_11==1){
			redirect(base_url().'Contrato');
		}else{

			$this->load->model(array('Mserie','Marticulo','Mmaquinas','Msolicitantes','Mcentrocosto'));
			$data['series']=$this->Mserie->listar_series();
			$data['codigos']=$this->Marticulo->getfromstkart();
			$data['maquinas']=$this->Mmaquinas->getmaquinas();
			$data['solicitantes']=$this->Msolicitantes->getsolicitantes();
			$data['areas']=$this->Mcentrocosto->getallcentros();
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('proyecto/consumo',$data);
			$this->load->view('layout/footer');
		}

	}

		public function recepcion(){
			if(!$this->session->acceso_submenu_14==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->model(array('Mdocumento'));

				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->model(array('Mserie'));
				$series['series']=$this->Mserie->listar_series();
				$this->load->view('proyecto/recepcion',$series);
				$this->load->view('layout/footer');
			}

		}
		public function transferencias(){
			if(!$this->session->acceso_submenu_14==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->model(array('Mdocumento','Malmacen','Mserie','Mtransaccion','Marticulo'));

				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$series['series']=$this->Mserie->listar_series();
				$series['almacenes']=$this->Malmacen->get();
				$series['transacciones']=$this->Mtransaccion->getxtipo('Transferencia');
				$series['articulos']=$this->Marticulo->getfromstkart();
				$this->load->view('proyecto/transferencias',$series);
				$this->load->view('layout/footer');
			}

		}
		public function devolucion_a_lima(){
			if(!true){
				redirect(base_url().'Contrato');
			}else{
				$this->load->model(array('Mserie','Mtransaccion','Marticulo'));
				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$series['series']=$this->Mserie->listar_series();
				$series['transacciones']=$this->Mtransaccion->getxtipo('Transferencia');
				$series['articulos']=$this->Marticulo->getfromstkart();
				$this->load->view('proyecto/devolucion',$series);
				$this->load->view('layout/footer');
			}
		}

		//--------------------------------consultas--------------------------------------------------------------------------------
		public function diferencias_activas(){
			if(!$this->session->acceso_submenu_16==1){
				redirect(base_url().'Contrato');
			}else{

				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->model(array('Mserie'));
				$series['series']=$this->Mserie->listar_series();
				$this->load->view('consultas/diferencias-activas',$series);
				$this->load->view('layout/footer');
			}

		}

		public function diferencias_cerradas(){
			if(!$this->session->acceso_submenu_17==1){
				redirect(base_url().'Contrato');
			}else{

				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->model(array('Mserie'));
				$series['series']=$this->Mserie->listar_series();
				$this->load->view('consultas/diferencias-cerradas',$series);
				$this->load->view('layout/footer');
			}

		}

		public function notas_ingreso(){
			if(!$this->session->acceso_submenu_18==1){
				redirect(base_url().'Contrato');
			}else{

				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->model(array('Mserie'));
				$series['series']=$this->Mserie->listar_series();
				$this->load->view('consultas/notas-de-ingreso',$series);
				$this->load->view('layout/footer');
			}

		}

		public function notas_salida(){
			if(!$this->session->acceso_submenu_19==1){
				redirect(base_url().'Contrato');
			}else{

				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->model(array('Mserie'));
				$series['series']=$this->Mserie->listar_series();
				$this->load->view('consultas/notas-de-salida',$series);
				$this->load->view('layout/footer');
			}

		}

		public function stock(){
			if(!$this->session->acceso_submenu_20==1){
				redirect(base_url().'Contrato');
			}else{

				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$this->load->model(array('Mserie'));
				$series['series']=$this->Mserie->listar_series();
				$this->load->view('consultas/stock-contrato',$series);
				$this->load->view('layout/footer');
			}

		}

		public function movimientos(){
			if(!$this->session->acceso_submenu_30==1){
				redirect(base_url().'Contrato');
			}else{

				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				//$this->load->model(array('Mserie'));
				//$series['series']=$this->Mserie->listar_series();
				$this->load->view('consultas/movimientos');
				$this->load->view('layout/footer');
			}

		}

		public function kardex_unidad(){
			if(!$this->session->acceso_submenu_22==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->model(array('Marticulo','Mserie'));
				$this->load->view('layout/header');
				$this->load->view('layout/menu');

				$series['series']=$this->Mserie->listar_series();
				$series['articulos']=$this->Marticulo->getfromstkart();

				$this->load->view('reportes/kardexunidad',$series);
				$this->load->view('layout/footer');
			}

		}
		public function costo_almacen(){
			if(!$this->session->acceso_submenu_21==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->model(array('Marticulo','Mserie','Mcierremes'));
				$this->load->view('layout/header');
				$this->load->view('layout/menu');

				$series['periodoscerrados']=$this->Mcierremes->getcierres($this->session->userdata('alm_id'));
				$series['series']=$this->Mserie->listar_series();
				$series['articulos']=$this->Marticulo->getfromstkart();

				$this->load->view('reportes/kardex-valorizado',$series);
				$this->load->view('layout/footer');
			}

		}

		public function recalculo_mes(){
			if(!$this->session->acceso_submenu_27==1){
				redirect(base_url().'Contrato');
			}else{

				$this->load->view('layout/header');
				$this->load->view('layout/menu');

				$this->load->view('procesos/recalculo_mes');
				$this->load->view('layout/footer');
			}
		}
		public function cierre_mes(){
			if(!$this->session->acceso_submenu_28==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->model(array('Mcierremes'));
				$data['periodo']=$this->Mcierremes->ultimo_mes_para_cerrar();
				$this->load->view('layout/header');
				$this->load->view('layout/menu');

				$this->load->view('procesos/cierre_mes',$data);
				$this->load->view('layout/footer');
			}
		}
		public function aperturar_mes(){
			if(!$this->session->acceso_submenu_29==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->model(array('Mcierremes'));
				$this->load->view('layout/header');
				$this->load->view('layout/menu');
$data['periodo']=$this->Mcierremes->getcierres($this->session->userdata('alm_id'));
				$this->load->view('procesos/apertura_mes',$data);
				$this->load->view('layout/footer');
			}
		}

		public function requerimiento_materiales(){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('proyecto/requerimiento_materiales');
			$this->load->view('layout/footer');
		}

		public function dashboard(){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->model(array('Mchart'));
			$data['ingresostotales']=$this->Mchart->getingresos($this->session->userdata('alm_id'));
			$data['salidastotales']=$this->Mchart->getsalidas($this->session->userdata('alm_id'));
			$data['codigotop']=$this->Mchart->get_articulo_1($this->session->userdata('alm_id'));
			$data['valoralmacen']=$this->Mchart->valor_almacen($this->session->userdata('alm_id'));
			$data['topcodigos']=$this->Mchart->get_topcodigos(10,$this->session->userdata('alm_id'));
			$data['topcodigosvalor']=$this->Mchart->get_topcodigos_valor(10,$this->session->userdata('alm_id'));
			$data['nmaquinas']=$this->Mchart->nmaquinas($this->session->userdata('alm_id'));
			$this->load->view('dashboards/dashbard1',$data);
			$this->load->view('layout/footer');
		}

		public function maquinas(){
			if(!$this->session->acceso_submenu_32==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->model(array('Mmaquinas'));
				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$data['maquinas']=$this->Mmaquinas->getmaquinas();
				$this->load->view('tabla-ayuda/maquinas',$data);
				$this->load->view('layout/footer');
			}
		}
		public function solicitantes(){
			if(!$this->session->acceso_submenu_33==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->model(array('Msolicitantes'));
				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$data['solicitantes']=$this->Msolicitantes->getsolicitantes();
				$this->load->view('tabla-ayuda/solicitantes',$data);
				$this->load->view('layout/footer');
			}
		}
		public function centros_de_costo(){
			if(!$this->session->acceso_submenu_34==1){
				redirect(base_url().'Contrato');
			}else{
				$this->load->model(array('Mcentrocosto'));
				$this->load->view('layout/header');
				$this->load->view('layout/menu');
				$data['centroscosto']=$this->Mcentrocosto->getallcentros();
				$this->load->view('tabla-ayuda/centroscostos',$data);
				$this->load->view('layout/footer');
			}
		}






	}
 ?>
