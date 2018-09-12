<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mreporte extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_saldo_inicial($almacen,$seriedoc,$codigo,$serieart,$fecha){

    $periodoanterior=strtotime ( '-1 month' , strtotime ( $fecha ) );
    $periodoanterior=date('Y-m',$periodoanterior);
    //ultimo periodo cerrado menor a la fecha
      $this->db->select('periodo');
      $this->db->from('cierre_mes');
      $this->db->where('idalmacen',$almacen);
      $this->db->where('periodo <=',date('Y-m',strtotime($periodoanterior)));
      $this->db->order_by('periodo','desc');
      $this->db->limit('1');
      $query=$this->db->get();

      if($query->row()){
        $ultimo_mes_cerrado= $query->row()->periodo;
        $this->db->select('cantidad');
        $this->db->from('moremes');
        $this->db->where('idalmacen',$almacen);
        $this->db->where('periodo', $ultimo_mes_cerrado);
        $this->db->where('seriedoc',$seriedoc);
        $this->db->where('codigoarticulo', $codigo);
        $this->db->where('seriearticulo', $serieart);
        $query2=$this->db->get();
        if($query2->row()){
            $saldo_mes_cerrado=$query2->row()->cantidad;
        }else{
           $saldo_mes_cerrado=0;
        }
      }
      else{
         $saldo_mes_cerrado=0;
      }

      //calcular saldo hasta la fecha
      //ingresos
        $this->db->select_sum('d.cantidad');
        $this->db->from('movalmdet d');
        $this->db->join('movalmcab c', 'd.movalmcabid=c.idmovalmcab');
        $this->db->where('c.contratoid', $almacen);
        $this->db->where('c.seriedocid', $seriedoc);
        $this->db->where('c.estado <>', 1);
        if($query->row()){
          $this->db->where('c.fecha>=',date('Y-m-d',strtotime($ultimo_mes_cerrado)));
        }
        $this->db->where('c.fecha<',date('Y-m-d',strtotime($fecha)));
        $this->db->where('d.codigo', $codigo);
        $this->db->where('d.serie', $serieart);
        $this->db->where('c.tipo', 'NI');
         $totalingresos=$this->db->get()->row()->cantidad;

         //salidas
         $this->db->select_sum('d.cantidad');
         $this->db->from('movalmdet d');
         $this->db->join('movalmcab c', 'd.movalmcabid=c.idmovalmcab');
         $this->db->where('c.contratoid', $almacen);
         $this->db->where('c.seriedocid', $seriedoc);
         $this->db->where('c.estado <>', 1);
         if($query->row()){
           $this->db->where('c.fecha>=',date('Y-m-d',strtotime($ultimo_mes_cerrado)));
         }
         $this->db->where('c.fecha<',date('Y-m-d',strtotime($fecha)));
         $this->db->where('d.codigo', $codigo);
         $this->db->where('d.serie', $serieart);
         $this->db->where('c.tipo', 'NS');
         $totalsalidas=$this->db->get()->row()->cantidad;

        return $neto=$saldo_mes_cerrado+$totalingresos-$totalsalidas;


  }

  public function getmovimientos($almacen,$seriedoc,$codigo,$serie,$fechainicial,$fechafin){
    $this->db->select('d.seriedocid,d.correlativo,d.tipo,d.cantidad,c.fecha,t.nombre');
    $this->db->from('movalmcab c');
    $this->db->join('movalmdet d', 'd.movalmcabid = c.idmovalmcab');
    $this->db->join('transaccion t', 't.transaccionid = c.transaccionid');
    $this->db->where('c.contratoid', $almacen);
    $this->db->where('c.seriedocid', $seriedoc);
    $this->db->where('d.codigo', $codigo);
    $this->db->where('d.serie', $serie);
    $this->db->where('c.estado <>', 1);
    $this->db->where('c.fecha >=', date('Y-m-d',strtotime($fechainicial)));
    $this->db->where('c.fecha <=', date('Y-m-d',strtotime($fechafin)));
    $query=$this->db->get();
    return $query->result();
  }

  public function getvalorizado($almacen,$seriedoc,$periodo){
    $this->db->select('m.*,s.descripcion,s.costo,s.unidad');
    $this->db->from('moremes m');
    $this->db->join('stkart s', 's.articuloid = m.codigoarticulo and s.seriearticulo=m.seriearticulo ');
    $this->db->where('m.idalmacen', $almacen);
    $this->db->where('m.periodo', $periodo);
    $this->db->where('m.seriedoc', $seriedoc);
    $query=$this->db->get();

    return $query->result();

  }



}
