<?php

	header('Content-Type: text/html; charset=utf-8');
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$codigo_sap = $_REQUEST['codigo_sap'];
	$nombre_campana = $_REQUEST['nombre_campana'];	
	
	mysqli_query($conexion,"INSERT INTO campana(id,nombre_campana) VALUES 
							('$codigo_sap','$nombre_campana')")or die("Problemas con el insert del proveedor");
	
	echo "<h3>Registro ingresado con éxito</h3>";
	echo "<br>";
	echo "<a href=\"gestionar-campanas.php\">Volver</a>";

?>