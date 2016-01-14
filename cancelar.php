<html>
  <head>
	<meta http-equiv="refresh" content="0;emision.php">
  </head>
<?php
	
	include "config.php";
	
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	
	mysqli_query($conexion,"delete from ordenes where numero_orden='$_REQUEST[ultimoid]'") or
    die("Problemas en el select:".mysqli_error($conexion));  
	
	mysqli_query($conexion,"delete from servicios where id_orden='$_REQUEST[ultimoid]'") or
    die("Problemas en el select:".mysqli_error($conexion));
	
	mysqli_close($conexion);

?>
</html>