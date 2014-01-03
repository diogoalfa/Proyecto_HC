<?php

 
  
   if (isset($asignaturas)) {
        $atributos_OptionAsig=array(''=>'->Seleccionar Asignatura',);
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
     <?= form_open('pedidos/verPedidos')?>
    <div class="row">
        <div class="span2">
        <?= form_label('Asignatura :')?>
        </div>
        <div class="span3">
        <?= form_dropdown('asignatura',$atributos_OptionAsig) ?>     
        </div>
    </div>   
    <div class="row">
        <div class="span2"><?= form_label('Seccion :')?></div>
        <div class="span3">
        <?= form_dropdown('seccion',$atributos_OptionSeccion)?>    
        </div>
    </div>
    <div class="row">
       <div class="span3"><button type="submit" class="btn">Consultar Pedido</button></div>  
    </div>   
       
    
</div>
