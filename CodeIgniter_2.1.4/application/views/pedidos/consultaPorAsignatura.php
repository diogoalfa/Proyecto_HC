<div class="well">
    <br>
    <h4>Consultar por Asignatura</h4><br><br>
     <?= form_open('pedidos/verPedidos')?>
    <div class="row">
        <div class="span2"><label>Asignatura :</label></div>
        <div class="span3">
         <select name="asignatura">
            <?php
    if(isset($asignaturas)){
        echo "<label>Asignatura :</label>";
       foreach ($asignaturas as $asig) {
           echo '<option value="'.$asig->pk.'">'.$asig->nombre.'</option>';
        }
    }    
           ?>
          </select>     
        </div> <div class="span3"><button type="submit" class="btn">Consultar Pedido</button></div>
    </div>
</div>
