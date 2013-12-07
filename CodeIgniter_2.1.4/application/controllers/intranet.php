<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Intranet extends CI_Controller {


    
    function __construct() {
        parent::__construct();
    }
 
    
    function index(){
        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');
        
        $this->load->view('intranet/login');
        
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
    }
    
    
}