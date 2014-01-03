<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pedidos extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
   
       //session_destroy();   
    }

    public function index(){

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
        
         if(!isset($_SESSION['usuarioProfesor'])){
          $this->load->view('general/headers');
          $this->load->view('general/menu_principal');
          $this->load->view('general/abre_bodypagina');
         $mensajeAlerta="No ha iniciado sesion!";
         $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
        
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
        
        }
        else{
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
       
    }    
    
    public function verPedidos() {
        
        if(!isset($_SESSION['usuarioProfesor'])){
          $this->load->view('general/headers');
          $this->load->view('general/menu_principal');
          $this->load->view('general/abre_bodypagina');
         $mensajeAlerta="No ha iniciado sesion!";
         $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
        
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
        
        }
        else{
        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');
        $this->load->view('pedidos/selecionar_opcionPedidos');
        $docente=$this->Docente_model->getDocenteRut($_SESSION['usuarioProfesor']);
        $asignaturas=$this->Docente_model->getAsignatura($docente->pk);
        $this->load->view('pedidos/consultaPorAsignatura',compact("asignaturas"));
        
        $asignatura_pk=$this->input->post('asignatura');
        $seccion=  $this->input->post('seccion');
        if($asignatura_pk){
            
            //Pedido es una reserva sin confirmar
            $pedidos=$this->Docente_model->getPedidoSalaDocente($asignatura_pk,$docente->pk,$seccion);
            $this->load->view('pedidos/verPedidos',compact("pedidos","asignatura_pk","seccion"));
        }
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
        }
    }
    
    public function editarPedido($pkPedido=null,$fecha=null,$seccion=null){
        
        if(!isset($_SESSION['usuarioProfesor'])){
          $this->load->view('general/headers');
          $this->load->view('general/menu_principal');
          $this->load->view('general/abre_bodypagina');
         $mensajeAlerta="No ha iniciado sesion!";
         $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
        
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
        
        }
        else{
        $docente=$this->Docente_model->getDocenteRut($_SESSION['usuarioProfesor']); 
        $asignaturas=$this->Docente_model->getAsignatura($docente->pk);
        $periodos= $this->Admin_model->getPeriodo();        
                
                
        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');
        $this->load->view('pedidos/selecionar_opcionPedidos');
         
        $this->load->view('pedidos/editarPedido',compact("pkPedido","asignaturas","periodos","fecha","docente"));
        
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
        }    
        
      }
      
      public function updatePedido() {
          if(!isset($_SESSION['usuarioProfesor'])){
          $this->load->view('general/headers');
          $this->load->view('general/menu_principal');
          $this->load->view('general/abre_bodypagina');
         $mensajeAlerta="No ha iniciado sesion!";
         $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
        
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
        
        }
        else{
          
          $pkPedido=  $this->input->post('pkPeriodo');
          $asignatura=$this->input->post('asignatura');
          $fecha=$this->input->post('fecha');
          $periodo=$this->input->post('periodo');
          $sala=$this->input->post('sala');
          $seccion=$this->input->post('seccion');
          $docente=$this->input->post('docente');
          
          
         $esActualizado=$this->Docente_model->updatePedido($pkPedido,$asignatura,$fecha,$periodo,$sala,$seccion,$docente);
           if($esActualizado==true){
               echo '<script>alert("Exito al Actualizar el Pedido"); </script>';
               redirect('pedidos', 'refresh');
          } 
          else{
               echo '<script>alert("A ocurrido un error al actualizar el Pedido"); </script>';
               redirect('pedidos', 'refresh');
         } 
        }
      }
    
    public function eliminarPedido($pkPedido=null) {
        
       if(!isset($_SESSION['usuarioProfesor'])){
          $this->load->view('general/headers');
          $this->load->view('general/menu_principal');
          $this->load->view('general/abre_bodypagina');
         $mensajeAlerta="No ha iniciado sesion!";
         $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
        
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
        
        }
        else{
          $esEliminado=$this->Docente_model->borrarPedido($pkPedido);
          if($esEliminado==true){
               echo '<script>alert("Exito al eliminar el Pedido"); </script>';
               redirect('pedidos', 'refresh');
          } 
          else{
               echo '<script>alert("A ocurrido un error al eliminar el Pedido"); </script>';
               redirect('pedidos', 'refresh');
         }  
         
        }
         
        
    }
    
    
    public function logueoError() {
        
        
        if(!isset($_SESSION['usuarioProfesor'])){
          $this->load->view('general/headers');
          $this->load->view('general/menu_principal');
          $this->load->view('general/abre_bodypagina');
         $mensajeAlerta="No ha iniciado sesion!";
         $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
        
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
        
        }
        else{
        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');
  
        $mensajeAlerta='Usuario y Clave invalido vuelva a intentar!';
        $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
        
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
        }
    }
    
    public function salaDisponible() {
        
        if(!isset($_SESSION['usuarioProfesor'])){
          $this->load->view('general/headers');
          $this->load->view('general/menu_principal');
          $this->load->view('general/abre_bodypagina');
         $mensajeAlerta="No ha iniciado sesion!";
         $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
        
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
        
        }
        else{  
        $pkPeriodo= $this->input->post('sePeriodo');
        $fecha=$this->input->post('datepicker');
        
       
       $salasDisponibles=$this->Sala_model->getSalasDisponibles($pkPeriodo,$fecha);
     //  echo "<option>".$pk_periodo."</option>";
     //  echo "<option>".$fecha."</option>";
        foreach ($salasDisponibles as $sala) {
           echo '<option value="'.$sala->pk.'">'.$sala->sala.'</option>';
        }     
       }
    }
    
    
    public function guardarPedidoSala(){
        
        if(!isset($_SESSION['usuarioProfesor'])){
          $this->load->view('general/headers');
          $this->load->view('general/menu_principal');
          $this->load->view('general/abre_bodypagina');
         $mensajeAlerta="No ha iniciado sesion!";
         $this->load->view('pedidos/login_docente',compact('mensajeAlerta'));
        
        $this->load->view('general/cierre_bodypagina');
        $this->load->view('general/cierre_footer');
        
        }
        else{
        
        $fecha=  $this->input->post('datepicker');
        $sala_pk=$this->input->post('sala');
        $periodo_pk=$this->input->post('sePeriodo');
        $docente_pk=$this->input->post('docente');
        $asignatura_pk=$this->input->post('asignatura'); 
        $seccion=$this->input->post('seccion');
        
       // echo " '$fecha'-'$sala_pk'-'$periodo_pk'-'$docente_pk'-'$asignatura_pk'";
        $pedidoSala=  $this->Docente_model->guardarPedidoSala($fecha,$sala_pk,$periodo_pk,$docente_pk,$asignatura_pk,$seccion);
        
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

}
