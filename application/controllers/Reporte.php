<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model(array('Mreporte','Marticulo'));
    $this->load->library('pdf');

  }

  function index()
  {

  }
  public function kardex_unidad(){
    $seriedoc=$this->input->post('form_seriedoc');
    $codigo= $this->input->post('form_codigo');
    $seriearticulo=$this->input->post('form_seriearticulo');
    $periodo=$this->input->post('form_periodo');
    $fechainicial=str_replace('/','-',substr($periodo,0,10))  ;
    $fechafin=str_replace('/','-',substr($periodo,-10))   ;


    $data['saldo_inicial']=$this->Mreporte->get_saldo_inicial($this->session->userdata('alm_id'),$seriedoc,$codigo,$seriearticulo,$fechainicial);

    $data['periodo']=$periodo;
    $data['seriedoc']=$seriedoc;
    $data['codigo'] =$codigo;
    $articulo=$this->Marticulo->getdatos($this->session->userdata('alm_id'),$seriedoc,$codigo);
    $data['descripcion']=$articulo->descripcion;
    $data['unidad']=$articulo->unidad;

     $data['movimientos']=$this->Mreporte->getmovimientos($this->session->userdata('alm_id'),$seriedoc,$codigo,$seriearticulo,$fechainicial,$fechafin);


    echo '<br><a class="btn btn-primary" target="_blank" id="imprimir_kardex">Imprimir</a><a class="btn btn-primary" target="_blank" id="imprimir_kardex_excel">Descargar excel</a>  ';
    $this->load->view('secciones/reportes/kardex_unidades',$data);



  }

  public function kardex_unidad_pdf(){


    $seriedoc=$this->input->get('form_seriedoc');
    $codigo= $this->input->get('form_codigo');
    $seriearticulo=$this->input->get('form_seriearticulo');
    $periodo=$this->input->get('form_periodo');
    $fechainicial=str_replace('/','-',substr($periodo,0,10))  ;
    $fechafin=str_replace('/','-',substr($periodo,-10))   ;


    $data['saldo_inicial']=$this->Mreporte->get_saldo_inicial($this->session->userdata('alm_id'),$seriedoc,$codigo,$seriearticulo,$fechainicial);

    $data['periodo']=$periodo;
    $data['seriedoc']=$seriedoc;
    $data['codigo'] =$codigo;
    $articulo=$this->Marticulo->getdatos($this->session->userdata('alm_id'),$seriedoc,$codigo);
    $data['descripcion']=$articulo->descripcion;
    $data['unidad']=$articulo->unidad;

     $data['movimientos']=$this->Mreporte->getmovimientos($this->session->userdata('alm_id'),$seriedoc,$codigo,$seriearticulo,$fechainicial,$fechafin);

     $paper_size = array(0,0,0,-1);

     $html_content = $this->load->view('secciones/reportes/kardex_unidades',$data,TRUE);

       $this->pdf->set_paper($paper_size);
       $this->pdf->set_paper('A4','letter');
       ini_set("memory_limit","10000M");
 			$this->pdf->loadHtml($html_content);
 			$this->pdf->render();
 			$this->pdf->stream("prueba.pdf", array("Attachment"=>0));




  }


  public function kardex_unidad_excel(){

    $this->load->library('excel');
    $seriedoc=$this->input->get('form_seriedoc');
    $codigo= $this->input->get('form_codigo');
    $seriearticulo=$this->input->get('form_seriearticulo');
    $periodo=$this->input->get('form_periodo');
    $fechainicial=str_replace('/','-',substr($periodo,0,10))  ;
    $fechafin=str_replace('/','-',substr($periodo,-10))   ;


    $saldoinicial=$this->Mreporte->get_saldo_inicial($this->session->userdata('alm_id'),$seriedoc,$codigo,$seriearticulo,$fechainicial);

    $data['periodo']=$periodo;
    $data['seriedoc']=$seriedoc;
    $data['codigo'] =$codigo;
    $articulo=$this->Marticulo->getdatos($this->session->userdata('alm_id'),$seriedoc,$codigo);
    $data['descripcion']=$articulo->descripcion;
    $data['unidad']=$articulo->unidad;

     $movimientos=$this->Mreporte->getmovimientos($this->session->userdata('alm_id'),$seriedoc,$codigo,$seriearticulo,$fechainicial,$fechafin);

     $this->excel->setActiveSheetIndex(0);
 	        $this->excel->getActiveSheet()->setTitle('Kardex  de Articulos');
 	         $this->excel->getActiveSheet()->setCellValue('A2', 'Kardex de Articulos');
 	          $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(18);
 	        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
 	         $this->excel->getActiveSheet()->mergeCells('A2:H2');

           $this->excel->getActiveSheet()->setCellValue('A4', 'Periodo Consultado:');
           $this->excel->getActiveSheet()->setCellValue('B4', $periodo);
           $this->excel->getActiveSheet()->setCellValue('A5', 'Kardex del Almacen:');
           $this->excel->getActiveSheet()->setCellValue('B5', $this->session->userdata('alm_nombre').' Guias: '.$seriedoc);

            $this->excel->getActiveSheet()->setCellValue('D4', 'Articulo:');
            $this->excel->getActiveSheet()->setCellValue('E4',$codigo );

            $this->excel->getActiveSheet()->setCellValue('D5', 'Descripcion/UND:');
            $this->excel->getActiveSheet()->setCellValue('E5',$articulo->descripcion.' / '.$articulo->unidad );

            $this->excel->getActiveSheet()->setCellValue('A7', 'FECHA');
            $this->excel->getActiveSheet()->setCellValue('B7', 'DOCUMENTO');
            $this->excel->getActiveSheet()->setCellValue('C7', 'TRANSACCION');
            $this->excel->getActiveSheet()->setCellValue('D7', 'STOCK INICIAL');
            $this->excel->getActiveSheet()->setCellValue('E7', 'INGRESOS');
            $this->excel->getActiveSheet()->setCellValue('F7', 'SALIDAS');
            $this->excel->getActiveSheet()->setCellValue('G7', 'STOCK FINAL');
            $this->excel->getActiveSheet()->getStyle('A7')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B7')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C7')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D7')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E7')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F7')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G7')->getFont()->setBold(true);

            $this->excel->getActiveSheet()->setCellValue('D8',$saldoinicial );
            $fila=9;
            $totalingreso=0;
            $totalsalida=0;
            foreach ($movimientos as $key) {
              $this->excel->getActiveSheet()->setCellValue('A'.$fila, $key->fecha);
              $this->excel->getActiveSheet()->setCellValue('B'.$fila, $key->seriedocid.str_pad($key->correlativo, 7, "0", STR_PAD_LEFT).' ');
              $this->excel->getActiveSheet()->setCellValue('C'.$fila, $key->nombre);
              $this->excel->getActiveSheet()->setCellValue('D'.$fila, '');
              $this->excel->getActiveSheet()->setCellValue('E'.$fila, ($key->tipo=='NI')?$key->cantidad:'' );
              $this->excel->getActiveSheet()->setCellValue('F'.$fila, ($key->tipo=='NS')?$key->cantidad:'');
              $this->excel->getActiveSheet()->setCellValue('G'.$fila, '');
              $fila++;
              if($key->tipo=='NI'){$totalingreso=$totalingreso+$key->cantidad;}
              if($key->tipo=='NS'){$totalsalida=$totalsalida+$key->cantidad;}
            }
            $this->excel->getActiveSheet()->setCellValue('C'.$fila,'Totales' );
            $this->excel->getActiveSheet()->setCellValue('D'.$fila,$saldoinicial );
            $this->excel->getActiveSheet()->setCellValue('E'.$fila,$totalingreso );
            $this->excel->getActiveSheet()->setCellValue('F'.$fila,$totalsalida);
            $this->excel->getActiveSheet()->setCellValue('G'.$fila, ($saldoinicial+$totalingreso-$totalsalida));
            $this->excel->getActiveSheet()->getStyle('C'.$fila)->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D'.$fila)->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E'.$fila)->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F'.$fila)->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G'.$fila)->getFont()->setBold(true);


            $this->excel->setActiveSheetIndex(0)->getColumnDimension('A')->setAutoSize(true);
	       $this->excel->setActiveSheetIndex(0)->getColumnDimension('B')->setAutoSize(true);
	       $this->excel->setActiveSheetIndex(0)->getColumnDimension('C')->setAutoSize(true);
	       $this->excel->setActiveSheetIndex(0)->getColumnDimension('D')->setAutoSize(true);
         $this->excel->setActiveSheetIndex(0)->getColumnDimension('E')->setAutoSize(true);
	       $this->excel->setActiveSheetIndex(0)->getColumnDimension('F')->setAutoSize(true);
	       $this->excel->setActiveSheetIndex(0)->getColumnDimension('G')->setAutoSize(true);


           header('Content-Type: application/vnd.ms-excel');
           	        header('Content-Disposition: attachment;filename="Reporte-detallado.xls"');
           	        header('Cache-Control: max-age=1'); //no cache
           	        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
           	        // Forzamos a la descarga
           	        $objWriter->save('php://output');

  }

  public function costo_almacen(){
    $almacen=$this->session->userdata('alm_id');
    $seriedoc=$this->input->post('form_seriedoc');
    $periodo=$this->input->post('periodo');

  //  $this->Mreporte->actualizarprecios();

    $data['moremes']=$this->Mreporte->getvalorizado($almacen,$seriedoc,$periodo);

    $this->load->view('secciones/reportes/valor-almacen', $data);

  }

  public function listarConsumos(){
    $datofiltro=$this->input->post('filtro');
    $periodo=$this->input->post('periodo');
    $campo=$this->input->post('campo');

    $data['consumos']=$this->Mreporte->getconsumo($campo,$datofiltro,$periodo);
    $this->load->view('secciones/reportes/reporte-consumos', $data);
  }
}
