<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper("ws_helper");
       session_start();
    }
  
    
    function index() {
              if ($this->input->post()) {
                $rut = $this->input->post("rut", TRUE);//rut
                $p = strtoupper($this->input->post("clave", TRUE));
                $str = hash('sha256', $p);
                error_log("$rut / $p / $str");
                $resultado = wsLogear($rut, $str);
          if($resultado==1){
                  $_SESSION['usuarioProfesor']=  $this->input->post('rut');
                  $alias=wsSession($rut);
                  if($alias==FALSE)
                    redirect('pedidos/logueoError',301);
                  else{
                     $_SESSION['bnv'] = $alias;
                   redirect('pedidos',301); 
                  }                  
            }
            else{
               redirect('pedidos/logueoError',301);
            }   
        }    
    }
    public function validarAdmin() {       
        if($this->input->post()){
           $clave=$this->input->post('clave');
           $nombre=$this->input->post('usuario');
           $respuestaLogin=$this->Admin_model->loguearAdmin($nombre,$clave);
            if($respuestaLogin==1){
                   $_SESSION['usuarioAdmin']=$this->input->post('usuario');
                  redirect('intranet/acceso',301); 
            }
            else{
               redirect('intranet/errorLoguear',301);
            }
           
        }
    }
    public function desconectar() {
        session_destroy();
        redirect('welcome');
    }
    
}

?>
