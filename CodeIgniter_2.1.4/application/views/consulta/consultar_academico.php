<div class="span9">
		<h3>Imparte Clase:</h3>
	<?php 
	        $atributos_Btn=  array(
            'class'=>'btn btn-primary'); 
            $atributos= array( "" => "Seleccione un Academico", );
			foreach ($academico as $profesor){ 
				$atributos[$profesor->pk] = $profesor->nombres." ".$profesor->apellidos; 
			}

				
				
		echo form_open('consulta/res_academico/');	
		echo form_dropdown('docente', $atributos);echo "<br />";
		 	echo form_submit($atributos_Btn, 'Enviar');
        echo form_close();
	?>

</div>