




<div class="well">
    <form>
    <div class="row"><h3>Bienvenido: <?php echo $_SESSION['bnv']; ?></h3>
        <div class="btn-group">
           <a class="btn btn-default btn-large" href="<?= site_url('pedidos/pedirSala');?>">Pedir Sala</a>
           <a class="btn btn-default btn-large" href="<?= site_url('pedidos/verPedidos');?>">Ver Pedido</a>
        </div>

    </div>
    </form>
    </div>