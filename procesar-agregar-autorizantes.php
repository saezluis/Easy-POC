<?php

	header('Content-Type: text/html; charset=utf-8');
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
		
	$nombre_autorizante = $_REQUEST['nombre_autorizante'];	
	
	mysqli_query($conexion,"INSERT INTO autorizante(nombre_autorizante) VALUES 
							('$nombre_autorizante')")or die("Problemas con el insert del proveedor");
	
	echo "<h3>Registro ingresado con éxito</h3>";
	echo "<br>";
	echo "<a href=\"gestionar-autorizantes.php\">Volver</a>";

?>