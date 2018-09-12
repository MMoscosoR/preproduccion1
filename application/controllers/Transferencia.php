<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transferencia extends CI_Controller{

  public function __construct()
  {
    parent::__construct();

  }

  function index()
  {

  }
  public function listarDetalle(){
    $seriedoc=$this->input->post('seriedoc');
    $this->load->model(array('Mcargaexcel'));
    if($this->Mcargaexcel->consumo_listar_temporal($seriedoc)==0){
      $carga['detalle']=0;
    }
    $carga['detalle']=$this->Mcargaexcel->consumo_listar_temporal($seriedoc);
    $this->load->view('secciones/transferencia/detalle.php',$carga);
  }

}
