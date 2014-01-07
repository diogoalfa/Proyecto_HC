
<div class="well">
    <form>
    <div class="row"><h3>Bienvenido: <?php echo $_SESSION['bnv']; ?></h3>
               	<div class="row">
   				 <h5 class="muted">Seleccione una opcion para pedir una peticion</h5>
			</div>	
        <div class="btn-group">
           <a class="btn btn-default btn-lg" href="<?= site_url('pedidos/pedirSala');?>">Pedir Sala</a>
           <a class="btn btn-default btn-lg" href="<?= site_url('pedidos/verPedidos');?>">Ver Pedido</a>

        </div><br><br>
  <!-- <a href="<?= site_url('login/desconectar');?>" class="btn btn-warning">desconectar</a> -->

    </div>
    </form>
    </div>