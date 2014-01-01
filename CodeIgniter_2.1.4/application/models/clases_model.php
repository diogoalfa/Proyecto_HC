<?php 
class Clases_model extends CI_Model{

        public function getTime(){
            date_default_timezone_set("America/Santiago");
            $time  = date("H:i:s");
            return $time;
        }

        public function getDate(){
            $year=date("Y");
            $month=date("N");
            $day=date("j");
            if (strlen($month)==1) {
                $month="0$month";
            }
            if (strlen($day)==1) {
                $day="0".$day;
            }
            $date=$year."-".$month."-".$day;
            return $date;
        }

	    public function getAhora($time,$date){
            //echo $date;

            $condicion=array(
                
                'p.inicio <='=>$time,
                'p.termino >='=>$time,
                //tomar dia falta
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
                    ->order_by('c.seccion','asc')
                    ->get();
            return $query->result();
        }

    public function getHoy($date){
        //echo $date;
        $query=$this->db
                ->select('p.periodo,p.inicio,p.termino, d.nombres,d.apellidos, a.nombre,s.sala,c.seccion')
                ->from('reservas as r')
                ->join('cursos as c','r.curso_fk=c.pk','inner')
                ->join('docentes as d','c.docente_fk=d.pk','inner')
                ->join('salas as s','r.sala_fk=s.pk','inner')
                ->join('asignaturas as a','c.asignatura_fk=a.pk','inner')
                ->join('periodos as p','p.pk=r.periodo_fk','inner')
                //where del dia falta
                ->order_by('p.periodo','asc')
                ->get();
        return $query->result();

    }






}
 ?>