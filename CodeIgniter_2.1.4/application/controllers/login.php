<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
       session_start();
      // session_destroy();
    }
  
    
    function index() {
       
        if($this->input->post()){
            $clave=$this->input->post('clave');
            $rut=$this->input->post('rut');
            
            $respuestaLogin=$this->Docente_model->loguearDocente($rut,$clave);
            if($respuestaLogin==1){
                   $_SESSION['usuarioProfesor']=  $this->input->post('rut');
                   redirect('pedidos',301); 
                   
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
                  // redirect('intranet/acceso',301); 
                  //  base_url("intranet/acceso");
              header ("Location: http://localhost/Proyecto_HC/CodeIgniter_2.1.4/index.php/intranet/acceso");
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
