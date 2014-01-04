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
       // $query=$this->db->query("SELECT * FROM docentes WHERE rut='$rut'");
       $where=array('rut'=>$rut);
       $query= $this->db
               ->select('*')
               ->from('docentes')
               ->where($where)
               ->get();
         return $query->row();
    }     
     function getAsignatura($pk_docente) {
        $query=$this->db->query("SELECT a.pk as pk, a.nombre as nombre, c.seccion as seccion 
                                 FROM cursos as c,asignaturas as a 
                                 WHERE  c.docente_fk='$pk_docente' AND a.pk=c.asignatura_fk;");
        return $query->result();
     }
     
     public function guardarPedidoSala($fecha,$sala_pk,$periodo_pk,$docente_pk,$asignatura_pk,$seccion) {
         echo "$seccion";
         $query=  $this->db
               ->query("INSERT INTO reservas (fecha,sala_fk,periodo_fk,curso_fk) values('$fecha','$sala_pk','$periodo_pk'"
                       . ",(select pk FROM cursos WHERE asignatura_fk='$asignatura_pk' and docente_fk='$docente_pk' and seccion=$seccion));");
         return true;
     }
     
     public function getPedidoSalaDocente($asignatura_pk,$docente_pk,$seccion){
//$query=$this->db->query("SELECT * FROM reservas WHERE curso_fk=(SELECT pk FROM cursos WHERE asignatura_fk='$asignatura_pk' AND docente_fk='$docente_pk') ");
         
      $query=$this->db->query("SELECT r.*,s.sala,p.periodo FROM reservas as r,salas as s,periodos as p WHERE r.curso_fk=(SELECT pk FROM cursos WHERE asignatura_fk='$asignatura_pk' AND docente_fk='$docente_pk' AND seccion='$seccion') "
              . "AND s.pk=r.sala_fk AND p.pk=r.periodo_fk ");
         
      return $query->result();
     }
     
     public function borrarPedido($pkPedido) {
        $this->db
             ->delete('reservas',array('pk'=>$pkPedido));
         return true;
     }
     
     public function getDocentePkPedido($pkPedido) {
         
        /* $query=$this->db
                 ->select('*')
                 ->from()
                 ->where()
                 ->get();
         * 
         */
        $query=$this->db
                 ->query('SELECT FROM reservas as r,docentes s WHERE');
         
         return $query->row();
     }
     
     public function updatePedido($pkPedido,$asignatura,$fecha,$periodo,$sala,$seccion,$docente) {
        
       $this->db
               ->query("UPDATE reservas  SET "
                       ."sala_fk='$sala', "
                       ."periodo_fk=(SELECT pk FROM periodos WHERE periodo='$periodo'), "
                       ."curso_fk=(SELECT pk FROM cursos WHERE  asignatura_fk='$asignatura' AND docente_fk='$docente' AND seccion='$seccion' ) ,"
                       . "fecha='$fecha' "
                       ." WHERE pk=$pkPedido");
       return true;
     }

     /*public function getSeccion_AsignaturasDocente($pkDocente,$pkAsignatura)){

        ->query=$this->db
              ->query('SELECT c.seccion from cursos c, docentes d,asignaturas a where d.pk=c.docente_fk and d.pk=$pkDocente and a.pk=c.asignatura_fk and a.pk=$pkAsignatura');
        return $query->row();

     }*/
     
     
   }
?>
