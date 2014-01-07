   
    <body>
 <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    <script>
    function CambiarEstilo(id) {
  var elemento = document.getElementById(id);
  elemento.className = "active";
}
    </script>
        
        <div class="masthead" id="divBarra1">
        <h3 class="muted">Horario de Clases</h3>
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container">
              <ul class="nav pull-left">
                <li><a href="<?= site_url('consulta');?>">Consulta</a></li>
                <li class="divider-vertical"></li>
                <li><a href="<?= site_url('pedidos');?>">Pedidos</a></li>
                <li class="divider-vertical"></li>
                <li><a href="<?= site_url('intranet');?>">Intranet</a></li>
                <li class="divider-vertical"></li>
                <li id="con"><a  href="<?= site_url('contacto');?>">Contacto</a></li>
                <li class="divider-vertical"></li>
              </ul> 
                <?php if(isset($_SESSION['bnv']) || isset($_SESSION['usuarioProfesor']) || isset($_SESSION['usuarioAdmin']))
                {
                  ?><ul class="nav pull-right"><li ><button class="btn btn-warning" onclick="location.href='<?= site_url('login/desconectar') ?>'" >Desconectar</button></li></ul><?php
                }?>
              
            </div>
          </div>
        </div><!-- /.navbar -->
      </div>