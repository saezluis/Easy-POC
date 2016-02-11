<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{

}
else
{
	
header('Content-Type: text/html; charset=UTF-8'); 
	
//echo "<br/>" . "Para tener una mejor experiencia de navegación te recomendamos que actualices tu navegador." . "<br/>";

//echo "<br/>" . "Si el error persiste, puede deberse a las siguientes causas:" . "<br/>";

//echo "<br/>" . " <h2> Estás a un click de Subirte, actualiza tu navegador <a href='http://windows.microsoft.com/es-cl/internet-explorer/download-ie'>aquí</a></h2>" . "<br/>";

//echo "<br/>" . " * Estás usando una versión antigua de Internet Explorer, actualízalo." . "<br/>";

//echo "<br/>" . "Entiendo las recomendaciones, volver al <a href='login.php'>Login</a>." . "<br/>";
	
echo "<br/>" . "Esta pagina es solo para usuarios registrados." . "<br/>";

echo "<br/>" . "<a href='login.php'>Hacer Login</a>";

exit;
}
$now = time(); // checking the time now when home page starts

if($now > $_SESSION['expire'])
{
session_destroy();
echo "<br/><br />" . "Su sesion a terminado, <a href='login.php'> Necesita Hacer Login</a>";
exit;
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
  <title> </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="tema/css/estilos.css">
	<script>	
	
	// Extend the default Number object with a formatMoney() method:
	// usage: someVar.formatMoney(decimalPlaces, symbol, thousandsSeparator, decimalSeparator)
	// defaults: (2, "$", ",", ".")
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
		
		
	
		var totalget = document.getElementById("totalhidden").value;
		
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
			document.getElementById("campo_subtotal_copy").value = calcularivaFormat;
			//alert('click en iva');
			//
			//alert(totalget);
			//var nameValue = document.getElementById("uniqueID").value;
			//Me interesa establecer el valor del campo luego del calculo del IVA
			//document.getElementById("campo2-c").value = '';
			document.getElementById("tipo_impuesto").value = document.getElementById("iva").value;
			
		} 
		
		if(select.options[select.selectedIndex].id == "boleta"){
			//alert('click en boleta');
			var calcularboleta = (parseFloat(totalget) * 10) / 100;
			var totalfinal = parseFloat(totalget) + calcularboleta;
			document.getElementById("totalfinalcampo").value = Math.round(totalfinal);
			document.getElementById("campo_subtotal").value = Math.round(calcularboleta);
			document.getElementById("campo_subtotal_copy").value = Math.round(calcularboleta);
			//var nameValue = document.getElementById("uniqueID").value;
			document.getElementById("tipo_impuesto").value = document.getElementById("boleta").value;
		} 
		if(select.options[select.selectedIndex].id == "exento"){
			//alert('click en exento');
			
			var totalgetFormat = parseFloat(totalget).formatMoney(0,"",".",".");
			
			document.getElementById("totalfinalcampo").value = totalgetFormat;
			document.getElementById("campo_subtotal").value = "0";
			document.getElementById("campo_subtotal_copy").value = "0";
			//var nameValue = document.getElementById("uniqueID").value;
			document.getElementById("tipo_impuesto").value = document.getElementById("exento").value;
		} 
		//alert(select.options[select.selectedIndex].getAttribute("iva"));
		//obtener valores del formulario
		//var nameValue = document.getElementById("uniqueID").value;
	}
	</script>
	
	<script type = "text/javascript" >
		history.pushState(null, null, 'orden-compra.php');
		window.addEventListener('popstate', function(event) {
			history.pushState(null, null, 'orden-compra.php');
		});
    </script>
	
		<!--
		<link href="print.css" rel="stylesheet" type="text/css" media="print" />
		-->
		
		<style type="text/css" media="print">
			header.cotizacion #datos--fac{
				width: 50% !important;
			}

		    header.cotizacion #datos--fac li {
				font-size: 10px !important;
       		}
       		#oc--datos #oc-proo li{
       			font-size: 0.7em;
       		}
       		#oc--datos #oc-proo li span.flot-2{
       			top: 25px !important;
       		}
       		#oc--datos #oc-proo li span.flot-3{
       			top: 60px !important;
       		}
       		#oc--datos #oc-proo li span.flot-4{
       			top: 90px !important;
       		}
       		#oc--datos #oc-proo li span.flot-5{
       			top: 125px !important;
       		}

       		.right--r{
       			padding-left: 160px !important;
       		}
			#item-1-print, #item-2-print, #item-3-print, #item-4-print, #item-5-print{
				
				font-size: 10px !important;
				padding: 5px !important;
				height: 30px !important;
			}
			#desglose-1, #desglose-2, #desglose-3, #desglose-4, #desglose-5{
				
				font-size: 10px !important;
				padding: 5px !important;
				height: 30px !important;

			}
       		.valores-select{
       			display: none;
       		}
    		.imprimir{
    			display: none;
    		}
			#neto input.no-hay{
				border:none !important;
			}
			#firmas{
				margin-top: 0 !important;
			}
		</style>
		
		<script type = "text/javascript" >
		/*
			window.onload = function() {
				var src = document.getElementById("campo_subtotal"),
				dst = document.getElementById("two");
				src.addEventListener('input', function() {
				dst.value = src.value;
				});
			};
		*/
		</script>
		
  </head>
<body>
<?php
error_reporting(E_ALL & ~E_NOTICE);

	include "config.php";

	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");

//Crear un campo descripcion y concatenar todos los descripcion que me llegan de agregar servicio

//$descripcionfull = "";

if ($_REQUEST['descripcion1']!=""){		
	$descripcionfull = $_REQUEST['descripcion1'];		
	if ($_REQUEST['descripcion2']!=""){
		$descripcionfull = $_REQUEST['descripcion1'] . " " . $_REQUEST['descripcion2'];		
		if ($_REQUEST['descripcion3']!=""){
			$descripcionfull = $_REQUEST['descripcion1'] . " " . $_REQUEST['descripcion2'] . " " . $_REQUEST['descripcion3'];
			if ($_REQUEST['descripcion4']!=""){
				$descripcionfull = $_REQUEST['descripcion1'] . " " . $_REQUEST['descripcion2'] . " " . $_REQUEST['descripcion3'] . " " . $_REQUEST['descripcion4'];
				if ($_REQUEST['descripcion5']!=""){
					$descripcionfull = $_REQUEST['descripcion1'] . " " . $_REQUEST['descripcion2'] . " " . $_REQUEST['descripcion3'] . " " . $_REQUEST['descripcion4'] . " " . $_REQUEST['descripcion5'];
					if ($_REQUEST['descripcion6']!=""){
						$descripcionfull = $_REQUEST['descripcion1'] . " " . $_REQUEST['descripcion2'] . " " . $_REQUEST['descripcion3'] . " " . $_REQUEST['descripcion4'] . " " . $_REQUEST['descripcion5'] . " " . $_REQUEST['descripcion6'];
						if ($_REQUEST['descripcion7']!=""){
							$descripcionfull = $_REQUEST['descripcion1'] . " " . $_REQUEST['descripcion2'] . " " . $_REQUEST['descripcion3'] . " " . $_REQUEST['descripcion4'] . " " . $_REQUEST['descripcion5'] . " " . $_REQUEST['descripcion6'] . " " . $_REQUEST['descripcion7'];
						}
					}	
				}
			}
		}
	}		
}

$nro_presupuesto_set = $_REQUEST['nro_presupuesto'];

	$id_proveedor_send = $_REQUEST['id_proveedor_send'];
	
	//echo "Id proveedor send: ".$id_proveedor_send;
	//echo "<br>";
	//echo "<br>";

	mysqli_query($conexion,"insert into ordenes(id_proveedor,fecha,visto_bueno,campana,nro_presupuesto_proveedor,nro_factura_proveedor,jefe_autorizacion,area_pago,descripcion,archivo,registro_gasto,control_presupuesto) 
													values 
													('$id_proveedor_send',
													'$_REQUEST[fecha_documento]',
													'no',
													'$_REQUEST[campana]',																								 
													'$_REQUEST[nro_presupuesto]',
													'$_REQUEST[nro_factura]',												
													'$_REQUEST[jefe_autorizacion]',
													'$_REQUEST[area_pagoland_send]',
													'$descripcionfull',
													'no',
													'$_REQUEST[registro_gastosland_send]',
													'$_REQUEST[id_controlP_send]')")
	  or die("Debe llenar todos los campos");  

//$last_id = mysqli_query($conexion,"SELECT LAST_INSERT_ID();"); 

$last_id = mysqli_insert_id($conexion); //Aqui se me devuelve el ultimo ID insertado

// ---------- Aqui es donde se agregan el primer servicio, es obligatorio ----------

mysqli_query($conexion,"insert into servicios(descripcion,cantidad,monto,id_orden) values ('$_REQUEST[descripcion1]',
												'$_REQUEST[cantidad1]',
												'$_REQUEST[valor1]',
												'$last_id')")
  or die("Problemas con el insert de los servicios");  

// ---------- Aqui es donde se agregan servicios adicionales ----------

// ---------- Query que ingresa datos de una descripcion 2 --------

if ($_REQUEST['descripcion2']!=""){
mysqli_query($conexion,"insert into servicios(descripcion,cantidad,monto,id_orden) values ('$_REQUEST[descripcion2]',
												'$_REQUEST[cantidad2]',
												'$_REQUEST[valor2]',
												'$last_id')") or die("Problemas con el insert de los servicios");    
  }

// ---------- Query que ingresa datos de una descripcion 3 --------

if ($_REQUEST['descripcion3']!=""){
mysqli_query($conexion,"insert into servicios(descripcion,cantidad,monto,id_orden) values ('$_REQUEST[descripcion3]',
												'$_REQUEST[cantidad3]',
												'$_REQUEST[valor3]',
												'$last_id')") or die("Problemas con el insert de los servicios");
  } 
  
// ---------- Query que ingresa datos de una descripcion 4 --------

if ($_REQUEST['descripcion4']!=""){
mysqli_query($conexion,"insert into servicios(descripcion,cantidad,monto,id_orden) values ('$_REQUEST[descripcion4]',
												'$_REQUEST[cantidad4]',
												'$_REQUEST[valor4]',
												'$last_id')") or die("Problemas con el insert de los servicios");
  } 

// ---------- Query que ingresa datos de una descripcion 5 --------

if ($_REQUEST['descripcion5']!=""){
mysqli_query($conexion,"insert into servicios(descripcion,cantidad,monto,id_orden) values ('$_REQUEST[descripcion5]',
												'$_REQUEST[cantidad5]',
												'$_REQUEST[valor5]',
												'$last_id')") or die("Problemas con el insert de los servicios");
  }   

// ---------- Query que ingresa datos de una descripcion 6 --------

if ($_REQUEST['descripcion6']!=""){
mysqli_query($conexion,"insert into servicios(descripcion,cantidad,monto,id_orden) values ('$_REQUEST[descripcion6]',
												'$_REQUEST[cantidad6]',
												'$_REQUEST[valor6]',
												'$last_id')") or die("Problemas con el insert de los servicios");
  }     
  
// ---------- Query que ingresa datos de una descripcion 7 --------

if ($_REQUEST['descripcion7']!=""){
mysqli_query($conexion,"insert into servicios(descripcion,cantidad,monto,id_orden) values ('$_REQUEST[descripcion7]',
												'$_REQUEST[cantidad7]',
												'$_REQUEST[valor7]',
												'$last_id')") or die("Problemas con el insert de los servicios");
  }   

$consulta_orden=mysqli_query($conexion,"select * from ordenes where numero_orden = '$last_id'") or die("Problemas en el select:");	    
			if($row=mysqli_fetch_array($consulta_orden))
			{
			  $nro_presupuesto = $row['nro_presupuesto_proveedor'];
			  $nro_factura = $row['nro_factura_proveedor'];
			}

	
			
$consulta_proveedor=mysqli_query($conexion,"select * from proveedor where nombre = '$_REQUEST[typeahead]'") or die("Problemas en el select:");	    
			if($row=mysqli_fetch_array($consulta_proveedor))
			{
			  $razon_social = $row['razon_social'];
			  $giro = $row['giro'];
			  $direccion = $row['direccion'];
			  $contacto = $row['contacto'];
			  $telefono = $row['telefono'];
			  $RUT = $row['rut'];
			}			
			
			
//mysqli_close($conexion);


?>
	<header class="cotizacion grupo">
			
		<div class="caja base-50 no-padding">
			<div id="cot--logo"> <img src="tema/img/logo.gif" alt="POC"></div>
			<div id="cotiza--datos">
				<p class="data--sa">Easy s.a.</p>
				<p class="data--co">96.671.750-5</p>
				<p class="data--co">Av. Keneddy 09001, piso 5, Las Condes</p>
				<p class="data--co">9590300</p>
			</div>
		</div>
      <div class="caja base-50 no-padding">
        <div id="datos--fac">
          <ul>
			<?php echo "<li>N° <span class=\"num-f\">$last_id</span></li>"; ?>
            
			<?php echo "<li>Presupuesto <span class=\"num-p\">$nro_presupuesto_set</span></li>"; ?>            
            
            <?php echo "<li>Nº Factura <span class=\"num-l\">$nro_factura</span></li>"; ?>
			
          </ul>
        </div>
      </div>
      <div class="caja base-100 no-padding">
		<?php 
			$dia = date('d', time());
			$mes = date('m', time());
			$anio = date('y', time()); 
		?>
        <p class="coti--fecha">Santiago,<span class="dia"><?php echo $dia; ?></span><span class="mes"><?php echo $mes; ?></span><span class="ano"><?php echo "20".$anio; ?></span></p>
        <h3>Orden de compra marketing</h3>
      </div>
	  
	</header>  
		
	<div id="oc--datos" class="no-padding grupo">
      <p class="d">Datos del Proveedor</p>
      <div id="oc-proo">
        <ul>
          <li> <?php echo " ".$razon_social; ?><span class="flot-1">Razón social:</span><span class="rut-social">RUT: <?php echo " ".$RUT; ?></span></li>
          <li><?php echo " ".$giro; ?><span class="flot-2">Giro:</span></li>
          <li><?php echo " ".$direccion; ?><span class="flot-3">Dirección:</span></li>
          <li><?php echo " ".$contacto; ?><span class="flot-4">Contacto:</span><span class="telefono-contacto">Teléfono: <?php echo " ".$telefono; ?></span></li>
          <li class="right--r"> 30 días<span class="flot-5">Condiciones de pago:</span></li>
        </ul>
      </div>
    </div>
	
	
	
	
	<div id="campana-print" class="grupo">
      <div class="caja-100">
        <div id="tabla">
          <div id="item-1-print">Campaña</div>
          <div id="item-2-print">Detalle</div>
          <div id="item-3-print">Cantidad</div>
          <div id="item-4-print">Precio Unitario</div>
          <div id="item-5-print">Precio Total</div>
        </div>
		

		<?php
		
		$registros=mysqli_query($conexion,"select * from servicios where id_orden = $last_id") or
		die("Problemas en el select:".mysqli_error($conexion));
		
		$subtotal = 0;
		$total = 0;
		$totaliva = 0;
		
		$id_campana = $_REQUEST['campana'];
		
		$registrosCampana=mysqli_query($conexion,"select * from campana WHERE id_campana = $id_campana") or die("Problemas en el select:".mysqli_error($conexion));
		
		if($reg=mysqli_fetch_array($registrosCampana)){
			$nombre_campana = $reg['nombre_campana'];
		}
		
		
		while ($reg=mysqli_fetch_array($registros))
		{
		
		$total =  $total + ($reg['cantidad'] * $reg['monto']);
		$subtotal = ($reg['cantidad'] * $reg['monto']);
        echo "<div id=\"tabla\">";
          echo "<div id=\"desglose-1\">".$nombre_campana."</div>";
          echo "<div id=\"desglose-2\">".$reg['descripcion']."</div>";
          echo "<div id=\"desglose-3\">".$reg['cantidad']."</div>";
          echo "<div id=\"desglose-4\">".number_format($reg['monto'],0, ",", ".")."</div>";
          echo "<div id=\"desglose-5\">".number_format($subtotal,0, ",", ".")."</div>";
        echo "</div>";    
		
		}
		
		$totaliva = round(($total * 19) / 100);
		//$totalivaf = number_format($totaliva,0);
		$totalivaf = number_format($totaliva,0, ",", ".");
		//number_format($numero, 2, ",", ".");
		
		$registros=mysqli_query($conexion,"select * from servicios where id_orden = $last_id") or
		die("Problemas en el select:".mysqli_error($conexion));
		
		//Hacer aqui un update
		mysqli_query($conexion, "UPDATE ordenes SET monto_neto=$total WHERE numero_orden='$last_id'") or
									die("Problemas en el select:".mysqli_error($conexion));
		
		
		//mysqli_close($conexion);
		
		?>
		
		<?php echo "<input type=\"text\" value=\"$total\" id=\"totalhidden\" hidden=hidden>";	?>		
		
		<?php
		
			$total_format = number_format($total,0, ",", ".");
			
		?>
		
        <div id="neto">
          <p class="neto">VALOR TOTAL NETO $<?php echo "<input class=\"no-hay\" type=\"text\" size=\"10\" value=\"$total_format\"  readonly>"; ?></p>
          <p class="iva">
		  
			  <select id="xxx" name="xxxyyy" class="valores-select" onchange="calcular(this)">
				<option value="#" id="elija">Elija</option>
				<option value="IVA" id="iva">IVA</option>
				<option value="10% BOLETA" id="boleta">10% BOLETA</option>
				<option value="EXENTO DE IVA" id="exento">EXENTO DE IVA</option>
			  </select>
			  
				<?php echo "<input class=\"no-hay\" type=\"text\" size=\"10\" value=\"\" id=\"campo_subtotal\" >"; ?> 
		  
		  </p>
		  
		  <form action="update-total.php" method="post">
			<p class="totality">Total $ <?php echo "<input class=\"no-hay\" name=\"total_final\" type=\"text\" size=\"10\" value=\"\" id=\"totalfinalcampo\" readonly>"; ?></p>
			<button type="button" class="imprimir" onclick="window.print(); ">IMPRIMIR</button><!-- esto se lo quité: window.location='emision.php'; -->
			<?php echo "<input type=\"text\" name=\"last_id_send\" value=\"$last_id\" hidden=hidden>"; ?>
			
			<?php echo "<input type=\"text\" value=\"\" name=\"subtotal_send\" id=\"campo_subtotal_copy\" hidden=hidden>"; ?>
			
			<?php echo "<input type=\"text\" value=\"\" name=\"tipo_impuesto_send\" id=\"tipo_impuesto\" hidden=hidden>"; ?>
			
			<button type="submit" class="imprimir" onClick="alert('OC guardada con éxito'); " >GUARDAR</button> <!-- window.location.href = 'emision.php'; -->
		</form>
		
		  <form action="cancelar.php" method="post">
			<?php echo "<input type=\"text\" name=\"ultimoid\" value=\"$last_id\" hidden=hidden>"; ?>		  
			<button type="submit" class="imprimir" >CANCELAR</button>
			</form>
			
			

        </div>
      </div>
    </div>
	<!-- <br><br><br><br><br><br><br><br> -->
  <div id="firmas">
    <div class="grupo">
      <?php
	  
		$username_from_sesion = $_SESSION['username'];
		
		$jefe_a = $_REQUEST['jefe_autorizacion'];
		// verificar firma de acuerdo a usuario que viene de la session variable		
		if($username_from_sesion=='user'){
			echo "<div id=\"firma-1\"><img src=\"tema/img/firma-luis.jpg\"></div>";
		}		
		if($username_from_sesion=='enriqueta.bierwirth@easy.cl'){
			echo "<div id=\"firma-1\"><img src=\"tema/img/enriqueta-bierwirth.jpg\"></div>";
		}
		if($username_from_sesion=='andrea.echagueflores@easy.cl'){
			echo "<div id=\"firma-1\"><img src=\"tema/img/andrea-echague.jpg\"></div>";
		}
		if($username_from_sesion=='gonzalo.elizaldepena@easy.cl'){
			echo "<div id=\"firma-1\"><img src=\"tema/img/gonzalo-elizalde.jpg\"></div>";
		}
		if($username_from_sesion=='francisca.hinojosa@easy.cl'){
			echo "<div id=\"firma-1\"><img src=\"tema/img/fran-hinojosa.jpg\"></div>";
		}
		if($username_from_sesion=='cristian.ortizdiaz@cencosud.cl'){
			echo "<div id=\"firma-1\"><img src=\"tema/img/cristian-ortiz.jpg\"></div>";
		}
		if($username_from_sesion=='jorge.lielmil@easy.cl'){
			echo "<div id=\"firma-1\"><img src=\"tema/img/jorge-lielmil.jpg\"></div>";
		}
		if($username_from_sesion=='rose.villalon@cencosud.cl'){
			echo "<div id=\"firma-1\"><img src=\"tema/img/rose.jpg\"></div>";
		}
		if($username_from_sesion=='andrea.montes@easy.cl'){
			echo "<div id=\"firma-1\"><img src=\"tema/img/andrea-montes.jpg\"></div>";
		}
		if($username_from_sesion=='daniela.salazarrojas@cencosud.cl'){
			echo "<div id=\"firma-1\"><img src=\"tema/img/daniela-salazar.jpg\"></div>";
		}
		if($username_from_sesion=='macarena.borquez@cencosud.cl'){
			echo "<div id=\"firma-1\"><img src=\"tema/img/macarena-borquez.jpg\"></div>";
		}	
		
		if($username_from_sesion=='diana.friedmanruiz@cencosud.cl'){
			echo "<div id=\"firma-1\"><img src=\"tema/img/diana-friedman.jpg\"></div>";
		}
		if($username_from_sesion=='ruby.plaza@easy.cl'){
			echo "<div id=\"firma-1\"><img src=\"tema/img/ruby-plaza.jpg\"></div>";
		}
		
			if($jefe_a=='Cristian Ortiz'){
				echo "<div id=\"firma-1\"><img src=\"tema/img/cristian-ortiz.jpg\"></div>";
			}
			if($jefe_a=='Andrea Montes'){
				echo "<div id=\"firma-1\"><img src=\"tema/img/andrea-montes.jpg\"></div>";
			}
			if($jefe_a=='Roberto Moore'){
				echo "<div id=\"firma-2\"><img src=\"tema/img/firma-2.jpg\"></div>";
			}
			if($jefe_a=='Rose Marie Villalón'){
				echo "<div id=\"firma-1\"><img src=\"tema/img/rose.jpg\"></div>";
			}
			if($jefe_a=='Macarena Borquez'){
				echo "<div id=\"firma-1\"><img src=\"tema/img/macarena-borquez.jpg\"></div>";
			}
			
		?>
    </div>
  </div>
</body>
</html>