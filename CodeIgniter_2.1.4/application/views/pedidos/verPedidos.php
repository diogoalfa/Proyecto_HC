<div class="well">
    
   <div class="mygrid-wrapper-div">
  <table class='table table-hover-striped'border="0" style="text-align:left;">
                   <thead >
                    <tr>
                        <th>N° Pedido</th>
                        <th>Asignatura</th>
                        <th >Fecha</th>
                        <th>Sala</th>
                        
                        <th>Periodo</th>
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr> 
                  </thead>
                 
                <tbody>
                    
                    <?php
                    foreach ($pedidos as $pedi) {
                        echo '<tr>';
                        echo '<td>'.form_label($pedi->pk).'</td>';
                        echo '<td>'.form_label($pedi->nombreasignatura).'</td>';
                        echo '<td>'.form_label($pedi->fecha).'</td>'; 
                        echo '<td>'.form_label($pedi->sala).'</td>'; 
                        echo '<td>'.form_label($pedi->periodo).'</td>';
                        
                      if($pedi->adm_fk==NULL){
                          echo "<td><span class='label label-info'>Pendiente</span></td>";
                          echo "<td><a href='".  base_url()."index.php/pedidos/editarPedido/$pedi->pk/$pedi->fecha/$seccion/$pedi->pkdocente/$pedi->pkasignatura/$pedi->nombreasignatura/$pedi->nombredocente/$pedi->periodo/$pedi->pksala/$pedi->sala' onclick='return confirm('¿Desea eliminar este Contenido?')' class='btn btn-success' >editar</a></td>";
                          echo "<td><a href='".  base_url()."index.php/pedidos/eliminarPedido/$pedi->pk' onclick='return confirm('¿Desea eliminar este Contenido?')' class='btn btn-danger' >Eliminar</a></td>";  
                      }
                      else{
                          echo "<td><span class='label label-success'>Aprobado</span></td>";
                          echo '<td></td>';
                          //echo "<td><a href='".  base_url()."index.php/pedidos/eliminarPedido/$pedi->pk' onclick='return confirm('¿Desea eliminar este Contenido?')' class='btn btn-danger' >Eliminar</a></td>";
                      }                      
                      echo '</tr>';
                    }
                    
                    ?>
                </tbody>
 </table>
   </div><br><br>
</div>
