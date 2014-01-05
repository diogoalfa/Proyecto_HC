<script type="text/javascript">
    $(document).ready(function() { 
       window.onload = function() {
          periodo = $('#periodo').val();
                   datepicker=$('#datepicker').val();
                    $.post("<?= base_url('/index.php/intranet/getSala');?>", {
                        periodo : periodo ,datepicker : datepicker
                    }, function(data) {
                        $("#sala").html(data);
                    });
        }
     
     });
</script>

<div class="well">
    <h4>Aprobar Pedido</h4><br>
    <?=form_open('intranet/aprobarFinal')?>
    <div class="row">
        <div class="span2">N° Pedido:</div><div class="span3"><?=form_input(array('name'=>'pkPedido','readonly'=>'readonly','value'=>$pedido['pk']))?></div>
    </div>
    <div class="row">
    <div class="span2">Nombre:</div><div class="span3"><?=form_input(array('name'=>'nombre','readonly'=>'readonly','value'=>$pedido['nombredocente'])) ?>
  
    </div>
    </div>
    <div class="row">
        <div class="span2">Apellido:</div><div class="span3"><?=form_input(array('name'=>'apellido','readonly'=>'readonly','value'=>$pedido['apellidodocente'])) ?></div>
    </div>
    <div class="row">
        <div class="span2">Fecha:</div><div class="span3"><?=form_input(array('name'=>'fecha','id'=>'datepicker','readonly'=>'readonly','value'=>$pedido['fecha'])) ?></div>
    </div>
    <div class="row">
        <div class="span2">Asignatura:</div><div class="span3"><?=form_input(array('name'=>'asignatura','id'=>'datepicker','readonly'=>'readonly','value'=>$pedido['asignatura'])) ?>
       
        </div>
    </div>
    <div class="row">
        <div class="span2">Periodo:</div><div class="span3"><?=form_input(array('name'=>'periodo','id'=>'datepicker','readonly'=>'readonly','value'=>$pedido['periodo'],'id'=>'periodo')) ?>
            
        </div>
    </div>
     <div class="row">
         <div class="span2">Sala:</div><div class="span3"><?=form_dropdown('sala',array($pedido['pksala']=>$pedido['sala']),'',"id='sala'")?>
            
         </div>
    </div>
    <div class="row">
        <div class="span2"><?=  form_submit("",'Aprobar',"class='btn btn-primary'")?></div>
    </div>
    <?=form_close()?>
</div>