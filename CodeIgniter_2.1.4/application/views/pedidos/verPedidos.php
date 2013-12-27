<div class="well">
 <table class='table table-hover-striped'>
                   <thead>
                    <tr>
                        <th>PK</th>
                        <th>Fecha</th>
                        <th>Sala</th>
                        <th>Periodo</th>
                        <th>Docente</th>
                        <th>Asignatura</th>
                        <th>Estado</th>
                    </tr> 
                  </thead>
                <tbody>
                      <?php
                      
                     // foreach ($pedidos as $pedi) {
                          echo "<tr>";
                          echo '<td>pk</td>';
                          echo '<td>Fecha</td>';
                          echo '<td>Sala</td>';
                          echo '<td>Periodo</td>';
                          echo '<td>Docente</td>';
                          echo '<td>Asignatura</td>';
                          echo '<td>Estado</td>';
                          echo "</tr>";
                     // }
                      
                      ?>
                      
                </tbody>
 </table><br><br>
     <button class="btn btn-warning" onclick="location.href='<?= site_url('login/desconectar') ?>'" >desconectar</button>
</div>
