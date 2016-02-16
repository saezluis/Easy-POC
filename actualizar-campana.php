<?php
	
	//OJO este es el actualizar
	
	header('Content-Type: text/html; charset=utf-8');
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$id_campana = $_REQUEST['id_campana'];
	
	$id = $_REQUEST['id'];
	$nombre_campana = $_REQUEST['nombre_campana'];
	
	
	mysqli_query($conexion, "UPDATE campana SET id='$id',nombre_campana='$nombre_campana'												  
									WHERE id_campana='$id_campana' ") or
									die("Problemas en el select:".mysqli_error($conexion));
	
	echo "<h3>Registro modificado con éxito</h3>";
	echo "<br>";
	echo "<a href=\"gestionar-campanas.php\">Volver</a>";
	
?>