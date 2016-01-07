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
	
	<script type="text/javascript">
   <!--
      // Form validation code will come here.
	  
		function copy(){
			document.getElementById("textBoxId").value = document.getElementById("selectBoxId").value
		}
	  
      function validate()
      {
		
         if( document.myform.typeahead.value == "" )
         {
            alert( "Por favor ingrese un Proveedor" );
            document.myform.typeahead.focus() ;
            return false;
         }
        
         if( document.myform.fecha_documento.value == "" )
         {
            alert( "Por favor ingrese una fecha" );
            document.myform.fecha_documento.focus() ;
            return false;
         }
		 
		 /*
		 if( document.myform.nro_presupuesto.value == "" )
         {
            alert( "Por favor ingrese un número de presupuesto" );
            document.myform.nro_presupuesto.focus() ;
            return false;
         }
		 */
		 
		 if( document.myform.nro_factura.value == "" )
         {
            alert( "Por favor ingrese un número de factura" );
            document.myform.nro_factura.focus() ;
            return false;
         }
        /* 
         if( document.myForm.Zip.value == "" ||
         isNaN( document.myForm.Zip.value ) ||
         document.myForm.Zip.value.length != 5 )
         {
            alert( "Please provide a zip in the format #####." );
            document.myForm.Zip.focus() ;
            return false;
         }
         */
         if( document.myform.campana.value == "-1" )
         {
            alert( "Por favor elija una Camapaña" );
            return false;
         }
		 
		 if( document.myform.jefe_autorizacion.value == "-1" )
         {
            alert( "Por favor elija un Autorizante" );
            return false;
         }
		 
		 if( document.myform.area_pago.value == "-1" )
         {
            alert( "Por favor elija un Centro de Costo" );
            return false;
         }
		 
		 if( document.myform.registro_gastos.value == "-1" )
         {
            alert( "Por favor elija un Registro" );
            return false;
         }
		 
		 
         return( true );
      }
   //-->
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
		
		$registrosCampana=mysqli_query($conexion,"select * from campana") or
		die("Problemas en el select:".mysqli_error($conexion));
		
		$registrosRegistro=mysqli_query($conexion,"select * from registro") or
		die("Problemas en el select:".mysqli_error($conexion));
		
		$registrosCentroCosto=mysqli_query($conexion,"select * from centro_costo") or
		die("Problemas en el select:".mysqli_error($conexion));
		
		$registrosAutorizante=mysqli_query($conexion,"select * from autorizante") or
		die("Problemas en el select:".mysqli_error($conexion));
		
		$registrosControlPresupuesto=mysqli_query($conexion,"select * from control_presupuesto") or
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
            <label>Nombre proveedor *</label>
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
			$id_proveedor = "";
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
			  $id_proveedor = $row['id_proveedor'];
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
			echo "<input type=\"text\" name=\"id_proveedor_send\" value=\"$id_proveedor\" hidden=hidden>";
			
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
			<!--																						Camapaña -->
            <label>Campaña*</label>			
			<!--	<input type="text" name="campana"> 	-->
			<select name="campana" class="pago required">
              <option selected="" value="-1">Elija</option>
			  <?php
				while($reg=mysqli_fetch_array($registrosCampana)){
					$id_campana = $reg['id_campana'];
					$id = $reg['id'];
					$nombre_campana = $reg['nombre_campana'];
					echo "<option value=\"$id_campana\">($id) $nombre_campana</option>";
				}			 
			  ?>			  
            </select>
			<!--																						-------- -->
          </div>
		   <div class="caja base-20">
            <label>Autorizante</label>
            <!-- <input type="text" name="jefe_autorizacion">  -->
			<select  name="jefe_autorizacion" class="pago required">
				<option selected="" value="-1">Elija</option>				
				<?php
					while($reg=mysqli_fetch_array($registrosAutorizante)){
						$nombre_autorizante = $reg['nombre_autorizante'];
						echo "<option value=\"$nombre_autorizante\">$nombre_autorizante</option>";
					}
				?>				
			</select>  
          </div>
		  <div class="caja base-10">
            <label>Nº Presupuesto proveedor</label>
            <input type="text" name="nro_presupuesto">
          </div>
          <div class="caja base-10">
            <label>Nº &nbsp;&nbsp;&nbsp; Factura  proveedor</label>
            <input type="text" name="nro_factura">
          </div>
		  
          <div class="caja base-20">
			<!--																						Centro de costo -->
            <label>Centro de costo</label>
            <select name="area_pago" class="pago required">
              <option selected="" value="-1">Elija</option>
			  <?php
				while($reg=mysqli_fetch_array($registrosCentroCosto)){
					$id_centro_costo = $reg['id_centro_costo'];
					$descripcion = $reg['descripcion'];	
					$codigo = $reg['codigo'];
					$ceco = $reg['ceco'];
					echo "<option value=\"$id_centro_costo\">($codigo) $descripcion</option>";
				}
			  ?>
            </select>
			<!--																						----------- -->
            <label> </label>            
          </div>
		  <!--																						Control Presupuesto -->
		  <div class="caja base-20">
			<label>Control Presupuesto</label>
				<select name="control_presupuesto" class="pago required">
					<option selected="" value="-1">Elija</option>
				<?php
					while($reg=mysqli_fetch_array($registrosControlPresupuesto)){
						$id_controlP = $reg['id_controlP'];
						$id_pre = $reg['id'];	
						$control_presupuesto = $reg['control_presupuesto'];
						echo "<option value=\"$id_controlP\">($id_pre) $control_presupuesto</option>";
					}
				?>
				</select>
			<!--																						----------- -->
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
			<!--																						Registro Gasto -->
			<label>Registro</label>
            <select name="registro_gastos" class="pago required">
              <option selected="" value="-1">Elija</option>
			  <?php
				while($reg=mysqli_fetch_array($registrosRegistro)){
					$id_registro = $reg['id_registro'];
					$registro_gasto = $reg['registro_gasto'];
					$id_gas = $reg['id'];
					
					echo "<option value=\"$id_registro\">($id_gas) $registro_gasto</option>";
				}
			  ?>
			  <!--
			  agregar aqui la data de BD
			  -->
			<!--																						----------- -->  
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
			<button type="submit" class="generar" style="margin-top: 52px;" onclick="return(validate())" formaction="agregarservicio.php">Agregar Servicios</button>
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