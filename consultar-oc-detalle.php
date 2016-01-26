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
  </head>
  <body>
	<?php
		$nro_oc = $_GET['oc_send'];
		
		include "config.php";
		
		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$registrosOrdenes=mysqli_query($conexion,"select * from ordenes WHERE numero_orden=$nro_oc") or die("Problemas en el select:".mysqli_error($conexion));
		
	?>
    <header class="grupo">
      <div class="caja base-50 no-padding">
        <h1> <a href="administrador.php"" class="logo"> <img src="tema/img/logo.jpg" alt="POC"></a></h1>
      </div>
      <div class="caja base-50 no-padding"><a href="logout.php" class="logout">Logout</a></div>
    </header>
    <div id="data--input" class="grupo">
      <h3>Administrador</h3>
	  <h4>Consultar en detalle Orden de Compra</h4>
	  <h6><a href="consultar-oc.php">Volver</a></h6>
    </div>
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
					
					$registrosCampana=mysqli_query($conexion,"select * from campana WHERE id_campana=$campana") or die("Problemas en el select:".mysqli_error($conexion));
					
					if($regCa=mysqli_fetch_array($registrosCampana)){
						$nombre_campana = $regCa['nombre_campana'];
					}
					
					$newDate_oc = date("d-m-Y", strtotime($fecha_oc));	
					
					$registrosAreaPago=mysqli_query($conexion,"select * from centro_costo WHERE id_centro_costo=$area_pago") or die("Problemas en el select:".mysqli_error($conexion));
					
					if($regAP=mysqli_fetch_array($registrosAreaPago)){
						$descripcion = $regAP['descripcion'];
					}
					
					$registroControlPresupuesto=mysqli_query($conexion,"select * from control_presupuesto WHERE id_controlP=$control_presupuesto") or die("Problemas en el select:".mysqli_error($conexion));
					
					if($regCP=mysqli_fetch_array($registroControlPresupuesto)){
						$control_presupuesto = $regCP['control_presupuesto'];
					}
					
					$registroGasto=mysqli_query($conexion,"select * from registro WHERE id_registro=$registro_gasto") or die("Problemas en el select:".mysqli_error($conexion));
					
					if($regRG=mysqli_fetch_array($registroGasto)){
						$registro_gasto_nombre = $regRG['registro_gasto'];
					}
					
					$registroServicios=mysqli_query($conexion,"select * from servicios WHERE id_orden=$numero_orden") or die("Problemas en el select:".mysqli_error($conexion));

			
					echo "<form id=\"\" method=\"\" action=\"\" class=\"info--cliente\" style=\"background:#E8E8E8 !important;\">";
					  echo "<div class=\"caja base-25\">";
						echo "<label>Nº OC</label>";
						 echo "<input type=\"text\" value=\"$nro_oc\" readonly >";
					  echo "</div>";
					  echo "<div class=\"caja base-25\">";
						echo "<label>Nº Presupuesto</label>";
						echo "<input type=\"text\" value=\"$nro_presupuesto_proveedor\" readonly>";
					  echo "</div>";
					  echo "<div class=\"caja base-25\">";
						echo "<label>Nº Factura</label>";
						echo "<input type=\"text\" value=\"$nro_factura_proveedor\" readonly>";
					  echo "</div>";
					  echo "<div class=\"caja base-25\">";
						echo "<label>Fecha</label>";
						echo "<input type=\"text\" value=\"$newDate_oc\" readonly>";
					  echo "</div>";
					  
					  
					  echo "<div style=\"width:100%; float:left; padding:15px 0 0 15px; font-weight:bold; font-size:1.3em;\" class=\"datosTexto\">Datos Proveedor</div>";
					  echo "<div class=\"caja base-20\">";					  
						echo "<label>Nombre Fantasía *</label>";
						echo "<input type=\"text\" value=\"$nombre_proveedor\" readonly>";
					  echo "</div>";
					  echo "<div class=\"caja base-20\">";
						echo "<label>RUT</label>";
						echo "<input type=\"text\" value=\"$rut_pr\" readonly>";
					  echo "</div>";
					  echo "<div class=\"caja base-20\">";
						echo "<label>Razón social</label>";
						echo "<input type=\"text\" value=\"$razon_social\" readonly>";
					  echo "</div>";
					  echo "<div class=\"caja base-20\">";
						echo "<label>Giro</label>";
						echo "<input type=\"text\" value=\"$giro\" readonly>";
					  echo "</div>";
					  echo "<div class=\"caja base-20\">";
						echo "<label>Dirección</label>";
						echo "<input type=\"text\" value=\"$direccion\" readonly>";
					  echo "</div>";
					  echo "<div class=\"caja base-20\">";
						echo "<label>Teléfono</label>";
						echo "<input type=\"text\" value=\"$telefono\" readonly>";
					  echo "</div>";
					  echo "<div class=\"caja base-20\">";
						echo "<label>Contacto</label>";
						echo "<input type=\"text\" value=\"$contacto\" readonly>";
					  echo "</div>";
					  
					  
					  echo "<div style=\"width:100%; float:left; padding:15px 0 0 15px; font-weight:bold; font-size:1.3em;\" class=\"datosTexto\">Datos OC</div>";
					  echo "<div class=\"caja base-20\">";
						echo "<label>Campaña*</label>";
						echo "<input type=\"text\" value=\"$nombre_campana\" readonly>";
						/*
						echo "<select id=\"xxx\" name=\"xxxyyy\" class=\"pago\">";
						  echo "<option value=\"#\">elija</option>";
						  echo "<option value=\"#\">Campaña 1</option>";
						  echo "<option value=\"#\">Campaña 2</option>";
						  echo "<option value=\"#\">Campaña 3</option>";
						echo "</select>";
						*/
					  echo "</div>";
					  echo "<div class=\"caja base-20\">";
						echo "<label>Autorizante</label>";
						echo "<input type=\"text\" value=\"$jefe_autorizacion\" readonly>";
						/*
						echo "<select id=\"xxx\" name=\"xxxyyy\" class=\"pago\">";
						  echo "<option value=\"#\">elija</option>";
						  echo "<option value=\"#\">Autorizante 1</option>";
						  echo "<option value=\"#\">Autorizante 2</option>";
						  echo "<option value=\"#\">Autorizante 3</option>";
						echo "</select>";
						*/
					  echo "</div>";
					  echo "<div class=\"caja base-20\">";
						echo "<label>Centro Costo</label>";
						echo "<input type=\"text\" value=\"$descripcion\" readonly>";
						/*
						echo "<select id=\"xxx\" name=\"xxxyyy\" class=\"pago\">";
						  echo "<option value=\"#\">elija</option>";
						  echo "<option value=\"#\">Centro costo 1</option>";
						  echo "<option value=\"#\">Centro costo 2</option>";
						  echo "<option value=\"#\">Centro costo 3</option>";
						echo "</select>";
						*/
					  echo "</div>";
					  echo "<div class=\"caja base-20\">";
						echo "<label>Control Presupuesto</label>";
						echo "<input type=\"text\" value=\"$control_presupuesto\" readonly>";
						/*
						echo "<select id=\"xxx\" name=\"xxxyyy\" class=\"pago\">";
						  echo "<option value=\"#\">elija</option>";
						  echo "<option value=\"#\">Control Presupuesto 1</option>";
						  echo "<option value=\"#\">Control Presupuesto 2</option>";
						  echo "<option value=\"#\">Control Presupuesto 3</option>";
						echo "</select>";
						*/
					  echo "</div>";
					  echo "<div class=\"caja base-20\">";
						echo "<label>Regístro</label>";
						echo "<input type=\"text\" value=\"$registro_gasto_nombre\" readonly>";
						/*
						echo "<select id=\"xxx\" name=\"xxxyyy\" class=\"pago\">";
						  echo "<option value=\"#\">elija</option>";
						  echo "<option value=\"#\">Regístro 1</option>";
						  echo "<option value=\"#\">Regístro 2</option>";
						  echo "<option value=\"#\">Regístro 3</option>";
						echo "</select>";
						*/
						echo "</div>";
						
						echo "<div style=\"width:100%; float:left; padding:15px 0 0 15px; font-weight:bold; font-size:1.3em;\" class=\"datosTexto\">Servicios</div>";
						
					while($regSe=mysqli_fetch_array($registroServicios)){
						
						$descripcion = $regSe['descripcion'];
						$cantidad = $regSe['cantidad'];
						$monto = $regSe['monto'];
						
						echo "<div class=\"caja base-25\">";
							echo "<label>Cantidad</label>";
							echo "<input type=\"text\" value=\"$cantidad\" readonly>";
						echo "</div>";
						echo "<div class=\"caja base-25\">";
							echo "<label>Monto Neto</label>";
							echo "<input type=\"text\" value=\"$monto\" readonly>";
						echo "</div>";
						echo "<div class=\"caja base-50\">";
							echo "<label>Descripción Servicio</label>";
							echo "<input type=\"text\" value=\"$descripcion\" readonly>";
						echo "</div>";
					
					}
					  /*
					  echo "<div class=\"caja base-25\">";
						echo "<label>Cantidad</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  echo "<div class=\"caja base-25\">";
						echo "<label>Monto Neto</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  echo "<div class=\"caja base-50\">";
						echo "<label>Descripción Servicio</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  
					  echo "<div class=\"caja base-25\">";
						echo "<label>Cantidad</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  echo "<div class=\"caja base-25\">";
						echo "<label>Monto Neto</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  echo "<div class=\"caja base-50\">";
						echo "<label>Descripción Servicio</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  
					  echo "<div class=\"caja base-25\">";
						echo "<label>Cantidad</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  echo "<div class=\"caja base-25\">";
						echo "<label>Monto Neto</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  echo "<div class=\"caja base-50\">";
						echo "<label>Descripción Servicio</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  
					  echo "<div class=\"caja base-25\">";
						echo "<label>Cantidad</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  echo "<div class=\"caja base-25\">";
						echo "<label>Monto Neto</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  echo "<div class=\"caja base-50\">";
						echo "<label>Descripción Servicio</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  
					  echo "<div class=\"caja base-25\">";
						echo "<label>Cantidad</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  echo "<div class=\"caja base-25\">";
						echo "<label>Monto Neto</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  echo "<div class=\"caja base-50\">";
						echo "<label>Descripción Servicio</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  
					  echo "<div class=\"caja base-25\">";
						echo "<label>Cantidad</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  echo "<div class=\"caja base-25\">";
						echo "<label>Monto Neto</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  echo "<div class=\"caja base-50\">";
						echo "<label>Descripción Servicio</label>";
						echo "<input type=\"text\">";
					  echo "</div>";
					  */
					  
					  /*
					  echo "<div style=\"float:left; padding:15px 0 0 15px; margin-top:15px;\" class=\"cancela-guarda\">";
						echo "<input type=\"submit\" value=\"Guardar\" style=\"margin-right:10px;\">";
						echo "<input type=\"submit\" value=\"Cancelar\" formaction=\"consultar-oc.php\">";
					  echo "</div>";
					  */
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