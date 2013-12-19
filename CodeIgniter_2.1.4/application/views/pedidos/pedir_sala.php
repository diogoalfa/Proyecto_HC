<?php
    
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.ss
 */
?>

<div class="well">
    <div class="row" id="divSaludoProfesor">
       <div class="span4"><h4>Bienvenido SR@ :<?='  '."_SESSION['usuarioProfesor']";?></h4></div> 
    </div>
    <div class="row">
        <div class="span6">Llene el formulario para enviar la solicitud de peticion de Sala.</div>
    </div>
</div><br>
<div class="well">
    <br><br>
    <?
      
    
    
       $atributos_Usuario = array(
          'name' => 'usuario',
            'value' => set_value('usuario')
        );
        $atributos_Clave=  array(
            'name'=>'clave'
            ,'type'=>'password'
        );
        $atributos_Btn=  array('class'=>'btn'); 
        
        echo form_open('');
        echo '<label>Nombre :</label>';
        echo form_input($atributos_Usuario);
        echo form_label('Clave', 'password');
        echo form_input($atributos_Clave);echo '<br>';      
        echo form_submit($atributos_Btn, 'Enviar');
        echo form_close(); 
    
    
    ?>
    <div class="row">
       <div class="span2"><label>Nombre :</label></div><div class="span4"><input type="text" placeholder="" value=""></div>
    </div>
    <div class="row">
        <div class="span2"><label>Apellidos :</label></div><div class="span4"><input type="text" placeholder="" value=""></div>
    </div>
      <div class="row">
        <div class="span2"><label>Contacto : </label></div><div class="span4"><input type="text" placeholder="example@gmail.com"></div>
    </div> 
    <div class="row">
        <div class="span2"><label>Asignatura : </label></div><div class="span4"><input type="text" placeholder="" ></div>
    </div>
   
    <div class="row">
        <div class="span2"><label>Dia de la semana : </label></div>
        <div class="span4">
            <select>
                <option>Lunes</option>
                <option>Martes</option>
                <option>Miercoles</option>
                <option>Jueves</option>
                <option>Viernes</option>
            </select>
        </div>
    </div>
     <div class="row">
        <div class="span2"><label>Periodo : </label></div>
       
             <div class="span4">
                 <select>
                <option>I</option>
                <option>II</option>
                <option>III</option>
                <option>IV</option>
                <option>V</option>
                <option>VI</option>
                <option>VII</option>
                <option>VIII</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="span2"><label>Sala a priori : </label></div><div class="span4"><input type="text" placeholder=""></div>
    </div>
    <div class="row">
        <div class="span2">Motivo : </label></div><div class="span4"><textarea rows="3"></textarea></div>
    </div>
    <div class="row">
        <div class="span3"><button type="submit" class="btn">Enviar</button> </div>
    </div>
    <button class="btn btn-warning" onclick="location.href='<?= site_url('login/desconectar') ?>'" >desconectar</button>
</div>