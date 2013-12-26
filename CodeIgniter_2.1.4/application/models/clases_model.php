<?php 
class Clases_model extends CI_Model{
	    public function getClases(){
        $time  = date("H:i:s");

      $condicion=array(
          
          'p.inicio <='=>$time,
          'p.termino >='=>$time,
        );
      $query=$this->db
              ->select('p.periodo,p.inicio,p.termino, d.nombres,d.apellidos, a.nombre,s.sala,c.seccion')
              ->from('reservas as r')
              ->join('cursos as c','r.curso_fk=c.pk','inner')
              ->join('docentes as d','c.docente_fk=d.pk','inner')
              ->join('salas as s','r.sala_fk=s.pk','inner')
              ->join('asignaturas as a','c.asignatura_fk=a.pk','inner')
              ->join('periodos as p','p.pk=r.periodo_fk','inner')
              ->where($condicion)
              ->get();
      return $query->result();
    }
}
 ?>