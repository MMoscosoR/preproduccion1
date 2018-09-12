<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcierremes extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public function ultimo_mes_para_cerrar(){
    $this->db->select('*');
    $this->db->from('cierre_mes');
    $this->db->where('idalmacen', $this->session->userdata('alm_id'));
    $this->db->order_by('fecha_cierre','desc');
    $this->db->limit(1);
    $query=$this->db->get();
    if($query->row()){
      $nuevoperiodo=strtotime ( '+1 month' , strtotime ( $query->row()->periodo ) );
      return date('Y-m',$nuevoperiodo);
    }
    else{
      $this->db->select('fecha');
      $this->db->from('movalmcab');
      $this->db->where('contratoid',$this->session->userdata('alm_id'));
      $this->db->order_by('fecha','asc');
      $this->db->limit(1);
      $query=$this->db->get();
      if($query->row()){
        return date('Y-m',strtotime($query->row()->fecha));
      }
      else {
        return 'NULL';
      }
    }

  }

  public function cerrar_mes($periodo){

    $periodoanterior=strtotime ( '-1 month' , strtotime ( $periodo ) );
    $periodoanterior=date('Y-m',$periodoanterior);
    $idalmacen=$this->session->userdata('alm_id');

    $this->db->trans_start();
      //insertar registro a cierre de mes para bloquear ingresos
      $mescerrado = array('idalmacen' =>$idalmacen,
                          'periodo'   => $periodo,
                          'fecha_cierre'=> date('Y-m-d H:i:s')
                       );
      $this->db->insert('cierre_mes', $mescerrado);

      //proceso de calculo e ingreo a moremes
          //select a toos las series de documentos
          $query_series=$this->db->get('serie_doc');
          $seriesdedocumentos=$query_series->result();

          foreach ($seriesdedocumentos as $key){

                $this->db->select('articuloid,seriearticulo');
                $this->db->from('stkart');
                $this->db->where('seriedocid', $key->serie_doc_id);
                $this->db->order_by('articuloid,seriearticulo');
                $query=$this->db->get();
                foreach ($query->result() as $key2) {

                  //select stock ultimo mes si no existe se considera 0
                    $this->db->select('cantidad,precio');
                    $this->db->from('moremes');
                    $this->db->where('idalmacen',$idalmacen);
                    $this->db->where('periodo', $periodoanterior);
                    $this->db->where('seriedoc', $key->serie_doc_id);
                    $this->db->where('codigoarticulo', $key2->articuloid);
                    $this->db->where('seriearticulo', $key2->seriearticulo);
                    $moremesprevio=$this->db->get();

                    $stockinicial=0;
                    $precioinicial=0;
                    if($moremesprevio->row()){
                      $stockinicial=$moremesprevio->row()->cantidad;
                      $precioinicial=$moremesprevio->row()->precio;
                    }
                    //stock neto del periodo
                      //ingresos
                        $this->db->select_sum('d.cantidad');
                        $this->db->from('movalmdet d');
                        $this->db->join('movalmcab c', 'd.movalmcabid=c.idmovalmcab');
                        $this->db->where('c.contratoid', $idalmacen);
                        $this->db->where('c.seriedocid', $key->serie_doc_id);
                        $this->db->where('month(c.fecha)',date('m',strtotime($periodo)));
                        $this->db->where('year(c.fecha)',date('Y',strtotime($periodo)));
                        $this->db->where('d.codigo', $key2->articuloid);
                        $this->db->where('d.serie', $key2->seriearticulo);
                        $this->db->where('c.tipo', 'NI');
                        $totalingresos=$this->db->get()->row()->cantidad;
                         //echo $this->db->last_query().'<br>';
                      //salidas
                        $this->db->select_sum('d.cantidad');
                        $this->db->from('movalmdet d');
                        $this->db->join('movalmcab c', 'd.movalmcabid=c.idmovalmcab');
                        $this->db->where('c.contratoid', $idalmacen);
                        $this->db->where('c.seriedocid', $key->serie_doc_id);
                        $this->db->where('month(c.fecha)',date('m',strtotime($periodo)));
                        $this->db->where('year(c.fecha)',date('Y',strtotime($periodo)));
                        $this->db->where('d.codigo', $key2->articuloid);
                        $this->db->where('d.serie', $key2->seriearticulo);
                        $this->db->where('c.tipo', 'NS');
                        $totalsalidas=$this->db->get()->row()->cantidad;
                      //neto
                        $neto=$totalingresos-$totalsalidas;
                        //precio promedio del moremes de $starsoft
                        $precioinicial=$this->actualizarprecios($key2->articuloid,$periodo);
                        //insercion en moremes
                        $data_para_moremes=array('idalmacen' => $idalmacen ,
                                                  'periodo' => $periodo,
                                                  'seriedoc' => $key->serie_doc_id,
                                                  'codigoarticulo'=> $key2->articuloid,
                                                  'seriearticulo' => $key2->seriearticulo,
                                                  'cantidad'     =>$neto,
                                                  'precio'       =>$precioinicial
                                                );
                          $this->db->insert('moremes', $data_para_moremes);
                    }



          }

    $this->db->trans_complete();


  }
  public function actualizarprecios($codigo,$periodo){
    $starsoft=$this->load->database('starsoft',TRUE);

    $starsoft->select('SMMNPREUNI');
    $starsoft->from('MORESMES');
    $starsoft->where('SMCODIGO', $codigo);
    $starsoft->where('SMMESPRO', str_replace('-','',$periodo));
    $query=$starsoft->get();
    if($query->row()){
      return $query->row()->SMMNPREUNI;
    }
    else{
      return 0.00;
    }

  }


    public function calculo_stock_periodo(){

    }

    public function getcierres($almacen){
      $this->db->select('*');
      $this->db->from('cierre_mes');
      $this->db->where('idalmacen', $almacen);
      $query=$this->db->get();
      return $query->result();
    }


  public function aperturar_mes($periodo,$almacen){
    $this->db->where('periodo',$periodo );
    $this->db->where('idalmacen', $almacen);
    $this->db->delete('moremes');

    $this->db->where('periodo',$periodo );
    $this->db->where('idalmacen', $almacen);
    $this->db->delete('cierre_mes');

  }




}
