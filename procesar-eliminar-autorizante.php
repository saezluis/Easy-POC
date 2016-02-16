<?php

header('Content-Type: text/html; charset=utf-8');
	
	$id_auto = $_REQUEST['id_autorizante'];
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	mysqli_query($conexion,"DELETE FROM autorizante WHERE id_autorizante = '$id_auto'") or
	die("Problemas en el select:".mysqli_error($conexion));
	
	echo "<h3>Registro eliminado con éxito</h3>";
	echo "<br>";
	echo "<a href=\"gestionar-autorizantes.php\">Volver</a>";

?>