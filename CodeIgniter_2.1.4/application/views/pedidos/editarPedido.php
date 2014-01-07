
<script type="text/javascript">
        $(document).ready(function() {
            $("#periodo").change(function() {
                $("#periodo option:selected").each(function() { 
                   periodo = $('#periodo').val();
                   datepicker=$('#datepicker').val();
                    $.post("<?= base_url('/index.php/pedidos/salaDisponible')?>", {
                        periodo : periodo ,datepicker : datepicker
                    }, function(data) {
                        $("#divSala").html(data);
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
                    $.post("<?= base_url('/index.php/pedidos/getAsignaturasDocente')?>", {
                        docente : docente
                    }, function(data) {
                        $("#asignatura").html(data);
                    });
                });
            });
        });
        
</script>
<script type="text/javascript">
        $(document).ready(function() {
            $("#asignatura").change(function() {
                $("#asignatura option:selected").each(function() { 
                   asignatura=$('#asignatura').val();
                   docente = $('#docente').val();
                  
                    $.post("<?= base_url('/index.php/pedidos/getSeccionDeAsignatura')?>", {
                        asignatura : asignatura , docente : docente
                    }, function(data) {
                        $("#seccion").html(data);
                    });
                });
            });
        });
        
</script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="jquery.ui.datepicker-es.js"></script>
<script type="text/javascript">

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
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };    
$.datepicker.setDefaults($.datepicker.regional["es"]);
$("#datepicker").datepicker({
minDate: "0D",
maxDate: "+1M, 5D"
});
});
</script>

<?php

   $contenidoPeriodo=array($periodo=>$periodo,);
 foreach ($periodos as $peri) {
    $contenidoPeriodo[$peri->pk]=$peri->periodo;
  }
  
  $contenidoAsignatura=array($pkasignatura=>$nombreasignatura,);
 
  foreach ($asignaturas as $asig) {
    $contenidoAsignatura[$asig->pk]=$asig->nombre;
 }
 
 $contenidoSeccion=array($seccion=>$seccion,);
 foreach ($secciones as $secc) {
    $contenidoSeccion[$secc->seccion]=$secc->seccion;
}
   
 
?>

    

<div class="well">
  
 <?=form_open(base_url('index.php/pedidos/updatePedido'))?>
    <?=  form_input(array('type'=>'hidden','name'=>'docente','id'=>'docente','value'=>$pkdocente))?>
     <div class="row">
        <div class="span2">N° Pedido :</div>
        <div class="span3"><?= form_input(array('name'=>'pkPedido','readonly'=>'readonly','value'=>$pkPedido))?></div>
    </div>   
    <div class="row">
        <div class="span2">Asignatura :</div>
        <div class="span3"><?= form_dropdown('asignatura',$contenidoAsignatura,'',"id='asignatura'")?></div>
    </div>
    <div class="row">
        <div class="span2">Seccion :</div>
        <div class="span3"><?= form_dropdown('seccion',$contenidoSeccion,'',"id='seccion'")?></div>
    </div>
    <div class="row">
         <div class="span2">Fecha :</div>
         <div class="span3"><?= form_input(array('name'=>'fecha','value'=>$fecha),'',"id='datepicker'")?></div>
    </div>
    <div class="row">
         <div class="span2">Periodo :</div>
         <div class="span3"><?= form_dropdown('periodo',$contenidoPeriodo,'',"id='periodo'")?></div>
    </div>
    <div class="row">
        <div class="span2">Sala :</div>
        <div class="span3"><?= form_dropdown('sala',array($pksala=>$sala),'',"id='divSala'");?></div>
    </div>
    <div class="row">
        <div class="span2"><?= form_submit('btnEditarPedido','Enviar',"class='btn btn-primary btn-lg'");?></div>
        
    </div>
     <?php form_close();?>
    
</div>
