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
	
	$rut = $_GET['rut_s'];
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosProveedor=mysqli_query($conexion,"select * from proveedor WHERE rut = '$rut'") or
	die("Problemas en el select:".mysqli_error($conexion));
	
	?>
    <header class="grupo">
      <div class="caja base-50 no-padding">
        <h1> <a href="administrador.php" class="logo"> <img src="tema/img/logo.jpg" alt="POC"></a></h1>
      </div>
      <div class="caja base-50 no-padding"><a href="#" class="logout">Logout</a></div>
    </header>
    <div id="data--input" class="grupo">
      <h3>Administrador</h3>
	  <h4>Modificar proveedor</h4>
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
      <p class="proBig">Modificar proveedor</p>	  
	-->
      <?php
		
		if($reg=mysqli_fetch_array($registrosProveedor)){
			$id_proveedor = $reg['id_proveedor'];
			$rut = $reg['rut'];
			$nombre_fantasia = $reg['nombre'];
			$razon_social = $reg['razon_social'];
			$giro = $reg['giro'];
			$direccion = $reg['direccion'];
			$telefono = $reg['telefono'];
			$contacto = $reg['contacto'];
		}
		
		echo "<form method=\"POST\" class=\"add\">";
			echo "<label>RUT</label>";
			echo "<input type=\"text\" value=\"$rut\" name=\"rut\" >";
			
			echo "<label>Nombre fantasía</label>";
			echo "<input type=\"text\" value=\"$nombre_fantasia\" name=\"nombre_fantasia\" >";
			
			echo "<label>Razón social</label>";
			echo "<input type=\"text\" value=\"$razon_social\" name=\"razon_social\">";
			
			echo "<label>Giro</label>";
			echo "<input type=\"text\" value=\"$giro\" name=\"giro\" >";
			
			echo "<label>Dirección</label>";
			echo "<input type=\"text\" value=\"$direccion\" name=\"direccion\">";
			
			echo "<label>Teléfono</label>";
			echo "<input type=\"text\" value=\"$telefono\" name=\"telefono\" >";
			
			echo "<label>Contacto</label>";
			echo "<input type=\"text\" value=\"$contacto\" name=\"contacto\" >";
			
			echo "<br><br>";
			
			echo "<input type=\"text\" name=\"id_proveedor\" value=\"$id_proveedor\" hidden=hidden>";
			
			echo "<input type=\"submit\" value=\"Guardar\" formaction=\"actualizar-proveedor.php\" >";			
			echo "<input type=\"submit\" value=\"Cancelar\" formaction=\"administrador.php\">";
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