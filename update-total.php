<?php
	
	session_start();
	
	//$conexion=mysqli_connect("localhost","pmdigita_admin","Prodigy12","pmdigita_test") or die("Problemas con la conexión");
	$conexion=mysqli_connect("localhost","root","123","test") or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$username = $_SESSION['username'];
		
	$registrosUsuario = mysqli_query($conexion,"select * from members WHERE username = '$username'") or die("Problemas en el select:".mysqli_error($conexion));
	
	if($reg=mysqli_fetch_array($registrosUsuario)){
		$id_member = $reg['id'];
	}
	
	$total_final = $_REQUEST['total_final'];
	$last_id = $_REQUEST['last_id_send'];
	
	$tipo_impuesto_send = $_REQUEST['tipo_impuesto_send'];
	
	$subtotal_send	= $_REQUEST['subtotal_send'];
	
	mysqli_query($conexion, "UPDATE ordenes SET total_final='$total_final',
												id_user='$id_member',
												sub_total='$subtotal_send',
												tipo_impuesto = '$tipo_impuesto_send'
												WHERE numero_orden='$last_id'") or
									die("Problemas en el select:".mysqli_error($conexion));

	
	header('Location: emision.php');
	
?>