<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mserie extends CI_Model{

  public function __construct()
  {
    parent::__construct();

  }
  public function listar_series(){
    $this->db->select('*');
    $this->db->from('serie_doc');
    $query=$this->db->get();

    return $query->result();

  }

}
