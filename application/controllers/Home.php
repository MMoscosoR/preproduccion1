<?php 
	/**
	 * 
	 */
	class Home extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function index(){
			echo 'estas en home';
		}
		public function almacen_by_name($name){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('layout/contenido');
			$this->load->view('layout/footer');
		}

		
	}
 ?>