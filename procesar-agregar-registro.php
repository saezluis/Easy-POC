<?php

	header('Content-Type: text/html; charset=utf-8');
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$codigo_sap = $_REQUEST['codigo_sap'];
	$registro_gasto = $_REQUEST['registro_gasto'];
	$control_presupuesto = $_REQUEST['control_presupuesto'];
	$articulo_sap = $_REQUEST['articulo_sap'];
	$cuenta_sap = $_REQUEST['cuenta_sap'];	
	
	mysqli_query($conexion,"INSERT INTO registro(id,registro_gasto,control_ppto,articulo_sap,cuenta_sap) VALUES 
							('$codigo_sap',
							'$registro_gasto',
							'$control_presupuesto',
							'$articulo_sap',
							'$cuenta_sap')")or die("Problemas con el insert del proveedor");
	
	echo "<h3>Registro ingresado con éxito</h3>";
	echo "<br>";
	echo "<a href=\"gestionar-registro.php\">Volver</a>";

?>