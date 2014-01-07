<div class="row-fluid"><br>
  <div class="span12">
     <?php 
        $atributos_Btnn=  array('class'=>'btn btn-primary btn-lg');
                    foreach ($periodo as $peri){ 
                        if($peri->pk==$edit->periodo_fk)  
                       $atributosPeriodo[0] = $peri->periodo." -> ".$peri->inicio." - ".$peri->termino; 
                      }
                    foreach ($periodo as $peri){  
                         if($peri->pk!=$edit->periodo_fk)  
                       $atributosPeriodo[$peri->pk] = $peri->periodo." -> ".$peri->inicio." - ".$peri->termino; 
                      } 

//----

                          foreach ($cursos as $grade) {
                            if($grade->pk==$edit->curso_fk){
                                foreach ($academico as $profesor) {
                                    if($profesor->pk==$grade->docente_fk)
                                       $atributosAcademico[0] = $profesor->nombres." ".$profesor->apellidos;
                                }
                              }
                          }
                          foreach ($cursos as $grade) {
                            if($grade->pk==$edit->curso_fk){
                                foreach ($academico as $profesor) {
                                    if($profesor->pk!=$grade->docente_fk)
                                       $atributosAcademico[$profesor->pk] = $profesor->nombres." ".$profesor->apellidos;
                                }
                              }
                          }
                          
                       

//-------------
                          foreach ($cursos as $grade) {
                            if($grade->pk==$edit->curso_fk){
                                foreach ($asignatura as $ramo) {
                                    if($ramo->pk==$grade->asignatura_fk)
                                       $listaAsignatura[0] = $ramo->nombre;
                                }
                              }
                          }
                          foreach ($cursos as $grade) {
                            if($grade->pk==$edit->curso_fk){
                                foreach ($asignatura as $ramo) {
                                    if($ramo->pk!=$grade->asignatura_fk)
                                       $listaAsignatura[$ramo->pk] = $ramo->nombre;
                                }
                              }
                          }


       //---

                    foreach ($salas as $aula){ 
                        if($aula->pk==$edit->sala_fk)  
                       $atributosSala[0] = $aula->sala;  
                      }
                    foreach ($salas as $aula){  
                         if($aula->pk!=$edit->sala_fk)  
                       $atributosSala[$aula->pk] = $aula->sala; 
                      } 
//--
                    foreach ($cursos as $grade){ 
                        if($grade->pk==$edit->curso_fk)  
                       $atributosSeccion[0] = $grade->seccion;  
                      }


          //foreach ($cursos as $grade)
                      
            for ($i=1; $i <=8; $i++) { 

                  $atributosSeccion[] =$i ;
            
             }

                 ?>
                          <?php 
                          echo form_open('intranet/updateReservas/'.$edit->pk.'');
            echo "<table class='table table-hover-striped' border='0'>
                   <thead>
                    <tr>
                            <th>Periodo</th>
                            <th>Nombre</th>
                            <th>Asignatura</th>
                    </tr> 
                  </thead><tbody>";
              
            
             ?>

            <tr>
                <td><?php echo form_dropdown('periodo', $atributosPeriodo); ?></td>
                <td><?php echo form_dropdown('docente', $atributosAcademico); ?></td>
                <td><?php echo form_dropdown('ramo', $listaAsignatura);?></td>
        <!--     </tr>
            <tr>   -->  
            </tr>
                   
            <?php 
            echo "</tbody></table>";

            echo "<table class='table table-hover-striped' border='0'>
                   <thead>
                    <tr>
                            <th>Sala</th>
                            <th>Seccion</th>
                    </tr> 
                  </thead><tbody>";
              
            
             ?>

            <tr>
        <!--     </tr>
            <tr>   -->  
                <td><?php echo form_dropdown('sala', $atributosSala);?></td>
                <td><?php echo form_dropdown('seccion', $atributosSeccion);?></td>
            </tr>
            <tr >
              <td><?php echo form_submit($atributos_Btnn, 'Editar')?></td>
            </tr>  
                   
            <?php 
            echo "</tbody></table>";
             echo form_close();
        ?>

</div>
</div>