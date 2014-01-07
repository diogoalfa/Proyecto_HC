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
    public function setSala(){
                $datos=array(
                 'facultad_fk'=>'1',//facultad de ingenieria=1   
                'sala'=>$this->input->post('nombre'),
                );
                $estado=$this->admin_model->setSala($datos);
                    if($estado==TRUE){
                    echo '<script>alert("Sala Ingresada con Exito"); </script>';
                     redirect('intranet/salas', 'refresh');
             }
    }
    public function setSalaAcademico(){
           
            $docentePk=$this->input->post('docente');
            //print_r($docentePk);
            //$comprobar=$this->admin_model->check($docentePk);//arreglar esto
            $cursoPk=$this->admin_model->pkCurso($docentePk);//extrae el pk apartir del docente
            // print_r($cursoPk);
            if($cursoPk==NULL)
            {
                    echo '<script>alert("Debes asignar un academico con una asignatura previamente"); </script>';
                     redirect('intranet/academico', 'refresh');
            }else{
                         $x=$cursoPk->pk;
                $datos=array(
                'sala_fk'=>$this->input->post('sala'),
                'periodo_fk'=>$this->input->post('periodo'),
                'curso_fk'=>$x,
                'adm_fk'=>'1',//1 por el administrador
                );
                $estado=$this->admin_model->setReserva($datos);
                    if($estado==TRUE){
                    echo '<script>alert("Reserva con Exito"); </script>';
                     redirect('intranet/salas', 'refresh');
             }
            } 
    }
    public function resultadosGral(){//muestra la tabla reserva "todos los datos (sala,periodo, academico etc)"

            if(!isset($_SESSION['usuarioAdmin']))
            {
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                        $this->load->view('intranet/nosesion');
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');

            }else{
                   $result=$this->admin_model->resultadosGral();
                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                    $this->load->view('intranet/bienvenido');
                    $this->load->view('intranet/header_menu');
                      $this->load->view('intranet/resultadosGral',compact('result'));
                    $this->load->view('intranet/fin_header_menu');
                
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }                
    }
    public function eliminar($id=NULL){
        if (!$id) {
            show_404();
        }
        $eliminar = $this->admin_model->delete($id);
        if($eliminar==TRUE)
        {
            echo '<script>alert("Se ha eliminado un registro"); </script>';
            redirect('/intranet/resultadosGral', 'refresh');
        }
    }
    public function editar($id = null){
        $edit=$this->admin_model->getReservas($id);
                    $academico=$this->docente_model->getAcademico();
                    $asignatura=$this->admin_model->getAsignatura();
                    $salas=$this->admin_model->getSala();
                    $periodo=$this->admin_model->getPeriodo();
                    $cursos=$this->admin_model->getCursos();

                $this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                    $edit=$this->admin_model->getReservas($id);
                $this->load->view('intranet/edit',compact('edit','academico','asignatura','salas','periodo','cursos'));
                    //$this->load->view('intranet/bienvenido');
                   // $this->load->view('intranet/header_menu');
                       // $this->load->view('intranet/resultadosGral',compact('result'));
                 //   $this->load->view('intranet/fin_header_menu');
                
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
    }
    public function updateReservas($id){
            //seguir
    }
    
    public function getAsignaturasDocente() {
        
        $pkDocente=$this->input->post('docente');
        $asignaturas=$this->Docente_model->getAsignatura($pkDocente);
        
        foreach ($asignaturas as $asig) {
            echo form_hidden('seccion',$asig->seccion,'',"id='seccion'");
            echo "<option value=".$asig->pk.">".$asig->nombre." sec. ".$asig->seccion."</option>";
        }
    }
    /*public function getSeccionAsignaturasDocente() {
        $pkDocente=$this->input->post('docente');
        $pkAsignatura=$this->input->post('asignatura');
        $asignaturas=$this->Docente_model->getSeccion_AsignaturasDocente($pkDocente,$pkAsignatura);
        
        
    }*/
    
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
        $fechaInicio=$this->input->post('datepickerInicio');   
        $fechaTermino=$this->input->post('datepickerTermino'); 
        $periodo=$this->input->post('periodo');
        $sala=$this->input->post('sala');
        if($pkDocente==null || $pkAsignatura==null || $fechaInicio==null || $fechaTermino==null || $periodo==null || $sala==null){
            echo '<script>alert("Debe llenar todos los campos, sin excepción"); </script>';
            redirect('intranet/academico');
        }
        else{
            $curso=$this->Docente_model->getCurso($pkDocente,$pkAsignatura);
            $listo=$this->Admin_model->AsignarPorTiempo($pkDocente,$pkAsignatura,$fechaInicio,$fechaTermino,$periodo,$sala,$curso); 
            if($listo==TRUE){
                    echo '<script>alert("Exito al guardar las salas"); </script>';
                    redirect('intranet/academico', 'refresh');
            } 
        }
        
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
    
     public function getSeccionDeAsignatura(){
        
         if(!isset($_SESSION['usuarioAdmin']))
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
           // $pkAsignatura='82';
            echo "$pkDocente - $pkAsignatura";
            $secciones=$this->admin_model->getSeccionDeAsignaturaDocente($pkDocente,$pkAsignatura);
            
            foreach ($secciones as $sec) {
         
                echo "<option value='".$sec->seccion."'>".$sec->seccion."</option>";
                
               
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
                $pkPedido=$this->input->post('pkPedido');
                $pkdocente=$this->input->post('docente');
                $pkAsignatura=$this->input->post('asignatura');
                $seccion=$this->input->post('seccion');
                $fecha=$this->input->post('datepicker');
                $periodo=$this->input->post('periodo');
                $pkSala=$this->input->post('sala');
                
                $esEditado=$this->admin_model->editarReserva($pkPedido,$pkdocente,$pkAsignatura,$seccion,$fecha,$periodo,$pkSala);
                if($esEditado==true){
                    echo '<script>alert("Reserva Editada"); </script>';
                    redirect('intranet', 'refresh');
                } 
                else{
                     echo '<script>alert("A ocurrido un error al editar la reserva"); </script>';
                     redirect('intranet', 'refresh');
               }
            }
        
    }
    
    
    
    
    public function desconectar() {
        session_destroy();
        redirect('welcome');
    }
    
}