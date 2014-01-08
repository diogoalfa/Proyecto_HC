
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
$atributos_Nombre=array('name'=>'nombre');
$atributos_Apellido=array('name'=>'Apellido');

    if (isset($asignaturas)) {
        $atributos_OptionAsig=array(''=>'->Seleccionar Asignatura',);
        $atributos_OptionSeccion=array(''=>'->Seleccionar seccion',);
     //  $atributos_OptionAsig=array(''=>'->Seleccionar Asignatura',);
       foreach ($asignaturas as $asig) {
           
           $atributos_OptionAsig[$asig->pk]=$asig->nombre;
           $atributos_OptionSeccion[$asig->seccion]=$asig->seccion;
       }
    }
    if (isset($periodos)) {
        $atributos_OptionPeriodo=array(''=>'->Seleccione Periodo',);
       foreach($periodos as $peri) {
           
           $atributos_OptionPeriodo[$peri->periodo]=$peri->pk." -> ".$peri->inicio." ".$peri->termino;
      }
    }
 
    

    
    $atributos_OptionDia=array(
    ''=>'->Seleccione el Dia',
    'optDia1'=>'Lunes',
    'optDia2'=>'Martes',
    'optDia3'=>'Miercoles',
    'optDia4'=>'Jueves',
    'optDia5'=>'Viernes');
 

   $atributos_OptionSala=array();



?>
<div class="well">
    <?php 
    
    if (isset($docente)) {
        ?>
    <div class="row-fluid">    
        <div class="span6">
            <h4>Docente</h4>
                <div class="row-fluid">
                    <div class="span6"></div>
                    <div class="span6"></div>
                </div>
                <div class="row-fluid">
                    <div class="span6"><?= form_label('Nombre :');?></div> <div class="span6"><?=  form_label($docente->nombres); ?></div>
                </div>
                <div class="row-fluid">
                   <div class="span6"><?=form_label('Apellido :');?></div>  <div></div><div class="span6"><?=  form_label($docente->apellidos); ?></div>   
                </div>
                <div class="row-fluid">
                   <div class="span6"><?=form_label('Rut :'); ?></div>  <div></div><div class="span6"><?=  form_label($docente->rut); ?></div>   
                </div>
                 <?php
                }
                ?>
        </div>
        <div class="span6">
               <h4>Pedir Sala</h4>
                 <?=     form_open(base_url('index.php/pedidos/guardarPedidoSala'));?>
                 <div class="row-fluid">
                     <div class="span6"></div><div class="span6"><?php echo form_input(array('name'=>'docente','type'=>'hidden','id'=>'docente','value'=>$docente->pk));?></div>
                 </div>
                <div class="row-fluid">
                    <div class="span6"><label>Asignatura : </label></div><div class="span6">
                        <?= form_dropdown('asignatura',$atributos_OptionAsig,'',"id='asignatura'style='width:250px'")?>  
                     </div>
                </div>
                 <div class="row-fluid">
                    <div class="span6"><label>Seccion : </label></div><div class="span6">
                        <?= form_dropdown('seccion',$atributos_OptionSeccion,'',"id='seccion' style='width:250px'")?>  
                     </div>
                </div>
               
                <div class="row-fluid">
                    <div class="span6"><label>Fecha : </label></div>
                    <div class="span6">
                        <input required style='width:250px' type="text" id="datepicker" placeholder="->Seleccione Fecha " name="datepicker" />
                    </div>
                </div>
                 <div class="row-fluid">
                    <div class="span6"><label>Periodo : </label></div>
                      <div class="span6">
                       <?= form_dropdown('sePeriodo',$atributos_OptionPeriodo,'',"id='periodo' style='width:250px'")?>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span6"><label>Sala a priori :</label></div>
                    <div class="span6" >
                        <select style='width:250px' id="divSala" name="sala"><option>->Seleccione la sala</option></select> 
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span6"><button type="submit" class="btn btn-primary btn-lg">Enviar</button> </div>
                </div>
             <?= form_close();?>
        </div>
    </div>
  
</div>