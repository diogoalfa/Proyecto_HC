



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
<div class="well">
    <div class="row" id="divSaludoProfesor">
       <div class="span4"><h4>Bienvenido SR@ :<?=$_SESSION['usuarioProfesor'];?></h4></div> 
    </div>
    <div class="row">
        <div class="span6">Llene el formulario para enviar la solicitud de peticion de Sala.</div>
    </div>
</div><br>
<br><br>
<?php
$atributos_Nombre=array('name'=>'nombre');
$atributos_Apellido=array('name'=>'Apellido');

    if (isset($asignaturas)) {
        $atributos_OptionAsig=array(''=>'->Seleccionar Asignatura',);
     //  $atributos_OptionAsig=array(''=>'->Seleccionar Asignatura',);
       foreach ($asignaturas as $asig) {
           
           $atributos_OptionAsig[$asig->pk]=$asig->nombre;
       }
    }
    if (isset($periodos)) {
        $atributos_OptionPeriodo=array(''=>'->Seleccione Periodo',);
       foreach($periodos as $peri) {
           
           $atributos_OptionPeriodo[$peri->periodo]=$peri->pk;
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
    <div class="row">
        <div class="span2"><?= form_label('Nombre :');?></div> <div class="span3"><?=  form_label($docente->nombres); ?></div>
    </div>
    <div class="row">
       <div class="span2"><?=form_label('Apellido :');?></div>  <div></div><div class="span3"><?=  form_label($docente->apellidos); ?></div>   
    </div>
    <div class="row">
       <div class="span2"><?=form_label('Rut :'); ?></div>  <div></div><div class="span3"><?=  form_label($docente->rut); ?></div>   
    </div>
     <?php
    }
    ?>
     <br><br>
     <?=     form_open('pedidos/guardarPedidoSala');?>
     <div class="row">
         <div class="span2">Curso :</div><div class="span4"><input type="text" name="docente" value="<?=$docente->pk?>"></div>
     </div>
    <div class="row">
        <div class="span2"><label>Asignatura : </label></div><div class="span4">
           
            <select id="" name="asignatura">
             <?php
                 echo '<option>->Seleccione Asignatura</option>';
                foreach ($asignaturas as $asig) {
                    echo '<option value="'.$asig->pk.'">'.$asig->nombre.'</option>';
                }
            
            ?>   
                
            </select>
            
         </div>
    </div>
   
    <div class="row">
        <div class="span2"><label>Fecha : </label></div>
        <div class="span4">
            <input required type="text" id="datepicker" placeholder="->Seleccione Fecha " name="datepicker" />
        </div>
    </div>
     <div class="row">
        <div class="span2"><label>Periodo : </label></div>
          <div class="span4">
          <?php // form_dropdown('periodo',$atributos_OptionPeriodo,'->Seleccione Periodo','id="periodo"');?>
              <select required  id="sePeriodo" name="sePeriodo" value="<?= set_value('sePeriodo')?>">
               <?php 
                echo "<option>->Seleccione Periodo</option>";
                foreach ($periodos as $peri) {
                    echo '<option value="'.$peri->pk.'">'.$peri->periodo.'</option>';
                }
               ?>  
              </select>
        </div>
    </div>
    <div class="row">
        <div class="span2"><label>Sala a priori :</label></div>
        <div class="span4" >
            <select id="divSala" name="sala"><option>->Seleccione la sala</option></select> 
        </div>
    </div>
    <div class="row">
        <div class="span3"><button type="submit" class="btn">Enviar</button> </div>
    </div>
     <?= form_close();?>
     <br>
    <button class="btn btn-warning" onclick="location.href='<?= site_url('login/desconectar') ?>'" >desconectar</button>
</div>