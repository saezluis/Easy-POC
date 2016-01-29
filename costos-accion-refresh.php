<html>
<head>
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>	
	
	<script type="text/javascript">
		$(document).ready(function(){
			document.getElementById('dynLink').click();			
		});
	</script>

</head>
<body>
<?php
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$rows = $_REQUEST['rows'];	
	$nro_solicitud_send = $_REQUEST['nro_solicitud_send'];
	
	
	$vistos_buenos = array();	
	$nro_VB = array();
	
	for ($x = 0; $x <= $rows; $x++) {
		$xy = "vb".$x;
		$vistos_buenos[] = $_REQUEST[$xy];
	}
	
	for ($x = 0; $x <= $rows; $x++) {				
		if($x!=0 && $vistos_buenos[$x]!=''){			
			$VB_explode = $vistos_buenos[$x];			
			$pieces = explode("-", $VB_explode);
			$nroOC_to_VB = $pieces[0];
			$option_to_VB = $pieces[1];
			buscarOCparaVB($nroOC_to_VB,$option_to_VB);
		}
		
	}
	
	function buscarOCparaVB($nro_oc_buscar,$option_VB){
		include "config.php";
		global $conexion;
		global $acentos;
		
		$registroOrdenes=mysqli_query($conexion,"select * from ordenes")or die("Problemas en el select:".mysqli_error($conexion));
		
		while($reg=mysqli_fetch_array($registroOrdenes)){
			$numero_orden = $reg['numero_orden'];
		
			if($numero_orden==$nro_oc_buscar){
				echo "la OC nro: ".$numero_orden." se va cambiar de VB";
				mysqli_query($conexion, "update ordenes set visto_bueno='$option_VB' WHERE numero_orden=$numero_orden") or	die("Problemas en el select:".mysqli_error($conexion));
			}
		}
	}
	
	
	//-------- Presupuesto Proyectado
	$ppto_real_name_final = array();	
	$ppt = array();
	
	$nro_oc_name_final = array();
	$nroOC = array();
	
	for ($x = 0; $x <= $rows; $x++) {
		$ppto_real_name = 'ppto';
		$ppto_real_name_final[] = $ppto_real_name.$x;
		
		$nro_oc_real_name = 'nroOC';
		$nro_oc_name_final[] = $nro_oc_real_name.$x;
	}
	
	
	for ($x = 0; $x <= $rows; $x++) {
		$ppt[] = str_replace(".","",$_REQUEST[$ppto_real_name_final[$x]]);
		
		$nroOC[] = $_REQUEST[$nro_oc_name_final[$x]];
		
		if($x!=0){
			buscarOC($nroOC[$x],$ppt[$x]);			
			$estatus_OC = descartarOC($nroOC[$x]);
			if($estatus_OC!='T'){				
				insertPptoReal($ppt[$x],$nroOC[$x],$nro_solicitud_send);
			}
		}
		
	}	
	
	
	
	
	function descartarOC($nro_oc_buscar){
		$v="";
		include "config.php";
		global $conexion;
		global $acentos;
	
		$registrosCAC=mysqli_query($conexion,"select * from cac")or die("Problemas en el select:".mysqli_error($conexion));
		
		while($reg=mysqli_fetch_array($registrosCAC)){
			$nro_oc_registro = $reg['nro_oc'];
			if($nro_oc_registro==$nro_oc_buscar){
				$v='T';
			}
		}
		return $v;
	}	
	
	function buscarOC($nro_oc_buscar,$ppto_real_snapshot){
		$variable_binaria = "";	
		include "config.php";
		global $conexion;
		global $acentos;
		
		$registrosCAC=mysqli_query($conexion,"select * from cac")or die("Problemas en el select:".mysqli_error($conexion));
		
		while($reg=mysqli_fetch_array($registrosCAC)){
			
			$nro_oc_registro = $reg['nro_oc'];
			
			if($nro_oc_registro==$nro_oc_buscar){				
				actualizarCAC($nro_oc_registro,$ppto_real_snapshot);				
			}
		}		
	}
	
	function actualizarCAC($nro_oc_buscar,$ppto_real_get){
	
		include "config.php";
		global $conexion;
		global $acentos;
		
		mysqli_query($conexion, "update cac set ppto_real='$ppto_real_get' WHERE nro_oc='$nro_oc_buscar'") or	die("Problemas en el select:".mysqli_error($conexion));
		
	}
	
	function insertPptoReal($ppto_real,$nro_oc,$nro_solicitud){
		
		include "config.php";
		global $conexion;
		global $acentos;
		
		mysqli_query($conexion,"INSERT INTO cac(ppto_real,nro_oc,nro_solicitud) values ('$ppto_real','$nro_oc','$nro_solicitud')") or die("Problemas con el insert de los servicios");
		
	}
	
	
	$campana_get = $_REQUEST['campana_send'];
	
	echo "<form method=\"post\" action=\"costos-accion.php\">";	
		echo "<a id=\"dynLink\" href=\"#\" onclick=\"$(this).closest('form').submit()\"></a>";	
		echo "<input type=\"text\" value=\"$campana_get\" name=\"campana\" hidden=hidden>";	
	echo "</form>";
	
	
?>



</body>
</html>