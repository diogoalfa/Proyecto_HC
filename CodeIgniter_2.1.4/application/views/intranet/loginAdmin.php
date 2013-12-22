<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="well">
    
    <?
    
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
    
    /*
      <form >
    <div class="row">
      <div class="span3">
        <div class="input-prepend">
          <span class="add-on"><i class="icon-user"></i></span>
          <input class="span2" id="prependedInput" type="text" placeholder="Usuario">
        </div>
      </div>
    </div>
        <div class="row">
            <div class="span3">
               <div class="input-prepend">
                   <span class="add-on"><i class="icon-lock"></i></span>
                 <input class="span2" id="prependedInput" type="password" placeholder="Clave">
               </div>
            </div>
    </div>
        <div class="row">
            <div class="span3"><button class="btn" type="submit">Entrar</button></div><div></div>
    </div>
    <div>
        <div><label></label></div><div></div>
    </div>
        
        
        
    </form>
     * 
     */
    
    ?>
<!--         <button class="btn btn-warning" onclick="location.href='<?= site_url('login/desconectar') ?>'" >desconectar</button>
 -->
    
   
</div>