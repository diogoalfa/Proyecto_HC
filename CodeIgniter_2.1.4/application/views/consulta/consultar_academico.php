	<div class="span9">
		<h3>Imparte Clase:</h3>
		<?php 
$opciones = array(//q se exraigan de la bd
                  'small'  => 'Ricaro Corbinaud',
                  'med'    => 'Santiago Zapata',
                  'large'   => 'Mauro Castillo',
                );

//$remeras_a_la_venta = array('small');
$clase='class="form-control"';
echo form_dropdown('academicos', $opciones, 'small',$clase);


		 ?>
	</div>