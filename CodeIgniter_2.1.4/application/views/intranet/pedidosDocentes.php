<script type="text/javascript" src="<?php echo base_url() ?>public/js/funciones.js"></script>
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
    <h4 class="">Pedidos de profesores</h4>
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
                        <th>Aprobar</th>
                        <th>Estado</th>
                    </tr> 
                  </thead>
                 
                  <tbody>
                
                     <?php
                    foreach ($pedidos as $pedi) { 
                        echo '<tr>';
                        echo '<td>'.form_label($pedi->pk).'</td>';
                        echo '<td>'.form_label($pedi->nombredocente).'</td>';
                        echo '<td>'.form_label($pedi->apellidodocente).'</td>';
                        echo '<td>'.form_label($pedi->fecha).'</td>'; 
                        
                        echo '<td>'.form_label($pedi->asignatura).'</td>';
                        echo '<td>'.form_label($pedi->periodo).'</td>';
                        echo '<td>'.form_label($pedi->sala).'</td>'; 
                        echo "<td><a href='".base_url()."index.php/intranet/aprobarPedido/$pedi->pk/$pedi->fecha/$pedi->sala/$pedi->pksala/$pedi->nombredocente/$pedi->apellidodocente/$pedi->pkdocente/$pedi->asignatura/$pedi->pkasignatura/$pedi->periodo' onclick='return confirm('¿Desea editar este Contenido?')' class='btn btn-success' >Aprobar</a></td>";
                        ?>
                        <td><a class="btn btn-danger" href="javascript:void(0);"onclick="eliminar('<?php base_url()?>eliminarPedido/<? echo $pedi->pk; ?>')">Rechazar</a></td>
                        <?php

                        echo "</tr>";
                    }
                    ?>
                 
                </tbody>
       </table>
        </div>
    
</div>
