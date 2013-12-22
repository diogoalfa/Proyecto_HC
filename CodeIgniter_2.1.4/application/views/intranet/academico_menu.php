<br><div class="row fluid">
	<div class="span4"><h4>Registrar Academico</h4>
			<?php 
				$nombre = array(
		          'name' => 'nombre',
		            'id' => 'nombre'
		        );
				$apellido = array(
		          'name' => 'apellido',
		            'id' => 'apellido'
		        );		        
		        $rut=  array(
		            'name'=>'rut'
		            ,'id'=>'rut'
		        );
		        $dpto=  array(
		            'name'=>'dpto'
		            ,'id'=>'dpto'
		        );		        
		        $atributos_Btn=  array('class'=>'btn btn-primary btn-large'); 
		        
		        echo form_open('intranet/setAcademico');
		        echo form_label('Nombre', 'usuario');
		        echo form_input($nombre);echo '<br>';

		      	echo form_label('Apellido', 'usuario');
		        echo form_input($apellido);echo '<br>';

		        echo form_label('Rut', 'password');
		        echo form_input($rut);echo '<br>';   

		       // echo form_label('Departamento', 'departamento');
		        //echo form_input($dpto);echo '<br>'; 

		        echo form_submit($atributos_Btn, 'Enviar');
		        echo form_close();
			 ?>
	</div>
	<div class="span4"><h4>Asocia</h4>
			<?php 
			$atributos_Btnn=  array('class'=>'btn btn-primary btn-large'); 
				echo form_label('Academico', 'academico');
			        $atributos_Btn=  array(
		            'class'=>'btn btn-primary'); 
		            $atributos= array( "" => "Seleccione un Academico", );
					foreach ($academico as $profesor){ 
						$atributos[$profesor->pk] = $profesor->nombres." ".$profesor->apellidos; 
					}
						
				echo form_open('consulta/res_academico/');	
				echo form_dropdown('docente', $atributos);echo "<br />";
				 	//echo form_submit($atributos_Btn, 'Enviar');
				//--------
					echo form_label('Asignatura', 'asignatura');
					$listaAsignatura= array( "" => "Seleccione una Asignatura", );
					foreach ($asignatura as $ramo){ 
						$listaAsignatura[$ramo->pk] = $ramo->nombre." ".$ramo->codigo; 
					}
					echo form_dropdown('ramo', $listaAsignatura);echo "<br />";
						echo "<br /><br /><br />";
				echo form_submit($atributos_Btnn, 'Asociar');		
		        echo form_close();
			?>
	</div>
	<div class="span4">
		
	</div>
</div>