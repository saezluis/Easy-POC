<?php
	
	//OJO este es el actualizar
	
	header('Content-Type: text/html; charset=utf-8');
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$id_control = $_REQUEST['id_controlP'];
	
	$id = $_REQUEST['id'];
	$control_presupuesto = $_REQUEST['control_presupuesto'];
	
	
	mysqli_query($conexion, "UPDATE control_presupuesto SET id='$id',control_presupuesto='$control_presupuesto'												  
									WHERE id_controlP='$id_control' ") or
									die("Problemas en el select:".mysqli_error($conexion));
	
	echo "<h3>Registro modificado con éxito</h3>";
	echo "<br>";
	echo "<a href=\"gestionar-control.php\">Volver</a>";
	
?>