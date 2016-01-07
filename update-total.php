<?php
	
	session_start();
	
	//$conexion=mysqli_connect("localhost","pmdigita_admin","Prodigy12","pmdigita_test") or die("Problemas con la conexión");
	$conexion=mysqli_connect("localhost","root","123","test") or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$username = $_SESSION['username'];
	
	$total_final = $_REQUEST['total_final'];
	$last_id = $_REQUEST['last_id_send'];
	
	mysqli_query($conexion, "update ordenes set total_final='$total_final', id_user='$username' WHERE numero_orden='$last_id'") or
									die("Problemas en el select:".mysqli_error($conexion));

	
	header('Location: emision.php');
	
?>