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
	
	$id_ceco = $_GET['id_ceco_s'];
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosCeco=mysqli_query($conexion,"select * from centro_costo WHERE id_centro_costo = '$id_ceco'") or
	die("Problemas en el select:".mysqli_error($conexion));
	
	?>
    <header class="grupo">
      <div class="caja base-50 no-padding">
        <h1> <a href="opcion-admin.php" class="logo"> <img src="tema/img/logo.jpg" alt="POC"></a></h1>
      </div>
      <div class="caja base-50 no-padding"><a href="eliminar-ceco-select.php" class="logout">Volver</a></div>
    </header>
    <div id="data--input" class="grupo">
      <h3>Administrador</h3>
	  <h4>Eliminar Centro de Costo</h4>
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
		
		if($reg=mysqli_fetch_array($registrosCeco)){
		
			$id_ceco = $reg['id_centro_costo'];
			
			$codigo_sap = $reg['codigo'];
			$descripcion = $reg['descripcion'];
			$ceco = $reg['ceco'];
			
		}
		
		echo "<form method=\"post\" class=\"add\">";
			echo "<label>ID Centro de Costo</label>";
			echo "<input type=\"text\" value=\"$id_ceco\" readonly>";
			
			echo "<label>Codigo SAP</label>";
			echo "<input type=\"text\" value=\"$codigo_sap\" readonly>";
			
			echo "<label>Descripción</label>";
			echo "<input type=\"text\" value=\"$descripcion\" readonly>";
			
			echo "<label>CECO</label>";
			echo "<input type=\"text\" value=\"$ceco\" readonly>";
			
			echo "<br><br>";
			
			echo "<input type=\"text\" value=\"$id_ceco\" name=\"id_ceco\" hidden=hidden>";
						
			echo "<input type=\"submit\" value=\"Eliminar\" formaction=\"procesar-eliminar-ceco.php\" onclick=\"return confirm('¿ Está seguro que desea eliminar el registro ?');\" >";
			echo "<input type=\"submit\" value=\"Cancelar\" formaction=\"eliminar-ceco-select.php\">";
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