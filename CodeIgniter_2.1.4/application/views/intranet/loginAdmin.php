
<div class="well">
   <div class="">
    <label><h2>Ingreso Administrador</h2></label>
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
        
        echo form_open('login/validarAdmin');
          echo form_label('Usuario', 'usuario');
          echo form_input($atributos_Usuario);echo '<br>';
          echo form_label('Clave', 'password');
          echo form_input($atributos_Clave);echo '<br>';      
          echo form_submit($atributos_Btn, 'Enviar');
        echo form_close();
    
    ?>
   </div>
</div>