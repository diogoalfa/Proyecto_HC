<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pedidos extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
        $this->load->library('calendar');
       //session_destroy();   
    }

    public function index() {

        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');
  
        if(!isset($_SESSION['usuarioProfesor'])){
            $this->load->view('pedidos/login_docente');
        }
        else{
        //echo $_SESSION['usuarioProfesor'];
          $docente=$this->Docente_model->getDocenteRut($_SESSION['usuarioProfesor']); 
          $asignaturas=$this->Docente_model->getAsignatura($docente->pk);
          $periodos= $this->Admin_model->getPeriodo();
          $this->load->view('pedidos/pedir_sala',compact("asignaturas","docente","periodos"));      
        }
        
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
    }

    
    public function logueoError() {
        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');
  
        $mensajeAlerta='Usuario y Clave invalido vuelva a intentar!';
        $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
        
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
        
    }
    

}
