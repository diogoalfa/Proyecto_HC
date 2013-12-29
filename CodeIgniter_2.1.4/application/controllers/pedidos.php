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
          
          $this->load->view('pedidos/selecionar_opcionPedidos');
          
           
        }
        
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
    }
    
    public function pedirSala(){
        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');
        $docente=$this->Docente_model->getDocenteRut($_SESSION['usuarioProfesor']); 
          $asignaturas=$this->Docente_model->getAsignatura($docente->pk);
          $periodos= $this->Admin_model->getPeriodo();
          $this->load->view('pedidos/selecionar_opcionPedidos');
          $this->load->view('pedidos/pedir_sala',compact("asignaturas","docente","periodos"));     
           
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
    }    
    
    public function verPedidos() {
        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');
        $this->load->view('pedidos/selecionar_opcionPedidos');
        $docente=$this->Docente_model->getDocenteRut($_SESSION['usuarioProfesor']);
        $asignaturas=$this->Docente_model->getAsignatura($docente->pk);
        $this->load->view('pedidos/consultaPorAsignatura',  compact("asignaturas"));
        
        if($this->input->post('asignatura')){
            $asignatura_pk=$this->input->post('asignatura');
            $pedidos=$this->Docente_model->getPedidoSalaDocente($asignatura_pk,$docente->pk);
            $this->load->view('pedidos/verPedidos',compact("pedidos"));
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
    
    public function salaDisponible() {
          
        $pk_periodo= $this->input->post('sePeriodo');
        $fecha=$this->input->post('datepicker');
        
       
       $salasDisponibles=$this->Sala_model->getSalasDisponibles((int)$pk_periodo,$fecha);
     //  echo "<option>".$pk_periodo."</option>";
     //  echo "<option>".$fecha."</option>";
        foreach ($salasDisponibles as $sala) {
                echo '<option value="'.$sala->pk.'">'.$sala->sala.'</option>';
        }      /*$docentes=$this->Docente_model->getAcademico();
            foreach ($docentes as $docen) {
                echo '<option value="'.$docen->pk.'">'.$docen->nombres.'</option>';
            }
             * 
             */
       // }
    }
    
    public function getCurso() {
        
        
    }
    public function guardarPedidoSala(){
        
        $fecha=  $this->input->post('datepicker');
        $sala_pk=$this->input->post('sala');
        $periodo_pk=$this->input->post('sePeriodo');
        $docente_pk=$this->input->post('docente');
        $asignatura_pk=$this->input->post('asignatura'); 
        
       // echo " '$fecha'-'$sala_pk'-'$periodo_pk'-'$docente_pk'-'$asignatura_pk'";
        $pedidoSala=  $this->Docente_model->guardarPedidoSala($fecha,$sala_pk,$periodo_pk,$docente_pk,$asignatura_pk);
        
        if($pedidoSala==true){
          echo '<script>alert("Se ha guardado Exitosamente!"); </script>';
             redirect('pedidos', 'refresh');
        }
        else{
           echo '<script>alert("Ha ocurrido un error !"); </script>';
           redirect('pedidos', 'refresh');
        }        
        
        
    }    

}
