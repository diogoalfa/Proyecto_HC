<div class="well">
<div class="row-fluid">
	<div class="span4"><h4>Agregar una Sala</h4>
			<?php 
				$nombreSala = array(
		          'name' => 'nombre',
		            'id' => 'nombre',
		        );
	        
		        $atributos_Btn=  array('class'=>'btn btn-primary btn-large'); 
		        
		        echo form_open('intranet/setSala');
		        echo form_label('Nombre o Codigo', 'usuario');
		        echo form_input($nombreSala);echo '<br>'; 

		        echo form_submit($atributos_Btn, 'Enviar');
		        echo form_close();
			 ?>
	</div>
	<div class="span6"><h4>Dar Sala a un Academico</h4>

        <?php 
        	echo form_open('intranet/setSalaAcademico');
        	$atributosSala= array( "" => "Seleccione una Sala", );
        	foreach ($salas as $aula){ 
						$atributosSala[$aula->pk] = $aula->sala; }
			$atributosAcademico= array( "" => "Seleccione un Academico", );
        	foreach ($academico as $profesor){ 
						$atributosAcademico[$profesor->pk] = $profesor->nombres." ".$profesor->apellidos; }
			$atributosPeriodo= array( "" => "Seleccione un Periodo", );
        	foreach ($periodo as $peri){ 
						$atributosPeriodo[$peri->pk] = $peri->periodo." -> ".$peri->inicio." - ".$peri->termino; }
			$atributos_Btn=  array('class'=>'btn btn-primary btn-lg','id'=>'btn_Asociar','name'=>'btn_Asociar');				
				echo form_label('Sala', 'sala');
				echo form_dropdown('sala', $atributosSala);
				echo form_label('Academico', 'academico');
				echo form_dropdown('docente', $atributosAcademico);
				echo form_label('Periodo', 'periodo');
				echo form_dropdown('periodo', $atributosPeriodo);echo "<br />";
				echo form_submit($atributos_Btn, 'Asociar');
            echo form_close();
        ?>	
	</div>
	<div class="span2"><h4>Resultados</h4>
			<?php echo form_label('Ver'); ?>
		<a class="btn btn-info btn-lg" href="<?= site_url('intranet/resultadosGral');?>">Asignaciones</a>
	</div>

</div>
</div>