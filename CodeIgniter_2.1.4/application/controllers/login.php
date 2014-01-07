<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper("ws_helper");
        $this->load->library('form_validation');

       session_start();
    }
  
    
    function index() {
        if ($this->input->post()) {
          if ($this->form_validation->run('Login')==TRUE) {
                 $formulario = array(
                  'rut' => $this->input->post('rut', true),
                  'clave' => $this->input->post('clave', true),
              );    
          }
          else{
              $error_user= form_error('rut');
              $error_pass=form_error('clave');
              $error="";
              $conta=0;
              if (strlen($error_user)>1) {
                $error=$error.$error_user."<br>";
                $conta++;
              }
              if (strlen($error_pass)>1) {
                $error=$error.$error_pass."<br>";
                $conta++;
              }
              if ($conta>0) {
                echo $error;
              }
            }
        }

        if ($this->input->post()) {
          $rut = $this->input->post("rut", TRUE);//rut
          $p = strtoupper($this->input->post("clave", TRUE));
          $str = hash('sha256', $p);
          error_log("$rut / $p / $str");
          $resultado = wsLogear($rut, $str);
          if($resultado==1){
                
                $alias=wsSession($rut);
                if($alias==FALSE){
                  redirect('pedidos/logueoError',301);
                }
                else{
                  $_SESSION['usuarioProfesor']=  $this->input->post('rut');
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
        if ($this->input->post()) {
          if ($this->form_validation->run('Login')==TRUE) {
                 $formulario = array(
                  'rut' => $this->input->post('rut', true),
                  'clave' => $this->input->post('clave', true),
              );    
          }
          else{
              $error_user= form_error('rut');
              $error_pass=form_error('clave');
              $error="";
              $conta=0;
              if (strlen($error_user)>1) {
                $error=$error.$error_user."<br>";
                $conta++;
              }
              if (strlen($error_pass)>1) {
                $error=$error.$error_pass."<br>";
                $conta++;
              }
              if ($conta>0) {
                echo $error;
              }
            }
        }    
           
        if($this->input->post()){
          $clave=hash('sha256', trim($this->input->post('clave')));
          $nombre=$this->input->post('rut');

           $respuestaLogin=$this->Admin_model->loguearAdmin($nombre,$clave);
            if($respuestaLogin==1){ 
                   $_SESSION['usuarioAdmin']=$this->input->post('rut');
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
