
<div class="row-fluid"><br>
  <div class="span12">
  
                          <?php 
            echo "<table border='0' class='table table-hover-striped'>
                   <thead>
                    <tr>
                        <th>Sala</th>
                        <th>Profesor</th>
                        <th>Asignatura</th>
                        <th>Seccion</th>
                        <th>Periodo</th>
                        <th>Rango</th>
                        <th colspan='2'>Opciones</th>
                        
                    </tr> 
                  </thead><tbody>";
            foreach ($result as $profesor) { 
              // if ($profesor->periodo==9) {
               
              
              ?>

             <tr>
                <td><?= $profesor->sala  ?></td>
                <td><?= $profesor->nombres." ".$profesor->apellidos; ?></td>
                <td><?= $profesor->nombre ;?></td>
                <td><?= $profesor->seccion;?></td>
                <td><?= $profesor->periodo;?></td>
                <td><?= $profesor->inicio." - ".$profesor->termino;?></td>
                <td><a class="btn btn-danger btn-small" href="javascript:void(0);"onclick="eliminar('<?php base_url('intranet/') ?>eliminar/<? echo $profesor->pk; ?>')">Eliminar</a></td>
                <td><a class="btn btn-succes btn-small" href="editar/<?php echo $profesor->pk; ?>">Editar</a></td>
            </tr>

                   
            <?php }//}
            echo "</tbody></table>";

        ?>
</div>
</div>