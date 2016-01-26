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
	<?php
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	
	
	?>
    <header class="grupo">
      <div class="caja base-50 no-padding">
        <h1> <a href="#" class="logo"> <img src="tema/img/logo.jpg" alt="POC"></a></h1>
      </div>
      <div class="caja base-50 no-padding"><a href="#" class="logout">Logout</a></div>
    </header>
    <div id="data--input" class="grupo">
      <h3>Administrador</h3>
    </div>
    <section class="grupo">
      <div class="nav-admin">
        <ul>
          <li><a href="" class="consultar">Consultar</a></li>
          <li><a href="" class="agregar">Agregar</a></li>
          <li><a href="" class="modificar">Modificar</a></li>
          <li><a href="" class="eliminar">Eliminar</a></li>
        </ul>
      </div>
    </section>
    <section class="grupo">
      <p class="proBig">Agregar proveedor</p>
      <form class="add">
        <label>RUT</label>
        <input type="text">
        <label>Nombre fantasía</label>
        <input type="text">
        <label>Razón social</label>
        <input type="text">
        <label>Giro</label>
        <input type="text">
        <label>Dirección</label>
        <input type="text">
        <label>Teléfono</label>
        <input type="text">
        <label>Contacto</label>
        <input type="text">
        <input type="submit" value="Agregar">
        <input type="submit" value="Cancelar">
      </form>
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