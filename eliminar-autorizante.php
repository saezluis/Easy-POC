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
	
	$id_auto = $_GET['id_auto_s'];
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosAuto=mysqli_query($conexion,"select * from autorizante WHERE id_autorizante = '$id_auto'") or
	die("Problemas en el select:".mysqli_error($conexion));
	
	?>
    <header class="grupo">
      <div class="caja base-50 no-padding">
        <h1> <a href="opcion-admin.php" class="logo"> <img src="tema/img/logo.jpg" alt="POC"></a></h1>
      </div>
      <div class="caja base-50 no-padding"><a href="eliminar-autorizante-select.php" class="logout">Volver</a></div>
    </header>
    <div id="data--input" class="grupo">
      <h3>Administrador</h3>
	  <h4>Eliminar Autorizante</h4>
    </div>
    <section class="grupo">
      <div class="nav-admin">
        <ul>
		  <!--	
          <li><a href="administrador.php" class="consultar">Consultar</a></li>
          <li><a href="" class="agregar">Agregar</a></li>
		  
          <li><a href="" class="modificar">Modificar</a></li>
          <li><a href="" class="eliminar">Eliminar</a></li>		  
		  -->
        </ul>
      </div>
    </section>
    <section class="grupo">
		<!--
      <p class="proBig">Modificar/Eliminar proveedor</p>	  
	  -->
      <?php
		
		if($reg=mysqli_fetch_array($registrosAuto)){
			$id_autorizante = $reg['id_autorizante'];
			$nombre_autorizante = $reg['nombre_autorizante'];			
			
		}
		
		echo "<form method=\"post\" class=\"add\">";
			echo "<label>ID</label>";
			echo "<input type=\"text\" value=\"$id_autorizante\" readonly>";
			
			echo "<label>Nombre Autorizante</label>";
			echo "<input type=\"text\" value=\"$nombre_autorizante\" readonly>";
			
			echo "<br><br>";
			
			echo "<input type=\"text\" value=\"$id_autorizante\" name=\"id_autorizante\" hidden=hidden>";
						
			echo "<input type=\"submit\" value=\"Eliminar\" formaction=\"procesar-eliminar-autorizante.php\" onclick=\"return confirm('¿ Está seguro que desea eliminar el registro ?');\" >";
			echo "<input type=\"submit\" value=\"Cancelar\" formaction=\"eliminar-autorizantes-select.php\">";
		echo "</form>";
	?>
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