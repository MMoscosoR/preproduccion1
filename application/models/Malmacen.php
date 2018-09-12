<?php
	/**
	 *
	 */
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Malmacen extends CI_Model
	{

		function __construct()
		{
			parent::__construct();

		}

		public function get(){
			$this->db->select('*');
			$this->db->from('contrato');
			$query=$this->db->get();

			return $query->result();
		}

		public function get_by_id($id){
			$this->db->select('*');
			$this->db->from('contrato');
			$this->db->where('contratoid',$id);
			$query=$this->db->get();

			return $query->result();
		}

		public function validar($cc){
			$this->db->select('*');
			$this->db->from('contrato');
			$this->db->where('centrocosto',$cc);
			$query=$this->db->get();

			return $query->num_rows();
		}

		public function save($almacen){


			if($this->db->insert('contrato',$almacen)){
				$last_id = $this->db->insert_id();

				$this->db->distinct();
				$this->db->select('usuarioid');
				$this->db->from('acceso_almacen');
				$this->db->where('rolid',1);
				$query=$this->db->get();
				foreach ($query->result() as $key) {
					$this->insertarAccesos($key->usuarioid,$last_id,1);
				}

				return $last_id;
			}else{
				return 0;
			}
		}

		public function update($almacen,$id){
			$this->db->where('contratoid',$id);
			$this->db->update('contrato',$almacen);
			if($this->db->affected_rows()>0){
				return 1;
			}
			else{
				return 0;
			}
		}

		private function insertarAccesos($usuarioid,$contratoid,$rolid){
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

		public function get_stock($idalmacen,$seriedoc){
			$this->db->select('*');
			$this->db->from('stkart');
			$this->db->where('contratoid',$idalmacen);
			$this->db->where('seriedocid',$seriedoc);
			$query=$this->db->get();
			return $query->result();

		}
	}
 ?>
