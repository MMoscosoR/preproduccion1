<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdocumento extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More

  }

  public function save($cabecera,$detalle,$seriedoc,$tipodoc){
    //iniciar transaccion
    $error='';
    $this->db->trans_begin();

      //verificar si el mes esta cerrado


      //insertar cabecera
      $this->db->insert('movalmcab', $cabecera);
      //capturar id autoincrement
      $lastid=$this->db->insert_id();
      //array a retornar
      $data=array();
      //item correlativo
      $item=1;
      //capturar codigo en caso de error
      $codigoconerror='';
      //insercion del detalle
      foreach ($detalle as $key) {
        //solicitante area y maquina
          if(!isset($key->idsolicitante)){
            $key->idsolicitante=null;
          }
          if(!isset($key->area)){
            $key->area=null;
          }

          //validar si hay stock cuando es una salida si no rollback

          if(!$this->validarstockdisponible($key->DECODIGO,$key->DESERIE,$seriedoc,$cabecera['contratoid'],$key->DECANTID) and $tipodoc=='NS' and $key->DECANTID>0){
              $this->db->trans_rollback();
              $error='No hay stock -> codigo:'.$key->DECODIGO.' Serie: '.$key->DESERIE.'<br>';

          }else {
          //comprobar si existe en la vista alm_virtual de starsoft
          $startsoftarticulo=$this->getfromstarsoft($key->DECODIGO,$key->DESERIE);

          if (trim($key->DESERIE,' ')=='' or is_null($key->DESERIE)) {
              $key->DESERIE='NULL';
          }
          if($this->existe_stkart($key->DECODIGO,$key->DESERIE,$seriedoc,$cabecera['contratoid'])<1){//no existe
            //se inserta a stkart mysql de starsoft

              $newrowstkart = array('contratoid'     => $cabecera['contratoid'],
                                    'seriedocid'     => $seriedoc,
                                    'articuloid'     => $key->DECODIGO,
                                    'seriearticulo'  => $key->DESERIE,
                                    'stock'          =>0.0,
                                    'costo'          =>$startsoftarticulo->APRECOM,
                                    'fechaactualizacion'=>date('Y-m-d'),
                                    'descripcion'    =>utf8_encode($startsoftarticulo->ADESCRI),
                                    'familia'        =>$startsoftarticulo->AFAMILIA,
                                    'unidad'         =>$startsoftarticulo->AUNIDAD,
                                    'moneda'        =>$startsoftarticulo->ACODMON
                                   );
              $this->db->insert('stkart', $newrowstkart);
          }
          //registro del detalle
          $rowdetalle = array('movalmcabid' => $lastid,
                              'contratoid'  => $cabecera['contratoid'],
                              'seriedocid'  => $seriedoc,
                              'correlativo' => $cabecera['correlativo'],
                              'tipo'        => $tipodoc,
                              'item'        => $item,
                              'codigo'      => $key->DECODIGO,
                              'serie'       => $key->DESERIE,
                              'descripcion' => utf8_encode($startsoftarticulo->ADESCRI),
                              'familia'    =>  $startsoftarticulo->AFAMILIA,
                              'unidad'      => $startsoftarticulo->AUNIDAD,
                              'cantidad'    => $key->DECANTID,
                              'costo'       => $startsoftarticulo->APRECOM,
                              'maquina'     =>$key->MAQUINA,
                              'solicitante' =>$key->idsolicitante,
                              'area'        =>$key->area,
                              'doc_referencia'=>$key->DOC_REF,
                              'centro_costo' =>$cabecera['centrocosto'],
                              'fecha_creacion' => date('Y-m-d H:i:s'),
                              'estado'        =>$cabecera['estado']
                             );
              $this->db->insert('movalmdet', $rowdetalle);
        $item++;
        }
      }






      if ($error!='' or $this->db->trans_status() === FALSE)
      {//hubo un error en la transaccion
        $this->db->trans_rollback();
        if($tipodoc=='NS'){
          $data['msg']=$error;
          return $data;
        }else{
          $data['msg']='Se cargo codigos o series incorrectas';
          return $data;
        }

      }
      else{
        $this->db->trans_commit();
        //actualizar el $correlativo
        $this->db->set('correlativo','correlativo+1',FALSE);
        $this->db->where('contratoid',$cabecera['contratoid']);
        $this->db->where('serie_docid', $seriedoc);
        $this->db->where('tipo', $tipodoc);
        $this->db->update('correlativo');
        $data['last_id']=$lastid;
        $data['msg']='1';

        $this->db->select('correo_para,correo_cc');
        $this->db->from('contrato');
        $this->db->where('contratoid',$this->session->userdata('alm_id'));
        $querycorreos=$this->db->get()->row();
        $this->enviar_correo($querycorreos->correo_para,$querycorreos->correo_cc,$lastid);
        return $data;
      }
    }

    //funcion de envio de correo
    private function enviar_correo($destinatarios,$copiados,$iddoc){
    			$this->load->library('email');
    			$config['protocol'] = 'smtp';
          $data['detalle']=$this->get_detalle_doc($iddoc);
          $data['cabecera']=$this->get_cabecera_doc($iddoc);
        $mensaje=  $this->load->view('secciones/correo/guias', $data,TRUE);


    		       //El servidor de correo que utilizaremos
    		        //$config["smtp_host"] = 'mail.disad.pe';
                  $config["smtp_host"] = 'mail.codrise.com';
    		       //Nuestro usuario
    		        //$config["smtp_user"] = 'aplicaciones@disad.pe';
                  $config["smtp_user"] = 'marco.moscoso@codrise.com';
    		       //Nuestra contraseña
    		        //$config["smtp_pass"] = 'AplRock452';
                  $config["smtp_pass"] = 'CodMarMos122';
    		       //El puerto que utilizará el servidor smtp
    		        $config["smtp_port"] = '587';
                $config['smtp_crypto'] = 'tls';
    		       //El juego de caracteres a utilizar
    		        $config['charset'] = 'utf-8';

    		       //Permitimos que se puedan cortar palabras
    		        $config['wordwrap'] = TRUE;
                $config['smtp_timeout'] = '25';
    		       //El email debe ser valido
    		       $config['validate'] = true;

    		       $this->email->initialize($config);

    		       $this->email->from('aplicaciones@rockdrillgroup.com','Almacenes Rockdrill');

    		       $this->email->to($destinatarios);
    		       $this->email->subject($this->session->userdata('alm_nombre').' - '.'Guia de salida:'.$data['cabecera']->comentario);
    		       $this->email->cc($copiados);
    		       $this->email->message($mensaje);
    				$this->email->set_mailtype('html');
    		      if($this->email->send()){
    		      	return 'enviado';

    		      }
           			else{
           				return 'no enviado';
           			}
    		}



//solo verifica si existe un registro en stkart del articulo
  private function existe_stkart($codigo,$serieart,$seriedoc,$contratoid){
        if(trim($serieart,' ')=='' or is_null($serieart)){
          $serieart='NULL';
        }
        $this->db->select('articuloid');
        $this->db->from('stkart');
        $this->db->where('contratoid', $contratoid);
        $this->db->where('seriedocid', $seriedoc);
        $this->db->where('articuloid',$codigo);
        $this->db->where('seriearticulo', $serieart);
        $query=$this->db->get();
        return $query->num_rows();
}

//a partir del codigo y serie de un articulo busca en la vista alm_virtual
  public function getfromstarsoft($codigo,$serieart){
   $starsoft=$this->load->database('starsoft',TRUE);

    $starsoft->select('*');
    $starsoft->from('alm_virtual');
    $starsoft->where('ACODIGO',$codigo);
    if(trim($serieart,' ')=='' or $serieart=='NULL' or is_null($serieart)){
      $starsoft->where('STSSERIE is null');
    }else{
      $starsoft->where('STSSERIE',$serieart);
    }
    $query=$starsoft->get();

    //echo $starsoft->last_query();
    return $query->row(0);




  }

  //verifica si hay stock antes de realizar una salida
  private function validarstockdisponible($codigo,$serieart,$seriedoc,$almid,$stocksolicitado){
    $this->db->select('stock');
    $this->db->from('stkart');
    $this->db->where('contratoid', $almid);
    $this->db->where('seriedocid', $seriedoc);
    $this->db->where('articuloid',$codigo);
    if(trim($serieart,' ')==''){
      $this->db->where("seriearticulo",'NULL');
    }else{
      $this->db->where('seriearticulo', $serieart);
    }

    $query=$this->db->get();

    if($query->num_rows()==1){
      if(($query->row()->stock - $stocksolicitado)>=0){
        return true;
      }
      else{
        return false;
      }

    }
    else{
      return false;
    }
  }
  //lee la data cargada del excel que se guarda en sqlserver
  public function gettemporal(){
    $starsoft=$this->load->database('starsoft',TRUE);

    $starsoft->select("CODIGO DECODIGO,SERIE DESERIE,CANTIDAD DECANTID,MAQUINA,DOC_REF,idsolicitante,area");
    $starsoft->from('004BDAPLICACION..CARGA_EXCEL2');
    $starsoft->where('IDUSUARIO',$this->session->userdata('user_id'));
    $starsoft->where('CODIGO is not null');
    $query=$starsoft->get();

    return $query->result();
  }

  //obtiene una nota de ingreso a un contrato en estado 1
  public function get_ni_pendientes($almacen,$seriedoc){
    $this->db->select('m.*,t.nombre transaccion,u.nombre,u.apepat,c.nombre as contrato');
    $this->db->from('movalmcab m');
    $this->db->join('transaccion t', 'm.transaccionid = t.transaccionid');
    $this->db->join('usuario u', 'm.usuarioid = u.usuarioid');
    $this->db->join('contrato c', 'c.contratoid = m.contrato_destino','left');
    $this->db->where('seriedocid', $seriedoc);
    $this->db->where('m.contratoid', $almacen);
    $this->db->where('m.tipo','NI');
    $this->db->where('m.estado', 1);

    $query=$this->db->get();
    $this->db->last_query();
    return $query->result();
  }

  //detalle de un documento
  public function get_detalle_doc($idcabecera){
      $this->db->select('*');
      $this->db->from('movalmdet');
      $this->db->where('movalmcabid',$idcabecera);
      $query=$this->db->get();
      return $query->result();
  }
  public function get_cabecera_doc($idcabecera){
      $this->db->select("c.seriedocid,c.tipo,c.correlativo,a.nombre,c.comentario,a.centrocosto,c.fecha,concat(u.nombre,' ',u.apepat) as fullname");
      $this->db->from('movalmcab c');
      $this->db->join('contrato a','a.contratoid=c.contratoid');
      $this->db->join('usuario u','c.usuarioid=u.usuarioid');
      $this->db->where('idmovalmcab',$idcabecera);
      $query=$this->db->get();
      return $query->row();
  }
  //solo obtiene el numero de doc de una nota, vista recepcion
  public function get_nota_ingreso($idcabecera){
    $this->db->select('seriedocid,correlativo');
    $this->db->from('movalmcab');
    $this->db->where('idmovalmcab',$idcabecera);
    $query=$this->db->get();
    return $query->first_row()->seriedocid.str_pad($query->first_row()->correlativo, 7, "0", STR_PAD_LEFT);
  }

  //actualiza a estado 2 despues de confirmar un envio desde lima
  public function confirmar_recepcion($almacen,$seriedoc,$correlativo,$datos_tabla){
      $estado_cab=2;
      foreach ($datos_tabla as $key) {
          if($key['cantidad']!=$key['cant_recepcionado']){
              //si existe una diferencia la cabecera tiene estado 3->diferencia activa
              $estado_cab=3;
              //se actualiza el estado del detalle a 3
              $this->db->set('estado','3');
              $this->db->set('cantidad_enviada',$key['cantidad']);
              $this->db->set('cantidad',$key['cant_recepcionado']);
              $this->db->where('contratoid',$almacen);
              $this->db->where('seriedocid',$seriedoc);
              $this->db->where('correlativo',$correlativo);
              $this->db->where('item',$key['item']);
              $this->db->update('movalmdet');
          }
          else{
            $this->db->set('estado','2');
            $this->db->set('cantidad_enviada',$key['cantidad']);
            $this->db->where('contratoid',$almacen);
            $this->db->where('seriedocid',$seriedoc);
            $this->db->where('correlativo',$correlativo);
            $this->db->where('item',$key['item']);
            $this->db->where('tipo','NI');
            $this->db->update('movalmdet');
          }
      }

      $this->db->set('estado',$estado_cab);
      $this->db->where('contratoid',$almacen);
      $this->db->where('seriedocid',$seriedoc);
      $this->db->where('correlativo',$correlativo);
      $this->db->where('tipo','NI');
      $this->db->update('movalmcab');
      $this->db->last_query();
      return $estado_cab;

  }

  public function get_docs($idalmacen,$seriedoc,$tipo){
    $this->db->select('c.*,u.nombre,u.apepat,t.nombre transaccion');
    $this->db->from('movalmcab c');
    $this->db->join('usuario u','c.usuarioid=u.usuarioid');
    $this->db->join('transaccion t','t.transaccionid=c.transaccionid');
    $this->db->where('c.tipo', $tipo);
    $this->db->where('c.contratoid', $idalmacen);
    $this->db->where('c.seriedocid', $seriedoc);
    $query=$this->db->get();
    return $query->result();

  }

  public function get_dif_docs($idalmacen,$seriedoc,$tipo,$estado){
    $this->db->select('c.*,u.nombre,u.apepat,t.nombre transaccion');
    $this->db->from('movalmcab c');
    $this->db->join('usuario u','c.usuarioid=u.usuarioid');
    $this->db->join('transaccion t','t.transaccionid=c.transaccionid');
    $this->db->where('c.tipo', $tipo);
    $this->db->where('c.contratoid', $idalmacen);
    $this->db->where('c.seriedocid', $seriedoc);
    $this->db->where('c.estado', $estado);
    $query=$this->db->get();
    return $query->result();
  }

  public function borrarcarga(){

    $starsoft=$this->load->database('starsoft',TRUE);
    $starsoft->where('IDUSUARIO',$this->session->userdata('user_id'));
    $starsoft->delete('004BDAPLICACION..CARGA_EXCEL2');
  }

  public function eliminardoc($idmovalmcab){
    //verificar el tipo de Transaccion
    $this->db->select('*');
    $this->db->from('movalmcab');
    $this->db->where('idmovalmcab', $idmovalmcab);
    $query_cabecera=$this->db->get();
    $cabecera=$query_cabecera->row();

    $this->load->model(array('Mtransaccion'));
    $tipotrans=$this->Mtransaccion->get_tipo_x_trans($cabecera->transaccionid);

    if($tipotrans=='Transferencia'){
      if($cabecera->tipo=='NI'){
        //get salida id
        $this->db->select('referencia_salida');
        $this->db->from('movalmcab');
        $this->db->where('idmovalmcab', $idmovalmcab);
        $trans_query=$this->db->get();
        $salidaID=$trans_query->row()->referencia_salida;
        //delete de los documentos
        $this->db->trans_start(TRUE);
          //delete ingreso
          $this->db->where('movalmcabid',$idmovalmcab);
          $this->db->delete('movalmdet');

          $this->db->where('idmovalmcab', $idmovalmcab);
          $this->db->delete('movalmcab');

          //delete Salida

          $this->db->where('movalmcabid',$salidaID);
          $this->db->delete('movalmdet');

          $this->db->where('idmovalmcab', $salidaID);
          $this->db->delete('movalmcab');

          echo "1";
        $this->db->trans_complete();
      }
      if($cabecera->tipo=='NS'){
          //get id ingreso
          $this->db->select('idmovalmcab');
          $this->db->from('movalmcab');
          $this->db->where('referencia_salida', $idmovalmcab);
          $trans_query=$this->db->get();
          $ingresoID=$trans_query->row()->idmovalmcab;

          $this->db->trans_start();
            //delete ingreso
            $this->db->where('movalmcabid',$ingresoID);
            $this->db->delete('movalmdet');

            $this->db->where('idmovalmcab', $ingresoID);
            $this->db->delete('movalmcab');

            //delete Salida

            $this->db->where('movalmcabid',$idmovalmcab);
            $this->db->delete('movalmdet');

            $this->db->where('idmovalmcab', $idmovalmcab);
            $this->db->delete('movalmcab');
            echo "1";
          $this->db->trans_complete();

      }
    }

    else{
      $this->db->trans_start();

      $this->db->where('movalmcabid',$idmovalmcab);
      $this->db->delete('movalmdet');

      $this->db->where('idmovalmcab', $idmovalmcab);
      $this->db->delete('movalmcab');

        echo '1';
      $this->db->trans_complete();
    }
  }

  public function previo_eliminacion($idmovalmcab,$tipodoc){

    $this->db->select('m.*,c.nombre');
    $this->db->from('movalmcab m');
    $this->db->join('contrato c','c.contratoid=m.contratoid');
    $this->db->where('idmovalmcab', $idmovalmcab);
    $query_cabecera=$this->db->get();
    $cabecera=$query_cabecera->row();

    $this->load->model(array('Mtransaccion'));
    $tipotrans=$this->Mtransaccion->get_tipo_x_trans($cabecera->transaccionid);

      if($tipotrans=='Transferencia'){
          if($tipodoc=='NI'){
            $this->db->select('referencia_salida');
            $this->db->from('movalmcab');
            $this->db->where('idmovalmcab', $idmovalmcab);
            $trans_query=$this->db->get();
            $salidaID=$trans_query->row()->referencia_salida;

            $this->db->select('m.*,c.nombre');
            $this->db->from('movalmcab m');
            $this->db->join('contrato c','c.contratoid=m.contratoid');
            $this->db->where('idmovalmcab', $salidaID);
            $query_cabecera_salida=$this->db->get();
            $cabecera_salida=$query_cabecera_salida->row();
                echo 'Se eliminara el documento de '.$cabecera_salida->nombre.': NS '.$cabecera_salida->seriedocid.str_pad($cabecera_salida->correlativo, 7, "0", STR_PAD_LEFT).'<br>';
            $this->db->select('m.*,c.nombre');
            $this->db->from('movalmcab m');
            $this->db->join('contrato c','c.contratoid=m.contratoid');
            $this->db->where('idmovalmcab', $idmovalmcab);
            $query_cabecera_ingreso=$this->db->get();
            $cabecera_ingreso=$query_cabecera_ingreso->row();

            echo 'Se eliminara el documento de '.$cabecera_ingreso->nombre.': NI '.$cabecera_ingreso->seriedocid.str_pad($cabecera_ingreso->correlativo, 7, "0", STR_PAD_LEFT);
          }
          if($tipodoc=='NS'){
            $this->db->select('idmovalmcab');
            $this->db->from('movalmcab');
            $this->db->where('referencia_salida', $idmovalmcab);
            $trans_query=$this->db->get();
            $ingresoID=$trans_query->row()->idmovalmcab;

            $this->db->select('m.*,c.nombre');
            $this->db->from('movalmcab m');
            $this->db->join('contrato c','c.contratoid=m.contratoid');
            $this->db->where('idmovalmcab', $ingresoID);
            $query_cabecera_ingreso = $this->db->get();
            $cabecera_ingreso=$query_cabecera_ingreso->row();
                echo 'Se eliminara el documento de '.$cabecera_ingreso->nombre.': NI '.$cabecera_ingreso->seriedocid.str_pad($cabecera_ingreso->correlativo, 7, "0", STR_PAD_LEFT).'<br>';

                $this->db->select('m.*,c.nombre');
                $this->db->from('movalmcab m');
                $this->db->join('contrato c','c.contratoid=m.contratoid');
                $this->db->where('idmovalmcab', $idmovalmcab);
                $query_cabecera_salida=$this->db->get();
                $cabecera_salida=$query_cabecera_salida->row();

                echo 'Se eliminara el documento de '.$cabecera_salida->nombre.': NS '.$cabecera_salida->seriedocid.str_pad($cabecera_salida->correlativo, 7, "0", STR_PAD_LEFT);
          }
      }else{

        echo 'Se eliminara el documento de '.$cabecera->nombre.': '.$cabecera->seriedocid.str_pad($cabecera->correlativo, 7, "0", STR_PAD_LEFT);
      }
  }

  public function insertar_reporte_diferencia($reporte){
    $this->db->insert('reportediferencia', $reporte);

    $this->db->set('estado',4);
    $this->db->where('idmovalmcab',$reporte['iddocumento']);
    $this->db->update('movalmcab');

    $this->db->set('estado',4);
    $this->db->where('movalmcabid',$reporte['iddocumento']);
    $this->db->update('movalmdet');
  }

  public function guardar_archivo($archivo){
    $this->db->insert('archivos_reporte', $archivo);
  }

  public function getmovimientos($inicio,$fin){
      $this->db->select('d.seriedocid,d.correlativo,d.familia,c.tipo,d.item,d.codigo,d.serie,d.descripcion,d.unidad,d.cantidad,d.costo,d.maquina,d.doc_referencia,c.centrocosto,c.fecha,c.comentario,t.codigo as codigotrans');
      $this->db->from('movalmdet d');
      $this->db->join('movalmcab c','d.movalmcabid=c.idmovalmcab');
      $this->db->join('transaccion t', 't.transaccionid = c.transaccionid');
      $this->db->where('c.fecha >=',$inicio);
      $this->db->where('c.fecha <=',$fin);
      $this->db->where('d.contratoid', $this->session->userdata('alm_id'));
      $this->db->where('c.estado <>', 1);
      $query=$this->db->get();

      return $query->result();
  }






}
