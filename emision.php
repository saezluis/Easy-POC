<!DOCTYPE html>
<html lang="es">
  <head>
    <title> </title>
    <meta charset="utf-8">
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
		
  </head>
  <body>
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
			$con=mysqli_connect("localhost","root","123","test") or die("Problemas con la conexión");		
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
            <input type="text" name="campana">
          </div>
		   <div class="caja base-20">
            <label>Jefe de autorización</label>
            <input type="text" name="jefe_autorizacion">
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
            <label>Área de pago</label>
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
			
			<button type="button"  style="margin-top: 52px;" ><a href="logout.php" >Logout</a></button>
			
			<!--
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