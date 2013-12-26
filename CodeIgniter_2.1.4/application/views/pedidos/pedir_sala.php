<?php
    
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.ss
 */
?>

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
       foreach ($asignaturas as $asig) {
           
           $atributos_OptionAsig[$asig->pk]=$asig->nombre;
       }
    }
    if (isset($periodos)) {
        $atributos_OptionPeriodo=array(''=>'->Seleccione Periodo',);
       foreach($periodos as $peri) {
           
           $atributos_OptionPeriodo[$peri->pk]=$peri->periodo;
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
    <div class="row">
        <div class="span2"><label>Asignatura : </label></div><div class="span4">
            <?= form_dropdown('asignatura',$atributos_OptionAsig) ?>
         </div>
    </div>
   
    <div class="row">
        <div class="span2"><label>Fecha : </label></div>
        <div class="span4">
           <?= form_dropdown('dia',$atributos_OptionDia);?>
            <?php
             
             echo $this->calendar->generate(2013,12);
            ?>
        </div>
    </div>
     <div class="row">
        <div class="span2"><label>Periodo : </label></div>
          <div class="span4">
          <?=  form_dropdown('periodo',$atributos_OptionPeriodo);?>
        </div>
    </div>
    <div class="row">
        <div class="span2"><label>Sala a priori :</label></div><div class="span4"><input type="text" placeholder=""></div>
    </div>
    <div class="row">
        <div class="span3"><button type="submit" class="btn">Enviar</button> </div>
    </div><br>
    <button class="btn btn-warning" onclick="location.href='<?= site_url('login/desconectar') ?>'" >desconectar</button>
</div>