<?php
	header('Content-Type: text/html; charset=utf-8');
	
	$id_user = $_REQUEST['id_user_send'];	
	$razon_send = $_REQUEST['razon_send'];
	$nro_or = $_REQUEST['nro_or_send'];
	
	include "config.php";

	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosUsuario=mysqli_query($conexion,"select * from members where id = $id_user ") or die("Problemas en el select:".mysqli_error($conexion));
	
	if($reg=mysqli_fetch_array($registrosUsuario)){
		$email_user = $reg['username'];
		$nombre = $reg['nombre'];
		$apellido = $reg['apellido'];
	}
	
	$nombre_final = $nombre." ".$apellido;
	
	$to = $email_user;
	$subject = "OC SAP no fue aprobada";		
	$message = "Su orden SAP nro:$nro_or no ha sido aprobada por el siguiente motivo: $razon_send";
	$headers = "Sistema Easy POC";
	
	mail($to,$subject,$message,$headers);

	//header("location:perfil-boss.php");
	echo "<script>
		
		alert('El usuario $nombre_final fue notificado via email de la negación de la OC SAP');
		
		window.location.href='perfil-boss.php';
		
		</script>
	
	";
	
	date_default_timezone_set("America/Santiago");
	$date =  date("Y-m-d h:i:sa");
	$timestamp = date('Y-m-d H:i:s', strtotime($date));
	
	mysqli_query($conexion,"INSERT INTO ordenes_negadas(id_orden,motivo,fecha) values 
							('$nro_or',
							'$razon_send',									
							'$timestamp'
							)")or die("Problemas con el insert del proveedor");
	
?>