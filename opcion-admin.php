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
  </head>
  <body>
    <div id="log"><img src="tema/img/login.png" alt="">
      <div id="chooseBoss">
		<h3 style="text-align: center;">Bienvenido al Administrador de Easy POC</h3>
        <p>Seleccione la opción que desea gestionar:</p>
        <div id="seleBoss">
          <ul>
            <li><a href="gestionar-proveedores.php">Proveedores</a></li>
            <li><a href="gestionar-campanas.php">Campañas</a></li>
			<li><a href="gestionar-ceco.php">CECO (Centro de Costo)</a></li>
			<li><a href="gestionar-control.php">Control Presupuesto</a></li>
			<li><a href="gestionar-registro.php">Registro Gasto</a></li>
			<li><a href="gestionar-autorizantes.php">Autorizantes</a></li>
			<li><a href="logout.php">Cerrar Sesión</a></li>
          </ul>
        </div>
      </div>
    </div>
  </body>
</html>