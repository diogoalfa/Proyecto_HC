<?php

   class Docente_model extends CI_Model{

       function __construct() {
           parent::__construct();
    }
    
    public function loguearDocente($usuario,$clave) {
        
        $where=array("usuario"=>$usuario,'clave'=>$clave);
        
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
    public function academicoSemana($datos){
       /* $where=array("d.pk"=>$datos,'d.pk'=>'c.docente_fk');
        $query=$this->db
                ->select('d.nombres,d.apellidos,c.asignatura_fk')
                ->from('docentes d, cursos c')
                ->where($where)
                ->get();
        return $query->result();*/
        $query = $this->db->query("SELECT d.nombres,d.apellidos,c.asignatura_fk FROM docentes d, cursos c WHERE c.docente_fk=d.pk");
        return $query->result();
    }
  
    
}
?>
