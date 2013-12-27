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
 
       $query=$this->db->query("SELECT s.sala, d.nombres,d.apellidos, a.nombre,c.seccion FROM reservas r, cursos c, docentes d, salas s, asignaturas a WHERE r.curso_fk=c.pk AND c.docente_fk=d.pk AND r.sala_fk=s.pk AND c.asignatura_fk=a.pk AND ".$pk."=d.pk");              
        return $query->result();
       }

    public function getDocenteRut($rut){
        $query=$this->db->query("SELECT * FROM docentes WHERE rut='$rut'");
         return $query->row();
    }     
     function getAsignatura($pk) {
        $query=$this->db->query("SELECT a.nombre as nombre, a.pk as pk 
                                 FROM cursos as c,asignaturas as a 
                                 WHERE  c.docente_fk='$pk' AND a.pk=c.asignatura_fk;");
        return $query->result();
     }
     
     public function guardarPedidoSala($fecha,$sala_pk,$periodo_pk,$docente_pk,$asignatura_pk) {
         
         $query=  $this->db
               ->query("INSERT INTO reservas (fecha,sala_fk,periodo_fk,curso_fk) values('$fecha','$sala_pk','$periodo_pk',"
                       . "(SELECT pk FROM cursos WHERE asignatura_fk='$asignatura_pk' and docente_fk='$docente_pk' ));");
         return true;
     }
   }
?>
