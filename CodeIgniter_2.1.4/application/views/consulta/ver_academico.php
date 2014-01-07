<div class="row-fluid"><br>
  <div class="span12">
  
                          <?php 

            if ($result != null) {
                    echo "<table class='table table-hover-striped' style='text-align:left;'>
                       <thead>
                        <tr>
                                <th>Periodo</th>
                                <th>Inicio</th>  
                                <th>Termino</th>
                                <th>Fecha (AA-MM-DD)</th>
                                <th>Asignatura</th>
                                <th>Sala</th>
                                <th>Seccion</th>
                        </tr> 
                      </thead><tbody>";
                  
                foreach ($result as $profesor) { ?>
                <tr>
                    <td><?= $profesor->periodo;  ?></td>
                    <td><?= $profesor->inicio; ?></td>
                    <td><?= $profesor->termino ;?></td>
                    <td><?= $profesor->fecha;?></td>
                    <td><?= $profesor->nombre ;?></td>
                    <td><?= $profesor->sala ;?></td>
                    <td><?= $profesor->seccion ;?></td>
                </tr>                 
                <?php }
                echo "</tbody></table>";
            }
            else{
               echo "El Profesor no esta impartiendo asignaturas<br>";
            }
        ?>
</div>
</div>