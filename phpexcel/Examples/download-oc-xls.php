<?php


/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Chile/Continental');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Agencia Punto Medio")
							 ->setLastModifiedBy("-")
							 ->setTitle("Office 2007 XLSX Documento con OC generadas por Easy POC")
							 ->setSubject("Office 2007 XLSX - Plataforma Easy POC");

					 

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Fecha de OC')
            ->setCellValue('B1', 'Nº de OC POC')
			->setCellValue('C1', 'Nº presupuesto')
			->setCellValue('D1', 'Nº factura')
			->setCellValue('E1', 'Monto neto')
			->setCellValue('F1', 'Descripción')
			->setCellValue('G1', 'Nº OC SAP')
			->setCellValue('H1', 'Nº OC recepción')
			
            ->setCellValue('I1', 'RUT proveedor')
            ->setCellValue('J1', 'Razón social')			
			->setCellValue('K1', 'Campaña')
			->setCellValue('L1', 'Centro de Costo')
			->setCellValue('M1', 'Control de Presupuesto')
			->setCellValue('N1', 'Registro')			
			->setCellValue('O1', 'Usuario responsable');

			
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(130);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(58);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(33);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(21);

$from = $_REQUEST['from'];
$to = $_REQUEST['to'];

$fecha_format_from = date("Y-m-d",strtotime($from));
$fecha_format_to = date("Y-m-d",strtotime($to));


include "config.php";
		
$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
$acentos = $conexion->query("SET NAMES 'utf8'");

//$sql = "SELECT * FROM ordenes";
//$result = mysqli_query($sql,$conexion);
$result	= mysqli_query($conexion,"SELECT fecha,numero_orden,nro_presupuesto_proveedor,nro_factura_proveedor,monto_neto,descripcion,orden_sap,orden_recepcion FROM ordenes WHERE fecha BETWEEN '$fecha_format_from' AND '$fecha_format_to' ");

$row = 2; // 1-based index
while($row_data = mysqli_fetch_assoc($result)) {
    $col = 0;
    foreach($row_data as $key=>$value) {
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
        $col++;
    }
    $row++;
}

$resultProveedores = mysqli_query($conexion,"SELECT id_proveedor FROM ordenes WHERE fecha BETWEEN '$fecha_format_from' AND '$fecha_format_to'");

$row = 2; // 1-based index
while($row_data = mysqli_fetch_assoc($resultProveedores)) {
    $col = 8;
    foreach($row_data as $key=>$value) {
		
		$Proveedores = mysqli_query($conexion,"SELECT rut FROM proveedor WHERE id_proveedor = '$value' ");
		
		if($reg=mysqli_fetch_array($Proveedores)){
			$rut = $reg['rut'];			
			//$razon_social = $reg['razon_social'];
		}
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $rut);
        $col++;
    }
    $row++;
}

$resultProveedores2 = mysqli_query($conexion,"SELECT id_proveedor FROM ordenes WHERE fecha BETWEEN '$fecha_format_from' AND '$fecha_format_to'");

$row = 2; // 1-based index
while($row_data = mysqli_fetch_assoc($resultProveedores2)) {
    $col = 9;
    foreach($row_data as $key=>$value) {
		
		$Proveedores2 = mysqli_query($conexion,"SELECT razon_social FROM proveedor WHERE id_proveedor = '$value' ");
		
		if($reg=mysqli_fetch_array($Proveedores2)){
			$razon_social = $reg['razon_social'];			
			//$razon_social = $reg['razon_social'];
		}
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $razon_social);
        $col++;
    }
    $row++;
}

$resultCampanas = mysqli_query($conexion,"SELECT campana FROM ordenes WHERE fecha BETWEEN '$fecha_format_from' AND '$fecha_format_to'");

$row = 2; // 1-based index
while($row_data = mysqli_fetch_assoc($resultCampanas)) {
    $col = 10;
    foreach($row_data as $key=>$value) {
		
		$campanas = mysqli_query($conexion,"SELECT nombre_campana FROM campana WHERE id_campana = '$value' ");
		
		if($reg=mysqli_fetch_array($campanas)){
			$nombre_campana = $reg['nombre_campana'];
			//$razon_social = $reg['razon_social'];
		}
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $nombre_campana);
        $col++;
    }
    $row++;
}

$resultCECO = mysqli_query($conexion,"SELECT area_pago FROM ordenes WHERE fecha BETWEEN '$fecha_format_from' AND '$fecha_format_to'");

$row = 2; // 1-based index
while($row_data = mysqli_fetch_assoc($resultCECO)) {
    $col = 11;
    foreach($row_data as $key=>$value) {
		
		$resCECO = mysqli_query($conexion,"SELECT descripcion FROM centro_costo WHERE id_centro_costo = '$value' ");
		
		if($reg=mysqli_fetch_array($resCECO)){
			$descripcion = $reg['descripcion'];
			//$razon_social = $reg['razon_social'];
		}
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $descripcion);
        $col++;
    }
    $row++;
}

$resultadosControlPresupuesto = mysqli_query($conexion,"SELECT control_presupuesto FROM ordenes WHERE fecha BETWEEN '$fecha_format_from' AND '$fecha_format_to'");

$row = 2; // 1-based index
while($row_data = mysqli_fetch_assoc($resultadosControlPresupuesto)) {
    $col = 12;
    foreach($row_data as $key=>$value) {
		
		$resControlP = mysqli_query($conexion,"SELECT control_presupuesto FROM control_presupuesto WHERE id_controlP = '$value' ");
		
		if($reg=mysqli_fetch_array($resControlP)){
			$control_name = $reg['control_presupuesto'];
			//$razon_social = $reg['razon_social'];
		}
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $control_name);
        $col++;
    }
    $row++;
}

$resultadosRegistroGasto = mysqli_query($conexion,"SELECT registro_gasto FROM ordenes WHERE fecha BETWEEN '$fecha_format_from' AND '$fecha_format_to'");

$row = 2; // 1-based index
while($row_data = mysqli_fetch_assoc($resultadosRegistroGasto)) {
    $col = 13;
    foreach($row_data as $key=>$value) {
		
		$resRegistroG = mysqli_query($conexion,"SELECT registro_gasto FROM registro WHERE id_registro = '$value' ");
		
		if($reg=mysqli_fetch_array($resRegistroG)){
			$registro_name = $reg['registro_gasto'];
			//$razon_social = $reg['razon_social'];
		}
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $registro_name);
        $col++;
    }
    $row++;
}

$resultadosUsuarioResponsable = mysqli_query($conexion,"SELECT id_user FROM ordenes WHERE fecha BETWEEN '$fecha_format_from' AND '$fecha_format_to'");

$row = 2; // 1-based index
while($row_data = mysqli_fetch_assoc($resultadosUsuarioResponsable)) {
    $col = 14;
    foreach($row_data as $key=>$value) {
		
		$resUsuariosR = mysqli_query($conexion,"SELECT nombre,apellido FROM members WHERE id = '$value' ");
		
		if($reg=mysqli_fetch_array($resUsuariosR)){
			$nombre_valor = $reg['nombre'];
			$apellido_valor = $reg['apellido'];
			//$razon_social = $reg['razon_social'];
		}
		
		$nombre_final = $nombre_valor." ".$apellido_valor;
		
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $nombre_final);
        $col++;
    }
    $row++;
}

/*
// Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');
*/
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
