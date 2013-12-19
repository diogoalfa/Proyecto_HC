


<div class="well">
    <div class="alert alert-block">
        <label><h2>Solicitar Salas</h2></label><br>
        <h5>Solo los profesores pueden pedir salas los profesores.Entrar con USUARIO y PASSWORD de reko!.</h5><br>
      
         <?php
         
         if(isset($mensajeAlerta)){
             echo "<h4>".$mensajeAlerta."</h4>";
         } 
         else{
             
         }
         
          $atributos_Usuario = array(
          'name' => 'usuario',
            'value' => set_value('usuario')
        );
        $atributos_Clave=  array(
            'name'=>'clave'
            ,'type'=>'password'
        );
        $atributos_Btn=  array('class'=>'btn'); 
        
        echo form_open('login/index');
        echo form_label('Usuario', 'usuario');
        echo form_input($atributos_Usuario);echo '<br>';
        echo form_label('Clave', 'password');
        echo form_input($atributos_Clave);echo '<br>';      
        echo form_submit($atributos_Btn, 'Enviar');
        echo form_close();
        
    ?>   
       
<?php
//----------------------------------------------------------------------------------------------------
/*
 * To change this template, choose Tools | Templatess
 * and open the template in the editor.
 * 
 */
/*
   if(isset($mensajeAlerta)){
       
       echo $mensajeAlerta;
       
   }else{
       echo "<form  action=".site_url('pedidos')." method='post'>";
       echo "<button type='button' class='close' data-dismiss='alert' onclick=".site_url('welcome').">&times;</button>";
       echo "<h4>Antes de seguir!</h4>
        Solo los profesores pueden pedir salas los profesores.Entrar con USUARIO y PASSWORD de reko!.<br>
        <br>
        <br>";
       echo "<div id='divLoginProfesor' class='center'>";
       echo "<div class='row' >";
       echo " <div class='span3'>"; 
       echo " <div class='input-prepend'>
          <span class='add-on'><i class='icon-user'></i></span>
          <input class='span3' name='usuario' id='prependedInput' type='text' placeholder='Usuario'>
          </div></div> </div> "; 
       echo " <div class='row'>
            <div class='span3'>
               <div class='input-prepend'>
                   <span class='add-on'><i class='icon-lock'></i></span>
                   <input class='span3' name='clave' id='prependedInput' type='password' placeholder='Clave'>
               </div>
            </div>
    </div> "; 
       echo " <div class='row'>
              <div class='span3'><button class='btn' type='submit'>Entrar</button></div>
              </div> ";
        echo "</div><br>
              <br>
              </form>   ";
       
   }
*/
?>

    </div>
</div>
