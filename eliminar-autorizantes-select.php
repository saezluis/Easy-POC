<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{

}
else
{
	
header('Content-Type: text/html; charset=UTF-8'); 
	
//echo "<br/>" . "Para tener una mejor experiencia de navegación te recomendamos que actualices tu navegador." . "<br/>";

//echo "<br/>" . "Si el error persiste, puede deberse a las siguientes causas:" . "<br/>";

//echo "<br/>" . " <h2> Estás a un click de Subirte, actualiza tu navegador <a href='http://windows.microsoft.com/es-cl/internet-explorer/download-ie'>aquí</a></h2>" . "<br/>";

//echo "<br/>" . " * Estás usando una versión antigua de Internet Explorer, actualízalo." . "<br/>";

//echo "<br/>" . "Entiendo las recomendaciones, volver al <a href='login.php'>Login</a>." . "<br/>";
	
echo "<br/>" . "Esta pagina es solo para usuarios registrados." . "<br/>";

echo "<br/>" . "<a href='login.php'>Hacer Login</a>";

exit;
}
$now = time(); // checking the time now when home page starts

if($now > $_SESSION['expire'])
{
session_destroy();
echo "<br/><br />" . "Su sesion a terminado, <a href='login.php'> Necesita Hacer Login</a>";
exit;
}
?>
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
	/*
	if(isset($_GET['letra'])){
		$letra = $_GET['letra'];
	}else{
		$letra = 'a';
	}*/	
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosAuto=mysqli_query($conexion,"select * from autorizante") or
	die("Problemas en el select:".mysqli_error($conexion));
	
	
	?>
    <header class="grupo">
      <div class="caja base-50 no-padding">
        <h1> <a href="opcion-admin.php" class="logo"> <img src="tema/img/logo.jpg" alt="POC"></a></h1>
      </div>
      <div class="caja base-50 no-padding"><a href="gestionar-autorizantes.php" class="logout">Volver</a></div>
    </header>
    <div id="data--input" class="grupo">
      <h3>Administrador</h3>
	  <h4>Eliminar Autorizante</h4>
	  <h6><a href="gestionar-autorizantes.php">Volver</a></h6>
	  <h6>Seleccione id del Autorizante que desea eliminar.</h6>
    </div>
    <section class="grupo">
      <div class="nav-admin">
        <ul>
			<!--
          <li><a href="administrador.php" class="consultar">Consultar</a></li>
          <li><a href="agregar.php" class="agregar">Agregar</a></li>
		  
          <li><a href="" class="modificar">Modificar</a></li>
          <li><a href="" class="eliminar">Eliminar</a></li>
		  -->
        </ul>
      </div>
    </section>
    
    <section class="grupo">
      <table class="table-sap" style="width: 40% !important;">
        <thead>
          <tr class="cabecc-sap">
            <th>ID</th>
            <th>Nombre Autorizante</th>
          </tr>
        </thead>
        <tbody>
			<?php
				
				while($reg=mysqli_fetch_array($registrosAuto)){
					$id_autorizante = $reg['id_autorizante'];					
					$nombre_autorizante = $reg['nombre_autorizante'];
				
					echo "<tr>";
						echo "<td class=\"area\"><a href=\"eliminar-autorizante.php?id_auto_s=",urlencode($id_autorizante)," \">$id_autorizante</a></td>";
						echo "<td class=\"ceco\">$nombre_autorizante</td>";						
					echo "</tr>";

				}
				
			?>
        </tbody>
      </table>
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