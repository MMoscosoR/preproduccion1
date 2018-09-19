<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitantes extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Msolicitantes'));
  }

  function index()
  {

  }

  public function save(){
    $solicitante=$this->input->post('fullname');
    $idsolicitante=$this->input->post('idsolicitante');
    $contrato=$this->input->post('contrato');
    $codigo=$this->Msolicitantes->getlastcodigo();

    if($idsolicitante==''){
      $objeto = array('fullname' => $solicitante,
                      'contratoid' =>$contrato,
                      'codigo' =>$codigo
                    );

      if($this->Msolicitantes->save($objeto)==1){
        echo 'Registrado exitosamente';
      }
      else{
        echo 'No se registro';
      }
    }
    else{
      $objeto = array('fullname' => $solicitante,
                      'contratoid' =>$contrato                      
                    );
      if($this->Msolicitantes->update($objeto,$idsolicitante)==1){
        echo 'Actualizado exitosamente';
      }
      else{
        echo 'No se actualizo ningun registro';
      }
    }
  }

}
