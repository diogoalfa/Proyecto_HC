 <?php

   class Admin_model extends CI_Model{

       function __construct() {
           parent::__construct();
       }
    
     public function loguearAdmin($nombre, $clave) {
        $where = array("nombre" => $nombre, "clave" => $clave);
        $query = $this->db
                ->select('*')
                ->from('administrador')
                ->where($where)
                ->count_all_results();
        return $query;
     }
     public function getAsignatura(){
            $query=$this->db
                ->select('pk,codigo,nombre')
                ->from('asignaturas')
                ->get();
        return $query->result();
     }
     public function setAcademico($datos){
        $this->db->insert('docentes',$datos);
            return true;
     }
     public function asocia($datos){
        $this->db->insert('cursos',$datos);
         return true;
     }
     public function getSala(){
      $query=$this->db
            ->select('pk,sala')
            ->from('salas')
            ->get();
        return $query->result();  
     }
      public function getPeriodo(){
      $query=$this->db
            ->select('pk,periodo,inicio,termino')
            ->from('periodos')
            ->get();
        return $query->result();  
     }
     public function setSala($datos){
              $this->db->insert('salas',$datos);
         return true;
     }
     public function pkCurso($pk){
        $cond=array('docente_fk'=>$pk);
        $query=$this->db
                    ->select('MAX(pk) as pk')
                    ->from ('cursos')
                    ->where($cond)
                    ->get();
        return $query->row(); 
     }
     public function getCursos(){
            $query=$this->db
                    ->select('pk,asignatura_fk,docente_fk,seccion')
                    ->from ('cursos')
                    ->get();
        return $query->result(); 
     }
     public function setReserva($datos){
                $this->db->insert('reservas',$datos);
         return true;
     }
     public function resultadosGral(){
            $query=$this->db
                ->select('r.pk,p.periodo,p.inicio,p.termino, d.nombres,d.apellidos, a.nombre,s.sala,c.seccion')
                ->from('reservas as r')
                ->join('cursos as c','r.curso_fk=c.pk','inner')
                ->join('docentes as d','c.docente_fk=d.pk','inner')
                ->join('salas as s','r.sala_fk=s.pk','inner')
                ->join('asignaturas as a','c.asignatura_fk=a.pk','inner')
                ->join('periodos as p','p.pk=r.periodo_fk','inner')
                ->order_by('r.periodo_fk','asc')
                ->get();
        return $query->result();
     }
    public function delete($id){
            $this->db->delete('reservas', array('pk' => $id));
            return true;
     }
     public function getReservas($pk){
            $condicion=array('r.pk'=>$pk);
              $query=$this->db
                ->select('r.curso_fk,sala_fk,r.periodo_fk,r.pk,p.periodo,p.inicio,p.termino, d.nombres,d.apellidos, a.nombre,s.sala,c.seccion')
                ->from('reservas as r')
                ->join('cursos as c','r.curso_fk=c.pk','inner')
                ->join('docentes as d','c.docente_fk=d.pk','inner')
                ->join('salas as s','r.sala_fk=s.pk','inner')
                ->join('asignaturas as a','c.asignatura_fk=a.pk','inner')
                ->join('periodos as p','p.pk=r.periodo_fk','inner')
                ->where($condicion)
                ->get();
        return $query->row();
       
     }
     public function edit($id){
            $query = $this->db
                ->select("pk,sala_fk,rut,contacto")
                ->from("reservas")
                ->where(array('pk' =>$id))
                ->get ();
                return $query->row();
     }

        public function AsignarPorTiempo($pkDocente,$pkAsignatura,$fechaInicio,$fechaTermino,$periodo,$sala,$curso){
            date_default_timezone_set("America/Santiago");
            $nuevafecha = strtotime ( '+0 day' , strtotime ( $fechaInicio ) ) ;
            $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
            a:
            if ($nuevafecha<=$fechaTermino) {
                $data = array(
                   'fecha' => "$nuevafecha",
                   'sala_fk' => $sala,
                   'periodo_fk' => $periodo,
                   'curso_fk' => $curso->pk,
                   'adm_fk' =>1,);
                $this->db->insert('reservas', $data);
                $nuevafecha = strtotime ( '+7 day' , strtotime ( $nuevafecha ) ) ;
                $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
                goto a;
            }
            return true;
        }
        
        public function getTodosPedidos() {
         
         $query=$this->db
              ->query("SELECT r.pk,r.fecha,s.sala,s.pk AS pksala,d.nombres AS nombredocente,d.apellidos AS apellidodocente,d.pk AS pkdocente,a.nombre AS asignatura,a.pk AS pkasignatura,p.periodo,p.pk AS pkperiodo 
                    FROM reservas as r,salas as s,docentes as d,cursos as c,asignaturas as a,periodos as p WHERE 
                    r.adm_fk is NULL and
                    s.pk=r.sala_fk and 
                    c.pk=r.curso_fk and 
                    p.pk=r.periodo_fk and 
                    d.pk=c.docente_fk and 
                    a.pk=c.asignatura_fk 
                    ORDER BY pk DESC");
       return $query->result();
     }
     
     
     public function aprobarReserva($pkPedido,$pkSala,$adm) {
         
         $query=  $this->db->query("UPDATE reservas "
                 . "SET sala_fk=$pkSala , adm_fk=(SELECT pk FROM administrador WHERE nombre='$adm' limit 1) "
                 . "WHERE pk=$pkPedido");
         return true;
     }
     
     public function eliminarPedido($pkPedido) {
         
        $this->db->delete('reservas',array('pk'=>$pkPedido));
         return true;
                 
     }
     
     public function getReserva() {
         
         $query=$this->db
                ->query("SELECT r.pk,r.fecha,s.sala,s.pk AS pksala,d.nombres AS nombredocente,d.apellidos AS apellidodocente,d.pk AS pkdocente,a.nombre AS asignatura,a.pk AS pkasignatura,c.seccion,p.periodo,p.pk AS pkperiodo 
                    FROM reservas as r,salas as s,docentes as d,cursos as c,asignaturas as a,periodos as p WHERE 
                    r.adm_fk is not NULL and
                    s.pk=r.sala_fk and 
                    c.pk=r.curso_fk and 
                    p.pk=r.periodo_fk and 
                    d.pk=c.docente_fk and 
                    a.pk=c.asignatura_fk 
                    ORDER BY pk DESC");
        return $query->result();
     }
     
     
     public function editarReserva($pkPedido,$pkdocente,$pkAsignatura,$seccion,$fecha,$periodo,$pkSala) {
         $this->db->
                 query("UPDATE reservas  SET "
                       ."sala_fk='$pkSala', "
                       ."periodo_fk=(SELECT pk FROM periodos WHERE periodo='$periodo'), "
                       ."curso_fk=(SELECT pk FROM cursos WHERE  asignatura_fk='$pkAsignatura' AND docente_fk='$pkdocente' AND seccion='$seccion' ) ,"
                       . "fecha='$fecha' "
                       ." WHERE pk=$pkPedido");
         return true;
         
     }
     
     public function getPkDocente($pkDocente) {
         $query=$this->db->query("SELECT * FROM docentes WHERE pk=$pkDocente ");
         return $query->row();
     }
      
     public function getSeccionDeAsignaturaDocente($pkDocente,$pkAsignatura) {
         $query=$this->db
                 ->query("SELECT seccion FROM cursos WHERE docente_fk=$pkDocente AND asignatura_fk=$pkAsignatura ;");
         return $query->result();
     }


    
    
   }
?>

