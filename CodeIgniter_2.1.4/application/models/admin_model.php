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
        $cond=array('docente_fk'=>$pk);
        $query=$this->db
                    ->select('MAX(pk) as pk')
                    ->from ('cursos')
                    ->where($cond)
                    ->get();
        return $query->row(); 
     }
     public function getCursos(){
            $query=$this->db
                    ->select('pk,asignatura_fk,docente_fk,seccion')
                    ->from ('cursos')
                    ->get();
        return $query->result(); 
     }
     public function setReserva($datos){
                $this->db->insert('reservas',$datos);
         return true;
     }
     public function resultadosGral(){
            $query=$this->db
                ->select('r.pk,p.periodo,p.inicio,p.termino, d.nombres,d.apellidos, a.nombre,s.sala,c.seccion')
                ->from('reservas as r')
                ->join('cursos as c','r.curso_fk=c.pk','inner')
                ->join('docentes as d','c.docente_fk=d.pk','inner')
                ->join('salas as s','r.sala_fk=s.pk','inner')
                ->join('asignaturas as a','c.asignatura_fk=a.pk','inner')
                ->join('periodos as p','p.pk=r.periodo_fk','inner')
                ->order_by('r.periodo_fk','asc')
                ->get();
        return $query->result();
     }
    public function delete($id){
            $this->db->delete('reservas', array('pk' => $id));
            return true;
     }
     public function getReservas($pk){
            $condicion=array('r.pk'=>$pk);
              $query=$this->db
                ->select('r.curso_fk,sala_fk,r.periodo_fk,r.pk,p.periodo,p.inicio,p.termino, d.nombres,d.apellidos, a.nombre,s.sala,c.seccion')
                ->from('reservas as r')
                ->join('cursos as c','r.curso_fk=c.pk','inner')
                ->join('docentes as d','c.docente_fk=d.pk','inner')
                ->join('salas as s','r.sala_fk=s.pk','inner')
                ->join('asignaturas as a','c.asignatura_fk=a.pk','inner')
                ->join('periodos as p','p.pk=r.periodo_fk','inner')
                ->where($condicion)
                ->get();
        return $query->row();
       
     }
     public function edit($id){
            $query = $this->db
                ->select("pk,sala_fk,rut,contacto")
                ->from("reservas")
                ->where(array('pk' =>$id))
                ->get ();
                return $query->row();
     }

    public function AsignacionPorTiempo($pkDocente,$pkAsignatura,$semestre,$fechaInicio,$fechaTermino,$periodo,$sala){
        //echo $pkDocente."<br>".$pkAsignatura."<br>".$semestre."<br>".$fechaInicio."<br>".$fechaTermino."<br>".$periodo."<br>".$sala;
        
        $date = explode("-", $fechaInicio, 3);
        $year=$date[0];   //año
        $month=$date[1];   //mes
        $day=$date[2];   //dia
        echo "fecha inicio: ".$fechaInicio."<br>";
        echo "fecha termino: ".$fechaTermino."<br>";
        
        // if (strlen($month)==1) {
        //     $month="0".$month;   //una forma de concadenar
        // }
        // if (strlen($day)==1) {
        //     $day="0".$day;      //otra forma de concadenar
        // }
        $date="$year-$month-$day";
        while($date<="$fechaTermino" ){
            echo "<br><br>".$date."<br>";
            for ($conta=1; $conta<=7 || $date<"2014-02-28"; $conta++) { 
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
            }
            $date="$year-$month-$day";
            
        }

        // $data = array(
        //        'fecha' => ,
        //        'sala_fk' => ,
        //        'periodo_fk' => ,
        //        'curso_fk' => ,
        //        'adm_fk' => ,
        //     );

        // $this->db->insert('mitabla', $data); 
        }

    
    
   }
?>

