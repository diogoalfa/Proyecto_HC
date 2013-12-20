<?php 
	        $salas=  array(
            'name'=>'salas',
            'id'=>'salas',
            'value'=>'Reservar Salas',
            'class'=>'btn btn-primary btn-large'
                    );
	        $departamento=  array(
            'name'=>'departamento',
            'id'=>'departamento',
            'value'=>'Agregar',
            'class'=>'btn btn-primary btn-large'
                    );	        
 ?>
<div class="well">
	<div class="row-fluid">
		<div class="span12"><h3>Que desea hacer:</h3></div>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<?php echo form_submit($salas); ?>
		</div>
		<div class="span4">
			<?php echo form_submit($departamento); ?>
		</div>
		<div class="span4">
			
		</div>
	</div>
</div>