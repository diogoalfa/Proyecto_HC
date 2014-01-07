<?php 
class Clases_model extends CI_Model{

    public function getTime(){
        date_default_timezone_set("America/Santiago");
        $hour= date("H");
        $min= date("i");
        $sec= date("s");
        $time=$hour.":".$min.":".$sec;
        //echo $time=$hour.":".$min.":".$sec;
        if (($time>"09:35:00" && $time<"09:45:00")||($time>"11:05:00" && $time<"11:15:00")||($time>"12:35:00" && $time<"12:45:00")||($time>"14:05:00" && $time<"14:15:00")||($time>"15:35:00" && $time<"15:45:00")||($time>"17:05:00" && $time<"17:15:00")||($time>"18:35:00" && $time<"19:00:00")||($time>"20:30:00" && $time<"20:45:00")) {
            $min=$min+"10"; 
            //ahi que probar esto mañana
        }
        $time=$hour.":".$min.":".$sec;
        //echo $time=$hour.":".$min.":".$sec;
        return $time;
    }

    public function getDate(){
        date_default_timezone_set("America/Santiago");
        $year=date("Y");
        $month=date("n");
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
        if ($day=date("N")<=5 && $day=date("j")>=1) {
            if ($time>="08:15" && $time<="22:15") {
            //Esta dentro del limite y si esta en receso automaticamente lo asigna al siguiente periodo 
            //gracias al "if" que hay en la funcion "getTime"
                
            }
            else{
                if ($time>"22:15:00" && $time<"23:59:59") {
                    $time="08:15:01";
                    if ($day=date("j")==5) {
                        $nuevafecha = strtotime ( 'next monday' , strtotime ( $date ) ) ;
                        $date = date ( 'Y-m-d' , $nuevafecha );
                    }
                    else{
                        $nuevafecha = strtotime ( '+1 day' , strtotime ( $date ) ) ;
                        $date = date ( 'Y-m-d' , $nuevafecha );
                    }
                    
                    
                }
                else{                
                    $time="08:15:01";
                }
            }
        }
        else{
            $time="08:15:01";
            $nuevafecha = strtotime ('next monday', strtotime ( $date ) ) ;
            $date = date ( 'Y-m-d' , $nuevafecha );
        }

        $condicion=array(
            
            'p.inicio <='=>$time,
            'p.termino >='=>$time,
            'r.fecha ='=>$date,
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
//arreglar para la wa del isnot null

        /*//INI
        date_default_timezone_set("America/Santiago");
        $year=date("Y");
        $month=date("n");
        $day=date("j");
        if (strlen($month)==1) {
            $month="0$month";   //una forma de concadenar
        }
        if (strlen($day)==1) {
            $day="0".$day;      //otra forma de concadenar
        }
        $date=$year."-".$month."-".$day;
        while($date<"2014-02-13"){
            for ($conta=1; $conta<=7 ; $conta++) { 
                if ($day=="31" && ($month=="01"||$month=="03"||$month=="05"||$month=="07"||$month=="08"||$month=="10"||$month=="12")){
                    if ($month=="12") {
                        $day="01";
                        $month="01";
                        $year=$year+"0001";
                    }
                    else{
                        $day="01";
                        $month=$month+"01";
                    }
                }
                elseif ($day=="30" && ($month=="04"||$month=="06"||$month=="09"||$month=="11")) {
                    $day="01";
                    $month=$month+"01";
                }
                else{
                    $day=$day+"01";
                }
                if (strlen($month)==1) {
                    $month="0$month";   //una forma de concadenar
                }
                if (strlen($day)==1) {
                    $day="0".$day;      //otra forma de concadenar
                }
            }
            $date=$year."-".$month."-".$day;
            //echo "$date<br>";
        }
        //FIN*/





        return $query->result();
    }

    public function getHoy($time, $date){
        if ($day=date("N")<=5 && $day=date("j")>=1) {
            
        }
        else{
            $nuevafecha = strtotime ('next monday', strtotime ( $date ) ) ;
            $date = date ( 'Y-m-d' , $nuevafecha );
        }
        $condicion=array(
                'r.fecha ='=>$date,
              );
                
        $query=$this->db
                ->select('p.periodo,p.inicio,p.termino, d.nombres,d.apellidos, a.nombre,s.sala,c.seccion')
                ->from('reservas as r')
                ->join('cursos as c','r.curso_fk=c.pk','inner')
                ->join('docentes as d','c.docente_fk=d.pk','inner')
                ->join('salas as s','r.sala_fk=s.pk','inner')
                ->join('asignaturas as a','c.asignatura_fk=a.pk','inner')
                ->join('periodos as p','p.pk=r.periodo_fk','inner')
                ->where ($condicion)
                ->order_by('p.periodo','asc')
                ->get();
        return $query->result();

    }






}
 ?>