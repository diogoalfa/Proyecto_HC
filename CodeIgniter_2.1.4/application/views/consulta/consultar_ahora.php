<div class="row-fluid">
	<div class="span12"><br>
		<?php 

            if ($time>="08:15" && $time<="22:15") {
                
            }
            else{
                if ($time>"22:15:00" && $time<"23:59:59") {
                    echo "<script>alert ('No hay clases en estos momentos pero se mostrará las clases del primer periodo del próximo día');</script>";
                    
                }
                else{                
                    echo "<script>alert ('No hay clases en estos momentos pero se mostrará las clases del primer periodo del próximo día');</script>";
                }
            }            

            if ($clases != null) {
                echo "<h3>Clases del periodo</h3>";
                echo "<table class='table table-hover-striped'>
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
            else echo "No hay clases en este periodo, recomendamos consultar por dia o profesor";
        ?>
	</div>
</div>