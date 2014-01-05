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

    public function AsignarPorTiempo($pkDocente,$pkAsignatura,$fechaInicio,$fechaTermino,$periodo,$sala,$curso){
        //echo $pkDocente."<br>".$pkAsignatura."<br>".$fechaInicio."<br>".$fechaTermino."<br>".$periodo."<br>".$sala."<br>".$curso;
        

        
        //echo "$fechaInicio -- $fechaTermino<br>";

        $nuevafecha = strtotime ( '+0 day' , strtotime ( $fechaInicio ) ) ;
        $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
        a:
        if ($nuevafecha<=$fechaTermino) {
            $data = array(
               'fecha' => "$nuevafecha",
               'sala_fk' => $sala,
               'periodo_fk' => $periodo,
               'curso_fk' => $curso->array(),
               'adm_fk' =>1,
            );

            $this->db->insert('reservas', $data);
            $nuevafecha = strtotime ( '+7 day' , strtotime ( $nuevafecha ) ) ;
            $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
            goto a;
        }

        //obtener curso_fk

         
        }

    
    
   }
?>

