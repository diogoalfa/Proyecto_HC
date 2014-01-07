<div class="row-fluid">
	<div class="span12"><br>
		<?php 
            if ($day=date("N")<=5 && $day=date("j")>=1) {
            
            }
            else{
                echo "Las proximas clases para el dia lunes son:";

            }
            if ($hoy != null) {
                echo "<h3></h3>";
                echo "<table class='table table-hover-striped' style='text-align:left;' >
                       <thead>
                        <tr>
                            <th>Periodo</th>
                            <th>Inicio</th>  
                            <th>Termino</th>
                            <th>Nombre</th>
                            <th>Asignatura</th>
                            <th>Sala</th>
                            <th>Seccion</th>
                        </tr> 
                      </thead><tbody>";
                  
                foreach ($hoy as $aula) { ?>
                    <tr>
                        <td><?= $aula->periodo;  ?></td>
                        <td><?= $aula->inicio; ?></td>
                        <td><?= $aula->termino ;?></td>
                        <td><?= $aula->nombres." ".$aula->apellidos;?></td>
                        <td><?= $aula->nombre ;?></td>
                        <td><?= $aula->sala ;?></td>
                        <td><?= $aula->seccion ;?></td>
                    </tr>
                    <?php 
                }
                echo "</tbody></table>";
            } 
            else {
                echo "No hay clases hoy día ";

            }
        ?>
	</div>
</div>