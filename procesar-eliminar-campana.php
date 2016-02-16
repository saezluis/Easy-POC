<?php

header('Content-Type: text/html; charset=utf-8');
	
	$id_campana = $_REQUEST['id_campana'];
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosCampana=mysqli_query($conexion,"DELETE FROM campana WHERE id_campana = '$id_campana'") or
	die("Problemas en el select:".mysqli_error($conexion));
	
	echo "<h3>Registro eliminado con éxito</h3>";
	echo "<br>";
	echo "<a href=\"gestionar-campanas.php\">Volver</a>";

?>