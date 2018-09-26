<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msolicitantes extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function getsolicitantes(){
    $this->db->select('*');
    $this->db->from('solicitantes');
    $this->db->where('contratoid', $this->session->userdata('alm_id'));
    $query=$this->db->get();
    return $query->result();
  }
  public function getlastcodigo(){
    $this->db->select_max('codigo');
    $this->db->where('contratoid',$this->session->userdata('alm_id'));
    $this->db->from('solicitantes');
    $query=$this->db->get();
    return $query->row()->codigo+1;
  }

  public function save($solicitante){
    $this->db->insert('solicitantes', $solicitante);
    if($this->db->affected_rows()>0){
      return 1;
    }
    else{
      return 0;
    }
  }
  public function update($solicitante,$id){
    $this->db->where('idsolicitante', $id);
    $this->db->update('solicitantes', $solicitante);
    if($this->db->affected_rows()>0){
      return 1;
    }
    else{
      return 0;
    }
  }

  public function getsolicitantebyid($id){
    $this->db->select('*');
    $this->db->from('solicitantes');
    $this->db->where('codigo',$id);
    $this->db->where('contratoid',$this->session->userdata('alm_id'));
    $query=$this->db->get();
    return $query->num_rows();
  }
}
