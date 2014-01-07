

<div class="well">
    <h4 class="">Reservas de Profesores</h4>
     <div class="mygrid-wrapper-div">
      <table class="table table-hover" style="text-align:left;">
             <thead>
                    <tr>
                        <th>N° Pedido</th>
                        <th>Profesor</th>
                        <th>Apellido</th>
                        <th>Fecha</th>
                       
                        <th>Asignatura</th>
                        <th>Periodo</th>
                        <th>Sala</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr> 
                  </thead>
                 
                <tbody >
                
                     <?php
                    foreach ($reservas as $pedi) {
                        echo '<tr>';
                        echo '<td>'.form_label($pedi->pk).'</td>';
                        echo '<td>'.form_label($pedi->nombredocente).'</td>';
                        echo '<td>'.form_label($pedi->apellidodocente).'</td>';
                        echo '<td>'.form_label($pedi->fecha).'</td>'; 
                        
                        echo '<td>'.form_label($pedi->asignatura).'</td>';
                        echo '<td>'.form_label($pedi->periodo).'</td>';
                        echo '<td>'.form_label($pedi->sala).'</td>'; 
                                                ?>
                        <td><a class="btn btn-info" href="<?php base_url()?>editarReserva/<?php echo $pedi->pk."/".$pedi->fecha."/".$pedi->sala."/".$pedi->pksala."/".$pedi->nombredocente."/".$pedi->apellidodocente."/".$pedi->pkdocente."/".$pedi->asignatura."/".$pedi->pkasignatura."/".$pedi->periodo."/".$pedi->seccion;?>" >Editar</a></td>                        
                        <td><a class="btn btn-danger" href="javascript:void(0);"onclick="eliminar('<?php base_url()?>eliminarPedido/<? echo $pedi->pk; ?>')">Eliminar</a></td>
                        <?php
                        echo "</tr>";
                    }
                    ?>
                 
                </tbody>
       </table>
     </div>    
    
</div>

