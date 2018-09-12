<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mguiasalida extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getguias($inicio,$fin,$seriedoc){
    $starsoft=$this->load->database('starsoft',TRUE);

    $starsoft->select('CANUMDOC');
    $starsoft->from('MOVALMCAB c');
    $starsoft->join('004BDAPLICACION.dbo.GUIAS_SALIDAS g','c.CANUMDOC=g.DOCUMENTO','left');
    $starsoft->where('LEFT(CANUMDOC,3)',$seriedoc);
    $starsoft->where('CATD','GS');
    $starsoft->where('CACODMOV','SO');
    $starsoft->where('CAALMA','01');
    $starsoft->where('CAFECDOC >=',str_replace('-','',$inicio));
    $starsoft->where('CAFECDOC <=',str_replace('-','',$fin));
    $starsoft->where('g.DOCUMENTO is null');
    $starsoft->order_by('CANUMDOC','asc');
    $query=$starsoft->get();
		return $query->result();
  }
  public function getdetalle($numero){
    $starsoft=$this->load->database('starsoft',TRUE);

    $starsoft->select("DEITEM,DECODIGO,DEDESCRI,DESERIE,DECANTID,DECANTENT,DEUNIDAD,MAQUINA='',DOC_REF=''");
    $starsoft->from('MOVALMDET');
    $starsoft->where('DENUMDOC',$numero);
    $starsoft->order_by('DEITEM');
    $query=$starsoft->get();

    return $query->result();
  }

  public function guardarguia($guia){
    $starsoft=$this->load->database('starsoft',TRUE);
    $starsoft->insert('004BDAPLICACION..GUIAS_SALIDAS',$guia);
  }
}
