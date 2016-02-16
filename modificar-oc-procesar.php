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
	
	/*
	echo $nro_oc;
	echo "<br>";
	echo $nro_presupuesto_proveedor;
	echo "<br>";
	echo $nro_factura_proveedor;
	echo "<br>";
	echo $fecha_oc;
	echo "<br><br>";
	*/
	
	$id_proveedor = $_REQUEST['id_proveedor'];
	
	/*
	echo $id_proveedor;
	echo "<br>";
	*/
	
	$campana = $_REQUEST['campana'];
	$autorizante = $_REQUEST['autorizante'];
	$area_pago = $_REQUEST['area_pago'];
	$control_presupuesto = $_REQUEST['control_presupuesto'];
	$registro_gasto = $_REQUEST['registro_gasto']; 
	
	/*
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
	*/
	
	//aqui debo construir el array que recoje los datos
	
	$rows = $_REQUEST['rows_servicio'];
	
	$cantidad = array();
	$monto = array();
	$descripcion = array();
	$nro_servicio = array();
	//echo "Rows de servicio: ".$rows."<br>";
	
	/*
	
	//------------------------------------------ Cantidad
	$cantidad = array();
	
	for ($x = 0; $x <= $rows; $x++) {
		$nc = 'cantidad'.$x;
		$cantidad[] = $_REQUEST[$nc];
	}
	
	for ($x = 0; $x <= $rows; $x++) {
		echo "Cantidad: ".$cantidad[$x]."<br>";
	}
	
	echo "<br>";
	echo "<br>";
	
	//------------------------------------------ Monto
	$monto = array();
	
	for ($x = 0; $x <= $rows; $x++) {
		$nm = 'monto'.$x;
		$monto[] = $_REQUEST[$nm];
	}
	
	for ($x = 0; $x <= $rows; $x++) {
		echo "Monto: ".$monto[$x]."<br>";
	}
	
	echo "<br>";
	echo "<br>";
	
	//------------------------------------------ Descripcion
	$descripcion = array();
	
	for ($x = 0; $x <= $rows; $x++) {
		$nd = 'descripcion'.$x;
		$descripcion[] = $_REQUEST[$nd];
	}
	
	for ($x = 0; $x <= $rows; $x++) {
		echo "Descripcion: ".$descripcion[$x]."<br>";
	}
	
	echo "<br>";
	echo "<br>";
	
	//------------------------------------------ ID Servicio
	$nro_servicio = array();
	
	for ($x = 0; $x <= $rows; $x++) {
		$nns = 'nroServicio'.$x;
		$nro_servicio[] = $_REQUEST[$nns];
	}
	
	for ($x = 0; $x <= $rows; $x++) {
		echo "Nro servicio: ".$nro_servicio[$x]."<br>";
	}	
	
	*/
	
	//$cantidad = $_REQUEST['cantidad'];
	//$monto = $_REQUEST['monto'];
	//$descripcion = $_REQUEST['descripcion'];
	//$nro_servicio = $_REQUEST['nro_servicio'];
	
	/*
	echo $cantidad;
	echo "<br>";
	echo $monto;
	echo "<br>";
	echo $descripcion;
	echo "<br>";
	echo $nro_servicio;
	echo "<br>";
	*/
	
	//$monto_neto = $cantidad * $monto;
	//echo "Monto neto: ".$monto_neto;
	
	$valor_t_neto = $_REQUEST['valor_t_neto'];
	$tipoImpuesto = $_REQUEST['tipoImpuesto'];
	$subTotal = $_REQUEST['subTotal'];
	$totalFinal = $_REQUEST['totalFinal'];
	
	/*
	echo "valor_t_neto: ".$valor_t_neto;
	echo "<br>";
	echo "tipoImpuesto: ".$tipoImpuesto;
	echo "<br>";
	echo "subTotal: ".$subTotal;
	echo "<br>";
	echo "totalFinal: ".$totalFinal;
	echo "<br>";
	*/
	
	//------------------------------------------ Descripcion
	$descripcion = array();
	$descripcion_final = '';
	
	for ($x = 0; $x <= $rows; $x++) {
		$nd = 'descripcion'.$x;
		$descripcion[] = $_REQUEST[$nd];
	}
	
	for ($x = 0; $x <= $rows; $x++) {
		if($x!=0){
		//echo "Descripcion: ".$descripcion[$x]."<br>";
		$descripcion_final = $descripcion_final.$descripcion[$x]." ";
		}
	}
	
	//echo "Descripcion final: ".$descripcion_final;
	
	mysqli_query($conexion, "UPDATE ordenes SET fecha='$fecha_oc',
												  campana='$campana',
												  nro_presupuesto_proveedor='$nro_presupuesto_proveedor',
												  nro_factura_proveedor='$nro_factura_proveedor',
												  monto_neto='$valor_t_neto',
												  jefe_autorizacion='$autorizante',
												  area_pago='$area_pago',
												  id_proveedor='$id_proveedor',
												  descripcion='$descripcion_final',
												  registro_gasto='$registro_gasto',
												  control_presupuesto='$control_presupuesto',												  
												  tipo_impuesto='$tipoImpuesto',
												  sub_total='$subTotal',
												  total_final='$totalFinal'
												  
									WHERE numero_orden='$nro_oc' ") or
									die("Problemas en el select:".mysqli_error($conexion));
	
	
	for ($x = 0; $x <= $rows; $x++) {
		
			$nc = 'cantidad'.$x;
			$cantidad[] = $_REQUEST[$nc];
			
			$nm = 'monto'.$x;
			$monto[] = $_REQUEST[$nm];
			
			$nd = 'descripcion'.$x;
			$descripcion[] = $_REQUEST[$nd];
			
			$nns = 'nroServicio'.$x;
			$nro_servicio[] = $_REQUEST[$nns];
			
			if($nro_servicio[$x]!='Rey'){
				mysqli_query($conexion, "UPDATE servicios SET descripcion='$descripcion[$x]',
														  cantidad='$cantidad[$x]',
														  monto='$monto[$x]'												  
											WHERE nro_servicio='$nro_servicio[$x]' ") or die("Problemas en el select:".mysqli_error($conexion));
			}
	}
	
	echo "<h4>Orden modificada con éxito</h4>";
	
	echo "<a href=\"historial-ordenes.php\">Volver</a>";
	//header('Location: historial-ordenes.php');
	
?>