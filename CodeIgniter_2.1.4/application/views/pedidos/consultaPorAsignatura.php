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
<?php

 
  
   if (isset($asignaturas)) {
      
         $atributos_OptionSeccion=array(''=>'->Seleccionar seccion',);
     //  $atributos_OptionAsig=array(''=>'->Seleccionar Asignatura',);
       foreach ($asignaturas as $asig) {
           
           $atributos_OptionAsig[$asig->pk]=$asig->nombre;
           $atributos_OptionSeccion[$asig->seccion]=$asig->seccion;
       }
       
      
    }
?>


<div class="well">
    <br>
    <h4>Consultar por Asignatura</h4><br><br>
     <?= form_open(base_url('index.php/pedidos/verPedidos'))?>
     <?=form_input(array("type"=>"hidden","name"=>"docente",'id'=>'docente','value'=>$docente->pk))?>
    <div class="row-fluid">
        <div class="span6">
        <?= form_label('Asignatura :')?>
        </div>
        <div class="span6">
        <?= form_dropdown('asignatura',$atributos_OptionAsig,'',"id='asignatura' style='width:250px'") ?>     
        </div>
    </div>   
    <div class="row-fluid">
        <div class="span6"><?= form_label('Seccion :')?></div>
        <div class="span6">
        <?= form_dropdown('seccion',$atributos_OptionSeccion,'',"id='seccion' style='width:250px'")?>    
        </div>
    </div>
    <div class="row"><div class="span6"></div>
       <div class="span2"><button type="submit" class="btn btn-primary">Consultar Pedido</button></div>  
      <div class="span4"></div>
    </div>   
       
    
</div>
