<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<br>
<div class="well" >
     <?php
    if (isset($errores)) {
     //  echo "<div class='alert alert-error'>";
        if(isset($errores['error_nombre']) && strlen($errores['error_nombre'])>0){
            echo "<div class='alert alert-error'><div class='row'><div class='span8'>".$errores['error_nombre']."</div></div></div>";
        }
        if(isset($errores['error_apellido']) && strlen($errores['error_apellido'])>0 ){
            echo "<div class='alert alert-error'><div class='row'><div class='span8'>".$errores['error_apellido']."</div></div></div>"; 
        }
        if(isset($errores['error_correo'])&& strlen($errores['error_correo'])>0){
            echo "<div class='alert alert-error'><div class='row'><div class='span8'>".$errores['error_correo']."</div></div></div>"; 
        }
        if(isset($errores['error_asunto'])&& strlen($errores['error_asunto'])>0){
            echo "<div class='alert alert-error'><div class='row'><div class='span8'>".$errores['error_asunto']."</div></div></div>"; 
        }
        if(isset($errores['error_comentario'])&& strlen($errores['error_comentario'])>0){
            echo "<div class='alert alert-error'><div class='row'><div class='span8'>".$errores['error_comentario']."</div></div></div>"; 
        }
        
       // echo "</div>";
    }

    
    ?>
    <?php echo form_open('contacto/enviar'); ?>
    <div class="row">
        <div class="span2"></div>
        <div class="span8">
        <div class="row-fluid">
    <div class="row">
        <div class="span2"><label>Nombre :</label></div><div class="span4"><?=form_input('nombre',set_value('nombre'),"id='nombre'");?></div>
    </div>
    <div class="row">
        <div class="span2"><label>Apellido</label></div><div class="span4"><?=form_input('apellido',set_value('apellido'),"id='nombre'");?></div>
    </div>
    <div class="row">
        <div class="span2"><label>E-mail :</label></div><div class="span4"><?=form_input('correo',set_value('correo'),"id='nombre'");?></div>
    </div>
    <div class="row">
        <div class="span2"><label>Asunto :</label></div><div class="span4"><?=form_input('asunto',set_value('asunto'),"id='nombre'");?></div>
    </div>
    <div class="row">
        <div class="span6"><?=form_textarea('comentario',set_value('comentario'),"id='textoAreaMensaje'","placeholder='Escriba mensaje ...'");?></div><div></div>
    </div>
    <div class="row">
        <div class="span4"></div><div class="span1"><input class="btn btn-primary btn-lg" type="submit" value="Enviar"></div><div></div>
    </div>
    
  </div>    
        </div>
    </div>   
        <?=  form_close(); ?>
   
    <br>
         
</div>


