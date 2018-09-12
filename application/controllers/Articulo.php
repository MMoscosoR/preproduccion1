<?php
	/**
	 *
	 */
	class Articulo extends CI_Controller
	{

		function __construct()
		{
			parent::__construct();
			$this->load->model('Marticulo');
		}

		public function get(){

			$start=$this->input->post('start');
			$length=$this->input->post('length');
			$search=$this->input->post('search')['value'];


			$articulos_activos=$this->Marticulo->get($start,$length,$search);
			$resultado=$this->Marticulo->prueba($start,$length,$search);
			$eliminarcaracteres= array("\r\n", "\n", "\r");

			$datos = array();
			foreach ($resultado->result() as $row) {
				$array= array();
				$array['ROW']=$row->ROW;
				$array['ADESCRI']=str_replace($eliminarcaracteres,'',str_replace('"',"'",utf8_encode($row->ADESCRI)));
				$array['ACODIGO']=$row->ACODIGO;
				$array['STSSERIE']=$row->STSSERIE;
				$array['AUNIDAD']=$row->AUNIDAD;
				$array['AFAMILIA']=$row->AFAMILIA;
				$datos[]=$array;
			}

			$totaldata=$resultado->num_rows();
			$json_data= array(
				'draw' 			=> intval($this->input->post('draw')),
				'recordsTotal'	=> intval($totaldata),
				'recordsFiltered'=>intval($articulos_activos['numdata']),
				"data"			=>$datos

				 );
			echo json_encode($json_data);

				/*
			$row="";

			$resultadojson='[';
			foreach ($articulos_activos as $key) {
				$row=$row.'{"codigo":"'.$key->codigo.'","descripcion":"'.str_replace($eliminarcaracteres,'',str_replace('"',"'",utf8_encode($key->descripcion))).'","serie":"'.$key->serie.'","familia":"'.$key->familia.'","unidad":"'.$key->unidad.'"},';
			}
			echo trim($row,',');
			echo ']';
			*/

		}

		public function exportar(){
			//load our new PHPExcel library
			$this->load->library('excel');
			//activate worksheet number 1
			$this->excel->setActiveSheetIndex(0);
			//set cell A1 content with some text
			$this->excel->setActiveSheetIndex(0);
	    $this->excel->getActiveSheet()->setTitle('Maestro de Articuloas');
	    $this->excel->getActiveSheet()->setCellValue('A2', 'Maestro de articulos activos');
	    $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(18);
	    $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
	    $this->excel->getActiveSheet()->mergeCells('A2:H2');
			$articulos=$this->Marticulo->getall();

			//cabeceras
			$this->excel->getActiveSheet()->setCellValue('A4','Código');
			$this->excel->getActiveSheet()->setCellValue('B4','Descripción');
			$this->excel->getActiveSheet()->setCellValue('C4','Unidad');
			$this->excel->getActiveSheet()->setCellValue('D4','Familia');
			//cuerpo
			$fila=5;
			foreach ($articulos as $key) {
				$this->excel->getActiveSheet()->setCellValue('A'.$fila,$key->ACODIGO);
				$this->excel->getActiveSheet()->setCellValue('B'.$fila,utf8_encode($key->ADESCRI));
	      $this->excel->getActiveSheet()->setCellValue('C'.$fila,$key->AUNIDAD);
				$this->excel->getActiveSheet()->setCellValue('D'.$fila,$key->AFAMILIA);
				$fila++;
			}
			$this->excel->setActiveSheetIndex(0)->getColumnDimension('A')->setAutoSize(true);
	    $this->excel->setActiveSheetIndex(0)->getColumnDimension('B')->setAutoSize(true);
	    $this->excel->setActiveSheetIndex(0)->getColumnDimension('C')->setAutoSize(true);
	    $this->excel->setActiveSheetIndex(0)->getColumnDimension('D')->setAutoSize(true);




			$filename='Maestro de articulos '.date('d-m-Y').'.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');
		}

		public function test(){
			$articulos_activos=$this->Marticulo->prueba(0,20,'acc');
			$eliminarcaracteres= array("\r\n", "\n", "\r");

			$datos = array();
			foreach ($articulos_activos->result() as $row) {
				$array= array();
				$array['ROW']=$row->ROW;
				$array['ADESCRI']=str_replace($eliminarcaracteres,'',str_replace('"',"'",utf8_encode($row->ADESCRI)));
				$array['ACODIGO']=$row->ACODIGO;
				$array['STSSERIE']=$row->STSSERIE;
				$array['AUNIDAD']=$row->AUNIDAD;
				$array['AFAMILIA']=$row->AFAMILIA;
				$datos[]=$array;
			}

			echo json_encode($datos);
		}

		public function fichatecnica(){
			$codigo=$this->input->post('codigo');
			echo utf8_encode($this->Marticulo->getfichatecnica($codigo));

		}
		public function getseriesdsponibles(){
			$codigo=$this->input->post('codigo');
			$almacen=$this->session->userdata('alm_id');
			$series=$this->Marticulo->getseriesdsponibles($codigo,$almacen);
			echo json_encode($series);
		}

		public function getArticuloFromStkart(){
			$codigo=$this->input->post('codigo');
			$seriedoc=$this->input->post('seriedoc');

			$articulo=$this->Marticulo->articuloFromStkart($this->session->userdata('alm_id'),$seriedoc,$codigo);
			echo json_encode($articulo);

		}
		public function getstockserie(){
			$seriearticulo=$this->input->post('serie');
			$seriedoc=$this->input->post('seriedoc');
			$this->db->select('stock');
			$this->db->from('stkart');
			$this->db->where('contratoid', $this->session->userdata('alm_id'));
			$this->db->where('seriearticulo', $seriearticulo);
			$this->db->where('seriedocid', $seriedoc);
			$query=$this->db->get();
			if($query->row()){
				echo $query->row()->stock;
			}
			else{
				echo '0';
			}

		}
	}
 ?>
