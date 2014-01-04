<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>



<footer><?php 
            date_default_timezone_set("America/Santiago");
            $time  = date("H:i:s");
            //Otro forma de fecha
            /*$year=date("Y");
            $month=date("n");
            $day=date("j");
            if (strlen($month)==1) {
                $month="0$month";
            }
            if (strlen($day)==1) {
                $day="0".$day;
            }
            $date=$day."/".$month."/".$year;*/
            
            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $fecha= $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

            echo "@UTEM-Company Son las $time, $fecha";


?> <ul class="breadcrumb">
  <li>
    <a href="#">Consulta</a> <span class="divider">/</span>
  </li>
  <li>
    <a href="#">Pedidos</a> <span class="divider">/</span>
  </li>
  <li>
    <a href="#">Profesores</a> <span class="divider">/</span>
  </li>
  <li>
    <a href="#">Ayuda</a> <span class="divider">/</span>
  </li>
  <li>
    <a href="#">Intranet</a> <span class="divider">/</span>
  </li>
  <li class="active">Data</li>
</ul></footer>
</body>
</html>