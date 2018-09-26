<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcentrocosto extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function getallcentros(){
    $this->db->select('*');
    $this->db->from('centrocostointerno');
    $this->db->where('contratoid', $this->session->userdata('alm_id'));
    $query=$this->db->get();
    return $query->result();
  }

  public function getlastcodigo(){
    $this->db->select_max('codigo');
    $this->db->where('contratoid',$this->session->userdata('alm_id'));
    $this->db->from('centrocostointerno');
    $query=$this->db->get();
    return $query->row()->codigo+1;
  }

  public function save($centrocosto){
    $this->db->insert('centrocostointerno', $centrocosto);
    if($this->db->affected_rows()>0){
      return 1;
    }
    else{
      return 0;
    }
  }
  public function update($centrocosto,$id){
    $this->db->where('idcentrocosto', $id);
    $this->db->update('centrocostointerno', $centrocosto);
    if($this->db->affected_rows()>0){
      return 1;
    }
    else{
      return 0;
    }
  }

  public function getareabyid($id){
    $this->db->select('*');
    $this->db->from('centrocostointerno');
    $this->db->where('codigo',$id);
    $this->db->where('contratoid',$this->session->userdata('alm_id'));
    $query=$this->db->get();
    return $query->num_rows();
  }

}
