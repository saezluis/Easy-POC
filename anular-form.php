<?php
	
	header('Content-Type: text/html; charset=utf-8');
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$nro_OC_send = $_REQUEST['nro_OC_send'];
	
	
	
	//aqui hago un update del campo anular
	mysqli_query($conexion, "UPDATE ordenes SET anular='si' WHERE
									numero_orden = '$nro_OC_send' ") or	die("Problemas en el select:".mysqli_error($conexion));
									
	//echo "<script type=\"text/javascript\">alert(\"Fotos guardadas\");</script>";  
	
	echo "OC número: ".$nro_OC_send." anulada satisfactoriamente.";
	
	echo "<br>";
	echo "<br>";
	
	echo "<a href=\"perfil-boss.php\"><input type=\"button\" value=\"Volver\"></a>";
	
?>