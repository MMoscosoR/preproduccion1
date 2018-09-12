<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcargaexcel extends CI_Model{

  public function __construct()
  {
    parent::__construct();

  }

  public function insertar_temporal($data){

    $starsoft=$this->load->database('starsoft',TRUE);
      //
      if(!isset($data['idsolicitante'])){
          $data['idsolicitante']=null;
        }
        if( $data['idsolicitante']==''){
            $data['idsolicitante']=null;
        }
        if(!isset($data['area'] )){
          $data['area']=null;
        }
        if($data['area']==''){
          $data['area']=null;
        }

      //
      $starsoft->select('*');
      $starsoft->from('004bdaplicacion..CARGA_EXCEL2');
      $starsoft->where('CODIGO',$data['CODIGO']);
      $starsoft->where('SERIE',$data['SERIE']);
      $starsoft->where('IDUSUARIO',$this->session->userdata('user_id'));
      $query=$starsoft->get();
      if($query->num_rows()>0 and false){
        $starsoft->set('CANTIDAD','CANTIDAD+'.$data['CANTIDAD'].'',FALSE);
        $starsoft->where('CODIGO',$data['CODIGO']);
        $starsoft->where('SERIE',$data['SERIE']);
        $starsoft->where('IDUSUARIO',$this->session->userdata('user_id'));
        $starsoft->update('004bdaplicacion..CARGA_EXCEL2');
      }
      else{
        $data2= array('CODIGO' =>$data['CODIGO'] ,
                        'SERIE'  =>$data['SERIE'],
                        'CANTIDAD'=>$data['CANTIDAD'],
                        'MAQUINA'=>$data['MAQUINA'],
                        'DOC_REF'=>$data['DOC_REF'],
                        'IDUSUARIO'=>$this->session->userdata('user_id'),
                        'idsolicitante'=>$data['idsolicitante'],
                        'area'=>$data['area']
                       );
        $starsoft->insert('004bdaplicacion..CARGA_EXCEL2', $data2);

      }

  }

  public function listarcarga(){
    $starsoft=$this->load->database('starsoft',TRUE);

    $starsoft->select("t.*,case when ADESCRI IS null then 'Codigo o serie no existe' else ADESCRI end ADESCRI");
    $starsoft->from('004BDAPLICACION..CARGA_EXCEL2 t');
    $starsoft->join('alm_virtual m',"t.codigo=m.acodigo and  (t.SERIE=m.stsserie or (t.serie='' and m.stsserie is null) )",'left');
    $starsoft->where('t.IDUSUARIO',$this->session->userdata('user_id'));
    $query=$starsoft->get();

    $temporal=$query->result();

    $utf8carga=array();
    foreach ($temporal as $key) {
        $data['item']=$key->ID;
        $data['codigo']=$key->CODIGO;
        $data['serie']=$key->SERIE;
        $data['cantidad']=$key->CANTIDAD;
        $data['maquina']=$key->MAQUINA;
        $data['docref']=$key->DOC_REF;
        $data['descripcion']=utf8_encode($key->ADESCRI);

        //Adjuntar el stock actual a la vista de carga

        $this->db->select('stock');
        $this->db->from('stkart');
        $this->db->where('seriedocid','031');
        $this->db->where('contratoid',14);
        $this->db->where('articuloid', $key->CODIGO);
        //cambiar null por 'NULL'
        if(trim($key->SERIE,' ')=='' or is_null($key->SERIE)){$key->SERIE='NULL';}
        $this->db->where('seriearticulo',$key->SERIE);
        $query=$this->db->get();

        if ($query->num_rows()>0) {
            $data['stockactual']=$query->row()->stock;
        }
        if($query->num_rows()==0){
              $data['stockactual']='0';
        }


      $utf8carga[]=$data;


    }
      return $utf8carga;
  }

  public function eliminar($id){
    $starsoft=$this->load->database('starsoft',TRUE);
      $starsoft->where('id',$id);
      $starsoft->delete('004BDAPLICACION..CARGA_EXCEL2');

  }

  public function consumo_listar_temporal($seriedoc){
    $starsoft=$this->load->database('starsoft',TRUE);
    $starsoft->select("t.*,case when ADESCRI IS null then 'Codigo o serie no existe' else ADESCRI end ADESCRI");
    $starsoft->from('004BDAPLICACION..CARGA_EXCEL2 t');
    $starsoft->join('alm_virtual m',"t.codigo=m.acodigo and  (t.SERIE=m.stsserie or (t.serie='' and m.stsserie is null) )",'left');
    $starsoft->where('t.IDUSUARIO',$this->session->userdata('user_id'));
    $starsoft->order_by('ID');
    $query=$starsoft->get();

    $temporal=$query->result();
    if($query->num_rows()>0){
      foreach ($temporal as $key) {
          $data['item']=$key->ID;
          $data['codigo']=$key->CODIGO;
          $data['serie']=$key->SERIE;
          $data['cantidad']=$key->CANTIDAD;
          $data['maquina']=$key->MAQUINA;
          $data['docref']=$key->DOC_REF;
          $data['descripcion']=utf8_encode($key->ADESCRI);

          //Adjuntar el stock actual a la vista de carga

          $this->db->select('stock');
          $this->db->from('stkart');
          $this->db->where('seriedocid',$seriedoc);
          $this->db->where('contratoid',$this->session->userdata('alm_id'));
          $this->db->where('articuloid', $key->CODIGO);
          //cambiar null por 'NULL'
          if(trim($key->SERIE,' ')=='' or is_null($key->SERIE)){$key->SERIE='NULL';}
          $this->db->where('seriearticulo',$key->SERIE);
          $query=$this->db->get();

          if ($query->num_rows()>0) {
              $data['stockactual']=$query->row()->stock;
          }
          if($query->num_rows()==0){
                $data['stockactual']='0';
          }


        $utf8carga[]=$data;


      }
      return $utf8carga;
    }else{
      return 0;
    }

  }


}
