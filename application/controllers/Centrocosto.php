<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Centrocosto extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Mcentrocosto'));
  }

  function index()
  {

  }

  public function save(){
    $maquina=$this->input->post('descripcion');
    $idmaquina=$this->input->post('idcentrocosto');
    $contrato=$this->input->post('contrato');
    $codigo=$this->Mcentrocosto->getlastcodigo();

    if($idmaquina==''){
      $objeto = array('descripcion' => $maquina,
                      'contratoid' =>$contrato,
                      'codigo' => $codigo
                    );
      if($this->Mcentrocosto->save($objeto)==1){
        echo 'Registrado exitosamente';
      }
      else{
        echo 'No se registro';
      }
    }
    else{
      $objeto = array('descripcion' => $maquina,
                      'contratoid' =>$contrato
                    );
      if($this->Mcentrocosto->update($objeto,$idmaquina)==1){
        echo 'Actualizado exitosamente';
      }
      else{
        echo 'No se actualizo ningun registro';
      }
    }
  }

}
