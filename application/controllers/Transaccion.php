<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaccion extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model(array('Mtransaccion'));
  }

  function index()
  {

  }
  public function getall(){
    $transacciones=$this->Mtransaccion->getall();
    echo json_encode($transacciones);
  }

  public function save(){
    $estado='';
    if($this->input->post('estado')=='on'){
      $estado=1;
    }
    if($this->input->post('estado')=='off'){
      $estado=0;
    }

    $datos = array('codigo' => $this->input->post('txtCodigo'),
                    'nombre'=>$this->input->post('txtDescripcion'),
                    'tipo'=>$this->input->post('sel_tipo'),
                    'estado'=>$estado
                   );
        if($this->input->post('accion')=='nuevo'){
          echo $this->Mtransaccion->save($datos);
        }

        if($this->input->post('accion')=='editar'){
          echo $this->Mtransaccion->update($datos,$this->input->post('txtIdtransac'));
        }

  }
  public function gettransacciones(){
    $tipo=$this->input->post('tipo');
    $transacciones=$this->Mtransaccion->getxtipo($tipo);
    echo json_encode($transacciones);
  }



}
