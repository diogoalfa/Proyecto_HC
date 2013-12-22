<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Intranet extends CI_Controller {


    
    function __construct() {
        parent::__construct();
       // session_start();   
        $this->load->model('docente_model');
        $this->load->model('admin_model');
    }
 
    
    function index(){
        
        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');
              $this->load->view('intranet/loginAdmin');
       
       
           //$this->load->view('intranet/central_secretaria');     
        
         
         
        
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
    public function acceso(){

                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                    $this->load->view('intranet/bienvenido');
                    $this->load->view('intranet/header_menu');
                        $this->load->view('intranet/menu');
                    $this->load->view('intranet/fin_header_menu');
                
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
    }
    public function academico(){
            $academico=$this->docente_model->getAcademico();
            $asignatura=$this->admin_model->getAsignatura();
            //print_r($asignatura);
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                    $this->load->view('intranet/bienvenido');
                    $this->load->view('intranet/header_menu');
                        $this->load->view('intranet/academico_menu',compact('academico','asignatura'));
                    $this->load->view('intranet/fin_header_menu');
                
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
    }
    public function setAcademico(){
            $datos=array(
                'nombres'=>$this->input->post('nombre'),
                'apellidos'=>$this->input->post('apellido'),
                'rut'=>$this->input->post('rut'),
                //'departamento'=>$this->input->post('dpto')
                'departamento_fk'=>1//el uno quiere decir de informatica :S
                );
            $estado=$this->admin_model->setAcademico($datos);
            if($estado==TRUE){
                    echo '<script>alert("Exito al guardar datos de Academico"); </script>';
                     redirect('intranet/academico', 'refresh');
            }
    }
    public function asocia(){
        $datos=array(
            'semestre'=>$this->input->post('semestre'),
            'anio'=>$this->input->post('anio'),
            'asignatura_fk'=>$this->input->post('ramo'),
            'docente_fk'=>$this->input->post('docente'),
            'seccion'=>$this->input->post('seccion')
            );
        $estado=$this->admin_model->asocia($datos);
                    if($estado==TRUE){
                    echo '<script>alert("Asociacion realizada con Exito"); </script>';
                     redirect('intranet/academico', 'refresh');
            }
    }
    public function salas(){
            $academico=$this->docente_model->getAcademico();
            $asignatura=$this->admin_model->getAsignatura();
            //print_r($asignatura);
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                    $this->load->view('intranet/bienvenido');
                    $this->load->view('intranet/header_menu');
                        $this->load->view('intranet/salas_menu',compact('academico','asignatura'));
                    $this->load->view('intranet/fin_header_menu');
                
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
    }
    
    
}