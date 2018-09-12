<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargaexcel extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Mcargaexcel'));
    $this->load->library('Excel');
  }

  function index()
  {

  }

  public function cargartemporal(){
      if(isset($_FILES["excelfile"]["name"])){
        $path=$_FILES["excelfile"]["tmp_name"];
        $object = PHPExcel_IOFactory::load($path);

        foreach ($object->getWorksheetIterator() as $Worksheet) {
          $highestrow=$Worksheet->getHighestRow();
          $highestColumn = $Worksheet->getHighestColumn();

          for($row=2 ; $row<=$highestrow; $row++){
            $articulo_codigo= trim($Worksheet->getCellByColumnAndRow(0,$row)->getValue(),' ');
            $articulo_serie=  trim($Worksheet->getCellByColumnAndRow(1,$row)->getValue(),' ');
            $articulo_cantidad=  trim($Worksheet->getCellByColumnAndRow(2,$row)->getValue(),' ');
            $articulo_maquina=  trim($Worksheet->getCellByColumnAndRow(3,$row)->getValue(),' ');
            $articulo_docref=  trim($Worksheet->getCellByColumnAndRow(4,$row)->getValue(),' ');
            if($articulo_codigo=='' or is_null($articulo_codigo) ){

            }
            else{
              $data= array('CODIGO' =>$articulo_codigo ,
                              'SERIE'  =>$articulo_serie,
                              'CANTIDAD'=>$articulo_cantidad,
                              'MAQUINA'=>$articulo_maquina,
                              'DOC_REF'=>$articulo_docref,
                              'IDUSUARIO'=>$this->session->userdata('user_id')
                             );
              $this->Mcargaexcel->insertar_temporal($data);
            }

          }
        }

        $carga=$this->Mcargaexcel->listarcarga();

        $data['carga']=$carga;

        $this->load->view('secciones/envios-lima/grid_detalle_carga', $data);
      }
      else{
        echo 'Error al cargar excel';
      }
  }




  public function listarcarga(){
    $carga=$this->Mcargaexcel->listarcarga();
    $utf8carga=array();
    foreach ($carga as $key) {
        $data['item']=$key->ID;
        $data['codigo']=$key->CODIGO;
        $data['serie']=$key->SERIE;
        $data['cantidad']=$key->CANTIDAD;
        $data['maquina']=$key->MAQUINA;
        $data['docref']=$key->DOC_REF;
        $data['descripcion']=utf8_encode($key->ADESCRI);
      $utf8carga[]=$data;
    }
    echo json_encode($utf8carga);
  }

  public function listarcarga2(){

    $data['carga']=$this->Mcargaexcel->listarcarga();
    $this->load->view('secciones/envios-lima/grid_detalle_carga', $data);

  }

  public function eliminar(){
    $id=$this->input->post('id');
    $this->Mcargaexcel->eliminar($id);
    $data['carga']=$this->Mcargaexcel->listarcarga();
    $this->load->view('secciones/envios-lima/grid_detalle_carga', $data);
  }

  public function carga_manual(){
    $data= array('CODIGO' =>$this->input->post('codigo') ,
                    'SERIE'  =>$this->input->post('serie'),
                    'CANTIDAD'=>$this->input->post('cantidad'),
                    'MAQUINA'=>$this->input->post('maquina'),
                    'DOC_REF'=>$this->input->post('doc_ref')
                   );
    $this->Mcargaexcel->insertar_temporal($data);
    $carga=$this->Mcargaexcel->listarcarga();

    $data['carga']=$carga;

    $this->load->view('secciones/envios-lima/grid_detalle_carga', $data);
  }

  public function carga_temporal_consumo(){
    $data= array('CODIGO' =>$this->input->post('codigo') ,
                    'SERIE'  =>$this->input->post('serie'),
                    'CANTIDAD'=>$this->input->post('cantidad'),
                    'MAQUINA'=>$this->input->post('maquina'),
                    'DOC_REF'=>$this->input->post('doc_ref'),
                    'idsolicitante'=>$this->input->post('solicitante'),
                    'area'=>$this->input->post('areacencos')
                   );
    $this->Mcargaexcel->insertar_temporal($data);
    $seriedoc=$this->input->post('seriedoc');
    $data['carga']=$this->Mcargaexcel->consumo_listar_temporal($seriedoc);
    $this->load->view('secciones/envios-lima/grid_detalle_carga', $data);
  }

  public function listar_consumo(){
    $seriedoc=$this->input->post('seriedoc');
    $data['carga']=$this->Mcargaexcel->consumo_listar_temporal($seriedoc);
    $this->load->view('secciones/envios-lima/grid_detalle_carga', $data);

  }
  public function eliminar_consumo(){
    $id=$this->input->post('id');
    $seriedoc=$this->input->post('seriedoc');
    $this->Mcargaexcel->eliminar($id);
    $data['carga']=$this->Mcargaexcel->consumo_listar_temporal($seriedoc);
    $this->load->view('secciones/envios-lima/grid_detalle_carga', $data);
  }

}
