


<div class="well">
    <div class="">
        <label><h2>Ingreso Docentes</h2></label>
        <h5>Solo los profesores pueden acceder.Entrar con USUARIO y PASSWORD de dirdoc!.</h5><br>
      
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
        $atributos_Btn=  array('class'=>'btn btn-primary btn-large'); 
        $form=array('name'=>'form1');
        echo form_open('login/index',$form);
        echo form_label('Rut', 'labelRut');
        echo form_input($atributos_Rut);echo '<br>';
        echo form_label('Clave', 'password');
        echo form_input($atributos_Clave);echo '<br>';      
        echo form_submit($atributos_Btn, 'Enviar');
        echo form_close();
        
    ?>   

    </div>
</div>
