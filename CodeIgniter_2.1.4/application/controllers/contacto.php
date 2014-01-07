<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto extends CI_Controller {

    
    function __construct() {
        parent::__construct();
        session_start();
        $this->load->library('form_validation');

    }
    public function index()
	{
            
        $this->load->library('email');
		$this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');                
        $this->load->view('contacto/contacto_informacion');
        $this->load->view('contacto/contacto_mail');
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
	}
    public function enviar(){
        $nombre=$this->input->post('nombre'); 
        $apellido=$this->input->post('apellido'); 
        $correo=$this->input->post('correo'); 
        $asunto=$this->input->post('asunto'); 
        $comentario=$this->input->post('comentario'); 
        if ($this->input->post()) {
            if ($this->form_validation->run('Contacto')==TRUE) {
                $formulario = array(
                    'nombre' => $this->input->post('nombre', true),
                    'apellido' => $this->input->post('apellido', true),
                    'correo'=>$this->input->post('correo',true), 
                    'asunto'=>$this->input->post('asunto',true), 
                    'comentario'=>$this->input->post('comentario',true),
        
                ); 
                if(!isset($errores)){
                    echo '<script>alert("Mensaje enviado"); </script>';
                }           
            }
            else{
                $error_nombre= form_error('nombre');
                $error_apellido=form_error('apellido');
                $error_correo=form_error('correo');
                $error_asunto=form_error('asunto');
                $error_comentario=form_error('comentario');
                $errores=array('error_nombre'=>$error_nombre,'error_apellido'=>$error_apellido,
                    'error_correo'=>$error_correo,'error_asunto'=>$error_asunto,'error_comentario'=>$error_comentario);
            }
            $this->load->view('general/headers');
            $this->load->view('general/menu_principal');
            $this->load->view('general/abre_bodypagina');                
            $this->load->view('contacto/contacto_informacion');
            $this->load->view('contacto/contacto_mail',compact("errores"));
            $this->load->view('general/cierre_bodypagina');
            $this->load->view('general/cierre_footer');
              
        }
       
        }

    }
?> 
