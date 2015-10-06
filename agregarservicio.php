<!DOCTYPE html>
<html lang="es">
  <head>
  
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="tema/css/prueba.css">	
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="tema/js/scripts.js"></script>
	
	
	

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="js/typeahead.min.js"></script>
	<script src="js/tipeo.js"></script>  
	<!-- Nuevos Scripts Mas Nuevos 
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">	
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>	      
	<script src="js/calendario.js"></script>		
	<script language="javascript" type="text/javascript" src="js/agregatexto.js"></script>	
  
	<script>
    $(function() {
		//---- Tabla carga de manera oculta ----
	
		//---- Fila 2 ----
		$("#campo2").hide();
		$("#campo2-b").hide();
		$("#campo2-c").hide();
		$("#boton2").hide();
		$("#boton2-e").hide();
		$("#label-1").hide();
		$("#label-2").hide();
		$("#label-3").hide();
		
		//---- Fila 3 ----
		$("#campo3").hide();
		$("#campo3-b").hide();
		$("#campo3-c").hide();
		$("#boton3").hide();
		$("#boton3-e").hide();
		$("#label-4").hide();
		$("#label-5").hide();
		$("#label-6").hide();
		
		//---- Fila 4 ----
		$("#campo4").hide();
		$("#campo4-b").hide();
		$("#campo4-c").hide();
		$("#boton4").hide();
		$("#boton4-e").hide();
		$("#label-7").hide();
		$("#label-8").hide();
		$("#label-9").hide();
		
		//---- Fila 5 ----
		$("#campo5").hide();
		$("#campo5-b").hide();
		$("#campo5-c").hide();
		$("#boton5").hide();
		$("#boton5-e").hide();
		$("#label-10").hide();
		$("#label-11").hide();
		$("#label-12").hide();
		
		//---- Fila 6 ----
		$("#campo6").hide();
		$("#campo6-b").hide();
		$("#campo6-c").hide();
		$("#boton6").hide();
		$("#boton6-e").hide();
		$("#label-13").hide();
		$("#label-14").hide();
		$("#label-15").hide();
		
		//---- Fila 7 ----
		$("#campo7").hide();
		$("#campo7-b").hide();
		$("#campo7-c").hide();
		$("#boton7").hide();
		$("#boton7-e").hide();
		$("#label-16").hide();
		$("#label-17").hide();
		$("#label-18").hide();
		
		// ---- Boton MOSTRAR 2 ----
        $('#boton1').click(function() {
          //$('p').toggle;
          $("#campo2").toggle();		  
		  $("#campo2-b").toggle();
		  $("#campo2-c").toggle();
		  $("#boton2").toggle();
		  $("#boton2-e").toggle();	
		  $("#label-1").toggle();	
		  $("#label-2").toggle();	
		  $("#label-3").toggle();	
        });
		
		// ---- Boton OCULTAR 2 ----
		$('#boton2-e').click(function() {
		$("#campo2").hide();				
			document.getElementById("campo2").value = '';
		$("#campo2-b").hide();
			document.getElementById("campo2-b").value = '';
		$("#campo2-c").hide();
			document.getElementById("campo2-c").value = '';
		$("#boton2").hide();
		$("#boton2-e").hide();
		$("#label-1").hide();	
		$("#label-2").hide();	
		$("#label-3").hide();
		
		
		});
		
		// ---- Boton MOSTRAR 3 ----
        $('#boton2').click(function() {
          //$('p').toggle;
          $("#campo3").toggle();		  
		  $("#campo3-b").toggle();
		  $("#campo3-c").toggle();
		  $("#boton3").toggle();
		  $("#boton3-e").toggle();	
		  $("#label-4").toggle();	
		  $("#label-5").toggle();	
		  $("#label-6").toggle();	
        });
		
		// ---- Boton OCULTAR 3 ----
		$('#boton3-e').click(function() {
		$("#campo3").hide();				
			document.getElementById("campo3").value = '';
		$("#campo3-b").hide();
			document.getElementById("campo3-b").value = '';
		$("#campo3-c").hide();
			document.getElementById("campo3-c").value = '';
		$("#boton3").hide();
		$("#boton3-e").hide();
		$("#label-4").hide();	
		$("#label-5").hide();	
		$("#label-6").hide();	
		});
		
		// ---- Boton MOSTRAR 4 ----
        $('#boton3').click(function() {
          //$('p').toggle;
          $("#campo4").toggle();		  
		  $("#campo4-b").toggle();
		  $("#campo4-c").toggle();
		  $("#boton4").toggle();
		  $("#boton4-e").toggle();	
		  $("#label-7").toggle();	
		  $("#label-8").toggle();	
		  $("#label-9").toggle();	
        });
		
		// ---- Boton OCULTAR 4 ----
		$('#boton4-e').click(function() {
		$("#campo4").hide();				
			document.getElementById("campo4").value = '';
		$("#campo4-b").hide();
			document.getElementById("campo4-b").value = '';
		$("#campo4-c").hide();
			document.getElementById("campo4-c").value = '';
		$("#boton4").hide();
		$("#boton4-e").hide();
		$("#label-7").hide();	
		$("#label-8").hide();	
		$("#label-9").hide();	
		});
		
		// ---- Boton MOSTRAR 5 ----
        $('#boton4').click(function() {
          //$('p').toggle;
          $("#campo5").toggle();		  
		  $("#campo5-b").toggle();
		  $("#campo5-c").toggle();
		  $("#boton5").toggle();
		  $("#boton5-e").toggle();	
		  $("#label-10").toggle();	
		  $("#label-11").toggle();	
		  $("#label-12").toggle();	
        });
		
		// ---- Boton OCULTAR 5 ----
		$('#boton5-e').click(function() {
		$("#campo5").hide();				
			document.getElementById("campo5").value = '';
		$("#campo5-b").hide();
			document.getElementById("campo5-b").value = '';
		$("#campo5-c").hide();
			document.getElementById("campo5-c").value = '';
		$("#boton5").hide();
		$("#boton5-e").hide();
		$("#label-10").hide();	
		$("#label-11").hide();	
		$("#label-12").hide();	
		});
		
		// ---- Boton MOSTRAR 6 ----
        $('#boton5').click(function() {
          //$('p').toggle;
          $("#campo6").toggle();		  
		  $("#campo6-b").toggle();
		  $("#campo6-c").toggle();
		  $("#boton6").toggle();
		  $("#boton6-e").toggle();	
		  $("#label-13").toggle();	
		  $("#label-14").toggle();	
		  $("#label-15").toggle();	
        });
		
		// ---- Boton OCULTAR 6 ----
		$('#boton6-e').click(function() {
		$("#campo6").hide();				
			document.getElementById("campo6").value = '';
		$("#campo6-b").hide();
			document.getElementById("campo6-b").value = '';
		$("#campo6-c").hide();
			document.getElementById("campo6-c").value = '';
		$("#boton6").hide();
		$("#boton6-e").hide();
		$("#label-13").hide();	
		$("#label-14").hide();	
		$("#label-15").hide();	
		});
		
		// ---- Boton MOSTRAR 7 ----
        $('#boton6').click(function() {
          //$('p').toggle;
          $("#campo7").toggle();		  
		  $("#campo7-b").toggle();
		  $("#campo7-c").toggle();
		  $("#boton7").toggle();
		  $("#boton7-e").toggle();	
		  $("#label-16").toggle();	
		  $("#label-17").toggle();	
		  $("#label-18").toggle();	
        });
		
		// ---- Boton OCULTAR 7 ----
		$('#boton7-e').click(function() {
		$("#campo7").hide();				
			document.getElementById("campo7").value = '';
		$("#campo7-b").hide();
			document.getElementById("campo7-b").value = '';
		$("#campo7-c").hide();
			document.getElementById("campo7-c").value = '';
		$("#boton7").hide();
		$("#boton7-e").hide();
		$("#label-16").hide();	
		$("#label-17").hide();	
		$("#label-18").hide();	
		});
		
	});
    </script>
	
	<script type = "text/javascript" >
		history.pushState(null, null, 'agregarservicio.php');
		window.addEventListener('popstate', function(event) {
			history.pushState(null, null, 'agregarservicio.php');
		});
    </script>
	
		
	
  </head>
  <body>
	<?php
		$rut = $_REQUEST['rut-send'];
		//echo "la variable rut lleva: ".$rut;		
		$razon_social = $_REQUEST['razon_social-send'];
		$giro = $_REQUEST['giro-send'];
		$direccion = $_REQUEST['direccion-send'];
		$telefono = $_REQUEST['telefono-send'];
		$contacto = $_REQUEST['contacto-send'];
		$fecha_documento = $_REQUEST['fecha_documento'];
		$campana = $_REQUEST['campana'];
		$jefe_autorizacion = $_REQUEST['jefe_autorizacion'];
		$nro_presupuesto = $_REQUEST['nro_presupuesto'];
		$nro_factura = $_REQUEST['nro_factura'];
		$area_pago = $_REQUEST['area_pago'];
		//echo "Esto lleva area pago: ".$area_pago;
		//echo $_REQUEST['rut-send'];
		//$selected = $_POST['select'];
		
	?>
	
	<header class="grupo">
      <div class="caja base-50 no-padding">
        <h1> <a href="#" class="logo"> <img src="tema/img/logo.jpg" alt="POC"></a></h1>
      </div>
      <div class="caja base-50 no-padding">
        <nav>
          <ul>
			<!--
            <li> <a href="#" class="active">Emisor de ódenes de compra</a></li>
			-->
            <li> <a href="perfil-sap.php" >Historial de órdenes</a></li>
			<li> </li>
			<li> </li>
			<li> </li>
			<li> </li>
			<li> </li>
			<li> <a href="#" class="active" >Por revisar</a></li>
          </ul>
        </nav>
        <div class="counter">15</div>
      </div>
      <div class="caja base-100 no-padding">
        <h2>Bienvenido al nuevo sistema de emisión de órdenes de compra.</h2>
        <p>Utiliza esta plataforma y ahorra tiempo. Para comenzar llena los campos obligatorios.</p>
      </div>
    </header>
	
	<div id="data--input" class="grupo">
      <h3>Emisión Orden de Compra</h3>
    </div>
    <div class="grupo no-padding">
      <div class="caja base-100">
        <form id="search-form" method="POST" action="" class="info--cliente" name="myform" onsubmit="return validateForm()">
		<button type="submit" value="Buscar" name="buscar" hidden=hidden></button>
          <div class="caja base-20">
            <label>Ingrese proveedor *</label>
			<!-- autocomplete="off" spellcheck="false" 
			evento para cargar datos luego del click onmousedown="document.forms['search-form'].submit();"
			-->
            <input type="text" size="40" name="typeahead" value="<?php echo isset($_POST['typeahead']) ? $_POST['typeahead'] : '' ?>" class="typeahead tt-query" placeholder="Campo obligatorio" readonly>
          </div>		  
          <div class="caja base-20">
            <label>Rut</label>
			<?php echo "<input type=\"text\" name=\"rut-send\" value=\"$rut\" readonly>";	?>					
          </div>
          <div class="caja base-20">
            <label>Razón social</label>
            <?php echo "<input type=\"text\" value=\"$razon_social\" readonly>";	?>
          </div>
          <div class="caja base-20">
            <label>Giro</label>
            <?php echo "<input type=\"text\" value=\"$giro\" readonly>"; ?>
          </div>
          <div class="caja base-20">
            <label>Dirección</label>
            <?php echo "<input type=\"text\" value=\"$direccion\" readonly>"; ?>
          </div>
          <div class="caja base-20">
            <label>Teléfono</label>
            <?php echo "<input type=\"text\" value=\"$telefono\" readonly>"; ?>
          </div>
          <div class="caja base-20">
            <label>Contacto</label>
            <?php echo "<input type=\"text\" value=\"$contacto\" readonly>"; ?>
          </div>
          <div class="caja base-20">
            <label>Fecha documento</label>
            <!--     <input type="text" name="fecha_documento" id="datepicker" >     -->
			<?php echo "<input type=\"text\" name=\"fecha_documento\" value=\"$fecha_documento\" readonly>"; ?>
          </div>
          <div class="caja base-20">
            <label>Campaña*</label>
            <!--      <input type="text" name="campana">     -->
			<?php echo "<input type=\"text\" name=\"campana\" value=\"$campana\" readonly>"; ?>
          </div>
		   <div class="caja base-20">
            <label>Jefe de autorización</label>
            <!--      <input type="text" name="jefe_autorizacion">   -->
			<?php echo "<input type=\"text\" name=\"jefe_autorizacion\" value=\"$jefe_autorizacion\" readonly>"; ?>
          </div>
		  <div class="caja base-20">
            <label>Nº Presupuesto proveedor</label>
            <!--     <input type="text" name="nro_presupuesto">    -->
			<?php echo "<input type=\"text\" name=\"nro_presupuesto\" value=\"$nro_presupuesto\" readonly>"; ?>
          </div>
          <div class="caja base-20">
            <label>Nº Factura proveedor</label>
            <!--    <input type="text" name="nro_factura">    -->
			<?php echo "<input type=\"text\" name=\"nro_factura\" value=\"$nro_factura\" readonly>"; ?>
          </div>
		  
		  <div class="caja base-20">
		  
		  </div>
		  
		  <div class="caja base-20">
		  
		  </div>
		  
		  <div class="caja base-20">
				<button type="submit" class="generar" formaction="orden-compra.php">GENERAR OC</button>
			</div>
		  
		  <?php echo "<input type=\"hidden\" name=\"area_pagoland_send\" value=\"$area_pago\">"; ?>
		  <!-- reojete reojete reojete desaparecer esto de aqui y meterlo a BD 
          <div class="caja base-20">
            <label>Área de pago</label>
              <select id="xxx" name="area_pagoland" class="pago">   			
              <option value="#">Elija</option>
              <option value="CEE1007700">Marketing Institucional</option>  
              <option value="CEE1007700">Marketing Construcción</option>   			  
              <option value="CEE1007700">Marketing Hogar</option>
			  <option value="CEE1007700">Marketing Regional</option>
			  <option value="CEE1007752">Mundo Experto</option>
			  <option value="CEE1008800">MKT Digital</option>
			  <option value="CEE1008800">e-commerce</option>
			  <option value="CEE1007701">Visual</option>
			  <option value="CEE1007702 ">Catálogos</option>
            </select>
            <label> </label>            
          </div>
		   reojete reojete reojete desaparecer esto de aqui y meterlo a BD -->
		  
		  
			<!--- --- Servicio 01  --- --->	
		   <div class="caja base-100">
			  <div class="caja base-20">
				<label>Descripción del servicio</label>				
				<input id="campo1" type="text" name="descripcion1" value="">
			  </div>
			  <div class="caja base-20">
				<label>Cantidad</label>				
				<input id="campo1-b" type="text" name="cantidad1" value="">
			  </div>
			  <div class="caja base-20">
				<label>Monto neto</label>				
				<input id="campo1-c" type="text" name="valor1" value="">										
			  </div>			  			 
			  <div class="caja base-20" style="margin-top: 52px;">							
				<button type="button" id="boton1" >Agregar</button>				
			  </div>
			  <div class="caja base-20">							
			  </div>			  
			</div>	
			
			<!--- ---  Servicio 02 ---  --->	
			<div class="caja base-100">
			  <div class="caja base-20">
				<label id="label-1">Descripción del servicio</label>				
				<input id="campo2" type="text" name="descripcion2" value="">
			  </div>
			  <div class="caja base-20">
				<label id="label-2">Cantidad</label>				
				<input id="campo2-b" type="text" name="cantidad2" value="">
			  </div>
			  <div class="caja base-20">
				<label id="label-3">Monto neto</label>				
				<input id="campo2-c" type="text" name="valor2" value="">										
			  </div>			  			 
			  <div class="caja base-20" style="margin-top: 52px;">							
				<button type="button" id="boton2" >Agregar</button>
				<button type="button" id="boton2-e" >Eliminar</button>				
			  </div>
			  <div class="caja base-20">							
			  </div>			  
			</div>
			
			<!--- ---  Servicio 03 ---  --->	
			<div class="caja base-100">
			  <div class="caja base-20">
				<label id="label-4">Descripción del servicio</label>				
				<input id="campo3" type="text" name="descripcion3" value="">
			  </div>
			  <div class="caja base-20">
				<label id="label-5">Cantidad</label>				
				<input id="campo3-b" type="text" name="cantidad3" value="">
			  </div>
			  <div class="caja base-20">
				<label id="label-6">Monto neto</label>				
				<input id="campo3-c" type="text" name="valor3" value="">										
			  </div>			  			 
			  <div class="caja base-20" style="margin-top: 52px;">							
				<button type="button" id="boton3" >Agregar</button>
				<button type="button" id="boton3-e" >Eliminar</button>				
			  </div>
			  <div class="caja base-20">							
			  </div>			  
			</div>
			
			<!--- ---  Servicio 04 ---  --->	
			<div class="caja base-100">
			  <div class="caja base-20">
				<label id="label-7">Descripción del servicio</label>				
				<input id="campo4" type="text" name="descripcion4" value="">
			  </div>
			  <div class="caja base-20">
				<label id="label-8">Cantidad</label>				
				<input id="campo4-b" type="text" name="cantidad4" value="">
			  </div>
			  <div class="caja base-20">
				<label id="label-9">Monto neto</label>				
				<input id="campo4-c" type="text" name="valor4" value="">										
			  </div>			  			 
			  <div class="caja base-20" style="margin-top: 52px;">							
				<button type="button" id="boton4" >Agregar</button>
				<button type="button" id="boton4-e" >Eliminar</button>				
			  </div>
			  <div class="caja base-20">							
			  </div>			  
			</div>
			
			<!--- ---  Servicio 05 ---  --->	
			<div class="caja base-100">
			  <div class="caja base-20">
				<label id="label-10">Descripción del servicio</label>				
				<input id="campo5" type="text" name="descripcion5" value="">
			  </div>
			  <div class="caja base-20">
				<label id="label-11">Cantidad</label>				
				<input id="campo5-b" type="text" name="cantidad5" value="">
			  </div>
			  <div class="caja base-20">
				<label id="label-12">Monto neto</label>				
				<input id="campo5-c" type="text" name="valor5" value="">										
			  </div>			  			 
			  <div class="caja base-20" style="margin-top: 52px;">							
				<button type="button" id="boton5" >Agregar</button>
				<button type="button" id="boton5-e" >Eliminar</button>				
			  </div>
			  <div class="caja base-20">							
			  </div>			  
			</div>
			
			<!--- ---  Servicio 06 ---  --->	
			<div class="caja base-100">
			  <div class="caja base-20">
				<label id="label-13">Descripción del servicio</label>				
				<input id="campo6" type="text" name="descripcion6" value="">
			  </div>
			  <div class="caja base-20">
				<label id="label-14">Cantidad</label>				
				<input id="campo6-b" type="text" name="cantidad6" value="">
			  </div>
			  <div class="caja base-20">
				<label id="label-15">Monto neto</label>				
				<input id="campo6-c" type="text" name="valor6" value="">										
			  </div>			  			 
			  <div class="caja base-20" style="margin-top: 52px;">							
				<button type="button" id="boton6" >Agregar</button>
				<button type="button" id="boton6-e" >Eliminar</button>				
			  </div>
			  <div class="caja base-20">							
			  </div>			  
			</div>
			
			<!--- ---  Servicio 07 ---  --->
			<div class="caja base-100">
			  <div class="caja base-20">
				<label id="label-16">Descripción del servicio</label>				
				<input id="campo7" type="text" name="descripcion7" value="">
			  </div>
			  <div class="caja base-20">
				<label id="label-17">Cantidad</label>				
				<input id="campo7-b" type="text" name="cantidad7" value="">
			  </div>
			  <div class="caja base-20">
				<label id="label-18">Monto neto</label>				
				<input id="campo7-c" type="text" name="valor7" value="">										
			  </div>			  			 
			  <div class="caja base-20" style="margin-top: 52px;">							
				<button type="button" id="boton7" >Agregar</button>
				<button type="button" id="boton7-e" >Eliminar</button>				
			  </div>
			  <div class="caja base-20">							
			  </div>			  
			</div>
									
			
        </form>		
      </div>
    </div>
	
  </body>
</html>

<!-- pagina de agregar servicio -->