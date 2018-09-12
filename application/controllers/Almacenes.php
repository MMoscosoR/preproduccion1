<?php
	/**
	 *
	 */
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Almacenes extends CI_Controller
	{

		function __construct()
		{
			parent::__construct();
			$this->load->model('Malmacen');
			$this->load->model('Mcorreo');
			$this->load->model('Mcorrelativo');
		}

		public function get(){
			$almacenes=$this->Malmacen->get();
			echo json_encode($almacenes);
		}
		public function get_by_id(){
			$idalmacen=$this->input->post('almacenid');
			$almacen=$this->Malmacen->get_by_id($idalmacen);
			echo json_encode($almacen);
		}

		public function save(){
			$accion=		$this->input->post('txtAccion');
			$idalmacen=		$this->input->post('txtIdalmacen');
			$nombrealmacen=		$this->input->post('txtNombre');
			$centrocosto=	$this->input->post('txtcentrocosto');
			$provincia=		$this->input->post('txtProvincia');
			$direccion=		$this->input->post('txtDireccion');
			$telefono=		$this->input->post('txtTelefono');
			$administrador=	$this->input->post('txtAdministrador');
			$correo_para=	$this->input->post('textCorreo_para');
			$correo_cc=		$this->input->post('textCorreo_cc');
			$estado=		$this->input->post('cbo_estado');
			if($estado=='on'){
				$estado=1;
			}
			if($estado=='off'){
				$estado=0;
			}

			$almacen = array('nombre' =>$nombrealmacen ,
										'centrocosto'=>$centrocosto,
										'direccion'=>$direccion,
										'provincia'=>$provincia,
										'telefono'=>$telefono,
										'administrador'=>$administrador,
										'estado'=>$estado,
										'correo_para'=>$correo_para,
										'correo_cc'=>$correo_cc
									);

			if($accion=='nuevo'){

				if($this->Malmacen->validar($centrocosto)<1){
						$id=$this->Malmacen->save($almacen);
					if($id!=0){
						$this->Mcorrelativo->crearCorrelativos($id);
						echo 'Guardado correctamente';
						$mensaje=$this->Mcorreo->nuevo_almacen($nombrealmacen);
						$this->Mcorreo->enviar_correo('marco.moscoso@rockdrillgroup.com,jose.adrian@rockdrillgroup.com','marco.moscoso@codrise.com','Creacion de nnuevo almacen',$mensaje);

					}

					else{
						echo 0;
					}
				}
			}
			if($accion=='editar'){
					if($this->Malmacen->update($almacen,$idalmacen)){
						echo 'Guardado correctamente';
					}else{
						echo 0;
					}
			}

		}

		public function get_stock(){
			$seriedoc=$this->input->post('seriedoc');
			$idalmacen=$this->session->userdata('alm_id');
			$data['stock']=$this->Malmacen->get_stock($idalmacen,$seriedoc);

			$this->load->view('secciones/consultas/stock_grid', $data);

		}
	}
 ?>
