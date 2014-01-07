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
    public function academicoSemana($pk,$time,$dateIni){
        $dateFin = strtotime ('next friday', strtotime ( $dateIni ) ) ;
        $dateFin = date ( 'Y-m-d' , $dateFin );
        $condicion=array('d.pk'=>$pk,
                         'r.fecha >='=>$dateIni,
                         'r.fecha <='=>$dateFin
          );
              $query=$this->db
                ->select('r.pk,p.periodo,p.inicio,p.termino, r.fecha,d.apellidos, a.nombre,s.sala,c.seccion')
                ->from('reservas as r')
                ->join('cursos as c','r.curso_fk=c.pk','inner')
                ->join('docentes as d','c.docente_fk=d.pk','inner')
                ->join('salas as s','r.sala_fk=s.pk','inner')
                ->join('asignaturas as a','c.asignatura_fk=a.pk','inner')
                ->join('periodos as p','p.pk=r.periodo_fk','inner')
                ->where($condicion)
                ->order_by('r.fecha','asc')
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
     
 public function hayProfesor($fecha,$sala_pk,$periodo_pk,$docente_pk,$asignatura_pk,$seccion,$date){ 
  $query=$this->db->query("SELECT count (*) AS cantidad 
    From reservas as r, docentes as d, cursos as c, periodos as p 
    Where r.periodo_fk=p.pk and
     r.curso_fk=c.pk and
      c.docente_fk=d.pk and 
      p.pk='$periodo_pk' and 
      d.pk='$docente_pk' and
       r.fecha='$date'"); 
  return $query->row(); 
} 

  public function guardarPedidoSala($fecha,$sala_pk,$periodo_pk,$docente_pk,$asignatura_pk,$seccion,$date)
   { 
    $this->db ->query("INSERT INTO reservas (fecha,sala_fk,periodo_fk,curso_fk) values('$fecha','$sala_pk','$periodo_pk',(select pk FROM cursos WHERE asignatura_fk='$asignatura_pk' and docente_fk='$docente_pk' and seccion=$seccion));");
     return true; 
   }
     
     public function getPedidoSalaDocente($asignatura_pk,$docente_pk,$seccion){
//$query=$this->db->query("SELECT * FROM reservas WHERE curso_fk=(SELECT pk FROM cursos WHERE asignatura_fk='$asignatura_pk' AND docente_fk='$docente_pk') ");
         
      $query=$this->db->query("SELECT r.*,s.sala,s.pk AS pksala,p.periodo,d.pk AS pkdocente,d.nombres AS nombredocente,"
              . "d.apellidos AS apellidodocente,a.pk AS pkasignatura,a.nombre AS nombreasignatura "
              . "FROM reservas as r,salas as s,periodos as p,docentes as d ,asignaturas as a "
              . "WHERE r.curso_fk=(SELECT pk FROM cursos WHERE asignatura_fk='$asignatura_pk' "
              . "AND docente_fk='$docente_pk' AND seccion='$seccion') "
              . "AND s.pk=r.sala_fk "
              . "AND p.pk=r.periodo_fk "
              . "AND d.pk=(SELECT docente_fk FROM cursos WHERE pk=r.curso_fk ) "
              . "AND a.pk=(SELECT asignatura_fk FROM cursos WHERE pk=r.curso_fk )");
         
      return $query->result();
     }
     
     public function borrarPedido($pkPedido){
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

      public function getCurso($pkDocente,$pkAsignatura){

        $where=array('d.pk ='=>$pkDocente,
                    'a.pk ='=>$pkAsignatura);

        $query=$this->db
              ->select('c.pk') 
              ->from ('cursos as c')
              ->join('docentes as d','d.pk = c.docente_fk','inner')
              ->join('asignaturas as a','a.pk = c.asignatura_fk','inner')
              ->where($where)
              ->get ();
        return $query->row();
      }

     
   }
?>
