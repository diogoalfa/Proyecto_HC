<?php


 class Sala_model extends CI_Model{

       function __construct() {
           parent::__construct();
       }
        
        public function getSalasDisponibles($pkPeriodo,$fecha) {
            
            $consul="select *
                   from salas 
                   where pk not in (select sala_fk from reservas where periodo_fk=".$pkPeriodo." and fecha='$fecha');";
            
            $query=  $this->db
           ->query($consul);
           return $query->result();
        }
        
       
        
      
       
       
       
 }
 
 