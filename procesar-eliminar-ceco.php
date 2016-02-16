<?php

header('Content-Type: text/html; charset=utf-8');
	
	$id_ceco = $_REQUEST['id_ceco'];
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosCeco=mysqli_query($conexion,"DELETE FROM centro_costo WHERE id_centro_costo = '$id_ceco'") or
	die("Problemas en el select:".mysqli_error($conexion));
	
	echo "<h3>Registro eliminado con éxito</h3>";
	echo "<br>";
	echo "<a href=\"gestionar-ceco.php\">Volver</a>";

?>