<?php

/**
 *
 */
class Login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Mlogin');
	}

	public function index(){
		$this->load->view('loguinView');
	}

	public function validacion(){
		$usuario=$this->input->post('txtUsuario');
		$pass=	$this->input->post('txtClave');
		$contrato =$this->input->post('contrato');

		$acceso=$this->Mlogin->validacion($usuario,$pass,$contrato);

		if($datos=$acceso->row()){
			$parametros=array(
				'user_id'=>$datos->usuarioid,
				'user_nombre'=>$datos->nombre,
				'user_apepat'=>$datos->apepat,
				'user_apemat'=>$datos->apemat,
				'user_dni'=>$datos->documento,
				'user_correo'=>$datos->correo,
				'user_cargo'=>$datos->cargo,
				'alm_nombre'=>$datos->contrato,
				'alm_cc'=>$datos->centrocosto,
				'alm_id'=>$datos->contratoid,
				'rol_nombre'=>$datos->rol,
				'rol_id'=>$datos->rolid,
				'acceso_id'=>$datos->acceso_almacenid
				);
			$this->session->set_userdata($parametros);

			//acceso a menus con acceso
			$menus_permitidos=$this->Mlogin->getmenusaccesibles($datos->acceso_almacenid,$datos->contratoid);
			foreach ($menus_permitidos as $key) {
			//asignacion a la session
				$this->session->set_userdata('acceso_menu_'.$key->menuid,1);
			}

			//acceso a submenus
			$submenus_permitidos=$this->Mlogin->getsubmenus($datos->acceso_almacenid,$datos->contratoid);
			//asignacion a la sesion
			foreach ($submenus_permitidos as $key) {
				$this->session->set_userdata('acceso_submenu_'.$key->submenuid,1);
			}
			echo '1';

		}
		else{

			echo'<div class="alert alert-danger alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-ban"></i> Error</h4>
                 Usted no cuenta con acceso a este almacen o ingreso un usuario incorrecto...
                 </div>';
		}


	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('Login');
	}
}
 ?>
