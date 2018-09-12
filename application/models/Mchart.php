<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mchart extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_topcodigos($n,$contrato){
    $this->db->select('codigo,sum(cantidad) cantidad,descripcion ');
    $this->db->from('movalmdet');
    $this->db->where('contratoid',$contrato );
    $this->db->where('estado !=', 1);
    $this->db->group_by('codigo,descripcion');
    $this->db->order_by('2','desc');
    $this->db->limit($n);
    $query=$this->db->get();

    if ($query->num_rows()>0) {
      return json_encode($query->result());
    }
    else{
      return -1;
    }

  }
  public function get_topcodigos_valor($n,$contrato){
    $this->db->select('codigo,sum(cantidad*costo) cantidad,descripcion ');
    $this->db->from('movalmdet');
    $this->db->where('contratoid',$contrato );
    $this->db->where('estado !=', 1);
    $this->db->group_by('codigo,descripcion');
    $this->db->order_by('2','desc');
    $this->db->limit($n);

    $query=$this->db->get();
    if ($query->num_rows()>0) {
      return json_encode($query->result());
    }
    else{
      return -1;
    }

  }
  public function getingresos($contrato){
    $this->db->select('idmovalmcab');
    $this->db->from('movalmcab');
    $this->db->where('contratoid', $contrato);
    $this->db->where('tipo', 'NI');
    $query=$this->db->get();
    return $query->num_rows();
  }
  public function getsalidas($contrato){
    $this->db->select('idmovalmcab');
    $this->db->from('movalmcab');
    $this->db->where('contratoid', $contrato);
    $this->db->where('tipo', 'NS');
    $query=$this->db->get();
    return $query->num_rows();
  }
  public function get_articulo_1($contrato){
    $this->db->select('descripcion,codigo,sum(cantidad) cantidad,unidad ');
    $this->db->from('movalmdet');
    $this->db->where('contratoid',$contrato );
    $this->db->where('estado !=', 1);
    $this->db->group_by('descripcion,codigo,unidad');
    $this->db->order_by('3','desc');
    $this->db->limit(1);

    $query=$this->db->get();
    
    if ($query->num_rows()>0) {
      return ($query->row());
    }
    else{
      return -1;
    }
  }

  public function valor_almacen($contratoid){
    $this->db->select('sum(stock*costo) valoralmacen');
    $this->db->from('stkart');
    $this->db->where('contratoid', $contratoid);

    $query=$this->db->get();
    return $query->row()->valoralmacen;
  }


}
