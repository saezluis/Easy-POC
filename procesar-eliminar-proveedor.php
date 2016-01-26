<?php

	$rut = $_REQUEST['rut_s'];
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosProveedor=mysqli_query($conexion,"delete from proveedor WHERE rut = '$rut'") or
	die("Problemas en el select:".mysqli_error($conexion));

?>