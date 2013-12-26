<div class="row-fluid">
	<div class="span12"><br>
		<h3>Clases del periodo</h3>
		                          <?php 
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

                   
            <?php }
            echo "</tbody></table>";
        //}else{
         //   echo "Noo exiten datos!<br>";
       // }
        ?>

	</div>
</div>