<?php
	/**
	 *
	 */
	class Musuario extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
		}

		public function get($tipousuario,$contrato){

			$this->db->select('u.usuarioid,nombre,apepat,apemat,documento,correo,u.estado,cargo,a.acceso_almacenid,a.rolid,r.rol');
			$this->db->from('usuario u');
			$this->db->join('acceso_almacen a','u.usuarioid=a.usuarioid and a.contratoid='.$contrato.'','left');
			$this->db->join('roles r','r.rolid=a.rolid and r.estado=1','left');
			//$this->db->where('a.contratoid',$contrato);
			if($this->session->rol_id!=1){
				$this->db->where('a.rolid !=',1);
			}
			$query=$this->db->get();

			return $query->result();
		}
		public function validar($dni,$usuarioid){
			$this->db->select('usuarioid');
			$this->db->from('usuario');
			$this->db->where('documento',$dni);
			if($usuarioid!=''){
			$this->db->where('usuarioid !=',$usuarioid);
			}
			$query=$this->db->get();

			return $query->num_rows();
		}
		public function getaccesos($usuarioid){
			$this->db->select('c.contratoid,c.nombre,centrocosto,acceso_almacenid,rolid');
			$this->db->from('contrato c');
			$this->db->join('acceso_almacen a ','c.contratoid=a.contratoid and a.usuarioid='.$usuarioid.'','left');
			$this->db->where('c.estado',1);
			$query=$this->db->get();

			return $query->result();
		}

		public function insertarUsuario($usuario){
			$datos = array('usuarioid' => $usuario['usuarioid'],
							'nombre' => $usuario['nombre'],
							'apepat' =>$usuario['apepat'] ,
							'apemat' => $usuario['apemat'],
							'documento' => $usuario['documento'],
							'correo' => $usuario['correo'],
							'estado' => $usuario['estado'],
							'usuario' => $usuario['usuario'],
							'cargo' => $usuario['cargo'],
							'clave' => $usuario['clave'],
							'fecha_creacion' => $usuario['fecha_creacion']
							);

			if($this->db->insert('usuario',$datos)){
				return $this->db->insert_id();
			}
			else{
				return 0;
			}



		}

		public function insertarAccesos($usuarioid,$contratoid,$rolid){
			$datos = array('rolid' => $rolid,
							'usuarioid'=>$usuarioid,
							'contratoid'=>$contratoid,
							'fecha_creacion'=>date('Y-m-d H:i:s')
							 );
			if($rolid!=0){
				if($this->db->insert('acceso_almacen',$datos)){
					$accesoid= $this->db->insert_id();

					$this->db->select('submenuid,'.$accesoid.' as accesoid');
					$this->db->from('detalle_rol');
					$this->db->where('rolid',$rolid);
					$query=$this->db->get();

					if(true){
						return 1;
					}
					else{
						return 0;
					}

				}
				else{
					return 0;
				}
			}else{
				return 0;
			}

		}

		public function updateUsuario($datos,$idusuario){

			$this->db->where('usuarioid',$idusuario);
			$this->db->update('usuario',$datos);

		}
		public function updateaccesos($idusuario,$rol,$contrato){

			if($rol==0){

				$this->db->where('usuarioid',$idusuario);
				$this->db->where('contratoid',$contrato);
				$this->db->delete('acceso_almacen');
	/*
				$this->db->where('accesoid',$this->get_acceso_id($idusuario,$contrato));
				$this->db->delete('privilegio');*/
			}
			else{
				$this->db->select('*');
				$this->db->from('acceso_almacen');
				$this->db->where('usuarioid',$idusuario);
				$this->db->where('contratoid',$contrato);
				$query=$this->db->get();
				if($query->num_rows()==0){
					$datosacceso = array('rolid' => $rol,
															'usuarioid'=>$idusuario,
															'contratoid'=>$contrato,
															'fecha_creacion'=>date('Y-m-d H:i:s')
														 );
					$this->db->insert('acceso_almacen', $datosacceso);
				}
				else{
					$this->db->set('rolid',$rol);
					$this->db->where('usuarioid',$idusuario);
					$this->db->where('contratoid',$contrato);
					$this->db->update('acceso_almacen');
				}



				/*
				//borrar privilegios actuales
				$this->db->where('accesoid',$this->get_acceso_id($idusuario,$contrato));
				$this->db->delete('privilegio');

				//nuevos privilegios

				$this->db->select('submenuid,'.$this->get_acceso_id($idusuario,$contrato).' as accesoid');
				$this->db->from('detalle_rol');
				$this->db->where('rolid',$rol);
				$query=$this->db->get();

				$this->db->insert_batch('privilegio',$query->result());
				*/
				echo $this->db->last_query();
			}
		}
		private function get_acceso_id($idusuario,$contrato){
			$this->db->select('acceso_almacenid');
			$this->db->from('acceso_almacen');
			$this->db->where('usuarioid',$idusuario);
			$this->db->where('contratoid',$contrato);
			$query=$this->db->get();
			return $query->row()->acceso_almacenid;
		}




	}
 ?>
