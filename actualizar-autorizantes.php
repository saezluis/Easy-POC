<?php
	
	//OJO este es el actualizar
	
	header('Content-Type: text/html; charset=utf-8');
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$id_autorizante = $_REQUEST['id_autorizante'];
		
	$nombre_autorizante = $_REQUEST['nombre_autorizante'];
	
	
	mysqli_query($conexion, "UPDATE autorizante SET nombre_autorizante='$nombre_autorizante'												  
									WHERE id_autorizante='$id_autorizante' ") or
									die("Problemas en el select:".mysqli_error($conexion));
	
	echo "<h3>Registro modificado con éxito</h3>";
	echo "<br>";
	echo "<a href=\"gestionar-autorizantes.php\">Volver</a>";
	
?>