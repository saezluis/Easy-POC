<?php
	header('Content-Type: text/html; charset=utf-8');

	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$nro_oc = $_REQUEST['nro_oc'];
	$nro_presupuesto_proveedor = $_REQUEST['nro_presupuesto_proveedor'];
	$nro_factura_proveedor = $_REQUEST['nro_factura_proveedor'];
	$newDate_oc = $_REQUEST['newDate_oc'];	
	
	$fecha_oc = date("Y-m-d", strtotime($newDate_oc));	
	
	echo $nro_oc;
	echo "<br>";
	echo $nro_presupuesto_proveedor;
	echo "<br>";
	echo $nro_factura_proveedor;
	echo "<br>";
	echo $fecha_oc;
	echo "<br><br>";
	
	$id_proveedor = $_REQUEST['id_proveedor'];
	
	echo $id_proveedor;
	echo "<br>";
	
	$campana = $_REQUEST['campana'];
	$autorizante = $_REQUEST['autorizante'];
	$area_pago = $_REQUEST['area_pago'];
	$control_presupuesto = $_REQUEST['control_presupuesto'];
	$registro_gasto = $_REQUEST['registro_gasto']; 
	
	echo "<br><br>";
	
	echo $campana;
	echo "<br>";
	echo $autorizante;
	echo "<br>";
	echo $area_pago;
	echo "<br>";
	echo $control_presupuesto;
	echo "<br>";
	echo $registro_gasto;
	echo "<br>";
	
	echo "<br><br>";
	
	$cantidad = $_REQUEST['cantidad'];
	$monto = $_REQUEST['monto'];
	$descripcion = $_REQUEST['descripcion'];
	$nro_servicio = $_REQUEST['nro_servicio'];
	
	echo $cantidad;
	echo "<br>";
	echo $monto;
	echo "<br>";
	echo $descripcion;
	echo "<br>";
	echo $nro_servicio;
	echo "<br>";
	
	$monto_neto = $cantidad * $monto;
	echo "Monto neto: ".$monto_neto;
	
	
	mysqli_query($conexion, "UPDATE ordenes SET fecha='$fecha_oc',
												  campana='$campana',
												  nro_presupuesto_proveedor='$nro_presupuesto_proveedor',
												  nro_factura_proveedor='$nro_factura_proveedor',
												  monto_neto='$monto_neto',
												  jefe_autorizacion='$autorizante',
												  area_pago='$area_pago',
												  id_proveedor='$id_proveedor',
												  descripcion='$descripcion',
												  registro_gasto='$registro_gasto',
												  control_presupuesto='$control_presupuesto'
												  
									WHERE numero_orden='$nro_oc' ") or
									die("Problemas en el select:".mysqli_error($conexion));
									
	mysqli_query($conexion, "UPDATE servicios SET descripcion='$descripcion',
												  cantidad='$cantidad',
												  monto='$monto'
												  
									WHERE nro_servicio='$nro_servicio' ") or
									die("Problemas en el select:".mysqli_error($conexion));	
	
	//echo "<h4>Orden modificada con éxito</h4>";
	
	header('Location: historial-ordenes.php');
	
?>