<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documento extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Mdocumento','Mcorrelativo','Mguiasalida'));
  }

  function index()
  {

  }

  public function eliminar(){

    $idmovalcab=$this->input->post('movalmcabid');
    //obtener mes del documento
    $this->db->select('fecha');
    $this->db->from('movalmcab');
    $this->db->where('idmovalmcab',$idmovalcab);
    $query=$this->db->get();
    $fecha=$query->row()->fecha;
    //verificar si el mes esta cerrado
    $this->db->select('periodo');
    $this->db->from('cierre_mes');
    $this->db->where('periodo', date('Y-m',strtotime($fecha)));
    $this->db->where('idalmacen', $this->session->userdata('alm_id'));
    $mes=$this->db->get();

    if($mes->row()){
          echo "El mes ya esta cerrado";
    }else{
      $this->Mdocumento->eliminardoc($idmovalcab);
    }


  }

  public function previo_eliminacion(){
      $id=$this->input->post('iddoc');
      $tipodoc=$this->input->post('tipodoc');
      $this->Mdocumento->previo_eliminacion($id,$tipodoc);
  }



  public function creardocumentos(){
    $this->load->model(array('Mtransaccion','Mcorrelativo','Malmacen','Mguiasalida'));
    //id transaccion a registrar
    $transaccionid=$this->input->post('form_transaccion');
    //get tipo de transaccion "ingreso,salida,transferencia"
    $tipotrans=$this->Mtransaccion->get_tipo_x_trans($transaccionid);

    switch ($tipotrans) {
      case 'Ingreso':
      //inicio igreso
        $cabecera = array('contratoid'   =>$this->session->userdata('alm_id') ,
                          'seriedocid'     =>$this->input->post('nidocid'),
                          'correlativo'  =>$this->input->post('nicorrelativo'),
                          'fecha'        =>$this->input->post('nifecha'),
                          'tipo'         =>'NI',
                          'centrocosto'  =>$this->session->userdata('alm_cc'),
                          'comentario'   =>$this->input->post('nicomentario'),
                          'usuarioid'    =>$this->session->userdata('user_id'),
                          'transaccionid'=>$this->input->post('form_transaccion'),
                          'estado'       =>($this->input->post('nguiasalida')=='')?'2':'1',
                          'fecha_registro'=>date('Y-m-d')
                         );
          //obtiene el detalle de la tabla temporal
            //si nguia tiene valor
            if($this->input->post('nguiasalida')==''){
              $detguia=$this->Mdocumento->gettemporal();



            }
            else{
              $detguia=$this->Mguiasalida->getdetalle($this->input->post('nguiasalida'));
              //insertar la guia para que no se vuelva a mostrar
              $guia = array('DOCUMENTO' => $this->input->post('nguiasalida'),
                            'FECHA'     =>date('Ymd H:i:s')
                             );
              $this->Mguiasalida->guardarguia($guia);
            }

          //verificar si el mes esta cerrado
            $this->db->select('periodo');
            $this->db->from('cierre_mes');
            $this->db->where('periodo', date('Y-m',strtotime($this->input->post('nifecha'))));
            $this->db->where('idalmacen', $this->session->userdata('alm_id'));
            $mes=$this->db->get();
          //se registra el documento y retorna 1 enc caso d exito
            if($mes->row()){
                  echo "El mes ya esta cerrado";
            }
            else{
                    $resultado= $this->Mdocumento->save($cabecera,$detguia,$this->input->post('nidocid'),'NI');
                    echo $resultado['msg'];
                    //si se registra se borra el temporal
                    if($resultado['msg']=='1'){
                      $this->Mdocumento->borrarcarga();
                    }

            }
        //fin reporte
        break;


      case 'Salida':
        $cabecera = array('contratoid'   =>$this->session->userdata('alm_id') ,
                          'seriedocid'   =>$this->input->post('nidocid'),
                          'correlativo'  =>$this->input->post('nicorrelativo'),
                          'fecha'        =>$this->input->post('nifecha'),
                          'tipo'         =>'NS',
                          'centrocosto'  =>$this->session->userdata('alm_cc'),
                          'comentario'   =>$this->input->post('nicomentario'),
                          'usuarioid'    =>$this->session->userdata('user_id'),
                          'transaccionid'=>$this->input->post('form_transaccion'),
                          'estado'       =>2,
                          'fecha_registro'=>date('Y-m-d')
                         );
          //obtiene el detalle de la tabla temporal
          $detguia=$this->Mdocumento->gettemporal();



          //verificar si el mes esta cerrado
            $this->db->select('periodo');
            $this->db->from('cierre_mes');
            $this->db->where('periodo', date('Y-m',strtotime($this->input->post('nifecha'))));
            $this->db->where('idalmacen', $this->session->userdata('alm_id'));
            $mes=$this->db->get();
          //se registra el documento y retorna 1 enc caso d exito
            if($mes->row()){
                  echo "El mes ya esta cerrado";
            }
            else{
              //se registra el documento y retorna 1 enc caso d exito
              $rs= $this->Mdocumento->save($cabecera,$detguia,$this->input->post('nidocid'),'NS')['msg'];
              echo $rs;
              if($rs=='1'){
                $this->Mdocumento->borrarcarga();
              }
            }



        break;
      case 'Transferencia':
            //identificar almacen de salida y el de entrada
              $almacen_salida;
              $almacen_ingreso;

              //si la transaccion es envio 027 automaticamente cojer salida r1 y llegada al almacen actualizar
            if($transaccionid=='5'){
                //colocar el id de r1
                $almacen_salida='14';
                $almacen_salida_cc=$this->Malmacen->get_by_id($almacen_salida)[0]->centrocosto;
                $seriedoc_salida=$this->input->post('nidocid');

                $almacen_ingreso=$this->session->userdata('alm_id');
                $almacen_ingreso_cc=$this->Malmacen->get_by_id($almacen_ingreso)[0]->centrocosto;
                $seriedoc_ingreso=$this->input->post('nidocid');
            }
            elseif($transaccionid=='6'){

              $almacen_salida=$this->session->userdata('alm_id');
              $almacen_salida_cc=$this->Malmacen->get_by_id($almacen_salida)[0]->centrocosto;
              $seriedoc_salida=$this->input->post('nidocid');

              $almacen_ingreso='14';
              $almacen_ingreso_cc=$this->Malmacen->get_by_id($almacen_ingreso)[0]->centrocosto;
              if($this->input->post('form_estado')=='usado'){
                $seriedoc_ingreso='031';
              }
              else{
                $seriedoc_ingreso='029';
              }


            }
            else{
              $almacen_salida=$this->session->userdata('alm_id');;
              $almacen_salida_cc=$this->Malmacen->get_by_id($almacen_salida)[0]->centrocosto;
              $seriedoc_salida=$this->input->post('nidocid');

              $almacen_ingreso=$this->input->post('contrato_destino');
              $almacen_ingreso_cc=$this->Malmacen->get_by_id($almacen_ingreso)[0]->centrocosto;
              $seriedoc_ingreso=$this->input->post('nidocid');
            }
            //identificar sus respectivos correlativos
             $correlativo_alm_salida=$this->Mcorrelativo->getcorrelativoactual($almacen_salida,$this->input->post('nidocid'),'NS');
             $correlativo_alm_ingreso=$this->Mcorrelativo->getcorrelativoactual($almacen_ingreso,$this->input->post('nidocid'),'NI');
            //verificar si el mes esta $mescerrado
            //almacen salida
            $this->db->select('periodo');
            $this->db->from('cierre_mes');
            $this->db->where('periodo', date('Y-m',strtotime($this->input->post('nifecha'))));
            $this->db->where('idalmacen', $almacen_salida);
            $mes_salida=$this->db->get();

            //almacen ingreso
            $this->db->select('periodo');
            $this->db->from('cierre_mes');
            $this->db->where('periodo', date('Y-m',strtotime($this->input->post('nifecha'))));
            $this->db->where('idalmacen', $almacen_ingreso);
            $mes_ingreso=$this->db->get();

            if(!$mes_salida->row() and !$mes_ingreso->row()){

            //ejecutar mtodo de guardado de documentos

            $cabecera_salida = array('contratoid'   =>$almacen_salida,
                              'seriedocid'     =>$seriedoc_salida,
                              'correlativo'  =>$correlativo_alm_salida,
                              'fecha'        =>$this->input->post('nifecha'),
                              'tipo'         =>'NS',
                              'centrocosto'  =>$almacen_salida_cc,
                              'comentario'   =>$this->input->post('nicomentario'),
                              'usuarioid'    =>$this->session->userdata('user_id'),
                              'transaccionid'=>$this->input->post('form_transaccion'),
                              'contrato_destino'=>$almacen_ingreso,
                              'estado'       =>2,
                              'fecha_registro'=>date('Y-m-d')
                             );
              $detalle=$this->Mdocumento->gettemporal();
              $resultado=$this->Mdocumento->save($cabecera_salida,$detalle,$seriedoc_salida,'NS');

              if($resultado['msg']=='1'){

                //si no hay error en la noa de salida se crea la nota de ingreso
                $cabecera_ingreso = array('contratoid'   =>$almacen_ingreso,
                                  'seriedocid'     =>$seriedoc_ingreso,
                                  'correlativo'  =>$correlativo_alm_ingreso,
                                  'fecha'        =>$this->input->post('nifecha'),
                                  'tipo'         =>'NI',
                                  'centrocosto'  =>$almacen_ingreso_cc,
                                  'comentario'   =>$this->input->post('nicomentario'),
                                  'usuarioid'    =>$this->session->userdata('user_id'),
                                  'transaccionid'=>$this->input->post('form_transaccion'),
                                  'estado'       =>1,
                                  'contrato_destino'=>$almacen_salida,
                                  'referencia_salida'=>$resultado['last_id'],
                                  'fecha_registro'=>date('Y-m-d')
                                 );
                  //borrar carga temporal
                $this->Mdocumento->borrarcarga();

                $resultado=$this->Mdocumento->save($cabecera_ingreso,$detalle,$seriedoc_ingreso,'NI');
                echo $resultado['msg'];
              }
              else{
                echo $resultado['msg'];
              }

            }else{
              echo "El mes ya esta cerrado";
            }

      break;

    }

  }


  public function get_enviados(){
    $seridoc=$this->input->post('seriedoc');
    $almacen=$this->session->userdata('alm_id');

    $data['nipendientes']=$this->Mdocumento->get_ni_pendientes($almacen,$seridoc);
    $this->load->view('secciones/recepcion/grid_ni_pendientes', $data);
  }
//para recepcion
  public function get_detalle($idcabecera){

    $data['detalle']=  $this->Mdocumento->get_detalle_doc($idcabecera);
    $data['notaingreso']=$this->Mdocumento->get_nota_ingreso($idcabecera);
    $this->load->view('secciones/recepcion/grid_detalle', $data);

  }
  //para consulta
  public function get_detalle_docs($idcabecera,$tipovista){

    $data['detalle']=  $this->Mdocumento->get_detalle_doc($idcabecera);
    $data['notaingreso']=$this->Mdocumento->get_nota_ingreso($idcabecera);
    $data['tipovista']=$tipovista;
    $data['idcabecera']=$idcabecera;
    $this->load->view('secciones/consultas/detalle_doc', $data);
  }
  public function recepcionar_ni(){

    $datos_tabla=$this->input->post('json_array');
    $doc=$this->input->post('ndoc');

    $seriedoc=substr($doc,1,3);
    $correlativo=  substr($doc,4)*1;
    $almacen=$this->session->userdata('alm_id');
    $tipo='NI';
    echo $this->Mdocumento->confirmar_recepcion($almacen,$seriedoc,$correlativo,$datos_tabla);


  }

  public function notas_ingreso(){
    $seriedoc=$this->input->post('seriedoc');
    $idalmacen=$this->session->userdata('alm_id');
    $data['ingresos']=$this->Mdocumento->get_docs($idalmacen,$seriedoc,'NI');
    $this->load->view('secciones/consultas/grid_ingreso', $data);
  }
  public function notas_salida(){
    $seriedoc=$this->input->post('seriedoc');
    $idalmacen=$this->session->userdata('alm_id');
    $data['ingresos']=$this->Mdocumento->get_docs($idalmacen,$seriedoc,'NS');
    $this->load->view('secciones/consultas/grid_ingreso', $data);
  }

  public function diferencias_activas(){
    $seriedoc=$this->input->post('seriedoc');
    $idalmacen=$this->session->userdata('alm_id');
    $data['docs_dif']=$this->Mdocumento->get_dif_docs($idalmacen,$seriedoc,'NI',3);
    $this->load->view('secciones/consultas/grid_docs_dif', $data);
  }
  public function diferencias_cerradas(){
    $seriedoc=$this->input->post('seriedoc');
    $idalmacen=$this->session->userdata('alm_id');
    $data['docs_dif']=$this->Mdocumento->get_dif_docs($idalmacen,$seriedoc,'NI',4);
    $this->load->view('secciones/consultas/grid_docs_dif', $data);
  }

  public function subir_reporte_diferencia(){

    $datos = array('iddocumento' => $this->input->post('idcabecera'),
                    'detalle'=>$this->input->post('detalle'),
                    'idusuario'=>$this->session->userdata('user_id'),
                    'fecha'=>date('Y-m-d H:i:s')
       );

       $this->Mdocumento->insertar_reporte_diferencia($datos);
			//subir imagenes

			$config = array(
					"upload_path" => "./uploads/",
          'allowed_types' => "*",
					'overwrite'     => "false"
				);

			$this->load->library("upload",$config);

				$variablefile= $_FILES;

        $info = array();
				 $files = count($_FILES['filevicendia']['name']);
				for ($i=0; $i < $files; $i++) {
					$_FILES['filevicendia']['name'] = $variablefile['filevicendia']['name'][$i];
					$_FILES['filevicendia']['type'] = $variablefile['filevicendia']['type'][$i];
					$_FILES['filevicendia']['tmp_name'] = $variablefile['filevicendia']['tmp_name'][$i];
					$_FILES['filevicendia']['error'] = $variablefile['filevicendia']['error'][$i];
					$_FILES['filevicendia']['size'] = $variablefile['filevicendia']['size'][$i];

					$this->upload->initialize($config);
					if ($this->upload->do_upload('filevicendia')) {
						$data = array("upload_data" => $this->upload->data());
						$datos_archivo = array(
							"nombre" => $data['upload_data']['file_name'],
							"url" => base_url()."uploads/".$data['upload_data']['file_name'],
							"iddocumento" =>$this->input->post('idcabecera'),
              "fecha"=> date('Y-m-d H:i:s')
						);
						$this->Mdocumento->guardar_archivo($datos_archivo);



					}
					else{
						echo $this->upload->display_errors();


					}
          echo '1';
				}


  }
  public function detalle_reporte(){
    $idcabecera=$this->input->post('idcabecera');
    $this->db->select('r.detalle,u.nombre,u.apepat,r.fecha');
    $this->db->from('reportediferencia r');
    $this->db->join('usuario u', 'r.idusuario = u.usuarioid');
    $this->db->where('r.iddocumento',$idcabecera);
    $query=$this->db->get();
    $data['detallereporte']=$query->row();


    $this->db->select('idarchivo,nombre,url');
    $this->db->from('archivos_reporte');
    $this->db->where('iddocumento',$idcabecera);
    $query2=$this->db->get();
    $data['archivos']=$query2->result();

    $this->load->view('secciones/consultas/modal-reporte', $data);
  }

  public function movimientos(){
     $periodo=$this->input->post('periodo');
     $fechainicial=date('Y-m-d',strtotime(str_replace('/','-',substr($periodo,0,10))));
     $fechafinal=date('Y-m-d',strtotime(str_replace('/','-',substr($periodo,-10))));

     $data['movimientos']=$this->Mdocumento->getmovimientos($fechainicial,$fechafinal);
     $this->load->view('secciones/consultas/grid_movimientos', $data);



  }




}
