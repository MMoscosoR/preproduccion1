<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seriedoc extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mseriedoc');
  }

  function index()
  {

  }

  public function solicitud(){
    $mensaje=$this->input->post('descripcion');

    $result=$this->enviar_correo('jose.adrian@rockdrillgroup.com,marco.moscoso@rockdrillgroup.com','marco.garcia@rockdrillgroup.com',$mensaje,'Solicitud de creacion de serie de documento');
    echo $result;
  }

  private function enviar_correo($destinatarios,$copiados,$mensaje,$asunto){
			$this->load->library('email');
			$config['protocol'] = 'smtp';

		       //El servidor de correo que utilizaremos
		        $config["smtp_host"] = 'mail.rockdrillgroup.com';

		       //Nuestro usuario
		        $config["smtp_user"] = 'marco.moscoso@rockdrillgroup.com';

		       //Nuestra contraseña
		        $config["smtp_pass"] = 'rcomos123';

		       //El puerto que utilizará el servidor smtp
		        $config["smtp_port"] = '587';

		       //El juego de caracteres a utilizar
		        $config['charset'] = 'utf-8';

		       //Permitimos que se puedan cortar palabras
		        $config['wordwrap'] = TRUE;

		       //El email debe ser valido
		       $config['validate'] = true;

		       $this->email->initialize($config);

		       $this->email->from('almacenes.virtuales@rockdrillgroup.com','Almacenes Rockdrill');

		       $this->email->to($destinatarios);
		       $this->email->subject($asunto);
		       $this->email->cc($copiados);
		       $this->email->message($mensaje);
				$this->email->set_mailtype('html');
		      if($this->email->send()){
		      	return 1;

		      }
       			else{
       				return 0;
       			}
		}


}
