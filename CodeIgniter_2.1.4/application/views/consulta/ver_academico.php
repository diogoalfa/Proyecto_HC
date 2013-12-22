<div class="span9">
	
	                        <?php 
            echo "<table class='table table-hover-striped'>
                   <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Asignatura</th>
                    </tr> 
                  </thead><tbody>";
              
            foreach ($result as $profesor) { ?>
             <tr>
                <td><?= $profesor->nombres; ?></td>
                <td><?= $profesor->apellidos; ?></td>
                <td><?= $profesor->asignatura_fk ;?></td>
            </tr>

                   
            <?}
            echo "</tbody></table>";
        //}else{
         //   echo "Noo exiten datos!<br>";
       // }
        ?>
</div>