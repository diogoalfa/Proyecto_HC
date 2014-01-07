
<div class="well">
   <div class="">
   <div class="span4"></div>
   <div class="span5"><h2>Ingreso Administrador</h2><br></div>
   <div class="span3"></div>
    <?php
    
    if(isset($mensajeAlerta)){
        echo "<h4>".$mensajeAlerta."</h4><br><br>";
    }
      
           $atributos_Usuario = array(
          'name' => 'rut',
            'value' => set_value('usuario'), 
            'placeholder'=>'Usuario',
            'id' => 'user'
        );
        $atributos_Clave=  array(
            'name'=>'clave'
            ,'type'=>'password',
            'placeholder'=>'Contraseña',
            'id' => 'pass'
        );
        $atributos_Btn=  array(
            'class'=>'btn btn-primary btn-lg'); 
        
       // echo form_open('login/validarAdmin');
       //    echo form_label('Usuario', 'usuario');
       //    echo form_input($atributos_Usuario);echo '<br>';
       //    echo form_label('Clave', 'password');
       //    echo form_input($atributos_Clave);echo '<br>';      
       //    echo form_submit($atributos_Btn, 'Enviar');
       //  echo form_close();
    
    ?>
    <div class="row" ><br>
      <div class="span5"></div>
      <div class="span4" >
        <?php  echo form_open('login/validarAdmin'); ?>
            <table style="text-align:center;" border="0">
          <tr>
            <td><?php echo form_label('Usuario', 'usuario'); ?></td>
            <td><?php  echo form_input($atributos_Usuario);  ?></td>
          </tr>
          <tr>
            <td> <?php echo form_label('Clave', 'password'); ?></td>
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