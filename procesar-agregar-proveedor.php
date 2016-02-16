<?php
	header('Content-Type: text/html; charset=utf-8');
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$rut = $_REQUEST['rut'];
	$nombre_fantasia = $_REQUEST['nombre_fantasia'];
	$razon_social = $_REQUEST['razon_social'];
	$giro = $_REQUEST['giro'];
	$direccion = $_REQUEST['direccion'];
	$telefono = $_REQUEST['telefono'];
	$contacto = $_REQUEST['contacto'];
	
	mysqli_query($conexion,"INSERT INTO proveedor(rut,nombre,razon_social,giro,direccion,telefono,contacto) values 
							('$rut',
							'$nombre_fantasia',									
							'$razon_social',
							'$giro',
							'$direccion',
							'$telefono',
							'$contacto'
							)")or die("Problemas con el insert del proveedor");
	
	echo "<h3>Registro ingresado con éxito</h3>";
	echo "<br>";
	echo "<a href=\"gestionar-proveedores.php\">Volver</a>";
?>