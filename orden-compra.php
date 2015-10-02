<!DOCTYPE html>
<html lang="es">
  <head>
  <title> </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="tema/css/estilos.css">
	<script>	
	function calcular(select) {
		var totalget = document.getElementById("totalhidden").value;
		
		if(select.options[select.selectedIndex].id == "elija"){
			document.getElementById("totalfinalcampo").value = '';
		}
		
		if(select.options[select.selectedIndex].id == "iva"){
			var calculariva = (parseFloat(totalget) * 19) / 100;
			var totalfinal = parseFloat(totalget) + calculariva;
			document.getElementById("totalfinalcampo").value = Math.round(totalfinal);
			//alert('click en iva');
			//
			//alert(totalget);
			//var nameValue = document.getElementById("uniqueID").value;
			//Me interesa establecer el valor del campo luego del calculo del IVA
			//document.getElementById("campo2-c").value = '';
		} 
		
		if(select.options[select.selectedIndex].id == "boleta"){
			//alert('click en boleta');
			var calcularboleta = (parseFloat(totalget) * 10) / 100;
			var totalfinal = parseFloat(totalget) + calcularboleta;
			document.getElementById("totalfinalcampo").value = Math.round(totalfinal);
			//var nameValue = document.getElementById("uniqueID").value;
		} 
		if(select.options[select.selectedIndex].id == "exento"){
			//alert('click en exento');
			document.getElementById("totalfinalcampo").value = totalget;
			//var nameValue = document.getElementById("uniqueID").value;
		} 
		//alert(select.options[select.selectedIndex].getAttribute("iva"));
		//obtener valores del formulario
		//var nameValue = document.getElementById("uniqueID").value;
	}
	</script>	
  </head>
<body>
<?php

//$conexion=mysqli_connect("localhost","pmdigita_admin","Prodigy12","pmdigita_test") or die("Problemas con la conexión");	
$conexion=mysqli_connect("localhost","root","123","test") or die("Problemas con la conexion");
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

mysqli_query($conexion,"insert into ordenes(id_proveedor,fecha,visto_bueno,campana,nro_presupuesto_proveedor,nro_factura_proveedor,
jefe_autorizacion,area_pago,descripcion) values ('$_REQUEST[typeahead]',
												'$_REQUEST[fecha_documento]',
												'no',
												'$_REQUEST[campana]',																								 
												'$_REQUEST[nro_presupuesto]',
												'$_REQUEST[nro_factura]',												
												'$_REQUEST[jefe_autorizacion]',
												'$_REQUEST[area_pagoland_send]',
												'$descripcionfull')")
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

//hacer otra consulta para traer los datos del proveedor			
			
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
			
			
mysqli_close($conexion);

/*
echo "El registo fue dado de alta."."<br>";
echo "Ultimo registro insertado ".$last_id;
echo "<br>";
echo "El presupuesto del proveedor es: ".$nro_presupuesto;
echo "<br>";
echo "La razon social del proveedor es: ".$razon_social;
*/
?>
	<header class="cotizacion grupo">
			<!--
		  <div class="caja base-50 no-padding">
			<h1> <a href="emision.php" class="logo"> <img src="tema/img/logo.jpg" alt="POC"></a></h1>
		  </div>      
		  <div class="caja base-100 no-padding">        
		  </div>
		  -->
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
            <!--  <li>Nº<span class="num-f">7570</span></li> -->
			<?php echo "<li>Presupuesto <span class=\"num-p\">$nro_presupuesto</span></li>"; ?>            
            <!--  <li>Presupuesto<span class="num-p">102949</span></li> -->
            <?php echo "<li>Nº Factura <span class=\"num-l\">$nro_factura</span></li>"; ?>
			<!--  <li>Nº de factura<span class="num-l">773</span></li> -->			
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
        <h2>Orden de compra marketing</h2>
      </div>
	  
	</header>  
	<!--
	Datos que llegan desde emision: 				Nombre en base de datos (Tabla: ordenes)
		typeahead: nombre proveedor 				-> id_proveedor
		fecha_documento: fecha de la orden			-> fecha
		campana: nombre de la campaña				-> campana
		outputtext: descripcion de los servicios 	-> detalle
		cantidad: monto de la orden					-> cantidad
		nro_presupuesto: numero de presupuesto		-> nro_presupuesto_proveedor
		nro_factura: numero de factura				-> nro_factura_proveedor
		monto_neto: monto neto						-> monto_neto
		jefe_autorizacion: jefe de autorizacion		-> jefe_autorizacion
		area_pago: area de pago						-> area_pago
		
													-> numero_orden: autogenerado por cada orden													
													-> orden_sap: falta origen de la data
													-> orden_recepcion: falta origen de la data
													-> visto_bueno: por defecto deberia guardar NO al ser una nueva orden
	-->
	
	
	
	<div id="oc--datos" class="no-padding grupo">
      <p class="d">Datos del Proveedor</p>
      <div id="oc-proo">
        <ul>
          <li> <?php echo " ".$razon_social; ?><span class="flot-1">Razón social:</span></li>
          <li><?php echo " ".$giro; ?><span class="flot-2">Giro:</span></li>
          <li><?php echo " ".$direccion; ?><span class="flot-3">Dirección:</span></li>
          <li><?php echo " ".$contacto; ?><span class="flot-4">Contacto:</span></li>
          <li class="right--r"> 30 días<span class="flot-5">Condiciones de pago:</span></li>
        </ul>
      </div>
    </div>
	
	
	
	
	<div id="campana" class="grupo">
      <div class="caja-100">
        <div id="tabla">
          <div id="item-1">Campaña</div>
          <div id="item-2">Detalle</div>
          <div id="item-3">Cantidad</div>
          <div id="item-4">Precio Unitario</div>
          <div id="item-5">Precio Total</div>
        </div>
		<!-- Esto va en un PHP -->
		<!-- Mientras exista una descripcion asociada al id_orden va a construir datos aqui -->

		<?php
		
		//$conexion=mysqli_connect("localhost","pmdigita_admin","Prodigy12","pmdigita_test") or die("Problemas con la conexión");	
		$conexion=mysqli_connect("localhost","root","123","test") or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$registros=mysqli_query($conexion,"select * from servicios where id_orden = $last_id") or
		die("Problemas en el select:".mysqli_error($conexion));
		
		$subtotal = 0;
		$total = 0;
		$totaliva = 0;
		
		while ($reg=mysqli_fetch_array($registros))
		{
		
		$total =  $total + ($reg['cantidad'] * $reg['monto']);
		$subtotal = ($reg['cantidad'] * $reg['monto']);
        echo "<div id=\"tabla\">";
          echo "<div id=\"desglose-1\">".$_REQUEST['campana']."</div>";
          echo "<div id=\"desglose-2\">".$reg['descripcion']."</div>";
          echo "<div id=\"desglose-3\">".$reg['cantidad']."</div>";
          echo "<div id=\"desglose-4\">".number_format($reg['monto'],0)."</div>";
          echo "<div id=\"desglose-5\">".$subtotal."</div>";
        echo "</div>";    
		
		}
		
		$totaliva = round(($total * 19) / 100);
		$totalivaf = number_format($totaliva,0);
		mysqli_close($conexion);
		
		?>
		<!-- Aqui capturo el valor total de la orden que me llega de la pagina anterior -->
		<?php echo "<input type=\"text\" value=\"$total\" id=\"totalhidden\" hidden=hidden>";	?>		
		
        <div id="neto">
          <p class="neto">NETO $<?php echo "<input type=\"text\" size=\"10\" value=\"$total\"  readonly>"; ?></p>
          <p class="iva">IVA $ <?php echo "<input type=\"text\" size=\"10\" value=\"$totalivaf\"  readonly>"; ?> </p>
		  <!-- OJO revisar el comportamiento del CSS en el campo del select -->
          <select id="xxx" name="xxxyyy" class="valores-select" onchange="calcular(this)">
            <option value="#" id="elija">Elija</option>
            <option value="iva" id="iva">IVA</option>
            <option value="boleta" id="boleta">10% BOLETA</option>
            <option value="#" id="exento">EXENTO DE IVA</option>
          </select>
          <p class="totality">Total $ <?php echo "<input type=\"text\" size=\"10\" value=\"\" id=\"totalfinalcampo\" readonly>"; ?></p>
          <button type="button" class="imprimir" onclick="window.print(); window.location='emision.php';">IMPRIMIR</button>
		  <!--
		  <button type="button" class="imprimir" >CANCELAR</button>
		  -->
		  <form action="cancelar.php" method="post">
			<?php echo "<input type=\"text\" name=\"ultimoid\" value=\"$last_id\" hidden=hidden>"; ?>		  
			<button type="submit" class="imprimir" >CANCELAR</button>
			</form>

        </div>
      </div>
    </div>
	<br><br><br><br><br><br><br><br>
</body>
</html>