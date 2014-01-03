<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="well">
    <div class="alert alert-block">
        <label><h2>Acceso Administrador</h2></label><br>
        <h5>Ingrese su usuario y clave !</h5><br>
    
    <?php
    
    if(isset($mensajeAlerta)){
        echo "<h4>".$mensajeAlerta."</h4><br><br>";
    }
      
           $atributos_Usuario = array(
          'name' => 'usuario',
            'value' => set_value('usuario')
        );
        $atributos_Clave=  array(
            'name'=>'clave'
            ,'type'=>'password'
        );
        $atributos_Btn=  array(
            'class'=>'btn btn-primary btn-large'); 
        
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