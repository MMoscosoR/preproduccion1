<?php
	/**
	 *
	 */
	class Marticulo extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
		}

		public function get($start,$length,$search){
			$starsoft=$this->load->database('starsoft',TRUE);

			#ignorar codigo se realiza en la funcion prueba
			#---------------------------------------------------------------------------------------
			$predicado='';
			if($search!=''){
				$predicado="and (ADESCRI like '%".$search."%' or AFAMILIA like '%".$search."%' or AUNIDAD like '%".$search."%' or ACODIGO like '%".$search."%' or STSSERIE like '%".$search."%')";
			}

			$datos2=$starsoft->query("SELECT a.* FROM (SELECT m.ADESCRI,AFAMILIA,AUNIDAD,m.ACODIGO,s.STSSERIE, ROW_NUMBER() OVER (ORDER BY 						acodigo,stsserie) as ROW from maeart m left join STKSERI s on s.STSCODIGO=m.ACODIGO
									where m.aestado='V' ".$predicado."  )a
									WHERE a.row >".$start." and a.row <=".($start+$length)."");

			#----------------------------------------no borrar porque causara error,-----------------------------------------------------------

			$nrow=$starsoft->query("SELECT count(1) ncant from maeart m left join STKSERI s on s.STSCODIGO=m.ACODIGO
									where m.aestado='V' and (AFSTOCK='S' or AFSERIE='S') and m.ACODIGO<>'TEXTO' ".$predicado."");
			$numerodefilas=$nrow->row()->ncant;

			$retornar = array(
					'numdata' =>$numerodefilas ,
					'data'=>$datos2);
			return $retornar;
		}




		public function prueba($start,$length,$search){
			$starsoft=$this->load->database('starsoft',TRUE);

			$predicado='';
			if($search!=''){
				$predicado="and (ADESCRI like '%".$search."%' or AFAMILIA like '%".$search."%' or AUNIDAD like '%".$search."%' or ACODIGO like '%".$search."%' or STSSERIE like '%".$search."%')";
			}
			$datos2=$starsoft->query("SELECT a.* FROM (SELECT m.ADESCRI,AFAMILIA,AUNIDAD,m.ACODIGO,s.STSSERIE, ROW_NUMBER() OVER (ORDER BY 						acodigo,stsserie) as ROW from maeart m left join STKSERI s on s.STSCODIGO=m.ACODIGO
									where m.aestado='V' and (AFSTOCK='S' or AFSERIE='S') and m.ACODIGO<>'TEXTO' ".$predicado."  )a
									WHERE a.row >".$start." and a.row <=".($start+$length)."");

			return $datos2;
		}

		public function getall(){
			$starsoft=$this->load->database('starsoft',TRUE);
			$query=$starsoft->query("SELECT ADESCRI,AFAMILIA,AUNIDAD,ACODIGO FROM maeart m where m.aestado='V' and (AFSTOCK='S' or AFSERIE='S' ) and m.ACODIGO<>'TEXTO' ");
			return $query->result();
		}
		public function getfichatecnica($codigo){
			$starsoft=$this->load->database('starsoft',TRUE);
			$query=$starsoft->query("SELECT ACOMENTA FROM MAEART where ACODIGO='".$codigo."'");
			return $query->row()->ACOMENTA;
		}

		public function getfromstkart(){
			$this->db->select('articuloid,descripcion');
			$this->db->from('stkart');
			$this->db->where('contratoid',$this->session->userdata('alm_id'));
			$this->db->group_by('articuloid,descripcion');
			$query=$this->db->get();
			return $query->result();
		}

		public function getseriesdsponibles($codigo,$almacen){
			$this->db->select('seriearticulo');
			$this->db->from('stkart');
			$this->db->where('articuloid',$codigo);
			$this->db->where('contratoid',$almacen);
			$query=$this->db->get();
			return $query->result();
		}
		public function articuloFromStkart($almacen,$seriedoc,$codigo){

			$this->db->select('s1.descripcion,s2.stock,s1.unidad');
			$this->db->from('stkart s1');
			$this->db->join('stkart s2','s1.articuloid=s2.articuloid and s2.contratoid='.$almacen.' and s2.seriedocid='.$seriedoc.'','left');
			$this->db->where('s1.articuloid', $codigo);

			$query=$this->db->get();
			return $query->row();


		}
		public function getdatos($almacen,$seriedoc,$codigo){
			$this->db->select('descripcion,unidad');
			$this->db->from('stkart');
			$this->db->where('articuloid',$codigo);
			$this->db->limit('1');
			$query=$this->db->get();
			$this->db->last_query();
			return $query->row();
		}

	}
 ?>
