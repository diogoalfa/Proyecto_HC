<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
       //session_start();
      // session_destroy();
    }
  
    
    function index() {
       
        if($this->input->post()){
            $clave=$this->input->post('clave');
            $usuario=$this->input->post('usuario');
            
            $respuestaLogin=$this->Docente_model->loguearDocente($usuario,$clave);
            if($respuestaLogin==1){
                   //$_SESSION['usuarioProfesor']=  $this->input->post('usuario');
                   redirect('pedido',301); 
                   
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
                 //  $_SESSION['usuarioAdmin']=$this->input->post('usuario');
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
