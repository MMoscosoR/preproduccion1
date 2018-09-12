<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guiadesalida extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Mguiasalida'));
  }

  function index()
  {

  }

  public function getguias(){
    $stringrango= $this->input->post('rango');
    $inicio= date('Y-m-d',strtotime(substr(str_replace('/','-',$stringrango),0,10)));
    $fin=date('Y-m-d',strtotime(substr(str_replace('/','-',$stringrango),12,11)));
    $seriedoc=$this->input->post('seriedoc');
    $guias=$this->Mguiasalida->getguias($inicio,$fin,$seriedoc);
    echo json_encode($guias);
  }
  public function getdetalle(){
    $nguia=$this->input->post('nguiasalida');
    $guiadesalida=$this->Mguiasalida->getdetalle($nguia);
    $utf8detalles = array();
    foreach ($guiadesalida as $key) {
        $dato['item']=$key->DEITEM;
        $dato['codigo']=$key->DECODIGO;
        $dato['descripcion']=utf8_encode($key->DEDESCRI);
        $dato['serie']=$key->DESERIE;
        $dato['cantidad']=$key->DECANTID;
        $dato['unidad']=$key->DEUNIDAD;
        $utf8detalles[]=$dato;
    }

    echo json_encode($utf8detalles);
  }

  public function getdatosmodal(){
    $this->load->model(array('Mcorrelativo'));
    $correlativo=$this->Mcorrelativo->getcorrelativoactual($this->session->userdata('alm_id'),$this->input->post('seriedoc'),$this->input->post('tipodoc'));
    $data['correlativo']=$correlativo;
    $data['seriedoc']=$this->input->post('seriedoc');

    if($this->input->post('seriedoc')=='022' or $this->input->post('seriedoc')=='029'){
      $data['transaccionnombre']='<select name="form_transaccion" class="form-control"><option value="4">Ingreso de Lima Starsoft</option></select>';
      $data['transaccionid']='4';
        $data['guiasalida']=$this->input->post('guiasalida');
    }
    if($this->input->post('seriedoc')=='031'){
      $data['transaccionnombre']='<select name="form_transaccion" class="form-control"><option value="5">Ingreso de Lima Fuera de sistema</option></select>';
      $data['transaccionid']='5';
      $data['guiasalida']='';
    }
    $this->load->view('secciones/envios-lima/modal-confirmacion',$data);
  }

  public function gettabladetalle(){
    $nguia=$this->input->post('nguiasalida');
    $guiadesalida=$this->Mguiasalida->getdetalle($nguia);
    $utf8detalles = array();
    foreach ($guiadesalida as $key) {
        $dato['item']=$key->DEITEM;
        $dato['codigo']=$key->DECODIGO;
        $dato['descripcion']=utf8_encode($key->DEDESCRI);
        $dato['serie']=$key->DESERIE;
        $dato['cantidad']=$key->DECANTID;
        $dato['unidad']=$key->DEUNIDAD;
        $utf8detalles[]=$dato;
    }
    $data['detalles']=$utf8detalles;
      //echo json_encode($data['detalles']);
    $this->load->view('secciones/envios-lima/grid_detalle_guia', $data);
  }

}
