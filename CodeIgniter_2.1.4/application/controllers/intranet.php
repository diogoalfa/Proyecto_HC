<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Intranet extends CI_Controller {


    
    function __construct() {
        parent::__construct();
       // session_start();   
    }
 
    
    function index(){
        
        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');
        /*
        if(!isset($_SESSION['usuarioAdmin'])){
              $this->load->view('intranet/loginAdmin');
        }
        else{
           $this->load->view('intranet/central_secretaria');     
        }
         * 
         */
        
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
    }
    
    public function errorLoguear() {
        
        $this->load->view('general/headers');   
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');
        
        $mensajeAlerta='Usuario y Clave Erroneo Vuelva a intentar!';
        $this->load->view('intranet/loginAdmin',  compact('mensajeAlerta'));
        
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
        
    }
    
    
}