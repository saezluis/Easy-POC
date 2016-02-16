<?php
	
	//OJO este es el actualizar
	
	header('Content-Type: text/html; charset=utf-8');
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$id_registro = $_REQUEST['id_registro'];
	
	$id = $_REQUEST['id'];
	$registro_gasto = $_REQUEST['registro_gasto'];
	$control_ppto =  $_REQUEST['control_ppto'];
	$articulo_sap = $_REQUEST['articulo_sap'];
	$cuenta_sap = $_REQUEST['cuenta_sap'];
	
	
	mysqli_query($conexion, "UPDATE registro SET 	id = '$id' , 
													registro_gasto = '$registro_gasto' , 
													control_ppto = '$control_ppto',
													articulo_sap = '$articulo_sap',
													cuenta_sap = '$cuenta_sap'
													
									WHERE id_registro='$id_registro' ") or
									die("Problemas en el select:".mysqli_error($conexion));
	
	echo "<h3>Registro modificado con éxito</h3>";
	echo "<br>";
	echo "<a href=\"gestionar-registro.php\">Volver</a>";
	
?>