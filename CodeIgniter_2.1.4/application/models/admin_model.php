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
        $cond=array('c.docente_fk'=>$pk);
        $query=$this->db
                    ->select('c.pk')
                    ->from('cursos as c')
                    ->join('docentes as d','d.pk=c.docente_fk','inner')
                    ->where($cond)
                    ->get();
        return $query->row(); 
     }
     public function setReserva($datos){
                $this->db->insert('reservas',$datos);
         return true;
     }
     public function resultadosGral(){
            $query=$this->db
                ->select('p.periodo,p.inicio,p.termino, d.nombres,d.apellidos, a.nombre,s.sala,c.seccion')
                ->from('reservas as r')
                ->join('cursos as c','r.curso_fk=c.pk','inner')
                ->join('docentes as d','c.docente_fk=d.pk','inner')
                ->join('salas as s','r.sala_fk=s.pk','inner')
                ->join('asignaturas as a','c.asignatura_fk=a.pk','inner')
                ->join('periodos as p','p.pk=r.periodo_fk','inner')
                ->get();
        return $query->result();
     }

    
   }
?>
