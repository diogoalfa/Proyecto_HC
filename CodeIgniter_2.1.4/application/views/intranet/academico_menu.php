<br><div class="row-fluid">
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
	<div class="span6"><h4>Asocia</h4>

			<?php 
			echo form_open('intranet/asocia');	
						        $atributos_Btn=  array('class'=>'btn btn-primary'); 
						        $atributos= array( "" => "Seleccione un Academico", );
						foreach ($academico as $profesor){ 
						$atributos[$profesor->pk] = $profesor->nombres." ".$profesor->apellidos; }

						$listaAsignatura= array( "" => "Seleccione una Asignatura", );
					foreach ($asignatura as $ramo){ 
						$listaAsignatura[$ramo->pk] = $ramo->nombre." ".$ramo->codigo; }
						$seccion= array( "" => "Seleccione una Seccion", );
					foreach ($asignatura as $ramo){ 
						for ($i=1; $i <=8; $i++) { 
								$seccion[$i] =$i ;
						}
						 }
					$sem1 = array(
					    'name'        => 'semestre',
					    'id'          => 'semestre',
					    'checked'     => TRUE,
					    'style'       => 'margin:10px',
					    'value'=>'1',
					    );
					$sem2 = array(
					    'name'        => 'semestre',
					    'id'          => 'semestre',
					    'style'       => 'margin:10px',
					    'value'=>'2',
					    );
								$año=array(
					    				'value'=>date("Y"),
					    				'readonly'=>'readonly',
					    				'id'=>'anio',
					    				'name'=>'anio',
					    			);
					    $atributos_Btnn=  array('class'=>'btn btn-primary btn-large');			    			
			echo '
				<table border="0">
					<tr>
						<td>'.form_label('Academico', 'academico').''.form_dropdown('docente', $atributos).'</td>
						<td>'.form_label('Año', 'año').''.form_input($año).'</td>
					</tr>
					<tr>
						<td>'.form_label('Asignatura', 'asignatura').''.form_dropdown('ramo', $listaAsignatura).'</td>
						<td>'.form_label('Semestre','semestre').'1'.form_radio($sem1).'2'.form_radio($sem2).'</td>
					</tr>
					<tr>
						<td>'.form_label('Seccion', 'seccion').''.form_dropdown('seccion', $seccion).'</td>
						<td>'.form_submit($atributos_Btnn, 'Asociar').'</td>
					</tr>
				</table>
			';

				 	//echo form_submit($atributos_Btn, 'Enviar');
				//--------
				        echo form_close();
					
?>	
	</div>
	<div class="span2">
		
	</div>

</div>