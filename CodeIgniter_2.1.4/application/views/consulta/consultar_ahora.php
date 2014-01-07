<div class="row-fluid">
	<div class="span12"><br>
		<?php 

            if ($day=date("N")<=5 && $day=date("j")>=1) {
                if ($time>="08:15" && $time<="22:15") {
                //Esta dentro del limite y si esta en receso automaticamente lo asigna al siguiente periodo 
                //gracias al "if" que hay en la funcion "getTime"
                    
                }
                else{
                    if ($time>"22:15:00" && $time<"23:59:59") {
                        if ($day=date("j")==5) {
                            echo "Las proximas clases para el dia lunes son:";
                        }
                        else{
                            echo "La clases para mañana son:";
                        }
                    }
                    else{
                    }
                }
            }
            else{
                echo "Las proximas clases para el dia lunes son:";
            }          

            if ($clases != null) {
                echo "<h3></h3>";
                echo "<table class='table table-hover-striped'style='text-align:left;'  >
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
                  
                foreach ($clases as $aula) { ?>
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
            else echo "No hay clases, recomendamos consultar por dia o profesor";
        ?>
	</div>
</div>