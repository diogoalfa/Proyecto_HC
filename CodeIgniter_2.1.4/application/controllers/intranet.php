<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Intranet extends CI_Controller {


    
    function __construct() {
        parent::__construct();
        session_start();   
        $this->load->model('docente_model');
        $this->load->model('admin_model');
    }
 
    
    function index(){
        
        $this->load->view('general/headers');
        $this->load->view('general/menu_principal');
        $this->load->view('general/abre_bodypagina');
              $this->load->view('intranet/loginAdmin');
       if (!isset($_SESSION['usuarioAdmin'])) {
                          
       }
       else{
        redirect('intranet/acceso', 'refresh');
       }
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
            if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                        $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                    //$this->load->view('intranet/bienvenido');
                    $this->load->view('intranet/header_menu');
                       // $this->load->view('intranet/menu');
                    //$this->load->view('intranet/fin_header_menu');
                
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }

    }
    public function academico(){
            if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                        $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                $academico=$this->docente_model->getAcademico();
                $asignatura=$this->admin_model->getAsignatura();
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                
                $periodos=$this->Admin_model->getPeriodo();
                    
                //$this->load->view('intranet/bienvenido');
                $this->load->view('intranet/header_menu');
                $this->load->view('intranet/academico_menu',compact('academico','asignatura','periodos'));
                  //  $this->load->view('intranet/fin_header_menu');
                
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }


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
        //print_r($datos);
        $estado=$this->admin_model->asocia($datos);
                    if($estado==TRUE){
                    echo '<script>alert("Asociacion realizada con Exito"); </script>';
                     redirect('intranet/academico', 'refresh');
            }
    }
    public function salas(){

            if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                $academico=$this->docente_model->getAcademico();
                $salas=$this->admin_model->getSala();
                $periodo=$this->admin_model->getPeriodo();
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
               // $this->load->view('intranet/bienvenido');
                
              $pedidos=$this->admin_model->getTodosPedidos();
              $reservas=$this->admin_model->getReserva();
                
                $this->load->view('intranet/header_menu');
                $this->load->view('intranet/pedidosDocentes',compact('pedidos'));
                $this->load->view('intranet/verReservas',compact('reservas'));
               //$this->load->view('intranet/fin_header_menu');
                
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }



    }
    
    
    public function updateReservas($id){
            //seguir
    }
    
    public function getAsignaturasDocente() {
        
        $pkDocente=$this->input->post('docente');
        $asignaturas=$this->Docente_model->getAsignatura($pkDocente);
        
        foreach ($asignaturas as $asig) {
            echo form_hidden('seccion',$asig->seccion,'',"id='seccion'");
            echo "<option value=''".$asig->pk."''>".$asig->nombre."-".$asig->seccion."</option>";
            
           
        }
    }
    
    public function getSala(){
        
       $pkPeriodo=$this->input->post('periodo');
       $fecha=$this->input->post('datepicker');
       echo "$fecha - $pkPeriodo";
       
       $salasDisponibles=$this->Sala_model->getSalasDisponibles($pkPeriodo,$fecha);
     //  echo "<option>".$pk_periodo."</option>";
     //  echo "<option>".$fecha."</option>";
        foreach ($salasDisponibles as $sala) {
           echo '<option value="'.$sala->pk.'">'.$sala->sala.'</option>';
        } 
       
    }
    
    public function llenarReservaSemestre() {
        
        $pkDocente=$this->input->post('docente');
        $pkAsignatura=$this->input->post('asignatura');
        $semestre=$this->input->post('semestre');  
        $fechaInicio=$this->input->post('datepickerInicio');
        
        
        
        
        
    }
    
    public function aprobarPedido($pk=NULL,$fecha=NULL,$sala=NULL,$pksala=NULL,$nombredocente=NULL,
            $apellidodocente=NULL,$pkdocente=NULL,$asignatura=NULL,$pkasignatura=NULL,$periodo=NULL) {
         
           if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
               
                
  $pedido=array('pk'=>$pk,'fecha'=>$fecha,'sala'=>$sala,'pksala'=>$pksala,'nombredocente'=>$nombredocente,'apellidodocente'=>$apellidodocente,'pkdocente'=>$pkdocente,'asignatura'=>$asignatura,'pkasignatura'=>$pkasignatura,'periodo'=>$periodo);
  
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
               // $this->load->view('intranet/bienvenido');
                
             
                
                $this->load->view('intranet/header_menu');
                
                
                $this->load->view('intranet/aprobarPedido',compact('pedido'));
              
                
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }
        
    }
    
    public function aprobarFinal() {
        
        if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
        
        $pkPedido=$this->input->post('pkPedido');
        $sala=$this->input->post('sala');
        
        $updateReserva=$this->admin_model->aprobarReserva($pkPedido,$sala,$_SESSION['usuarioAdmin']);
        
         if($updateReserva==true){
               echo '<script>alert("Reserva Aprobada"); </script>';
               redirect('intranet', 'refresh');
          } 
          else{
               echo '<script>alert("A ocurrido un error al aprobar la reserva"); </script>';
               redirect('intranet', 'refresh');
         } 
           
         
          }
        
        
    }
    
    public function eliminarPedido($pkPedido=NULL){
        
        if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
        
        $eliminarPedido=$this->admin_model->eliminarPedido($pkPedido);
         if($eliminarPedido==true){
               echo '<script>alert("Pedido Eliminado"); </script>';
               redirect('intranet', 'refresh');
          } 
          else{
               echo '<script>alert("A ocurrido un error al eliminar el pedido"); </script>';
               redirect('intranet', 'refresh');
         } 
            }
    }
    
    
    public function editarReserva($pk=NULL,$fecha=NULL,$sala=NULL,$pksala=NULL,$nombredocente=NULL,
            $apellidodocente=NULL,$pkdocente=NULL,$asignatura=NULL,$pkasignatura=NULL,$periodo=NULL,$seccion=NULL) {
        
          if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                
                $docente=$this->admin_model->getPkDocente($pkdocente); 
                $asignaturas=$this->Docente_model->getAsignatura($docente->pk);
                $periodos= $this->Admin_model->getPeriodo();      
                $pkPedido=$pk;
                $academicos=$this->Docente_model->getAcademico();
               
                
                
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
               // $this->load->view('intranet/bienvenido');
                
             
                
                $this->load->view('intranet/header_menu');
                
                
                
                $this->load->view('intranet/editarReserva',compact("pkPedido","asignaturas","periodos","fecha","docente"
                        ,'pk','fecha','sala','pksala','nombredocente',
            'apellidodocente','pkdocente','asignatura','pkasignatura','periodo','pksala','academicos','seccion'));
              
                
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }
        
    }
    
    public function eliminarReserva($pkReserva) {
        
        if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
        
        $eliminarReserva=$this->admin_model->eliminarPedido($pkReserva);
        if($eliminarReserva==true){
               echo '<script>alert("Reserva Eliminada"); </script>';
               redirect('intranet', 'refresh');
          } 
          else{
               echo '<script>alert("A ocurrido un error al eliminar la reserva"); </script>';
               redirect('intranet', 'refresh');
         } 
        
            }
        
    }
    
    public function editarReservaFinal() {
        
        if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                
                $docente=$this->input->post('docente');
                $this->input->post('asignatura');
                $this->input->post('datepicker');
                $this->input->post('periodo');
                $this->input->post('sala');
                
            }
        
    }
    
     public function getAsignaturasDocente2() {
        
        $pkDocente=$this->input->post('docente');
        $pkAsignatura=$this->input->post('asignatura');
        $secciones=$this->Admin_model->getSeccionDeAsignaturaDocente($pkDocente,$pkAsignatura);
        
        foreach ($secciones as $sec) {
     
            echo "<option value=''".$sec->seccion."''>".$sec->seccion."</option>";
            
           
        }
    }
    
    
    
    public function desconectar() {
        session_destroy();
        redirect('welcome');
    }
    
}