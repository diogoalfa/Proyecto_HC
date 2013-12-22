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
       $query = $this->db->query("SELECT d.nombres,d.apellidos,c.asignatura_fk FROM docentes d, cursos c WHERE c.docente_fk=d.pk AND ".$pk."=d.pk ");
        return $query->result();
    }
  
    /* $this->db->select('*');
     $this->db->from('blogs');
      $this->db->join('comments', 'comments.id = blogs.id');*/
}
?>
