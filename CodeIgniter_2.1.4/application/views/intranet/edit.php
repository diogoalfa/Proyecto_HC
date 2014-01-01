<div class="row-fluid"><br>
  <div class="span12">
     <?php 
                $atributosPeriodo= array( "" => "Seleccione un Periodo", );
                    foreach ($periodo as $peri){ 
                        $atributosPeriodo[$peri->pk] = $peri->periodo." -> ".$peri->inicio." - ".$peri->termino; }
                $atributosAcademico= array( "" => "Seleccione un Academico", );
                     foreach ($academico as $profesor){ 
                        $atributosAcademico[$profesor->pk] = $profesor->nombres." ".$profesor->apellidos; }
                $listaAsignatura= array( "" => "Seleccione una Asignatura", );
                    foreach ($asignatura as $ramo){ 
                        $listaAsignatura[$ramo->pk] = $ramo->nombre." ".$ramo->codigo; }
                $atributosSala= array( "" => "Seleccione una Sala", );
                    foreach ($salas as $aula){ 
                        $atributosSala[$aula->pk] = $aula->sala; }                
                 ?>
                          <?php 
            echo "<table class='table table-hover-striped'>
                   <thead>
                    <tr>
                            <th>Periodo</th>
                            <th>Nombre</th>
                            <th>Asignatura</th>
                            <th>Sala</th>
                            <th>Seccion</th>
                    </tr> 
                  </thead><tbody>";
              
            
             ?>

            <tr>
                <td><?php echo form_dropdown('periodo', $atributosPeriodo); ?></td>
                <td><?php echo form_dropdown('docente', $atributosAcademico); ?></td>
                <td><?php echo form_dropdown('ramo', $listaAsignatura);?></td>
                <td><?php echo form_dropdown('sala', $atributosSala);?></td>
                <td><?php ?></td>
            </tr>

                   
            <?php 
            echo "</tbody></table>";
        //}else{
         //   echo "Noo exiten datos!<br>";
       // }
        ?>
</div>
</div>