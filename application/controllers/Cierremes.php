<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cierremes extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model(array('Mcierremes'));
  }

  function index()
  {

  }

  public function pruebas(){
    $this->Mcierremes->ultimo_mes_para_cerrar();
  }

  public function cierre_mes(){

      $periodo=$this->input->post('periodo');
      $this->Mcierremes->cerrar_mes($periodo);
  }
  public function aperturar_mes(){
    $periodo=$this->input->post('periodo');
    $almacen=$this->session->userdata('alm_id');
    $this->Mcierremes->aperturar_mes($periodo,$almacen);
  }

}
