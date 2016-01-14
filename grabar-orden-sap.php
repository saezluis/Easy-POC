<?php

//nro_orden_send_hidden
//lleva el nro de orden que voy a usar para modificar BD

//nro_orden_send
//lleva el valor de Orden SAP que voy a guardar en BD

	include "config.php";
	
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");

mysqli_query($conexion,"update ordenes set orden_sap='$_REQUEST[nro_orden_send]' where numero_orden='$_REQUEST[nro_orden_send_hidden]'") or
  die("Problemas en el select:".mysqli_error($conexion));

mysqli_close($conexion);
  
header('Location: perfil-sap.php');  
	/*
mysqli_query($conexion,"insert into ordenes(id_proveedor,fecha,visto_bueno,campana,nro_presupuesto_proveedor,nro_factura_proveedor,
jefe_autorizacion,area_pago,descripcion) values ('$_REQUEST[typeahead]',
												'$_REQUEST[fecha_documento]',
												'no',
												'$_REQUEST[campana]',																								 
												'$_REQUEST[nro_presupuesto]',
												'$_REQUEST[nro_factura]',												
												'$_REQUEST[jefe_autorizacion]',
												'$_REQUEST[area_pago]',
												'$descripcionfull')")
  or die("Debe llenar todos los campos");  
	*/

?>