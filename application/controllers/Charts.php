<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Charts extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Mchart'));
  }

  function index()
  {

  }

  public function topcantidades(){
    $data=$this->Mchart->get_topcodigos(5,$this->session->userdata('alm_id'));
    if($data!=-1){
      echo json_encode($data);
    }
  }

}
