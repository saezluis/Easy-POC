<?php
  session_start();

  if(!isset($_SESSION['username'])){
    header("location:login.php");
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title> </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="tema/css/estilos.css">
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="tema/js/scripts.js"></script>
    <link rel="stylesheet" href="tema/js/source/jquery.fancybox.css?v=2.1.5">
    <script src="tema/js/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="js/typeahead.min.js"></script>
	<script src="js/tipeo.js"></script>  
	
	<style type="text/css">
	.bs-example{
		font-family: sans-serif;
		position: relative;
		margin: 50px;
	}
	.typeahead, .tt-query, .tt-hint {
		border: 2px solid #CCCCCC;
		border-radius: 0px;
		font-size: 24px;
		height: 32px;
		line-height: 30px;
		outline: medium none;
		padding: 8px 12px;
		width: 296px;
	}
	.typeahead {
		background-color: #FFFFFF;
	}
	.typeahead:focus {
		border: 2px solid #0097CF;
	}
	.tt-query {
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
	}
	.tt-hint {
		color: #999999;
	}
	.tt-dropdown-menu {
		background-color: #FFFFFF;
		border: 1px solid rgba(0, 0, 0, 0.2);
		border-radius: 8px;
		box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
		margin-top: 12px;
		padding: 8px 0;
		width: 370px;
		/*width: 222px;*/
	}
	.tt-suggestion {
		font-size: 12px;
		line-height: 16px;
		padding: 3px 20px;
	}
	.tt-suggestion.tt-is-under-cursor {
		background-color: #ED1B24;
		color: #FFFFFF;
	}
	.tt-suggestion p {
		margin: 0;
		text-align: left !important;
	}
	
	.cajitaTexto {
		width: 200px !important;
	}
	</style>
	
	<script>
		
		Number.prototype.formatMoney = function(places, symbol, thousand, decimal) {
		places = !isNaN(places = Math.abs(places)) ? places : 2;
		symbol = symbol !== undefined ? symbol : "$";
		thousand = thousand || ",";
		decimal = decimal || ".";
		var number = this, 
	    negative = number < 0 ? "-" : "",
	    i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
	    j = (j = i.length) > 3 ? j % 3 : 0;
		return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
		};
		
		function calcular(select) {
		
			var totalget = document.getElementById("valorTotalNeto").value;
			
			if(select.options[select.selectedIndex].id == "elija"){
				document.getElementById("totalfinalcampo").value = '';
			}
			
			if(select.options[select.selectedIndex].id == "iva"){
			
				var calculariva = (parseFloat(totalget) * 19) / 100;
				//var calculariva = (totalget * 19) / 100;
				var totalfinal = parseFloat(totalget) + calculariva;
				
				var calcularivaFormat = parseFloat(calculariva).formatMoney(0,"",".",".");
				var totalfinalFormat = parseFloat(totalfinal).formatMoney(0,"",".",".");
				
				document.getElementById("totalfinalcampo").value = totalfinalFormat;
				document.getElementById("campo_subtotal").value = calcularivaFormat;
				//document.getElementById("campo_subtotal_copy").value = calcularivaFormat;
				//alert('click en iva');
				//
				//alert(totalget);
				//var nameValue = document.getElementById("uniqueID").value;
				//Me interesa establecer el valor del campo luego del calculo del IVA
				//document.getElementById("campo2-c").value = '';
				//document.getElementById("tipo_impuesto").value = document.getElementById("iva").value;
				
			} 
			
			if(select.options[select.selectedIndex].id == "boleta"){
				//alert('click en boleta');
				var calcularboleta = (parseFloat(totalget) * 10) / 100;
				var totalfinal = parseFloat(totalget) - calcularboleta;
				
				var calcularboletaFormat = parseFloat(calcularboleta).formatMoney(0,"",".",".");
				var totalfinalFormat = parseFloat(totalfinal).formatMoney(0,"",".",".");
				
				document.getElementById("totalfinalcampo").value = (totalfinalFormat);
				document.getElementById("campo_subtotal").value = (calcularboletaFormat);
				//document.getElementById("campo_subtotal_copy").value = (calcularboletaFormat);
				//var nameValue = document.getElementById("uniqueID").value;
				//document.getElementById("tipo_impuesto").value = document.getElementById("boleta").value;
			} 
			
			if(select.options[select.selectedIndex].id == "exento"){
				//alert('click en exento');
				
				var totalgetFormat = parseFloat(totalget).formatMoney(0,"",".",".");
				
				document.getElementById("totalfinalcampo").value = totalgetFormat;
				document.getElementById("campo_subtotal").value = "0";
				//document.getElementById("campo_subtotal_copy").value = "0";
				//var nameValue = document.getElementById("uniqueID").value;
				//document.getElementById("tipo_impuesto").value = document.getElementById("exento").value;
			} 
			//alert(select.options[select.selectedIndex].getAttribute("iva"));
			//obtener valores del formulario
			//var nameValue = document.getElementById("uniqueID").value;
			
		}
		
		function recalcularIVA() {
			
			var totalget = document.getElementById("valorTotalNeto").value;
			
			var calculariva = (parseFloat(totalget) * 19) / 100;
				//var calculariva = (totalget * 19) / 100;
			var totalfinal = parseFloat(totalget) + calculariva;
				
			var calcularivaFormat = parseFloat(calculariva).formatMoney(0,"",".",".");
			var totalfinalFormat = parseFloat(totalfinal).formatMoney(0,"",".",".");
				
			document.getElementById("totalfinalcampo").value = totalfinalFormat;
			document.getElementById("campo_subtotal").value = calcularivaFormat;
		
		}
		
		function recalcularBoleta() {
			
			var totalget = document.getElementById("valorTotalNeto").value;
			
			var calcularBoleta = (parseFloat(totalget) * 10) / 100;
				//var calculariva = (totalget * 19) / 100;
			var totalfinal = parseFloat(totalget) - calcularBoleta;
				
			var calcularBoletaFormat = parseFloat(calculariva).formatMoney(0,"",".",".");
			var totalfinalFormat = parseFloat(totalfinal).formatMoney(0,"",".",".");
				
			document.getElementById("totalfinalcampo").value = totalfinalFormat;
			document.getElementById("campo_subtotal").value = calcularBoletaFormat;
		
		}
		
		function exentoIVA() {
			
			var totalget = document.getElementById("valorTotalNeto").value;
			
			var totalgetFormat = parseFloat(totalget).formatMoney(0,"",".",".");
				
			document.getElementById("totalfinalcampo").value = totalgetFormat;
			document.getElementById("campo_subtotal").value = "0";
		}
		
	
	</script>
	
	
	
	<script>
		
		$( document ).ready(function() {
			//function calcularValorNeto() {
			
				var cantidadCampo1 = document.getElementById("cantidadCampo1").value;
				var montoNeto1 = document.getElementById("montoNeto1").value;
				
				//----------------------------------------------------------------------- Campo 2
				if (document.getElementById('cantidadCampo2') != null) {
					var cantidadCampo2 = document.getElementById("cantidadCampo2").value;
				}
				else {
					var cantidadCampo2 = null;
				}
				
				if (document.getElementById('montoNeto2') != null) {
					var montoNeto2 = document.getElementById("montoNeto2").value;
				}
				else {
					var montoNeto2 = null;
				}
				
				//----------------------------------------------------------------------- Campo 3
				if (document.getElementById('cantidadCampo3') != null) {
					var cantidadCampo3 = document.getElementById("cantidadCampo3").value;
				}
				else {
					var cantidadCampo3 = null;
				}
				
				if (document.getElementById('montoNeto3') != null) {
					var montoNeto3 = document.getElementById("montoNeto3").value;
				}
				else {
					var montoNeto3 = null;
				}
				
				//----------------------------------------------------------------------- Campo 4
				if (document.getElementById('cantidadCampo4') != null) {
					var cantidadCampo4 = document.getElementById("cantidadCampo4").value;
				}
				else {
					var cantidadCampo4 = null;
				}
				
				if (document.getElementById('montoNeto4') != null) {
					var montoNeto4 = document.getElementById("montoNeto4").value;
				}
				else {
					var montoNeto4 = null;
				}
				
				//----------------------------------------------------------------------- Campo 5
				if (document.getElementById('cantidadCampo5') != null) {
					var cantidadCampo5 = document.getElementById("cantidadCampo5").value;
				}
				else {
					var cantidadCampo5 = null;
				}
				
				if (document.getElementById('montoNeto5') != null) {
					var montoNeto5 = document.getElementById("montoNeto5").value;
				}
				else {
					var montoNeto5 = null;
				}
				
				//----------------------------------------------------------------------- Campo 6
				if (document.getElementById('cantidadCampo6') != null) {
					var cantidadCampo6 = document.getElementById("cantidadCampo6").value;
				}
				else {
					var cantidadCampo6 = null;
				}
				
				if (document.getElementById('montoNeto6') != null) {
					var montoNeto6 = document.getElementById("montoNeto6").value;
				}
				else {
					var montoNeto6 = null;
				}
				
				//----------------------------------------------------------------------- Campo 7
				if (document.getElementById('cantidadCampo7') != null) {
					var cantidadCampo7 = document.getElementById("cantidadCampo7").value;
				}
				else {
					var cantidadCampo7 = null;
				}
				
				if (document.getElementById('montoNeto7') != null) {
					var montoNeto7 = document.getElementById("montoNeto7").value;
				}
				else {
					var montoNeto7 = null;
				}
				
	            //------------------------------------------------------------------------ Verificaciones
				if(cantidadCampo1!=''){
					var subTotal = cantidadCampo1 * montoNeto1;
				}
				
				if(cantidadCampo2 != null){
					var subTotal = (cantidadCampo1 * montoNeto1) + (cantidadCampo2 * montoNeto2);
				}
				
				if(cantidadCampo3 != null){
					var subTotal = (cantidadCampo1 * montoNeto1) + (cantidadCampo2 * montoNeto2) + (cantidadCampo3 * montoNeto3);
				}
				
				if(cantidadCampo4 != null){
					var subTotal = (cantidadCampo1 * montoNeto1) + (cantidadCampo2 * montoNeto2) + (cantidadCampo3 * montoNeto3) + (cantidadCampo4 * montoNeto4);
				}
				
				if(cantidadCampo5 != null){
					var subTotal = (cantidadCampo1 * montoNeto1) + (cantidadCampo2 * montoNeto2) + (cantidadCampo3 * montoNeto3) + (cantidadCampo4 * montoNeto4) + (cantidadCampo5 * montoNeto5);
				}
				
				if(cantidadCampo6 != null){
					var subTotal = (cantidadCampo1 * montoNeto1) + (cantidadCampo2 * montoNeto2) + (cantidadCampo3 * montoNeto3) + (cantidadCampo4 * montoNeto4) + (cantidadCampo5 * montoNeto5) + (cantidadCampo6 * montoNeto6);
				}
				
				if(cantidadCampo7 != null){
					var subTotal = (cantidadCampo1 * montoNeto1) + (cantidadCampo2 * montoNeto2) + (cantidadCampo3 * montoNeto3) + (cantidadCampo4 * montoNeto4) + (cantidadCampo5 * montoNeto5) + (cantidadCampo6 * montoNeto6) + (cantidadCampo7 * montoNeto7);
				}
				
				document.getElementById("valorTotalNeto").value = subTotal;
				
			//}
		});
		
	</script>
	
	<script>
	
		function recalcular(){
		
				var cantidadCampo1 = document.getElementById("cantidadCampo1").value;
				var montoNeto1 = document.getElementById("montoNeto1").value;
				
				//----------------------------------------------------------------------- Campo 2
				if (document.getElementById('cantidadCampo2') != null) {
					var cantidadCampo2 = document.getElementById("cantidadCampo2").value;
				}
				else {
					var cantidadCampo2 = null;
				}
				
				if (document.getElementById('montoNeto2') != null) {
					var montoNeto2 = document.getElementById("montoNeto2").value;
				}
				else {
					var montoNeto2 = null;
				}
				
				//----------------------------------------------------------------------- Campo 3
				if (document.getElementById('cantidadCampo3') != null) {
					var cantidadCampo3 = document.getElementById("cantidadCampo3").value;
				}
				else {
					var cantidadCampo3 = null;
				}
				
				if (document.getElementById('montoNeto3') != null) {
					var montoNeto3 = document.getElementById("montoNeto3").value;
				}
				else {
					var montoNeto3 = null;
				}
				
				//----------------------------------------------------------------------- Campo 4
				if (document.getElementById('cantidadCampo4') != null) {
					var cantidadCampo4 = document.getElementById("cantidadCampo4").value;
				}
				else {
					var cantidadCampo4 = null;
				}
				
				if (document.getElementById('montoNeto4') != null) {
					var montoNeto4 = document.getElementById("montoNeto4").value;
				}
				else {
					var montoNeto4 = null;
				}
				
				//----------------------------------------------------------------------- Campo 5
				if (document.getElementById('cantidadCampo5') != null) {
					var cantidadCampo5 = document.getElementById("cantidadCampo5").value;
				}
				else {
					var cantidadCampo5 = null;
				}
				
				if (document.getElementById('montoNeto5') != null) {
					var montoNeto5 = document.getElementById("montoNeto5").value;
				}
				else {
					var montoNeto5 = null;
				}
				
				//----------------------------------------------------------------------- Campo 6
				if (document.getElementById('cantidadCampo6') != null) {
					var cantidadCampo6 = document.getElementById("cantidadCampo6").value;
				}
				else {
					var cantidadCampo6 = null;
				}
				
				if (document.getElementById('montoNeto6') != null) {
					var montoNeto6 = document.getElementById("montoNeto6").value;
				}
				else {
					var montoNeto6 = null;
				}
				
				//----------------------------------------------------------------------- Campo 7
				if (document.getElementById('cantidadCampo7') != null) {
					var cantidadCampo7 = document.getElementById("cantidadCampo7").value;
				}
				else {
					var cantidadCampo7 = null;
				}
				
				if (document.getElementById('montoNeto7') != null) {
					var montoNeto7 = document.getElementById("montoNeto7").value;
				}
				else {
					var montoNeto7 = null;
				}
				
				//------------------------------------------------------------------------ Verificaciones
				if(cantidadCampo1!=''){
					var subTotal = cantidadCampo1 * montoNeto1;
				}
				
				if(cantidadCampo2 != null){
					var subTotal = (cantidadCampo1 * montoNeto1) + (cantidadCampo2 * montoNeto2);
				}
				
				if(cantidadCampo3 != null){
					var subTotal = (cantidadCampo1 * montoNeto1) + (cantidadCampo2 * montoNeto2) + (cantidadCampo3 * montoNeto3);
				}
				
				if(cantidadCampo4 != null){
					var subTotal = (cantidadCampo1 * montoNeto1) + (cantidadCampo2 * montoNeto2) + (cantidadCampo3 * montoNeto3) + (cantidadCampo4 * montoNeto4);
				}
				
				if(cantidadCampo5 != null){
					var subTotal = (cantidadCampo1 * montoNeto1) + (cantidadCampo2 * montoNeto2) + (cantidadCampo3 * montoNeto3) + (cantidadCampo4 * montoNeto4) + (cantidadCampo5 * montoNeto5);
				}
				
				if(cantidadCampo6 != null){
					var subTotal = (cantidadCampo1 * montoNeto1) + (cantidadCampo2 * montoNeto2) + (cantidadCampo3 * montoNeto3) + (cantidadCampo4 * montoNeto4) + (cantidadCampo5 * montoNeto5) + (cantidadCampo6 * montoNeto6);
				}
				
				if(cantidadCampo7 != null){
					var subTotal = (cantidadCampo1 * montoNeto1) + (cantidadCampo2 * montoNeto2) + (cantidadCampo3 * montoNeto3) + (cantidadCampo4 * montoNeto4) + (cantidadCampo5 * montoNeto5) + (cantidadCampo6 * montoNeto6) + (cantidadCampo7 * montoNeto7);
				}
				
				document.getElementById("valorTotalNeto").value = subTotal;			
		}
		
	</script>
	
  </head>
  <body>
	<?php
		$z=0;
		$nro_oc = $_GET['oc_send'];
		
		include "config.php";
		
		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$registrosOrdenes=mysqli_query($conexion,"select * from ordenes WHERE numero_orden=$nro_oc") or die("Problemas en el select:".mysqli_error($conexion));
		
		$username = $_SESSION['username'];
		
		$registrosUsuario = mysqli_query($conexion,"select * from members WHERE username = '$username'") or die("Problemas en el select:".mysqli_error($conexion));
	
		if($reg=mysqli_fetch_array($registrosUsuario)){
			$id_member = $reg['id'];
			$nombre = $reg['nombre'];
			$apellido = $reg['apellido'];
		}
		
	?>
    <header class="grupo">
      <div class="caja base-50 no-padding">
        <h1> <a href="administrador.php"" class="logo"> <img src="tema/img/logo.jpg" alt="POC"></a></h1>
      </div>
		<div class="caja base-50 no-padding">
		<!--
		<a href="logout.php" class="logout">Logout</a>
		-->
			<nav>
				<ul>            
					<?php
					echo "<li><h4>Usuario: $nombre $apellido</h4></li>";
					?>
				</ul>
			</nav>
		</div>
    </header>
    <div id="data--input" class="grupo">      
	  <h4>Modificar Orden de Compra</h4>
	  <input type="button" value="Volver" onclick="history.go(-1);">	  	  
    </div>
	<br>
	 <div class="grupo no-padding">
		  <div class="caja base-100">
			<?php			
				if($reg=mysqli_fetch_array($registrosOrdenes)){
					$numero_orden = $reg['numero_orden'];
					$id_proveedor = $reg['id_proveedor'];
					$campana = $reg['campana'];
					$fecha_oc = $reg['fecha'];
					$nro_presupuesto_proveedor = $reg['nro_presupuesto_proveedor'];
					$nro_factura_proveedor = $reg['nro_factura_proveedor'];
					$jefe_autorizacion = $reg['jefe_autorizacion'];
					$area_pago = $reg['area_pago'];
					$control_presupuesto = $reg['control_presupuesto'];
					$registro_gasto = $reg['registro_gasto'];
					
					$monto_neto = $reg['monto_neto'];
					$tipo_impuesto = $reg['tipo_impuesto'];
					
					$sub_total = $reg['sub_total'];
					$total_final = $reg['total_final'];
					
					$registrosProveedor=mysqli_query($conexion,"select * from proveedor WHERE id_proveedor=$id_proveedor") or die("Problemas en el select:".mysqli_error($conexion));
					
					if($regPr=mysqli_fetch_array($registrosProveedor)){					
						$rut_pr = $regPr['rut'];
						$nombre_proveedor = $regPr['nombre'];
						$razon_social = $regPr['razon_social'];
						$giro = $regPr['giro'];
						$direccion = $regPr['direccion'];
						$telefono = $regPr['telefono'];
						$contacto = $regPr['contacto'];
						
					}
					
					$registrosCampana=mysqli_query($conexion,"select * from campana") or die("Problemas en el select:".mysqli_error($conexion));
					
					$registrosAutorizante=mysqli_query($conexion,"select * from autorizante") or die("Problemas en el select:".mysqli_error($conexion));
					
					$newDate_oc = date("d-m-Y", strtotime($fecha_oc));	
					
					$registrosAreaPago=mysqli_query($conexion,"select * from centro_costo") or die("Problemas en el select:".mysqli_error($conexion));
					
					$registroControlPresupuesto=mysqli_query($conexion,"select * from control_presupuesto") or die("Problemas en el select:".mysqli_error($conexion));
					
					$registroGasto=mysqli_query($conexion,"select * from registro") or die("Problemas en el select:".mysqli_error($conexion));
					
					$registroServicios=mysqli_query($conexion,"select * from servicios WHERE id_orden=$numero_orden") or die("Problemas en el select:".mysqli_error($conexion));

			
					echo "<form id=\"\" method=\"POST\" action=\"\" class=\"info--cliente\" style=\"background:#E8E8E8 !important;\">";
					  echo "<div class=\"caja base-25\">";
						echo "<label>Nº OC</label>";
						 echo "<input type=\"text\" value=\"$nro_oc\" name=\"nro_oc\" style=\"background-color:#E8E8E8;\" readonly >";
					  echo "</div>";
					  echo "<div class=\"caja base-25\">";
						echo "<label>Nº Presupuesto</label>";
						echo "<input type=\"text\" value=\"$nro_presupuesto_proveedor\" name=\"nro_presupuesto_proveedor\" >";
					  echo "</div>";
					  echo "<div class=\"caja base-25\">";
						echo "<label>Nº Factura</label>";
						echo "<input type=\"text\" value=\"$nro_factura_proveedor\" name=\"nro_factura_proveedor\" >";
					  echo "</div>";
					  echo "<div class=\"caja base-25\">";
						echo "<label>Fecha</label>";
						echo "<input type=\"text\" value=\"$newDate_oc\" name=\"newDate_oc\" >";
					  echo "</div>";
					  
					  
					  echo "<div style=\"width:100%; float:left; padding:15px 0 0 15px; font-weight:bold; font-size:1.3em;\" class=\"datosTexto\">Datos Proveedor</div>";
					  echo "<div class=\"caja base-20\">";					  
						echo "<label>Nombre Fantasía *</label>";
						?>
						<input type="text" size="40" name="typeahead" value="<?php echo isset($_POST['typeahead']) ? $_POST['typeahead'] : $nombre_proveedor ?>" class="typeahead tt-query" >
						<?php
						//echo "<input type=\"text\" value=\"$nombre_proveedor\" >";						
					  echo "</div>";
					  
						if (isset($_POST['typeahead'])){
						  $busqueda = $_POST['typeahead'];
						  
							$consulta_mysql=mysqli_query($conexion,"select * from proveedor where nombre = '$busqueda'") or die("Problemas en el select:");	    
							
							if($rowBus=mysqli_fetch_array($consulta_mysql)){
								  $id_proveedor_bus = $rowBus['id_proveedor'];
								  $razon_social_bus = $rowBus['razon_social'];
								  $giro_bus = $rowBus['giro'];
								  $direccion_bus = $rowBus['direccion'];
								  $telefono_bus = $rowBus['telefono'];
								  $contacto_bus = $rowBus['contacto'];
								  $rut_bus = $rowBus['rut'];
								  $nombre_bus = $rowBus['nombre'];
							}
						  
							  echo "<div class=\"caja base-20\">";
							echo "<label>RUT</label>";
							echo "<input type=\"text\" value=\"$rut_bus\" style=\"background-color:#E8E8E8;\" readonly>";
						  echo "</div>";
						  echo "<div class=\"caja base-20\">";
							echo "<label>Razón social</label>";
							echo "<input type=\"text\" value=\"$razon_social_bus\" style=\"background-color:#E8E8E8;\" readonly>";
						  echo "</div>";
						  echo "<div class=\"caja base-20\">";
							echo "<label>Giro</label>";
							echo "<input type=\"text\" value=\"$giro_bus\" style=\"background-color:#E8E8E8;\" readonly>";
						  echo "</div>";
						  echo "<div class=\"caja base-20\">";
							echo "<label>Dirección</label>";
							echo "<input type=\"text\" value=\"$direccion_bus\" style=\"background-color:#E8E8E8;\" readonly>";
						  echo "</div>";
						  echo "<div class=\"caja base-20\">";
							echo "<label>Teléfono</label>";
							echo "<input type=\"text\" value=\"$telefono_bus\" style=\"background-color:#E8E8E8;\" readonly>";
						  echo "</div>";
						  echo "<div class=\"caja base-20\">";
							echo "<label>Contacto</label>";
							echo "<input type=\"text\" value=\"$contacto_bus\" style=\"background-color:#E8E8E8;\" readonly>";
						  echo "</div>";
							echo "<input type=\"text\" value=\"$id_proveedor_bus\" name=\"id_proveedor\" hidden=hidden>";
						  
						}else{
					  
						  echo "<div class=\"caja base-20\">";
							echo "<label>RUT</label>";
							echo "<input type=\"text\" value=\"$rut_pr\" style=\"background-color:#E8E8E8;\" readonly>";
						  echo "</div>";
						  echo "<div class=\"caja base-20\">";
							echo "<label>Razón social</label>";
							echo "<input type=\"text\" value=\"$razon_social\" style=\"background-color:#E8E8E8;\" readonly>";
						  echo "</div>";
						  echo "<div class=\"caja base-20\">";
							echo "<label>Giro</label>";
							echo "<input type=\"text\" value=\"$giro\" style=\"background-color:#E8E8E8;\" readonly>";
						  echo "</div>";
						  echo "<div class=\"caja base-20\">";
							echo "<label>Dirección</label>";
							echo "<input type=\"text\" value=\"$direccion\" style=\"background-color:#E8E8E8;\" readonly>";
						  echo "</div>";
						  echo "<div class=\"caja base-20\">";
							echo "<label>Teléfono</label>";
							echo "<input type=\"text\" value=\"$telefono\" style=\"background-color:#E8E8E8;\" readonly>";
						  echo "</div>";
						  echo "<div class=\"caja base-20\">";
							echo "<label>Contacto</label>";
							echo "<input type=\"text\" value=\"$contacto\" style=\"background-color:#E8E8E8;\" readonly>";
						  echo "</div>";
						  echo "<input type=\"text\" value=\"$id_proveedor\" name=\"id_proveedor\" hidden=hidden>";
					  
					  }
					  
					  echo "<div style=\"width:100%; float:left; padding:15px 0 0 15px; font-weight:bold; font-size:1.3em;\" class=\"datosTexto\">Datos OC</div>";
					  echo "<div class=\"caja base-20\">";
						echo "<label>Campaña*</label>";
						//echo "<input type=\"text\" value=\"$nombre_campana\" readonly>";
						
							echo "<select name=\"campana\" class=\"pago\">";
								while($regCa=mysqli_fetch_array($registrosCampana)){
									$nombre_campana = $regCa['nombre_campana'];
									$id_campana = $regCa['id_campana'];
									if($id_campana==$campana){
										echo "<option value=\"$id_campana\" selected=selected>$nombre_campana</option>";
									}else{
										echo "<option value=\"$id_campana\">$nombre_campana</option>";
									}
								}
							echo "</select>";
						
					  echo "</div>";
					  echo "<div class=\"caja base-20\">";
						echo "<label>Autorizante</label>";
						//echo "<input type=\"text\" value=\"$jefe_autorizacion\" readonly>";
						
						
						echo "<select name=\"autorizante\" class=\"pago\">";
							while($regAu=mysqli_fetch_array($registrosAutorizante)){
								$nombre_autorizante = $regAu['nombre_autorizante'];
								if($nombre_autorizante==$jefe_autorizacion){
									echo "<option value=\"$nombre_autorizante\" selected=selected>$nombre_autorizante</option>";
								}else{
									echo "<option value=\"$nombre_autorizante\">$nombre_autorizante</option>";
								}
							}
						echo "</select>";
						
					  echo "</div>";
					  echo "<div class=\"caja base-20\">";
						echo "<label>Centro Costo</label>";
						//echo "<input type=\"text\" value=\"$descripcion\" readonly>";
						echo "<select name=\"area_pago\" class=\"pago\">";
							while($regAP=mysqli_fetch_array($registrosAreaPago)){
								$id_centro_costo = $regAP['id_centro_costo'];
								$descripcion = $regAP['descripcion'];
								if($id_centro_costo==$area_pago){
									echo "<option value=\"$id_centro_costo\" selected=selected>$descripcion</option>";
								}else{
									echo "<option value=\"$id_centro_costo\">$descripcion</option>";
								}
							}
						echo "</select>";
					  echo "</div>";
					  
					  echo "<div class=\"caja base-20\">";
						echo "<label>Control Presupuesto</label>";
						//echo "<input type=\"text\" value=\"$control_presupuesto\" readonly>";
						echo "<select name=\"control_presupuesto\" class=\"pago\">";
							while($regCP=mysqli_fetch_array($registroControlPresupuesto)){
								$id_controlP = $regCP['id_controlP'];
								$control_presupuesto_name = $regCP['control_presupuesto'];
								if($id_controlP==$control_presupuesto){
									echo "<option value=\"$id_controlP\" selected=selected >$control_presupuesto_name</option>";
								}else{
									echo "<option value=\"$id_controlP\">$control_presupuesto_name</option>";
								}
							}
								
						echo "</select>";
						
					  echo "</div>";
					  echo "<div class=\"caja base-20\">";
						echo "<label>Regístro</label>";
						//echo "<input type=\"text\" value=\"$registro_gasto_nombre\" readonly>";
						
						echo "<select name=\"registro_gasto\" class=\"pago\">";
							while($regRG=mysqli_fetch_array($registroGasto)){
								$id_registro = $regRG['id_registro'];
								$registro_gasto_nombre = $regRG['registro_gasto'];
								if($id_registro==$registro_gasto){
									echo "<option value=\"$id_registro\" selected=selected>$registro_gasto_nombre</option>";
								}else{
									echo "<option value=\"$id_registro\">$registro_gasto_nombre</option>";
								}
							}	
						echo "</select>";
						
						echo "</div>";
						
						echo "<div style=\"width:100%; float:left; padding:15px 0 0 15px; font-weight:bold; font-size:1.3em;\" class=\"datosTexto\">Servicios</div>";
						
					while($regSe=mysqli_fetch_array($registroServicios)){
						
						$nro_servicio = $regSe['nro_servicio'];
						$descripcion = $regSe['descripcion'];
						$cantidad = $regSe['cantidad'];
						$monto = $regSe['monto'];
						
						$z = $z + 1;
						$name_cantidad = 'cantidad'.$z;
						$name_monto = 'monto'.$z;
						$name_descripcion = 'descripcion'.$z;
						
						$name_cantidadCampo = 'cantidadCampo'.$z;
						$name_montoNeto = 'montoNeto'.$z;
						
						$name_nroServicio = 'nroServicio'.$z;
						
						echo "<div class=\"caja base-25\">";
							echo "<label>Cantidad</label>";
							if($tipo_impuesto=='IVA'){
								$segundaFuncion = 'recalcularIVA();';
							}
							if($tipo_impuesto=='10% BOLETA'){
								$segundaFuncion = 'recalcularBoleta();';
							}							
							if($tipo_impuesto=='EXENTO DE IVA'){
								$segundaFuncion = 'exentoIVA();';
							}
							if($tipo_impuesto==''){
								$segundaFuncion = '';
							}
							echo "<input id=\"$name_cantidadCampo\" type=\"text\" value=\"$cantidad\" name=\"$name_cantidad\" onchange=\"recalcular(); $segundaFuncion \" >";
						echo "</div>";
						
						echo "<div class=\"caja base-25\">";
							echo "<label>Monto Neto</label>";
							if($tipo_impuesto=='IVA'){
								$segundaFuncion = 'recalcularIVA();';
							}
							if($tipo_impuesto=='10% BOLETA'){
								$segundaFuncion = 'recalcularBoleta();';
							}
							if($tipo_impuesto=='EXENTO DE IVA'){
								$segundaFuncion = 'exentoIVA();';
							}
							if($tipo_impuesto==''){
								$segundaFuncion = '';
							}
							echo "<input id=\"$name_montoNeto\" type=\"text\" value=\"$monto\" name=\"$name_monto\" onchange=\"recalcular(); $segundaFuncion \" >";
						echo "</div>";
						
						echo "<div class=\"caja base-50\">";
							echo "<label>Descripción Servicio</label>";
							echo "<input type=\"text\" value=\"$descripcion\" name=\"$name_descripcion\" >";
						echo "</div>";
						
						echo "<input type=\"text\" value=\"$nro_servicio\" name=\"$name_nroServicio\" hidden=hidden >";
					
					}
						//enviar por fuera del while el nro de rows que tiene servicios
						$rows = mysqli_num_rows($registroServicios);
						
						echo "<input type=\"text\" value=\"$rows\" name=\"rows_servicio\" hidden=hidden >";
						
						echo "<input type=\"text\" value=\"Gendo\" name=\"cantidad0\" hidden=hidden />";
						echo "<input type=\"text\" value=\"Shinji\" name=\"monto0\" hidden=hidden />";
						echo "<input type=\"text\" value=\"Asuka\" name=\"descripcion0\" hidden=hidden />";
						echo "<input type=\"text\" value=\"Rey\" name=\"nroServicio0\" hidden=hidden />";
						
						echo "<div class=\"caja base-20\">";
							echo "<label>Valor Total Neto</label>";
							echo "<input id=\"valorTotalNeto\" type=\"text\" value=\"\" name=\"valor_t_neto\" readonly>";
						echo "</div>";
						
						echo "<div class=\"caja base-20\">";
							echo "<label>IVA / Boleta / Exento</label>";
								echo "<select name=\"tipoImpuesto\" onchange=\"calcular(this)\">";
									if($tipo_impuesto=='IVA'){
										echo "<option value=\"-1\" >Seleccione</option>";
										echo "<option value=\"IVA\" id=\"iva\" selected=selected >IVA</option>";
										echo "<option value=\"10% BOLETA\" id=\"boleta\" >Boleta</option>";
										echo "<option value=\"EXENTO DE IVA\" id=\"exento\" >Exento</option>";
									}
									if($tipo_impuesto=='10% BOLETA'){
										echo "<option value=\"-1\" >Seleccione</option>";
										echo "<option value=\"IVA\" id=\"iva\">IVA</option>";
										echo "<option value=\"10% BOLETA\" id=\"boleta\" selected=selected>Boleta</option>";
										echo "<option value=\"EXENTO DE IVA\" id=\"exento\" >Exento</option>";
									}
									if($tipo_impuesto=='EXENTO DE IVA'){
										echo "<option value=\"-1\" >Seleccione</option>";
										echo "<option value=\"IVA\" id=\"iva\" >IVA</option>";
										echo "<option value=\"10% BOLETA\" id=\"boleta\" >Boleta</option>";
										echo "<option value=\"EXENTO DE IVA\" id=\"exento\" selected=selected >Exento</option>";
									}	
								echo "</select>";
						echo "</div>";
						
						echo "<div class=\"caja base-20\">";
							echo "<label>IVA / Boleta / Exento</label>";
							echo "<input id=\"campo_subtotal\" type=\"text\" value=\"$sub_total\" name=\"subTotal\" readonly>";
						echo "</div>";
						
						echo "<div class=\"caja base-40\">";
							echo "<label>Total</label>";
							echo "<input id=\"totalfinalcampo\" class=\"cajitaTexto\" type=\"text\" value=\"$total_final\" name=\"totalFinal\" readonly>";
						echo "</div>";
						
					  echo "<div style=\"float:left; padding:15px 0 0 15px; margin-top:15px;\" class=\"cancela-guarda\">";
						echo "<input type=\"submit\" value=\"stuff\" style=\"margin-right:10px;\" hidden=hidden >";
						echo "<input type=\"submit\" value=\"Modificar\" style=\"margin-right:10px;\" formaction=\"modificar-oc-procesar.php\" >";
						echo "<input type=\"button\" value=\"Cancelar\" onclick=\"history.go(-1);\">";
					  echo "</div>";
					  
					echo "</form>";
				}
			?>
		  </div>
		</div>
		
    <div id="footer" class="total">
      <div class="grupo">
        <div id="logo-footer" class="caja-50"><img src="tema/img/logo-footer.png" alt=""></div>
        <div id="copy" class="caja-50">
          <p>© 2016 Easy S.A.</p>
        </div>
      </div>
    </div>
  </body>
</html>