<div class="row-fluid"><br>
  <div class="span12">
  
                          <?php 
            echo "<table class='table table-hover-striped'>
                   <thead>
                    <tr>
                        <th>Sala</th>
                        <th>Profesor</th>  
                        <th>Asignatura</th>
                        <th>Seccion</th>
                    </tr> 
                  </thead><tbody>";
              
            foreach ($result as $profesor) { ?>
             <tr>
                <td><?= $profesor->sala;  ?></td>
                <td><?= $profesor->nombres." ".$profesor->apellidos; ?></td>
                <td><?= $profesor->nombre ;?></td>
                <td><?= $profesor->seccion;?></td>
            </tr>

                   
            <?php }
            echo "</tbody></table>";
        //}else{
         //   echo "Noo exiten datos!<br>";
       // }
        ?>
</div>
</div>