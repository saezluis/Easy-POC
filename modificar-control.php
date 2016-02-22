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
	
	$id_control = $_GET['id_control_s'];
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosControl=mysqli_query($conexion,"SELECT * FROM control_presupuesto WHERE id_controlP = '$id_control'") or
	die("Problemas en el select:".mysqli_error($conexion));
	
	?>
    <header class="grupo">
      <div class="caja base-50 no-padding">
        <h1> <a href="opcion-admin.php" class="logo"> <img src="tema/img/logo.jpg" alt="POC"></a></h1>
      </div>
      <div class="caja base-50 no-padding"><a href="modificar-control-principal.php" class="logout">Volver</a></div>
    </header>
    <div id="data--input" class="grupo">
      <h3>Administrador</h3>
	  <h4>Modificar Control Presupuesto</h4>
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
		
		if($reg=mysqli_fetch_array($registrosControl)){
			$id_controlP = $reg['id_controlP'];
			$id = $reg['id'];
			$control_presupuesto = $reg['control_presupuesto'];			
		}
		
		echo "<form method=\"POST\" class=\"add\">";
			echo "<label>Codigo SAP</label>";
			echo "<input type=\"text\" value=\"$id\" name=\"id\" >";
			
			echo "<label>Control Presupuesto</label>";
			echo "<input type=\"text\" value=\"$control_presupuesto\" name=\"control_presupuesto\" >";
			
			echo "<br><br>";
			
			echo "<input type=\"text\" name=\"id_controlP\" value=\"$id_controlP\" hidden=hidden>";
			
			echo "<input type=\"submit\" value=\"Guardar\" formaction=\"actualizar-control.php\" >";			
			echo "<input type=\"submit\" value=\"Cancelar\" formaction=\"modificar-control-principal.php\">";
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