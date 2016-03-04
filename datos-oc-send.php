<?php

$from = $_REQUEST['from'];
$to = $_REQUEST['to'];

$fecha_format_from = date("Y-m-d",strtotime($from));
$fecha_format_to = date("Y-m-d",strtotime($to));

echo "Fecha desde: ".$fecha_format1;
echo "<br>";
echo "Fecha hasta: ".$fecha_format2;
echo "<br>";
echo "<br>";

	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosOrdenes = mysqli_query($conexion,"SELECT * FROM ordenes WHERE fecha BETWEEN '$fecha_format1' AND '$fecha_format2' ORDER BY fecha ASC") 
	or die("Problemas en el select de ordenes".mysqli_error($conexion));

	$num_rows = mysqli_num_rows($registrosOrdenes);
	
	echo "Nro de registros que devuelve la consulta: ".$num_rows;
	
	
	
	Fecha de OC
	Nº de OC POC
		RUT proveedor
		Razon social
		
	Nº presupuesto
	Nº factura
	
		Campaña
	
		Centro de Costo
	
		Control de Presupuesto
		
		Registro
		
	Monto neto
	Descripción
	
		Usuario responsable
		
	Nº OC SAP
	Nº OC recepción
	
	//arranco del nro dos porque ya el primer registro esta ocupado por la cabecera
	
	while($reg=mysqli_fetch_array($registrosOrdenes)){
		$fecha = $reg['fecha'];
		$numero_orden = $reg['numero_orden'];
		
		$nro_presupuesto_proveedor = $reg['nro_presupuesto_proveedor'];
		$nro_factura_proveedor = $reg['nro_factura_proveedor'];
		
		$monto_neto = $reg['monto_neto'];
		$descripcion = $reg['descripcion'];
		
		$orden_sap = $reg['orden_sap'];
		$orden_recepcion = $reg['orden_recepcion'];
		
	}
	
	for ($x = 2; $x <= $num_rows; $x++) {
		echo "The number is: $x <br>";
	}
	
?>