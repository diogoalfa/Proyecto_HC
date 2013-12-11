<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto extends CI_Controller {


    
    function __construct() {
        parent::__construct();
    }


    public function index()
	{
            
		$this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                
                $this->load->view('contacto/contacto_informacion');
                $this->load->view('contacto/contacto_mail');
                
                
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
	}
}
