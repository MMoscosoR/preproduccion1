<?php
	/**
	 *
	 */
	class Perfil extends CI_Controller
	{

		function __construct()
		{
			parent::__construct();
			$this->load->model('Mperfil');
		}
		public function getperfiles(){
			$perfiles=$this->Mperfil->getperfiles();

			echo json_encode($perfiles);
		}

		public function get_accesos(){
			$rolid=$this->input->post('rolid');

			$accesos=$this->Mperfil->get_accesos($rolid);

			echo json_encode($accesos);


		}

		public function save(){
			$accion=$this->input->post('txtAccion');
			if ($accion=='nuevo') {
				$nombreperfil=$this->input->post('txtNombre');

				$submenus=$this->Mperfil->getsubmenus();
					foreach ($submenus as $key) {
						$acceso[$key->submenuid]=$this->input->post($key->submenuid);
					}
			echo	$this->Mperfil->save($nombreperfil,$acceso);

			}
			if ($accion=='editar') {
				$nombreperfil=$this->input->post('txtNombre');
				$idperfil=$this->input->post('txtIdperfil');
				$submenus=$this->Mperfil->getsubmenus();
					foreach ($submenus as $key) {
						$acceso[$key->submenuid]=$this->input->post($key->submenuid);
					}
					echo $this->Mperfil->update($nombreperfil,$acceso,$idperfil);
			}

		}

	}
 ?>
