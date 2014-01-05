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
                $this->load->view('intranet/header_menu');                
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
                $this->load->view('intranet/header_menu');
                $this->load->view('intranet/academico_menu',compact('academico','asignatura','periodos'));
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
            }


        }

        public function setAcademico(){
            $datos=array(
                'nombres'=>$this->input->post('nombre'),
                'apellidos'=>$this->input->post('apellido'),
                'rut'=>$this->input->post('rut'),
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
                $this->load->view('intranet/header_menu');
                $this->load->view('intranet/salas_menu',compact('salas','academico','periodo'));
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
            $cursoPk=$this->admin_model->pkCurso($docentePk);//extrae el pk apartir del docente
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
            $this->load->view('general/cierre_bodypagina');
            $this->load->view('general/cierre_footer');
        }
        public function getAsignaturasDocente() {

            $pkDocente=$this->input->post('docente');
            $asignaturas=$this->Docente_model->getAsignatura($pkDocente);

            foreach ($asignaturas as $asig) {
                echo form_hidden('seccion',$asig->seccion,'',"id='seccion'");
                echo "<option value=".$asig->pk.">".$asig->nombre." sec. ".$asig->seccion."</option>";
            }
        }
        public function getSala(){
             $pkPeriodo=$this->input->post('periodo');
             $fecha=$this->input->post('datepicker');
             $salasDisponibles=$this->Sala_model->getSalasDisponibles($pkPeriodo,$fecha);
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
            $curso=$this->Docente_model->getCurso($pkDocente,$pkAsignatura);
            $listo=$this->Admin_model->AsignarPorTiempo($pkDocente,$pkAsignatura,$fechaInicio,$fechaTermino,$periodo,$sala,$curso);
        }
        public function desconectar() {
            session_destroy();
            redirect('welcome');
        }

}