<?php

   class Docente_model extends CI_Model{

       function __construct() {
           parent::__construct();
       }
    
    public function loguearDocente($rut,$clave) {
        
        $where=array("rut"=>$rut,'clave'=>$clave);
        
        $query=$this->db
                ->select('*')
                ->from('profesor')
                ->where($where)
                ->count_all_results();
        return $query;
    }
    public function getDocente(){
        $query=$this->db
                ->select('*')
                ->from('profesor')
                ->get();
        return $query->result();
    }
    public function getAcademico(){
        $query=$this->db
                ->select('pk,nombres,apellidos')
                ->from('docentes')
                ->get();
        return $query->result();
    }
    public function academicoSemana($pk){
        //$where=array('d.pk'=>);
   /*     $query=$this->db
                ->select('docentes.nombres,docentes.apellidos,cursos.asignatura_fk')
                ->from('docentes')
                //->where($where)
                ->join('cursos','cursos.asignatura_fk=docentes.pk')
                ->get();

 */ 
               /* $where = "cursos.docente_fk = docentes.pk";
         $query=$this->db
                ->select('docentes.nombres,docentes.apellidos,cursos.asignatura_fk')
                ->from('docentes')
                ->from('cursos')
                ->where($where)
                 ->get();      */   
       $query=$this->db->query("SELECT s.sala, d.nombres,d.apellidos, a.nombre,c.seccion FROM reservas r, cursos c, docentes d, salas s, asignaturas a WHERE r.curso_fk=c.pk AND c.docente_fk=d.pk AND r.sala_fk=s.pk AND c.asignatura_fk=a.pk AND ".$pk."=d.pk");              
      // $query = $this->db->query("SELECT d.nombres,d.apellidos,a.nombre,c.seccion FROM docentes d, cursos c, asignaturas a WHERE c.docente_fk=d.pk AND ".$pk."=d.pk AND c.asignatura_fk=a.pk");
        return $query->result();
       }
  
    /* $this->db->select('*');
     $this->db->from('blogs');
      $this->db->join('comments', 'comments.id = blogs.id');*/
    public function getDocenteRut($rut){
       //  $where=array('rut'=>$rut);
         /*$query=$this->db
                ->select('pk')
                ->from('docentes')
                ->where($where)
                ->get();
          */
        $query=$this->db->query("SELECT * FROM docentes WHERE rut='$rut'");
         return $query->row();
    }     
     function getAsignatura($pk) {
        $query=$this->db->query("SELECT a.nombre as nombre, a.pk as pk 
                                 FROM cursos as c,asignaturas as a 
                                 WHERE  c.docente_fk='$pk' AND a.pk=c.asignatura_fk;");
        return $query->result();
     }
     function getAsignaturaRut($rut) {
        $query=$this->db->query("SELECT a.nombre as nombre 
                                 FROM docentes as d,cursos as c,asignaturas as a 
                                 WHERE d.rut='$rut' c.docente_fk=d.pk AND a.pk=c.asignatura_fk;");
        return $query->result();
     }
   }
?>
