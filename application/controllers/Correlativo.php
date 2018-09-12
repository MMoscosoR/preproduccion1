<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Correlativo extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Mcorrelativo'));
  }

  function index()
  {

  }
  public function getall(){
    $correlativos=$this->Mcorrelativo->getcorrelativos($this->session->userdata('alm_id'));
    echo json_encode($correlativos);
  }

  public function save(){
    $serie=$this->input->post('txtSeriedoc');
    $correlativo=$this->input->post('correlativo');
    $contrato=  $this->session->userdata('alm_id');
    $tipodoc=$this->input->post('txtTipo');

    if($this->Mcorrelativo->exist($serie,$correlativo,$contrato,$tipodoc)<1){

        echo $this->Mcorrelativo->save($serie,$correlativo,$contrato,$tipodoc);
    }
    else{
      echo "El correlativo ya existe";
    }

  }
  public function get_correlativo(){
    $seriedoc=$this->input->post('seriedoc');

    $this->db->select('correlativo');
    $this->db->from('correlativo');
    $this->db->where('contratoid', $this->session->userdata('alm_id'));
    $this->db->where('serie_docid', $seriedoc);
    $this->db->where('tipo', $this->input->post('tipodoc'));
    $query=$this->db->get();
    echo  $query->row(0)->correlativo;
  }

  


}
