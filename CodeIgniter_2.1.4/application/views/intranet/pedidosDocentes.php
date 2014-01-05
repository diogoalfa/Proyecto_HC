

<div class="well">
    <h4 class="">Pedidos de profesores</h4>
      <table class="table table-hover">
             <thead>
                    <tr>
                        <th>N° Pedido</th>
                        <th>Profesor</th>
                        <th>Apellido</th>
                        <th>Fecha</th>
                       
                        <th>Asignatura</th>
                        <th>Periodo</th>
                        <th>Sala</th>
                        <th>Aprobar</th>
                        <th>Eliminar</th>
                    </tr> 
                  </thead>
                 
                <tbody>
                
                     <?php
                    foreach ($pedidos as $pedi) {
                        echo '<tr>';
                        echo "<option>";
                        echo '<td>'.form_label($pedi->pk).'</td>';
                        echo '<td>'.form_label($pedi->nombredocente).'</td>';
                        echo '<td>'.form_label($pedi->apellidodocente).'</td>';
                        echo '<td>'.form_label($pedi->fecha).'</td>'; 
                        
                        echo '<td>'.form_label($pedi->asignatura).'</td>';
                        echo '<td>'.form_label($pedi->periodo).'</td>';
                        echo '<td>'.form_label($pedi->sala).'</td>'; 
                        echo "<td><a href='".base_url()."index.php/intranet/aprobarPedido/$pedi->pk/$pedi->fecha/$pedi->sala/$pedi->pksala/$pedi->nombredocente/$pedi->apellidodocente/$pedi->pkdocente/$pedi->asignatura/$pedi->pkasignatura/$pedi->periodo' onclick='return confirm('¿Desea editar este Contenido?')' class='btn btn-primary' >Aprobar</a></td>";
                        echo "<td><a href='".base_url()."index.php/intranet/eliminarPedido/$pedi->pk' onclick='return confirm('¿Desea eliminar este Contenido?')' class='btn btn-danger' >Eliminar</a></td>";  
                        echo "</tr>";
                    }
                    ?>
                 
                </tbody>
       </table>
    
</div>
