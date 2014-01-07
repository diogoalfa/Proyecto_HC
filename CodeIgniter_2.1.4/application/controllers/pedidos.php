<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Pedidos extends CI_Controller {

  function __construct() {
    parent::__construct();
    session_start();   
  }

  public function index(){

    $this->load->view('general/headers');
    $this->load->view('general/menu_principal');
    $this->load->view('general/abre_bodypagina');
    if(!isset($_SESSION['usuarioProfesor'])){
      $this->load->view('pedidos/login_docente');
    }
    else{
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
    $this->load->view('pedidos/consultaPorAsignatura',compact("asignaturas",'docente'));
    $asignatura_pk=$this->input->post('asignatura');
    $seccion=  $this->input->post('seccion');
    $pkDocente=$this->input->post('docente');
    if($seccion){
     
      $pedidos=$this->Docente_model->getPedidoSalaDocente($asignatura_pk,$docente->pk,$seccion);
      $this->load->view('pedidos/verPedidos',compact("pedidos","asignatura_pk","seccion"));
    }
    $this->load->view('general/cierre_bodypagina');
    $this->load->view('general/cierre_footer');
  }
}

public function editarPedido($pkPedido=null,$fecha=null,$seccion=null,$pkdocente=NULL,
        $pkasignatura=NULL,$nombreasignatura=NULL,$nombredocente=NULL,$periodo=NULL,$pksala=NULL,$sala=NULL){

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
    $secciones= $this->Admin_model->getSeccionDeAsignaturaDocente($pkdocente,$pkasignatura);
    $this->load->view('general/headers');
    $this->load->view('general/menu_principal');
    $this->load->view('general/abre_bodypagina');
    $this->load->view('pedidos/selecionar_opcionPedidos');
    $this->load->view('pedidos/editarPedido',compact("secciones",'asignaturas','periodos','pkPedido','fecha','seccion','pkdocente',
        'pkasignatura','nombreasignatura','nombredocente','periodo','pksala','sala'));
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

    $pkPedido=  $this->input->post('pkPedido');
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
    $pkPeriodo= $this->input->post('periodo');
    $fecha=$this->input->post('datepicker');
    $salasDisponibles=$this->Sala_model->getSalasDisponibles($pkPeriodo,$fecha);
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
  } else{
   $fecha= $this->input->post('datepicker');
    $sala_pk=$this->input->post('sala'); 
    $periodo_pk=$this->input->post('sePeriodo'); 
    $docente_pk=$this->input->post('docente'); 
    $asignatura_pk=$this->input->post('asignatura'); 
    $seccion=$this->input->post('seccion'); 
    if($fecha==null || $sala_pk==null || $periodo_pk==null || $docente_pk==null || $asignatura_pk==null || $seccion==null )
      { redirect('pedidos/pedirSala');
       }else{ 
        $date=$this->Clases_model->getDate(); 
        $listo=$this->Docente_model->hayProfesor($fecha,$sala_pk,$periodo_pk,$docente_pk,$asignatura_pk,$seccion,$date);
         if ($listo->cantidad==0) { 
          $pedidoSala=$this->Docente_model->guardarPedidoSala($fecha,$sala_pk,$periodo_pk,$docente_pk,$asignatura_pk,$seccion,$date); 
        } else{ 
          echo '<script>alert("El profesor ya esta asignado a esa hora y en esa fecha"); </script>'; 
          redirect('pedidos', 'refresh'); 
        } if($pedidoSala==true){
         echo '<script>alert("Se ha guardado Exitosamente!"); </script>'; 
         redirect('pedidos', 'refresh');
          } else{ echo '<script>alert("Ha ocurrido un error !"); </script>';
           redirect('pedidos', 'refresh'); 
         } 
       } 
     } 
    }

    public function getSeccionDeAsignatura(){
        
         if(!isset($_SESSION['usuarioProfesor']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
         
        $pkDocente=$this->input->post('docente');
        $pkAsignatura=$this->input->post('asignatura');
        echo "$pkDocente - $pkAsignatura";
        $secciones=$this->Admin_model->getSeccionDeAsignaturaDocente($pkDocente,$pkAsignatura);
        
        foreach ($secciones as $sec) {
     
            echo "<option value='".$sec->seccion."'>".$sec->seccion."</option>";
            
           
        }
            }
    }

}
