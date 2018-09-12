<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmaquinas extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getmaquinas(){
    $this->db->select('*');
    $this->db->from('maquinas');
    $this->db->where('idcontrato',$this->session->userdata('alm_id'));
    $query=$this->db->get();

    return $query->result();

  }

  public function save($maquina){
    $this->db->insert('maquinas', $maquina);
    if($this->db->affected_rows()>0){
      return 1;
    }
    else{
      return 0;
    }
  }
  public function update($maquina,$id){
    $this->db->where('idmaquina', $id);
    $this->db->update('maquinas', $maquina);
    if($this->db->affected_rows()>0){
      return 1;
    }
    else{
      return 0;
    }
  }
}
