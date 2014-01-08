<script>
      $(function() {  
   var window_height = $(window).height(),
   content_height = window_height - 200;
   $('.mygrid-wrapper-div').height(content_height);
});

$( window ).resize(function() {
   var window_height = $(window).height(),
   content_height = window_height - 50;
   $('.mygrid-wrapper-div').height(content_height);
});
</script>
<div class="well">
    <h4 class="">Pedidos de Profesores</h4>
    <div class="mygrid-wrapper-div">
      <table class="table table-hover-striped" style="text-align:left;">
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
                        <th>Estado</th>
                    </tr> 
                  </thead>
                 
                  <tbody>
                
                     <?php
                    foreach ($pedidos as $pedi) { 
                        echo '<tr>';
                        echo '<td>'.$pedi->pk.'</td>';
                        echo '<td>'.$pedi->nombredocente.'</td>';
                        echo '<td>'.$pedi->apellidodocente.'</td>';
                        echo '<td>'.$pedi->fecha.'</td>'; 
                        
                        echo '<td>'.$pedi->asignatura.'</td>';
                        echo '<td>'.$pedi->periodo.'</td>';
                        echo '<td>'.$pedi->sala.'</td>'; 
                        echo "<td><a href='".base_url()."index.php/intranet/aprobarPedido/$pedi->pk/$pedi->fecha/$pedi->sala/$pedi->pksala/$pedi->nombredocente/$pedi->apellidodocente/$pedi->pkdocente/$pedi->asignatura/$pedi->pkasignatura/$pedi->periodo' onclick='return confirm('¿Desea editar este Contenido?')' class='btn btn-success' >Aprobar</a></td>";
                        ?>
                        <td><a class="btn btn-danger" href="javascript:void(0);"onclick="eliminar('<?php base_url()?>eliminarPedido/<?php echo $pedi->pk; ?>')">Rechazar</a></td>
                        <?php

                        echo "</tr>";
                    }
                    ?>
                 
                </tbody>
       </table>
        </div>
    
</div>
