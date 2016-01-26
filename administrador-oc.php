<!DOCTYPE html>
<html lang="es">
  <head>
    <title> </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="tema/css/estilos.css">
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="tema/js/scripts.js"></script>
    <link rel="stylesheet" href="tema/js/source/jquery.fancybox.css?v=2.1.5">
    <script src="tema/js/source/jquery.fancybox.pack.js?v=2.1.5"></script>
  </head>
  <body>	
    <header class="grupo">
      <div class="caja base-50 no-padding">
        <h1> <a href="administrador.php"" class="logo"> <img src="tema/img/logo.jpg" alt="POC"></a></h1>
      </div>
      <div class="caja base-50 no-padding"><a href="logout.php" class="logout">Logout</a></div>
    </header>
    <div id="data--input" class="grupo">
      <h3>Administrador</h3>
	  <h4>Gestionar Ordenes de Compra</h4>
    </div>
    <section class="grupo">
      <div class="nav-admin">
        <ul>
          <li><a href="consultar-oc.php" class="consultar">Consultar</a></li>          
          <li><a href="modificar-oc.php" class="modificar">Modificar</a></li>
          <li><a href=".php" class="eliminar">Eliminar</a></li>		 
        </ul>
      </div>
    </section>
	
    <div id="footer" class="total">
      <div class="grupo">
        <div id="logo-footer" class="caja-50"><img src="tema/img/logo-footer.png" alt=""></div>
        <div id="copy" class="caja-50">
          <p>© 2016 Easy S.A.</p>
        </div>
      </div>
    </div>
  </body>
</html>