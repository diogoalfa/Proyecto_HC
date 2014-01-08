<script type="text/javascript">
     $(document).ready(function() {
            $("#periodo").change(function() {
                $("#periodo option:selected").each(function() { 
                   periodo = $('#periodo').val();
                   datepicker=$('#datepicker').val();
                    $.post("<?= base_url('/index.php/intranet/getSala');?>", {
                        periodo : periodo ,datepicker : datepicker
                    }, function(data) {
                        $("#sala").html(data);
                    });
                });
            });
        });
</script>
<script type="text/javascript">
        $(document).ready(function() {
            $("#docente").change(function() {
                $("#docente option:selected").each(function() { 
                   docente = $('#docente').val();
                    $.post("<?= base_url('/index.php/intranet/getAsignaturasDocente')?>", {
                        docente : docente
                    }, function(data) {
                        $("#asignatura").html(data);
                    });
                });
            });
        });
        
</script>

<!--PARA COMBOBOX DE SECCION
<script type="text/javascript">
        $(document).ready(function() {
            $("#docente").change(function() {
                $("#docente option:selected").each(function() { 
                   docente = $('#docente').val();
                    $.post("<?= base_url('/index.php/intranet/getSeccionAsignaturasDocente')?>", {
                        docente : docente
                    }, function(data) {
                        $("#asignatura").html(data);
                    });
                });
            });
        });
        
</script>-->

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="jquery.ui.datepicker-es.js"></script>
<script>
$(function () {
 $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };    
$.datepicker.setDefaults($.datepicker.regional["es"]);
$("#datepicker").datepicker({
minDate: "0D",
maxDate: "+7M, 6D"
});
$('#datepicker2').datepicker({
minDate: "0D",
maxDate: "+7M, 6D"
});
});
</script>

<?php
  $atributosDocente= array( "" => "Seleccione un Academico", );
    foreach ($academico as $profesor){ 
    $atributosDocente[$profesor->pk] = $profesor->nombres." ".$profesor->apellidos; 
    }
    
    
    $atributosPeriodo=array( "" => "Seleccione un Periodo", );
    foreach ($periodos as $peri) {
      $atributosPeriodo[$peri->pk]=$peri->periodo." -> ".$peri->inicio." - ".$peri->termino;
    }
    $atributosAsignatura= array( "" => "Seleccione una Asignatura", );
                    foreach ($asignatura as $ramo){ 
                        $atributosAsignatura[$ramo->pk] = $ramo->nombre." ".$ramo->codigo; }
    
?>


<div class="well">
    
    
        <?= form_open('intranet/llenarReservaSemestre');?>
        <h4>Asignacion por semestre</h4><br>
        <div class="row-fluid">
            <div class="span2">Docente:</div> <div class="span3"><?=form_dropdown('docente',$atributosDocente,'',"id='docente' style='width:250px'");?></div>
        </div>
        <div class="row-fluid">
            <div class="span2">Asignatura:</div> <div class="span3"><?=form_dropdown('asignatura',$atributosAsignatura,'',"id='asignatura' style='width:250px'");?></div>
        </div>
        <div class="row-fluid">
            <div class="span2">Fecha:</div><div class="span3"><?= form_input(array('style'=>'width:250px','name'=>'datepickerInicio','id'=>'datepicker','placeholder'=>'Desde'));?></div>
            <div class="span3"><?=form_input(array('style'=>'width:250px','name'=>'datepickerTermino','id'=>'datepicker2','placeholder'=>'Hasta'));?></div>
        </div>
        <div class="row-fluid">
            <div class="span2">Periodo:</div><div class="span3"><?=form_dropdown('periodo',$atributosPeriodo,'',"id='periodo' style='width:250px'" );?></div>
        </div>
        
        <div class="row-fluid">
        <div class="span2">Sala :</div> <div class="span3"><?=form_dropdown('sala',array(''=>'Seleccione Sala'),'',"id='sala'style='width:250px'");?></div>
        </div>
        <div class="row">
            <div class="span7"><?= form_submit("btnEnviar", "Enviar","class='btn btn-primary btn-lg'"); ?></div> <div class="span3"></div>
        </div>
        <?=  form_close(); ?>
        <div class="row">
            <div class="span2"></div> <div class="span3"></div>
        </div>
    
    

   
<br>

			<?php 
                        /*
                        date_default_timezone_set("America/Santiago");
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
                         * 
                         */
					
?>	
	
	


</div>