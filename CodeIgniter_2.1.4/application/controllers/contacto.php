<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto extends CI_Controller {


    
    function __construct() {
        parent::__construct();
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
        // $this->load->library('email');
        // $config['protocol'] = 'sendmail';
        // $config['mailpath'] = '/usr/sbin/sendmail';
        // $config['charset'] = 'iso-8859-1';
        // $config['wordwrap'] = TRUE;
        // $this->email->initialize($config);
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
            }
            else{
                $error_nombre= form_error('nombre');
                $error_apellido=form_error('apellido');
                $error_correo=form_error('correo');
                $error_asunto=form_error('asunto');
                $error_comentario=form_error('comentario');
                $error="";
                $conta=0;
                if (strlen($error_nombre)>1) {
                    //echo "<script>alert('.$error_nombre.'); </script>";
                    $error=$error.$error_nombre."<br>";
                    $conta++;
                }
                if (strlen($error_apellido)>1) {
                    $error=$error.$error_apellido."<br>";
                    $conta++;
                }
                if (strlen($error_correo)>1) {
                    $error=$error.$error_correo."<br>";
                    $conta++;
                }
                if (strlen($error_asunto)>1) {
                    $error=$error.$error_asunto."<br>";
                    $conta++;
                }
                if (strlen($error_comentario)>1) {
                    $error=$error.$error_comentario."<br>";
                    $conta++;
                }
                if ($conta>=1) {
                    echo $error;
                }
                echo "La pagina se redireccionará en 8 segundos...";
                header ("refresh: 8, http://localhost/Proyecto_HC/CodeIgniter_2.1.4/index.php/contacto"); 

            }
        }
        // $config = array(
        //   'protocol' => 'smtp',
        //   'smtp_host' => 'ssl://smtp.googlemail.com',
        //   'smtp_port' => 465,
        //   'smtp_user' => 'franciscoramirezfernandez@gmail.com', // change it to yours
        //   'smtp_pass' => 'xxxx', // change it to yours
        //   'mailtype' => 'html',
        //   'charset' => 'iso-8859-1',
        //   'wordwrap' => TRUE);
        // $this->load->library('email', $config);

        // $message = $comentario;
        // $this->email->from($correo); // change it to yours
        // $this->email->to('franciscoramirezfernandez@gmail.com');// change it to yours
        // $this->email->subject('Resume from JobsBuddy for your Job posting');
        // $this->email->message($message);
        // if($this->email->send())
        // {
        // echo 'Email sent.';
        // }
        // else
        // {
        // show_error($this->email->print_debugger());
        // }
            }

    }
?> 
