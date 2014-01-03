<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>



<footer><?php 
            date_default_timezone_set("America/Santiago");
            $time  = date("H:i:s");
            $year=date("Y");
            $month=date("n");
            $day=date("j");
            if (strlen($month)==1) {
                $month="0$month";
            }
            if (strlen($day)==1) {
                $day="0".$day;
            }
            $date=$day."/".$month."/".$year;
            echo "@UTEM-Company $time $date";


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