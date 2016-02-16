<?php

	header('Content-Type: text/html; charset=utf-8');
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$codigo_sap = $_REQUEST['codigo_sap'];
	$descripcion = $_REQUEST['descripcion'];
	$ceco = $_REQUEST['ceco'];
	
	
	mysqli_query($conexion,"INSERT INTO centro_costo(codigo,descripcion,ceco) VALUES 
							('$codigo_sap','$descripcion','$ceco')")or die("Problemas con el insert del ceco");
	
	echo "<h3>Registro ingresado con éxito</h3>";
	echo "<br>";
	echo "<a href=\"gestionar-ceco.php\">Volver</a>";

?>