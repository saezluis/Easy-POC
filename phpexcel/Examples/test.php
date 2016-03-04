<?php

include "config.php";
		
$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
$acentos = $conexion->query("SET NAMES 'utf8'");

$resultProveedores = mysqli_query($conexion,"SELECT id_proveedor FROM ordenes");

$row = 2; // 1-based index
while($row_data = mysqli_fetch_assoc($resultProveedores)) {
    $col = 9;
    foreach($row_data as $key=>$value) {
		
		$Proveedores = mysqli_query($conexion,"SELECT rut FROM proveedor WHERE id_proveedor = $value ");
		
		if($reg=mysqli_fetch_array($Proveedores)){
			$rut = $reg['rut'];	
			echo $rut;
			echo "<br>";
			//$razon_social = $reg['razon_social'];
		}
		
        //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rut);
        $col++;
    }
    $row++;
}

?>