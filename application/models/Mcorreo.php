<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcorreo extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function enviar_correo($para,$cc,$asunto,$mensaje){
    $this->load->library('email');
          $config['protocol'] = 'smtp';
         //El servidor de correo que utilizaremos
          //$config["smtp_host"] = 'mail.rockdrillgroup.com';
          $config["smtp_host"] = 'ssl://smtp.googlemail.com';
         //Nuestro usuario
          $config["smtp_user"] = 'marco.moscoso.r@gmail.com';

         //Nuestra contraseña
          $config["smtp_pass"] = 'marcomr1';

         //El puerto que utilizará el servidor smtp


          //$config["smtp_port"] = 587;
          $config["smtp_port"] = 465;

         //El juego de caracteres a utilizar
          $config['charset'] = 'utf-8';
          $config['newline'] = "\r\n";
          $config['crlf'] = "\r\n";

         //Permitimos que se puedan cortar palabras
          $config['wordwrap'] = TRUE;

         //El email debe ser valido
         $config['validate'] = true;

         $this->email->initialize($config);

         $this->email->from('aplicaciones@rockdrillgroup.com');

         $this->email->to($para);
         $this->email->subject($asunto);
         $this->email->cc($cc);
         $this->email->message($mensaje);
      $this->email->set_mailtype('html');
        if($this->email->send()){
          //echo 'se envio correctamente';

        }
          else{
            echo 'error';
          }
  }

  public function nuevo_almacen($almacen){
    return "Nuevo almacen aperturado".$almacen;
  }

}
