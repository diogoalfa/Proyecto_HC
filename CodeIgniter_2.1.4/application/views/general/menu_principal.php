   
    <body >
 <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
  <h3 class="muted">Horario de Clases</h3>
        
      <div class="container">
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li><a href="<?= site_url('consulta');?>">Consulta</a></li>
            <li><a href="<?= site_url('pedidos');?>">Pedidos</a></li>
            <li><a href="<?= site_url('intranet');?>">Intranet</a></li>
            <li><a  href="<?= site_url('contacto');?>">Contacto</a></li>
          </ul>
                <?php if(isset($_SESSION['bnv']) || isset($_SESSION['usuarioProfesor']) || isset($_SESSION['usuarioAdmin']))
                { 
                  ?><ul class="nav pull-right"><li ><button class="btn btn-warning" onclick="location.href='<?= site_url('login/desconectar') ?>'" >Desconectar</button></li></ul><?php
                }?>
        </div>
      </div>
