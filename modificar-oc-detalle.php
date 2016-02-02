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
	</style>
	
  </head>
  <body>
	<?php
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
						
						echo "<div class=\"caja base-25\">";
							echo "<label>Cantidad</label>";
							echo "<input type=\"text\" value=\"$cantidad\" name=\"cantidad\">";
						echo "</div>";
						echo "<div class=\"caja base-25\">";
							echo "<label>Monto Neto</label>";
							echo "<input type=\"text\" value=\"$monto\" name=\"monto\" >";
						echo "</div>";
						echo "<div class=\"caja base-50\">";
							echo "<label>Descripción Servicio</label>";
							echo "<input type=\"text\" value=\"$descripcion\" name=\"descripcion\" >";
						echo "</div>";
						
						echo "<input type=\"text\" value=\"$nro_servicio\" name=\"nro_servicio\" hidden=hidden >";
					
					}
					  
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