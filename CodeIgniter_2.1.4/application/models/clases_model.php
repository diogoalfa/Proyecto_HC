<?php 
class Clases_model extends CI_Model{

        public function getTime(){
            date_default_timezone_set("America/Santiago");
            $hour= date("H");
            $min= date("i");
            $sec= date("s");
            $time=$hour.":".$min.":".$sec;
            if (($time>"09:35:00" && $time<"9:45:00")||($time>"11:05:00" && $time<"11:15:00")||($time>"12:35:00" && $time<"12:45:00")||($time>"14:05:00" && $time<"14:15:00")||($time>"15:35:00" && $time<"15:45:00")||($time>"17:05:00" && $time<"17:15:00")||($time>"18:35:00" && $time<"19:00:00")||($time>"20:30:00" && $time<"20:45:00")) 
            $min=$min+"10"; //ahi que probar esto mañana
            $time=$hour.":".$min.":".$sec;
            return $time;
        }

        public function getDate(){
            $year=date("Y");
            $month=date("N");
            $day=date("j");
            if (strlen($month)==1) {
                $month="0$month";   //una forma de concadenar
            }
            if (strlen($day)==1) {
                $day="0".$day;      //otra forma de concadenar
            }
            $date=$year."-".$month."-".$day;
            return $date;
        }

	    public function getAhora($time,$date){
            if ($time>="08:15" && $time<="22:15") {
                //Esta dentro del limite y si esta en receso automaticamente lo asigna al siguiente periodo 
                //gracias al "if" que hay en la funcion "getTime"
                
            }
            else{
                if ($time>"22:15:00" && $time<"23:59:59") {
                    $time="08:15:01";
                    
                }
                else{                
                    $time="08:15:01";
                }
            }


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