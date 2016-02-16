<?php
	
	//OJO este es el actualizar
	
	header('Content-Type: text/html; charset=utf-8');
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$id_ceco = $_REQUEST['id_ceco'];
	
	$codigo_sap = $_REQUEST['codigo_sap'];
	$descripcion = $_REQUEST['descripcion'];
	$ceco = $_REQUEST['ceco'];
	
	
	mysqli_query($conexion, "UPDATE centro_costo SET codigo='$codigo_sap',descripcion='$descripcion',ceco='$ceco'
									WHERE id_centro_costo='$id_ceco' ") or
									die("Problemas en el select:".mysqli_error($conexion));
	
	echo "<h3>Registro modificado con éxito</h3>";
	echo "<br>";
	echo "<a href=\"gestionar-ceco.php\">Volver</a>";
	
?>