<?php

	header('Content-Type: text/html; charset=utf-8');
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$codigo_sap = $_REQUEST['codigo_sap'];
	$control_presupuesto = $_REQUEST['control_presupuesto'];	
	
	mysqli_query($conexion,"INSERT INTO control_presupuesto(id,control_presupuesto) VALUES 
							('$codigo_sap','$control_presupuesto')")or die("Problemas con el insert del proveedor");
	
	echo "<h3>Registro ingresado con éxito</h3>";
	echo "<br>";
	echo "<a href=\"gestionar-control.php\">Volver</a>";

?>