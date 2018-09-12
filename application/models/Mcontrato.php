<?php
	/**
	 *
	 */
	class Mcontrato extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
		}

		public function get($estado){

			$this->db->select("contratoid,nombre,centrocosto,estado");
			$this->db->from("contrato");
			if($estado!='all'){
			$this->db->where("estado",$estado);
			}
			$query=$this->db->get();

			return $query->result();
		}

		public function gettogin($estado,$usuario){
			$this->db->select('c.contratoid,c.nombre,centrocosto,c.estado');
			$this->db->from('acceso_almacen a');
			$this->db->join('usuario u ', 'a.usuarioid=u.usuarioid');
			$this->db->join('contrato c', 'c.contratoid=a.contratoid');
			$this->db->where('usuario', $usuario);
			$this->db->where('c.estado', $estado);
			$query=$this->db->get();
			return $query->result();
		}

		public function get_stocks($idalmacen,$serie){
				$this->db->select('*');
				$this->db->from('stkart');
				$this->db->where('contratoid', $idalmacen);
				$this->db->where('seriedocid', $serie);
				$query=$this->db->get();

				return $query->result();
		}
	}
 ?>
