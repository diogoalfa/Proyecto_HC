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
    <h4 class="">Reservas de Profesores</h4>
     <div class="mygrid-wrapper-div">
      <table class="table table-hover-striped" style="text-align:left;" border="0">
             <thead>
                    <tr>
                        <th>N° Pedido</th>
                        <th >Profesor</th>
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
                        echo '<td >'.$pedi->pk.'</td>';
                        echo '<td>'.$pedi->nombredocente.'</td>';
                        echo '<td>'.$pedi->apellidodocente.'</td>';
                        echo '<td>'.$pedi->fecha.'</td>'; 
                        
                        echo '<td>'.$pedi->asignatura.'</td>';
                        echo '<td>'.$pedi->periodo.'</td>';
                        echo '<td>'.$pedi->sala.'</td>'; 
                                                ?>
                        <td><a class="btn btn-info" href="<?php base_url()?>editarReserva/<?php echo $pedi->pk."/".$pedi->fecha."/".$pedi->sala."/".$pedi->pksala."/".$pedi->nombredocente."/".$pedi->apellidodocente."/".$pedi->pkdocente."/".$pedi->asignatura."/".$pedi->pkasignatura."/".$pedi->periodo."/".$pedi->seccion;?>" >Editar</a></td>                        
                        <td><a class="btn btn-danger" href="javascript:void(0);"onclick="eliminar('<?php base_url()?>eliminarPedido/<?php echo $pedi->pk; ?>')">Eliminar</a></td>
                        <?php
                        echo "</tr>";
                    }
                    ?>
                 
                </tbody>
       </table>
     </div>    
    
</div>

