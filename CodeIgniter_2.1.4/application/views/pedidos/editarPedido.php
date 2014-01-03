
<script type="text/javascript">
        $(document).ready(function() {
            $("#sePeriodo").change(function() {
                $("#sePeriodo option:selected").each(function() { 
                   sePeriodo = $('#sePeriodo').val();
                   datepicker=$('#datepicker').val();
                    $.post("<?= base_url('/index.php/pedidos/salaDisponible')?>", {
                        sePeriodo : sePeriodo ,datepicker : datepicker
                    }, function(data) {
                        $("#divSala").html(data);
                    });
                });
            });
        });
</script>


<?php

   $contenidoPeriodo=array(''=>'Seleccione periodo',);
 foreach ($periodos as $peri) {
    $contenidoPeriodo[$peri->pk]=$peri->periodo;
  }
  
  $contenidoAsignatura=array(''=>'Seleccione asignatura',);
  foreach ($asignaturas as $asig) {
    $contenidoAsignatura[$asig->pk]=$asig->nombre;
  }
 
?>

    

<div class="well">
  
 <?=form_open('pedidos/updatePedido')?>
     <div class="row">
        <div class="span2">Pk :</div>
        <div class="span3"><?= form_input(array('name'=>'pkPeriodo','readonly'=>'readonly','value'=>$pkPedido))?></div>
    </div>   
    <div class="row">
        <div class="span2">Asignatura :</div>
        <div class="span3"><?= form_dropdown('asignatura',$contenidoAsignatura)?></div>
    </div>
    <div class="row">
         <div class="span2">Fecha :</div>
         <div class="span3"><?= form_input(array('name'=>'fecha','value'=>$fecha),'',"id='datepicker'")?></div>
    </div>
    <div class="row">
         <div class="span2">Periodo :</div>
         <div class="span3"><?= form_dropdown('periodo',$contenidoPeriodo,'',"id='sePeriodo'")?></div>
    </div>
    <div class="row">
        <div class="span2">Sala :</div>
        <div class="span3"><?= form_dropdown('sala',array(''=>'Seleccione Sala'),'',"id='divSala'");?></div>
    </div>
    <div class="row">
        <div class="span2"><?= form_submit('btnEditarPedido','Enviar',"class='btn'");?></div>
        
    </div>
     <?php form_close();?>
    
</div>
