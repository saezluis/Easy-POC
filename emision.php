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
              <option value="Daniela Mosquera">Daniela Mosquera</option>
              <option value="Sofia Pascal">Sofia Pascal</option>
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