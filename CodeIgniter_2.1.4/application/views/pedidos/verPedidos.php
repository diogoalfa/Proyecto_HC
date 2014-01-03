<div class="well">
    
   
  <table class='table table-hover-striped'>
                   <thead>
                    <tr>
                        <th>PK</th>
                        <th>Fecha</th>
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
                        echo '<td>'.form_label($pedi->pk).'</td>';;  
                        echo '<td>'.form_label($pedi->fecha).'</td>'; 
                        echo '<td>'.form_label($pedi->sala).'</td>'; 
                        echo '<td>'.form_label($pedi->periodo).'</td>';
                        
                      if($pedi->adm_fk==NULL){
                          echo "<td><span class='label'>Pendiente</span></td>";
                          echo "<td><a href='".  base_url()."index.php/pedidos/editarPedido/$pedi->pk/$pedi->fecha' onclick='return confirm('¿Desea eliminar este Contenido?')' class='btn' >editar</a></td>";
                          echo "<td><a href='".  base_url()."index.php/pedidos/eliminarPedido/$pedi->pk' onclick='return confirm('¿Desea eliminar este Contenido?')' class='btn btn-warning' >Eliminar</a></td>";  
                      }
                      else{
                          echo "<td><span class='label label-success'>Aprobado</span></td>";
                          echo '<td></td>';
                          echo "<td><a href='".  base_url()."index.php/pedidos/eliminarPedido/$pedi->pk' onclick='return confirm('¿Desea eliminar este Contenido?')' class='btn btn-warning' >Eliminar</a></td>";
                      }                      
                      echo '</tr5>';
                    }
                    
                    ?>
                </tbody>
 </table><br><br>
    <button class="btn btn-warning" onclick="location.href='<?= site_url('login/desconectar') ?>'" >desconectar</button>
</div>
