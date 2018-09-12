<?php
	/**
	 *
	 */
	class Usuarios extends CI_Controller
	{

		function __construct()
		{
			parent::__construct();
			$this->load->model('Musuario');
			$this->load->model('Mcontrato');
			$this->load->model('Mperfil');
		}

		public function index(){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('usuarios/grid_usuarios');
			$this->load->view('layout/footer');
		}

		public function get(){
			$usuarios=$this->Musuario->get($this->session->userdata('rol_id'),$this->session->userdata('alm_id'));

			echo json_encode($usuarios);
		}
		public function save(){
			$tipoaccion=$this->input->post('txtAccion');

			$datos['usuarioid']=$this->input->post('txtIdusuario');
			$datos['nombre']=$this->input->post('txtNombres');
			$datos['apepat']=$this->input->post('txtApepat');
			$datos['apemat']=$this->input->post('txtApemat');
			$datos['documento']=$this->input->post('txtDni');
			$datos['correo']=$this->input->post('txtCorreo');
			$datos['estado']=1;
			$datos['usuario']=$this->input->post('txtDni');
			$datos['cargo']=$this->input->post('txtCargo');
			$datos['clave']=$this->input->post('txtDni');
			$datos['fecha_creacion']=date('Y-m-d H:i:s');

			$datos['rolid']=$this->input->post('cbotipo');

			if($this->Musuario->validar($datos['documento'],$datos['usuarioid'])<1){

				if($tipoaccion=='nuevo'){

					//insertar a la tabla usuario
					$usuarioid_inserted=$this->Musuario->insertarUsuario($datos);
					if($usuarioid_inserted != 0){
						//si se inserta, insertamos sus accesos
						if($this->session->rol_id==1){
							$contratos=$this->Mcontrato->get(1);

							foreach ($contratos as $key) {
								$resultado=$this->Musuario->insertarAccesos($usuarioid_inserted,$key->contratoid,$this->input->post('cbo_tipo_'.$key->contratoid));

							}
							ECHO 'Nuevo usuario registrado';
						}
						if($this->session->rol_id!=1){
							$this->Musuario->insertarAccesos($usuarioid_inserted,$this->session->alm_id,$this->input->post('cbotipo'));
						}
					}
					else{
						echo 'No se grabo correctamente';
					}


				}
				if($tipoaccion=='editar'){

					if($this->session->rol_id==1){

						$nuevos_datos = array('nombre' => $datos['nombre'],
												'apepat' => $datos['apepat'],
												'apemat' => $datos['apemat'],
												'documento'=>$datos['documento'],
												'correo' => $datos['correo'],
												'estado' => 1,
												'cargo'  => $datos['cargo']
											);


						$this->Musuario->updateUsuario($nuevos_datos,$datos['usuarioid']);
						$contratos=$this->Mcontrato->get(1);

						foreach ($contratos as $key) {
							$resultado=$this->Musuario->updateaccesos($datos['usuarioid'],$this->input->post('cbo_tipo_'.$key->contratoid),$key->contratoid);

						}

					}
					if($this->session->rol_id==2){

						$nuevos_datos = array('nombre' => $datos['nombre'],
											  'apepat' => $datos['apepat'],
											  'apemat' => $datos['apemat'],
											  'documento'=>$datos['documento'],
											  'correo' => $datos['correo'],
											  'estado' => 1,
											  'cargo'  => $datos['cargo']
											);

						$this->Musuario->updateUsuario($nuevos_datos,$datos['usuarioid']);
						$this->Musuario->updateaccesos($datos['usuarioid'],$this->input->post('cbotipo'),$this->session->alm_id);
					}

				}

			}
			else{
				echo 'Ya existe un usuario registrado con ese DNI';
			}


		}

		public function accesos(){
			$usuarioid=$this->input->post('usuarioid');
			$data['accesos']=$this->Musuario->getaccesos($usuarioid);
			$data['perfiles']=$this->Mperfil->getperfiles();
			$this->load->view('usuarios/grid_accesos',$data);
		}
	}
 ?>
