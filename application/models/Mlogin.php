<?php
	/**
	 *
	 */
	class Mlogin extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
		}

		public function validacion($usuario,$clave,$contrato){
			$this->db->select('u.usuarioid,u.cargo,u.nombre,u.apepat,u.apemat,u.documento,u.correo,c.nombre contrato,c.centrocosto,c.contratoid,r.rol,r.rolid,a.acceso_almacenid');
			$this->db->from('usuario u');
			$this->db->join('acceso_almacen a','u.usuarioid=a.usuarioid and u.estado=1');
			$this->db->join('contrato c','c.contratoid=a.contratoid and c.estado=1');
			$this->db->join('roles r','a.rolid=r.rolid');
			$this->db->where('u.usuario',$usuario);
			$this->db->where('u.clave',$clave);
			$this->db->where('c.contratoid',$contrato);
			$query=$this->db->get();

			return $query;

		}
		public function getmenusaccesibles($accesoid,$contrato){
			$this->db->select('s.menuid');
			$this->db->from('detalle_rol dr');
			$this->db->join('acceso_almacen aa','aa.rolid=dr.rolid');
			$this->db->join('submenu s','s.submenuid=dr.submenuid');
			$this->db->where('aa.acceso_almacenid',$accesoid);
			$this->db->where('aa.contratoid',$contrato);
			$this->db->group_by('s.menuid');
			$query=$this->db->get();

			return $query->result();
		}
		public function getsubmenus($accesoid,$contrato){
			$this->db->select('dr.submenuid');
			$this->db->from('detalle_rol dr');
			$this->db->join('acceso_almacen aa','aa.rolid=dr.rolid');

			$this->db->where('aa.acceso_almacenid',$accesoid);
			$this->db->where('aa.contratoid',$contrato);
			$query=$this->db->get();

			return $query->result();
		}
	}
 ?>
