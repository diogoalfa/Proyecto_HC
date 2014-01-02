<div class="well">
    
   
  <table class='table table-hover-striped'>
                   <thead>
                    <tr>
                        <th>PK</th>
                        <th>Fecha</th>
                        <th>Sala</th>
                        <th>Periodo</th>
                        <th>Estado</th>
                    </tr> 
                  </thead>
                <tbody>
                      <?php
                      
                      foreach ($pedidos as $pedi) {
                          echo "<tr>";
                          echo "<td>$pedi->pk</td>";
                          echo "<td>$pedi->fecha</td>";
                          echo "<td>$pedi->sala</td>";
                          echo "<td>$pedi->periodo</td>";
                          if($pedi->adm_fk==NULL){
                               echo "<td><span class='label'>Pendiente</span></td>";
                          } 
                          else{
                               echo "<td><span class='label label-success'>Aprobada</span></td>";
                          }                              
                         
                          echo "</tr>";
                      }
                      
                      ?>
                      
                </tbody>
 </table><br><br>
    <button class="btn btn-warning" onclick="location.href='<?= site_url('login/desconectar') ?>'" >desconectar</button>
</div>
