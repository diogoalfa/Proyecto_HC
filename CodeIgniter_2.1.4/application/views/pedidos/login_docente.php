


<div class="well">
    <div class="">
      <div class="span4"></div>
      <div class="span5"><h2>Ingreso Docentes</h2><br>
      <h5>Solo los profesores pueden acceder.Entrar con USUARIO y PASSWORD de dirdoc!.</h5>
      </div>
      <div class="span3"></div><br>
        
        
      
         <?php
         
         if(isset($mensajeAlerta)){
             echo "<h4>".$mensajeAlerta."</h4>";
         } 
         else{
             
         }
         
          $atributos_Rut = array(
          'name' => 'rut',
          'id'=>'rut',
            'value' => set_value('usuario'),
            'placeholder'=>'Ej: 12.345.678-9',
            'onblur'=>'return Rut(form1.rut.value)'
        );
        $atributos_Clave=  array(
            'name'=>'clave'
            ,'type'=>'password',
            'placeholder'=>'************'
        );
        $atributos_Btn=  array('class'=>'btn btn-primary btn-lg'); 
        $form=array('name'=>'form1');
        
    ?>   
        <div class="row" ><br>
      <div class="span5"></div>
      <div class="span4" >
        <?php  echo form_open('login/index',$form); ?>
            <table style="text-align:center;" border="0">
          <tr>
            <td><?php echo form_label('Rut', 'labelRut');; ?></td>
            <td><?php  echo form_input($atributos_Rut);  ?></td>
          </tr>
          <tr>
            <td><?php echo form_label('Clave', 'password'); ?></td>
            <td><?php echo form_input($atributos_Clave); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo form_submit($atributos_Btn, 'Enviar'); ?></td>
          </tr>
        </table>
        <?php echo form_close(); ?>
      </div>
      <div class="span3"></div>
</div>

    </div>
</div>
