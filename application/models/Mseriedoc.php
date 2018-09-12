<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mseriedoc extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function getseries(){
    $query=  $this->db->get('serie_doc');
    return $query->result();

  }
}
