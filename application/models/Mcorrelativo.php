<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcorrelativo extends CI_Model{

  public function __construct()
  {
    parent::__construct();

  }

  public function getcorrelativos($contrato){
    $this->db->select('c.*,s.nombre');
    $this->db->from('correlativo c');
    $this->db->join('serie_doc s','s.serie_doc_id=c.serie_docid');
    $this->db->where('c.contratoid',$contrato);
    $query=$this->db->get();

    return $query->result();
  }
  public function save($serie,$correlativo,$contrato,$tipodoc){
      $datos = array('correlativo' =>$correlativo);
      if($this->exist($serie,$correlativo,$contrato,$tipodoc)<1){
        if($this->db->update('correlativo', $datos,'contratoid='.$contrato.' and serie_docid='.$serie.' and tipo=\''.$tipodoc.'\' ')){
          return 1;
        }
        else {
          echo 'Ocurrio un error y no se guardo el cambio';
        }

      }
      else{
        return "Error no se actualizo el correlativo";
      }
  }

  //validar si el correlativo ya existe
  public function exist($serie,$correlativo,$contrato,$tipodoc){
    $this->db->select('*');
    $this->db->from('movalmcab');
    $this->db->where('seriedocid',$serie);
    $this->db->where('contratoid', $contrato);
    $this->db->where('correlativo', $correlativo);
    $this->db->where('tipo', $tipodoc);
    $query=$this->db->get();
    return $query->num_rows();
  }


  public function getcorrelativoactual($contratoid,$seriedoc,$tipodoc){
    $this->db->select('correlativo');
    $this->db->from('correlativo');
    $this->db->where('contratoid', $contratoid);
    $this->db->where('serie_docid', $seriedoc);
    $this->db->where('tipo', $tipodoc);
    $query=$this->db->get();

    return $query->row(0)->correlativo;


  }

  public function crearCorrelativos($almacen){
      $this->db->select("".$almacen." as contratoid,serie_doc_id as serie_docid,'NI' AS tipo,0 as correlativo");
      $this->db->from('serie_doc');
      $query=$this->db->get();

      $this->db->insert_batch('correlativo',$query->result_array());

      $this->db->select("".$almacen." AS contratoid,serie_doc_id as serie_docid,'NS' AS tipo,0 as correlativo");
      $this->db->from('serie_doc');
      $query=$this->db->get();
      $this->db->insert_batch('correlativo',$query->result_array());
  }
}
