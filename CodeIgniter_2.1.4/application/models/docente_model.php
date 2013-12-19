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
  
    
}
?>
