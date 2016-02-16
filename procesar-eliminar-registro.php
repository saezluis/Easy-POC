<?php

header('Content-Type: text/html; charset=utf-8');
	
	$id_registro = $_REQUEST['id_registro'];
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosGasto=mysqli_query($conexion,"DELETE FROM registro WHERE id_registro = '$id_registro'") or
	die("Problemas en el select:".mysqli_error($conexion));
	
	echo "<h3>Registro eliminado con éxito</h3>";
	echo "<br>";
	echo "<a href=\"gestionar-registro.php\">Volver</a>";

?>