<br><div class="row-fluid">
	<div class="span4"><h4>Agregar una Sala</h4>
			<?php 
				$nombreSala = array(
		          'name' => 'nombre',
		            'id' => 'nombre',
		            'placeholder'=>'Sala',
		        );
	        
		        $atributos_Btn=  array('class'=>'btn btn-primary btn-large'); 
		        
		        echo form_open('intranet/setAcademico');
		        echo form_label('Nombre o Codigo', 'usuario');
		        echo form_input($nombreSala);echo '<br>'; 

		        echo form_submit($atributos_Btn, 'Enviar');
		        echo form_close();
			 ?>
	</div>
	<div class="span6"><h4>Dar Sala a un Academico</h4>

                          <?php form_open('');
            
            form_close();
        ?>	
	</div>
	<div class="span2">
		
	</div>

</div>