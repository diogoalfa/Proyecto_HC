


<div class="well">
    <div class="alert alert-block">
        <label><h2>Ingreso Docentes</h2></label>
        <h5></h5><br>
      
         <?php
         
         if(isset($mensajeAlerta)){
             echo "<h4>".$mensajeAlerta."</h4>";
         } 
         else{
             
         }
         
          $atributos_Rut = array(
          'name' => 'rut',
            'value' => set_value('usuario'),
            'placeholder'=>'Ej: 12.345.678-9',
            'id' => 'user'
        );
        $atributos_Clave=  array(
            'name'=>'clave',
            'type'=>'password',
            'placeholder'=>'Contraseña',
            'id' => 'pass'

        );
        $atributos_Btn=  array('class'=>'btn btn-primary btn-large'); 
        
        echo form_open('login/index');
        echo form_label('Rut', 'labelRut');
        echo form_input($atributos_Rut);echo '<br>';
        echo form_label('Clave', 'password');
        echo form_input($atributos_Clave);echo '<br>';      
        echo form_submit($atributos_Btn, 'Enviar');
        echo form_close();
        
    ?>   

    </div>
</div>
