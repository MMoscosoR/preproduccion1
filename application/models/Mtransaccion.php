<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtransaccion extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function getall(){
    $query=$this->db->get('transaccion');
    return $query->result();
  }

  public function save($datos){
      if($this->db->insert('transaccion', $datos)){
        return 1;
      }
      else{
        return 0;
      }
  }
  public function update($datos,$id){
    if($this->db->update('transaccion', $datos,'transaccionid='.$id.'')){
      return 1;
    }
    else{
      return 0;
    }
  }

  public function getxtipo($tipo){
    $this->db->select('*');
    $this->db->from('transaccion');
    $this->db->where('tipo', $tipo);
    $query=$this->db->get();

    return $query->result();
  }

  public function get_tipo_x_trans($idtrans){
    $this->db->select('tipo');
    $this->db->from('transaccion');
    $this->db->where('transaccionid', $idtrans);
    $query=$this->db->get();
    return $query->first_row()->tipo;
  }

}
