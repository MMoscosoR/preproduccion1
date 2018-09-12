<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Htmltopdf extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->library('pdf');
    $this->load->model(array('Mdocumento'));
  }

  function index()
  {

  }
  public function documentospdf($id){

    $paper_size = array(0,0,0,-1);
    $data['detalle']=$this->Mdocumento->get_detalle_doc($id);
    $data['cabecera']=$this->Mdocumento->get_cabecera_doc($id);
    $html_content = $this->load->view('pdf/detalledocumento', $data,TRUE);

      $this->pdf->set_paper($paper_size);
      $this->pdf->set_paper('A4','letter');
      ini_set("memory_limit","10000M");
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$this->pdf->stream("prueba.pdf", array("Attachment"=>0));
  }

  public function kardex_unidad($pagina){
    $paper_size = array(0,0,0,-1);
    $data['detalle']=$this->Mdocumento->get_detalle_doc($id);
    $data['cabecera']=$this->Mdocumento->get_cabecera_doc($id);
    $html_content = urldecode($pagina);

      $this->pdf->set_paper($paper_size);
      $this->pdf->set_paper('A4','letter');
      ini_set("memory_limit","10000M");
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$this->pdf->stream("prueba.pdf", array("Attachment"=>0));
  }

}
