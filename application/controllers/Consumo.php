<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumo extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('Excel');
    $this->load->model(array('Mcargaexcel','Msolicitantes','Mmaquinas','Mcentrocosto'));
  }

  function index()
  {

  }

  public function carga_consumo(){
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
          $articulo_solicitante=  trim($Worksheet->getCellByColumnAndRow(5,$row)->getValue(),' ');
          $articulo_area=  trim($Worksheet->getCellByColumnAndRow(6,$row)->getValue(),' ');

          //validar codigo solicitante
            $nsolicitante=$this->Msolicitantes->getsolicitantebyid($articulo_solicitante);
            if($nsolicitante==0){
                $articulo_solicitante=-1;
            }
          //validar Maquina
            $nmaquina=$this->Mmaquinas->getmaquinabynombre($articulo_maquina);
            if($nmaquina==0){
              $articulo_maquina='-1';
            }
          //validar area
          $nareas=$this->Mcentrocosto->getareabyid($articulo_area);
          if($nareas==0){
            $articulo_area='-1';
          }



          if($articulo_codigo=='' or is_null($articulo_codigo) ){

          }
          else{
            $data= array('CODIGO' =>$articulo_codigo ,
                            'SERIE'  =>$articulo_serie,
                            'CANTIDAD'=>$articulo_cantidad,
                            'MAQUINA'=>$articulo_maquina,
                            'DOC_REF'=>$articulo_docref,
                            'IDUSUARIO'=>$this->session->userdata('user_id'),
                            'idsolicitante'=>$articulo_solicitante,
                            'area'=> $articulo_area
                           );
            $this->Mcargaexcel->insertar_temporal($data);
          }

        }
      }

      $data['carga']=$this->Mcargaexcel->consumo_listar_temporal($this->input->post('seriedoc'));



      $this->load->view('secciones/consumo/grid_consumo', $data);
    }
    else{
      echo 'Error al cargar excel';
    }
  }



}
