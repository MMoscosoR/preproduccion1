<?php
	/**
	 *
	 */
	class Mperfil extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
		}

		public function getperfiles(){
			$this->db->select('rolid,rol');
			$this->db->from('roles');
			if($this->session->rol_id!=1){
			$this->db->where('rolid !=',1);
			}
			$query=$this->db->get();
			return $query->result();
		}

		public function getmenus(){
			$query=$this->db->get('menu');
			return $query->result();

		}

		public function getsubmenus(){
			$this->db->select('*');
			$this->db->from('submenu');
			$this->db->where('estado',1);
			$query=$this->db->get();

			return $query->result();


		}

		public function get_accesos($rolid){
			$this->db->select('submenuid');
			$this->db->from('detalle_rol');
			$this->db->where('rolid', $rolid);
			$query=$this->db->get();
			return $query->result();
		}

		public function save($nombre,$accesos){
			$rol = array('rol' =>$nombre ,
										'estado'=>1,
										'fecha_creacion'=>date('Y-m-d H:i:s')
									 );
			if($this->db->insert('roles', $rol)){
				$rolid=$this->db->insert_id();
				$submenus=$this->getsubmenus();
				foreach ($submenus as $key) {
						if($accesos[$key->submenuid]=='on'){
							$detalle_rol = array('submenuid' => $key->submenuid,
																		'rolid'		=>$rolid
																	 );
							$this->db->insert('detalle_rol', $detalle_rol);
						}
				}
				return 1;
			}
			else{
				return 0;
			}


		}

		public function update($nombre,$accesos,$idperfil){
			$rol = array('rol' =>$nombre ,
										'estado'=>1,
										'fecha_creacion'=>date('Y-m-d H:i:s')
									 );
		//	if($this->are_profile_asigned($idperfil)<1){
				if($this->db->update('roles', $rol,"rolid=".$idperfil."")){
						$this->db->where('rolid',$idperfil);
						$this->db->delete('detalle_rol');
						$submenus=$this->getsubmenus();
						foreach ($submenus as $key) {
								if($accesos[$key->submenuid]=='on'){
									$detalle_rol = array('submenuid' => $key->submenuid,
																				'rolid'		=>$idperfil
																			 );
									$this->db->insert('detalle_rol', $detalle_rol);
								}
						}
					return 1;
				}
				else{
					return 0;
				}
		//	}
		//	else{
		//		return 10;
		//	}
		}

		private function are_profile_asigned($rolid){
			$this->db->select('acceso_almacenid');
			$this->db->from('acceso_almacen');
			$this->db->where('rolid', $rolid);
			$query=$this->db->get();
			return $query->num_rows();
		}




	}
 ?>
