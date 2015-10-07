<!DOCTYPE html>
<html lang="es">
  <head>
    <title> </title>
	<!--
    <meta charset="utf-8">
	-->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="tema/css/estilos.css">	
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="tema/js/scripts.js"></script>
	<!-- Nuevos Scripts
	
	<link rel="stylesheet" href="tema/css/tipeo.css">
	-->
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
	
	<!-- 
	Formulario Ajax
	<script src="magic.js"></script>
	-->
		
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
		width: 396px;
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
		width: 222px;
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
	}
	</style>
	
	<script type = "text/javascript" >
		history.pushState(null, null, 'emision.php');
		window.addEventListener('popstate', function(event) {
			history.pushState(null, null, 'emision.php');
		});
    </script>
	
  </head>
  <body>
	<?php
		//header("Content-Type: text/html;charset=utf-8");
		//$conexion=mysqli_connect("localhost","pmdigita_admin","Prodigy12","pmdigita_test") or die("Problemas con la conexión");	
		$conexion=mysqli_connect("localhost","root","123","test") or die("Problemas con la conexión");		
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$revisar=mysqli_query($conexion,"select * from ordenes where visto_bueno = \"no\" AND orden_sap IS NULL OR orden_recepcion IS NULL") or
		die("Problemas en el select:".mysqli_error($conexion));
		
		$num_rows = mysqli_num_rows($revisar);
	?>
    <header class="grupo">
      <div class="caja base-50 no-padding">
        <h1> <a href="#" class="logo"> <img src="tema/img/logo.jpg" alt="POC"></a></h1>
      </div>
      <div class="caja base-50 no-padding">
      	<a class="logout" href="logout.php" >Logout</a>
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
			<li> <a href="por-revisar-sap.php" class="active" >Por revisar</a></li>
          </ul>
        </nav>
		<!--
		<div class="counter">15</div>
		-->
		<?php echo "<div class=\"counter\">$num_rows</div>"; ?>        
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
            <input type="text" size="40" name="typeahead" value="<?php echo isset($_POST['typeahead']) ? $_POST['typeahead'] : '' ?>" class="typeahead tt-query" placeholder="Campo obligatorio" >
          </div>
		  <?php
			$busqueda = "";
			if (isset($_POST['typeahead'])){
		    $busqueda = $_POST['typeahead'];
			}
			
			//echo $busqueda;			
			//$nro_orden = "142-424-555";
			$razon_social = "";
			$giro = "";
			$direccion = "";
			$telefono = "";
			$contacto = "";
			$rut = "";
			$nombre = "";
			//$con=mysqli_connect("localhost","pmdigita_admin","Prodigy12","pmdigita_test") or die("Problemas con la conexión");	
			$con=mysqli_connect("localhost","root","123","test") or die("Problemas con la conexión");		
			$acentos = $con->query("SET NAMES 'utf8'");
			
			$consulta_mysql=mysqli_query($con,"select * from proveedor where nombre = '$busqueda'") or die("Problemas en el select:");	    
			if($row=mysqli_fetch_array($consulta_mysql))
			{
			  $razon_social = $row['razon_social'];
			  $giro = $row['giro'];
			  $direccion = $row['direccion'];
			  $telefono = $row['telefono'];
			  $contacto = $row['contacto'];
			  $rut = $row['rut'];
			  $nombre = $row['nombre'];
			}
			//echo $detalle;
			//echo "la wea";		
			//echo ($razon_social);
			
		  ?>
          <div class="caja base-20">
            <label>Rut</label>
			<?php echo "<input type=\"text\" name=\"rut-send\" value=\"$rut\">";	?>					
          </div>
          <div class="caja base-20">
            <label>Razón social</label>
            <?php echo "<input type=\"text\" name=\"razon_social-send\" value=\"$razon_social\">";	?>
          </div>
          <div class="caja base-20">
            <label>Giro</label>
            <?php echo "<input type=\"text\" name=\"giro-send\" value=\"$giro\">"; ?>
          </div>
          <div class="caja base-20">
            <label>Dirección</label>
            <?php echo "<input type=\"text\" name=\"direccion-send\" value=\"$direccion\">"; ?>
          </div>
          <div class="caja base-20">
            <label>Teléfono</label>
            <?php echo "<input type=\"text\" name=\"telefono-send\" value=\"$telefono\">"; ?>
          </div>
          <div class="caja base-20">
            <label>Contacto</label>
            <?php echo "<input type=\"text\" name=\"contacto-send\" value=\"$contacto\">"; ?>
          </div>
          <div class="caja base-20">
            <label>Fecha documento</label>
            <input type="text" name="fecha_documento"  id="datepicker" >            
          </div>
          <div class="caja base-20">
            <label>Campaña*</label>			
			<!--	<input type="text" name="campana"> 	-->
			<select id="xxx" name="campana" class="pago">
              <option value="#">Elija</option>
              <option value="Actividad Digital">Actividad Digital</option>
              <option value="Actividad Interna">Actividad Interna</option>
			  <option value="Actividad Locales">Actividad Locales</option>
			  <option value="Agua Caliente">Agua Caliente</option>
			  <option value="Ahorro de Energía">Ahorro de Energía</option>
			  <option value="Ajustes Campañas">Ajustes Campañas</option>
			  <option value="Aniversario Cencosud">Aniversario Cencosud</option>
			  <option value="Auspicios">Auspicios</option>
			  <option value="Banco de Chile">Banco de Chile</option>
			  <option value="Campaña Alexis Sanchez">Campaña Alexis Sanchez</option>
			  <option value="Campaña Arauco">Campaña Arauco</option>
			  <option value="Campaña Calefacción">Campaña Calefacción</option>
			  <option value="Campaña Camping">Campaña Camping</option>
			  <option value="Campaña Eco Easy">Campaña Eco Easy</option>
			  <option value="Campaña Iluminación">Campaña Iluminación</option>
			  <option value="Campaña Muebles">Campaña Muebles</option>
			  <option value="Campaña Navidad">Campaña Navidad</option>
			  <option value="Campaña Organización">Campaña Organización</option>
			  <option value="Campaña Parrillas">Campaña Parrillas</option>
			  <option value="Campaña Seguridad">Campaña Seguridad</option>
			  <option value="Campaña Terrazas">Campaña Terrazas</option>
			  <option value="Campañas Construcción">Campañas Construcción</option>
			  <option value="Comisiones">Comisiones</option>
			  <option value="Día Del Níspero">Día Del Níspero</option>
			  <option value="Estudios">Estudios</option>
			  <option value="Eventos Comerciales">Eventos Comerciales</option>
			  <option value="Fe de erratas">Fe de erratas</option>
			  <option value="Ferretería del Experto">Ferretería del Experto</option>
			  <option value="Gasto Fijo Catálogos">Gasto Fijo Catálogos</option>
			  <option value="Guía del Experto">Guía del Experto</option>
			  <option value="Guía Jardin">Guía Jardin</option>
			  <option value="Guia Terminaciones">Guia Terminaciones</option>
			  <option value="Imperdibles">Imperdibles</option>
			  <option value="Inauguración Locales">Inauguración Locales</option>
			  <option value="Institucional">Institucional</option>
			  <option value="Liquidación">Liquidación</option>
			  <option value="Marketing Interno">Marketing Interno</option>
			  <option value="Mes del Experto">Mes del Experto</option>
			  <option value="Mes del Hogar">Mes del Hogar</option>	
			  <option value="Mundo Experto">Mundo Experto</option>
			  <option value="Ofertas Exclusivas Tarjetas">Ofertas Exclusivas Tarjetas</option>
			  <option value="Originales">Originales</option>
			  <option value="Otros Gastos Marketing">Otros Gastos Marketing</option>
			  <option value="Precios para Expertos">Precios para Expertos</option>
			  <option value="Prepárate para el invierno">Prepárate para el invierno</option>
			  <option value="Proyecto Baño y Cocina">Proyecto Baño y Cocina</option>
			  <option value="Rostros">Rostros</option>
			  <option value="RSE">RSE</option>
			  <option value="Temporada del Experto">Temporada del Experto</option>
			  <option value="Visual">Visual</option>
			  <option value="Weekend Tarjetas">Weekend Tarjetas</option>		  
            </select>
          </div>
		   <div class="caja base-20">
            <label>Autorizante</label>
            <!-- <input type="text" name="jefe_autorizacion">  -->
			<select id="" name="jefe_autorizacion" class="pago">
				<option value="Cristian Ortiz">Cristian Ortiz</option>
				<option value="Marcelo Giraldo">Marcelo Giraldo</option>
				<option value="Roberto Moore">Roberto Moore</option>												
				<option value="Sofia Pascal">Sofia Pascal</option>
				<option value="Daniela Mosquera">Daniela Mosquera</option>             			
			</select>  
          </div>
		  <div class="caja base-20">
            <label>Nº Presupuesto proveedor</label>
            <input type="text" name="nro_presupuesto">
          </div>
          <div class="caja base-20">
            <label>Nº Factura proveedor</label>
            <input type="text" name="nro_factura">
          </div>
          <div class="caja base-20">
            <label>Centro de costo</label>
            <select id="xxx" name="area_pago" class="pago">
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
			  <option value="Recupero ">Recupero</option>
			  <option value="Proveedor ">Proveedor</option>
			  <option value="Tarjetas ">Tarjetas</option>
            </select>
            <label> </label>            
          </div>
		  <!-- Colocar dos campos vacios 
		  <div class="caja base-20">
            <label>ESPACIO</label>
            <input type="text" name="nro_factura">
          </div>
		  <div class="caja base-20">
            <label>ESPACIO</label>
            <input type="text" name="nro_factura">
          </div>
		   Colocar dos campos vacios -->
          
		  <div class="caja base-20">
			<label>Registro</label>
            <select id="xxx" name="registro_gastos" class="pago">
              <option value="#">Elija</option>
			  <option value="117  Fidelidad">Acciones Captación</option>
			  <option value="117  Venta Empresa">Apoyo venta Empresa</option>
			  <option value="112  Eventos/Promociones">Art. Promo Institucionales</option>
			  <option value="112  Locales">Art. Promo Locales</option>
			  <option value="1018 Estudios de Mercado">Asesoría The Lab</option>
			  <option value="111  Eventos/Promociones">Auspicio de Evento</option>
			  <option value="111  Locales">Auspicios Locales</option>
			  <option value="113  Fidelidad">Beneficios Club</option>
			  <option value="7406 Comisiones de Agencias">Comisiones Agencias Visuales</option>
			  <option value="122  Fidelidad">Comision Agencias Fidelidad</option>
			  <option value="122  Fidelidad">Comision CG3</option>  
			  <option value="7405 Comisiones de Agencias">Comisiones Agencias Gráficas</option>
			  <option value="7407 Comisiones">Comisiones Mediaplannig</option>
			  <option value="122  Comisiones">Comisiones Agencia Creativa	</option>
			  <option value="131  Catálogos">Correo Catálogos</option>
			  <option value="874  Distribución, Inserción y Correo Impresos">Correo Volantes</option>
			  <option value="109  Visual">Decoraciones Especiales</option>
			  <option value="     Produccion Varias">Derechos Musicales Gingles</option>
			  <option value="5826 Despachos">Despachos Impresos</option>
			  <option value="5831 Despachos">Despachos materiales</option>
			  <option value="123  Visual">Diseño - Afiches (Originales POP)</option>
			  <option value="128  Produccion Varias">Diseño - Revistas (Producción)</option>
			  <option value="94	  Catálogos">Distribución Catálogos (Cruce/Cassas)</option>
			  <option value="876  Medios Varios">Elaboración de Gift Card</option>
			  <option value="90	  Catálogos">Embolsado y Otros</option>
			  <option value="1018 Estudios de Mercado">Estudios Especiales</option>
			  <option value="1018 Estudios de Mercado">Estudio Tracking de Marca</option>
			  <option value="7399 Eventos Varios">Eventos Musicales</option>
			  <option value="7398 Eventos Varios">Eventos por Concursos</option>
			  <option value="7401 Eventos Varios">Eventos por Cursos y Debates</option>
			  <option value="7400 Eventos Varios">Eventos por Desfiles</option>
			  <option value="98   Exhibición de Medios">Exhibición Prensa</option>
			  <option value="99   Exhibición de Medios">Exhibición Prensa en Revistas</option>
			  <option value="102  Exhibición de Medios">Exhibición Radio Local</option>
			  <option value="102  Exhibición de Medios">Exhibición Radio Nacional</option>
			  <option value="104  Exhibición de Medios">Exhibición Televisión</option>
			  <option value="105  Exhibición de Medios">Exhibición Televisión Cable</option>
			  <option value="107  Exhibición de Medios">Exhibición Vïa Pública</option>
			  <option value="115  Impresos">Impresión Boletín</option>
			  <option value="90	  Catálogos">Impresión Catálogos</option>
			  <option value="5825 Locales">Impresión Cuartillas/Volantes/POP Activ Locales</option>
			  <option value="7403 Eventos Promociones y POP">Impresión en PVC</option>
			  <option value="5914 Eventos Promociones y POP">Impresión Lienzos Fachada Tiendas</option>
			  <option value="118  Visual">Impresión Material POP Construcción</option>
			  <option value="118  Visual">Impresión Material POP Hogar</option>
			  <option value="204  Produccion Grafica Interna">Impresiones de Tarjetas</option>
			  <option value="115  Impresos">Impresiones Mundo Experto Volantes/mailing directo/cartas</option>
			  <option value="200  Eventos Varios">Inauguración Cocktails</option>
			  <option value="5912 Catálogos">Inserción Catálogos</option>
			  <option value="1011 Medios Digitales Internet">Internet</option>			  	  	
			  <option value="7397 Eventos Varios">Kermeses Colegios</option>
			  <option value="121  Visual">Lienzos de Fachada</option>
			  <option value="1021 Fidelidad">Mantención Base Datos</option>
			  <option value="1022 Marketing Interno">Marketing Interno</option>
			  <option value="98   Locales">Medios Locales Adicionales</option>
			  <option value="873  Rostros Celebrities">Modelos para Catálogos</option>
			  <option value="1022 Exhibición de Medios">Otros Medios</option>
			  <option value="5913 Medios Varios">Otros Medios Masivos</option>
			  <option value="5915 Produccion Varias">Otros Produccion</option>
			  <option value="5916 Produccion Varias">Producciones Fotográficas</option>
			  <option value="872  Rostros Celebrities">Rostros</option>
			  <option value="1024 Eventos Promociones y POP">POP Apertura de Local</option>
			  <option value="7402 Eventos Promociones y POP">POP Campaña</option>
			  <option value="119  Eventos Promociones y POP">POP Carteles</option>
			  <option value="5829 Eventos Promociones y POP">POP Cupones</option>
			  <option value="120  Visual">POP Decoración</option>
			  <option value="113  Eventos/Promociones">Premios</option>
			  <option value="127  Catálogos">Pre-Prensa Donnelley</option>
			  <option value="100  Produccion de Medios">Producción Auspicios (PNT)</option>
			  <option value="127  Catálogos">Producción Diseño Catálogos</option>
			  <option value="1025 Eventos/Promociones">Producción Eventos/Promo</option>
			  <option value="1025 Locales">Producción Eventos/Promo Locales</option>
			  <option value="88	  Catálogos">Producción Fotográfica Catálogos</option>
			  <option value="125  Locales">Producción Medios Locales</option>
			  <option value="129  Produccion de Medios">Producción Originales</option>
			  <option value="1015 Produccion de Medios">Producción Otros Medios</option>
			  <option value="1015 Produccion de Medios">Producción Prensa</option>
			  <option value="125  Produccion de Medios">Producción Radio</option>
			  <option value="5830 Visual">Visual</option>
			  <option value="126  Produccion de Medios">Producción Televisión</option>			  
			  <option value="1016 Produccion de Medios">Producción Vía Pública</option>
			  <option value="114  Eventos Promociones y POP">Promos Especiales</option>
			  <option value="1020 Eventos/Promociones">Promotoras</option>
			  <option value="1019 Eventos Promociones y POP">Promotoras Puntos de Venta</option>
			  <option value="89	  Medios Varios">Publicidad en Cine</option>
			  <option value="7404 Comisiones de Agencias">Publicidad No Tradicional</option>
			  <option value="102  Exhibición de Medios">Radio Regional Base</option>
			  <option value="102  Exhibición de Medios">Radio Regional Flight</option>
			  <option value="9007 Gtos de Marketing por recuperar">Recupero</option>
			  <option value="117  Fidelidad">Servicios adicionales</option>
			  <option value="5827 Eventos Promociones y POP">Uniformes Promotoras</option> 
			</select>  
			<!--	
            <label>Descripción del servicio</label>
            <input type="text" name="inputtext" class="descrip" placeholder="Agregar Servicios">
            <button type="button" data-tooltip="agregar otro servicio" class="add" onClick="addtext();" >+</button>						
			
			<input type="radio" name="placement" value="append" checked="checked" hidden="hidden">			
			<input type="radio" name="placement" value="replace" hidden="hidden">			
			<input type="text" name="outputtext" hidden="hidden">									
			-->
          </div>
          <div class="caja base-20">
			<!--
            <label>Cantidad</label>
            <input type="text" name="cantidad">
			-->
			<button type="submit" class="generar" style="margin-top: 52px;" formaction="agregarservicio.php">Agregar Servicios</button>
          </div>
		  <div class="caja base-20">
			<!--
			<button type="button"  style="margin-top: 52px;" ><a href="logout.php" >Logout</a></button>
			
			
            <label>Monto neto</label>
            <input type="text" name="monto_neto">
			<button type="submit" class="generar" formaction="orden-compra.php">GENERAR OC</button>
			-->
			
          </div>			            		 
        </form>		
      </div>
    </div>
	
	
	<!-- El boton generar OC debe guardar los datos de los campos
         para ello el action del formulario debe ir a una segunda pagina donde guardara los datos y
	     luego debe rellenar la "Orden de compra Marketing"
	-->
        
    <div id="footer" class="total">
      <div class="grupo">
        <div id="logo-footer" class="caja-50"><img src="tema/img/logo-footer.png" alt=""></div>
        <div id="copy" class="caja-50">
          <p>© 2015 Easy S.A.</p>
        </div>
      </div>
    </div>
  </body>
</html>