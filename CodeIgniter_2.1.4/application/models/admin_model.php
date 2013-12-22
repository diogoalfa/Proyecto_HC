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
    
   }
?>
