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
 
       // $query=$this->db->query("SELECT p.termino,p.inicio,s.sala, d.nombres,d.apellidos, a.nombre,c.seccion FROM reservas r, cursos c, docentes d, salas s, asignaturas a WHERE r.curso_fk=c.pk AND c.docente_fk=d.pk AND r.sala_fk=s.pk AND c.asignatura_fk=a.pk AND ".$pk."=d.pk");              
       //  return $query->result();
        $condicion=array('d.pk'=>$pk);
              $query=$this->db
                ->select('r.pk,p.periodo,p.inicio,p.termino, d.nombres,d.apellidos, a.nombre,s.sala,c.seccion')
                ->from('reservas as r')
                ->join('cursos as c','r.curso_fk=c.pk','inner')
                ->join('docentes as d','c.docente_fk=d.pk','inner')
                ->join('salas as s','r.sala_fk=s.pk','inner')
                ->join('asignaturas as a','c.asignatura_fk=a.pk','inner')
                ->join('periodos as p','p.pk=r.periodo_fk','inner')
                ->where($condicion)
                ->order_by('r.periodo_fk','asc')
                ->get();
        return $query->result();
       }

    public function getDocenteRut($rut){
        $query=$this->db->query("SELECT * FROM docentes WHERE rut='$rut'");
         return $query->row();
    }     
     function getAsignatura($pk_docente) {
        $query=$this->db->query("SELECT a.nombre as nombre, a.pk as pk 
                                 FROM cursos as c,asignaturas as a 
                                 WHERE  c.docente_fk='$pk_docente' AND a.pk=c.asignatura_fk;");
        return $query->result();
     }
     
     public function guardarPedidoSala($fecha,$sala_pk,$periodo_pk,$docente_pk,$asignatura_pk) {
         
         $query=  $this->db
               ->query("INSERT INTO reservas (fecha,sala_fk,periodo_fk,curso_fk) values('$fecha','$sala_pk','$periodo_pk',"
                       . "(SELECT pk FROM cursos WHERE asignatura_fk='$asignatura_pk' and docente_fk='$docente_pk' ));");
         return true;
     }
     
     public function getPedidoSalaDocente($asignatura_pk,$docente_pk){
//$query=$this->db->query("SELECT * FROM reservas WHERE curso_fk=(SELECT pk FROM cursos WHERE asignatura_fk='$asignatura_pk' AND docente_fk='$docente_pk') ");
         
      $query=$this->db->query("SELECT r.*,s.sala,p.periodo FROM reservas as r,salas as s,periodos as p WHERE r.curso_fk=(SELECT pk FROM cursos WHERE asignatura_fk='$asignatura_pk' AND docente_fk='$docente_pk') "
              . "AND s.pk=r.sala_fk AND p.pk=r.periodo_fk ");
         
      return $query->result();
     }
     
     
   }
?>
