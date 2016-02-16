<?php
	
	//OJO este es el actualizar
	
	header('Content-Type: text/html; charset=utf-8');
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$id_proveedor = $_REQUEST['id_proveedor'];
	
	$rut = $_REQUEST['rut'];
	$nombre_fantasia = $_REQUEST['nombre_fantasia'];
	$razon_social = $_REQUEST['razon_social'];
	$giro = $_REQUEST['giro'];
	$direccion = $_REQUEST['direccion'];
	$telefono = $_REQUEST['telefono'];
	$contacto = $_REQUEST['contacto'];
	
	mysqli_query($conexion, "UPDATE proveedor SET rut='$rut',
												  nombre='$nombre_fantasia',
												  razon_social='$razon_social',
												  giro='$giro',
												  direccion='$direccion',
												  telefono='$telefono',
												  contacto='$contacto'
									WHERE id_proveedor='$id_proveedor' ") or
									die("Problemas en el select:".mysqli_error($conexion));
	
	echo "<h3>Registro modificado con éxito</h3>";
	echo "<br>";
	echo "<a href=\"gestionar-proveedores.php\">Volver</a>";
?>