
<footer class="footer"><?php 
            date_default_timezone_set("America/Santiago");
            $time  = date("H:i:s");
            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $fecha= $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

            echo "Universidad Tecnologica Metropolitana del Estado de Chile.";echo "<br/>";
              echo "Son las $time, $fecha";


?> <ul class="breadcrumb">
  <li>
    <a href="http://www.utem.cl" target="_blank">UTEM</a> <span class="divider">/</span>
  </li>
  <li>
    <a href="http://postulacion.utem.cl" target="_blank">Dirdoc</a> <span class="divider">/</span>
  </li>
  <li>
    <a href="http://reko.utem.cl" target="_blank">Reko</a> <span class="divider">/</span>
  </li>
  <li>
    <a href="http://www.cftutem.cl" target="_blank">CFTUTEM</a> <span class="divider">/</span>
  </li>
  <li>
    <a href="http://utemvirtual.cl" target="_blank">UTEM Virtual</a> <span class="divider">/</span>
  </li>
</ul></footer>
</body>
</html>