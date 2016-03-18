<?php
  session_start();
  
  header('Cache-Control: no cache'); //no cache
  session_cache_limiter('private_no_expire');

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
	
	
	<script type = "text/javascript" >
	/*
		history.pushState(null, null, 'perfil-sap.php');
		window.addEventListener('popstate', function(event) {
			history.pushState(null, null, 'perfil-sap.php');
		});
		*/
    </script>
	
  </head>
  <body>
	
	<?php
		
		include "config.php";
		
		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
				
		
		$registros=mysqli_query($conexion,"select * from ordenes WHERE orden_sap IS NOT NULL AND orden_recepcion IS NOT NULL AND archivo='si'") or
		die("Problemas en el select:".mysqli_error($conexion));
		
		$revisar=mysqli_query($conexion,"select * from ordenes WHERE visto_bueno = \"no\" AND orden_sap IS NULL OR orden_recepcion IS NULL") or
		die("Problemas en el select:".mysqli_error($conexion));
		
		$num_rows = mysqli_num_rows($revisar);		
		
			

		//-------------- INICIO Paginador ------------------
		
		//Limito la busqueda a 10 registros por pagina
		$TAMANO_PAGINA = 20; 
		
		//examino la página a mostrar y el inicio del registro a mostrar 
		@$pagina = $_GET["pagina"]; 
		if (!$pagina) { 
			$inicio = 0; 
			$pagina=1; 
		} 
		else { 
			$inicio = ($pagina - 1) * $TAMANO_PAGINA; 
		}
		
		$num_total_registros = mysqli_num_rows($registros); 
		//calculo el total de páginas 
		$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 
		
		$ssql = "select * from ordenes WHERE orden_sap IS NOT NULL AND orden_recepcion IS NOT NULL AND archivo='si' limit " . $inicio . "," . $TAMANO_PAGINA; 
		$rs = mysqli_query($conexion,$ssql); 
		
		//-------------- FIN Paginador ------------------	
		
	?>
	
    <header class="grupo">
      <div class="caja base-50 no-padding">
        <h1> <a href="#" class="logo"> <img src="tema/img/logo.jpg" alt="POC"></a></h1>
      </div>
      <div class="caja base-50 no-padding">
		<!--
      	<a class="logout" href="logout.php" >Logout</a>
		-->
        <nav>
          <ul>
			<!--
            <li> <a href="emision.php">Emisor de órdenes de compra</a></li>
			-->
            <li> <a href="por-revisar-sap.php" class="active" >OC Por revisar</a></li>
          </ul>
        </nav>
        <?php echo "<div class=\"counter\" style=\"right: 195px; !important; \">$num_rows</div>"; ?>
      </div>
      <div class="caja base-100 no-padding">
        <h2>En esta sección podrás encontrar el historial de todas tus órdenes de compra emitidas.</h2>
      </div>
    </header>
    <div id="data--input" class="grupo">
      <h3>Historial de órdenes de compra</h3>
    </div>
    <div id="buscar" class="grupo">
      <div class="caja-80">
		<!--
        <form id="" method="POST" action="" class="seek"> 
          <input type="search" name="palabra" placeholder="ingresa número de OC">
          <button type="submit" value="buscar OC" name="buscar">buscar</button>
        </form>
		
		<form id="" method="POST" action="" class="seek"> 
          <input type="search" name="rut_proveedor" placeholder="ingresa RUT proveedor">
          <button type="submit" value="Busca_pro" name="buscar_pro" style="margin-right: 70px;">buscar</button>
        </form>
		
		<form id="" method="POST" action="" class="seek"> 
          <input type="search" name="nombre_proveedor" placeholder="ingresa nombre proveedor" size="35">
          <button type="submit" value="Busca_Npro" name="buscar_Npro" style="margin-right: 70px;">buscar</button>
        </form>
		-->
      </div>
    </div>

<?php    	
	//  ----------   A partir de este codigo se realiza la busqueda  OJO ----------
	
	
		$buscar = @$_REQUEST["palabra"];
		
		if($buscar!=''){
		
			//echo $buscar;
			//Ojo esto es para buscar una orden en especifica
			$consulta_mysql=mysqli_query($conexion,"SELECT * FROM ordenes WHERE numero_orden = '$buscar' AND orden_sap IS NOT NULL AND orden_recepcion IS NOT NULL AND archivo='si'") or				
			die("Problemas en el select:".mysqli_error($conexion));
			
			$rows_consulta = mysqli_num_rows($consulta_mysql);
			
			if($rows_consulta!=0){
		
				echo "<br>";
			
				echo "<section class=\"grupo\">";
					echo "<table class=\"table-sap\">";
						echo "<thead>";
							echo "<tr class=\"cabecc-sap\">";
								echo "<th>Nº OC</th>";
								echo "<th>Editar</th>";
								echo "<th>Fecha</th>";
								echo "<th>Código PEP</th>";
								echo "<th>OC SAP</th>";
								echo "<th><img src=\"tema/img/upload.gif\" alt=\"\" class=\"marggen-tabl\"></th>";
								echo "<th>OC Recepción</th>";
								echo "<th><img src=\"tema/img/upload.gif\" alt=\"\" class=\"marggen-tabl\"></th>";
								echo "<th><img src=\"tema/img/time.gif\" alt=\"\" class=\"marggen-tabl\"></th>";
							echo "</tr>";
						echo "</thead>";
				
				
						$n_orden2 = 1000;
						$more_foo = 2000;
				
						$dir = "uploads/";
						$items = array();
				
						// Aqui leo el contenido del directorio uploads
						if (is_dir($dir)) {
							if ($dh = opendir($dir)) {
								while (($file = readdir($dh)) !== false) {										
									$items[] = $file;					
								}
								closedir($dh);
							}
						}
						
					while($reg = mysqli_fetch_array($consulta_mysql)) {
							//Aqui se calculan los dias que van transcurriendo desde la emision de la OC
							$fecha = $reg['fecha'];		  
							$todate = date("Y-m-d",strtotime($fecha));		  
							$fecha_format = date("d-m-Y",strtotime($fecha));		  		  		  
							date_default_timezone_set('America/Santiago');
							$fromdate = date('Y-m-d', time());		  
							$calculate_seconds = strtotime($fromdate) - strtotime($todate); // Numero de segundos entre las dos fechas
							$days = floor($calculate_seconds / (24 * 60 * 60 )); // Conversion a dias	
					
					
							$n_orden = "";
							$n_orden = $reg['numero_orden'];
							$n_orden2 = $n_orden2 + 1;	
							
							$nro_orden_comp = $n_orden . ".pdf";
							
							$nro_recep_comp = $n_orden."-or".".pdf";
							
							$nro_orden_foo = $reg['numero_orden'];
							$more_foo = $more_foo + 1;
							
							//-------------------------- Creacion del codigo PEP ---------------------------------------------
							$area_pago = $reg['area_pago'];
							$registro_gasto = $reg['registro_gasto'];
							$control_presupuesto = $reg['control_presupuesto'];
							$campana = $reg['campana'];
					
							$registrosAreaPago=mysqli_query($conexion,"SELECT * FROM centro_costo WHERE id_centro_costo = $area_pago") or die ("Problemas en el select");
											
							if($reg2=mysqli_fetch_array($registrosAreaPago)){
								$codigo_areaP = $reg2['codigo'];
							}
									
							$registrosRegistro=mysqli_query($conexion,"SELECT * FROM registro WHERE id_registro = $registro_gasto") or die ("Problemas en el select");
											
							if($reg3=mysqli_fetch_array($registrosRegistro)){				
								$id_sap_RG = $reg3['id'];
							}
									
							$registrosControlPre=mysqli_query($conexion,"SELECT * FROM control_presupuesto WHERE id_controlP = $control_presupuesto") or die ("Problemas en el select");
											
							if($reg4=mysqli_fetch_array($registrosControlPre)){
								$id_cp = $reg4['id'];
							}
					
							$registrosCampana=mysqli_query($conexion,"SELECT * FROM campana WHERE id_campana = $campana") or die ("Problemas en el select");
							
							if($reg5=mysqli_fetch_array($registrosCampana)){
								$id_campana = $reg5['id'];
							}
					
							$codigoPep = $codigo_areaP."-".$id_sap_RG."-".$id_cp."-".$id_campana;			
							//-------------------------- Creacion del codigo PEP ---------------------------------------------
							
						
						echo "<tbody>";
						  echo "<tr>";
							echo "<td class=\"area\"><a href=\"consultar-orden.php?numero_orden=",urlencode($n_orden)," \">$n_orden</a></td>";	
							
							echo "<td class=\"ppto-proyecto\">";
							echo "<a href=\"modificar-oc-detalle-sap.php?oc_send=",urlencode($n_orden)," \">Editar</a>";
							echo "</td>";
							
							echo "<td class=\"ceco\">".$fecha_format."</td>";
							echo "<td class=\"desc-servicio\">".$codigoPep."</td>";
							
							//-------------- OC SAP
							echo "<td class=\"ocrecepcion\">".$reg['orden_sap']."<span style=\"float:left;\"><img src=\"tema/img/yes.gif\" alt=\"\" style=\"margin-top:3px;padding-left: 3px;\"></span><span style=\"float:right;\"> <a href=\"#$n_orden\" data-tooltip=\"Editar\" class=\"various\">  <img src=\"tema/img/edit.gif\" alt=\"\" style=\"margin-right: 3px;\">";
								  echo "<div id=\"$n_orden\" name=\"\" style=\"display: none;\">";
										echo "<form id=\"edit-recep\" method=\"POST\" action=\"grabar-orden-sap.php\">";
											echo "<h1 style=\"font-size: 1em;\">Ingresa nro OC SAP</h1>";
											echo "<input type=\"hidden\" name=\"nro_orden_send_hidden\" value=\"$reg[numero_orden]\">";
											echo "<input style=\"width: 100%; padding: 5px;\"; type=\"text\" name=\"nro_orden_send\" value=\"\">";
											echo "<button style=\"width: 100%;margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" value=\"grabar\">Grabar</button>";
										echo "</form>";
								  echo "</div></a></span></td>";
							
							if (in_array($nro_orden_comp,@$items)){
									echo "<td class=\"pep\"><a href=\"./uploads/$n_orden.pdf\" data-tooltip=\"Ver Documento\" class=\"various\" ><img src=\"tema/img/ver-doc.gif\" alt=\"\"></a>";
								}else{
									echo "<td class=\"pep\"></td>";
								}			  
							echo "</td>";
							
							//-------------- OC RECEPCION
							echo "<td class=\"ocsap\">".$reg['orden_recepcion']."<span style=\"float:left;\"><img src=\"tema/img/yes.gif\" alt=\"\" style=\"margin-top:3px;padding-left: 3px;\"></span><span style=\"float:right;\"> <a href=\"#$n_orden2\" data-tooltip=\"Editar\" class=\"various\">  <img src=\"tema/img/edit.gif\" alt=\"\" style=\"margin-right: 3px;\">";
								  echo "<div id=\"$n_orden2\" style=\"display: none;\">";
										echo "<form id=\"edit-recep\" method=\"POST\" action=\"grabar-recepcion-sap.php\">";
											echo "<h1 style=\"font-size: 1em;\">Ingresa nro OC Recepcion</h1>";
											echo "<input type=\"hidden\" name=\"nro_ordenRecep_send_hidden\" value=\"$reg[numero_orden]\">";
											echo "<input style=\"width: 100%; padding: 5px;\"; type=\"text\" name=\"nro_recepcion_send\" value=\"\">";
											echo "<button style=\"width: 100%;margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" value=\"grabar\">Grabar</button>";
										echo "</form>";
								  echo "</div></a></span></td>";
							
							if (in_array($nro_recep_comp,@$items)){
									echo "<td class=\"pep\"><a href=\"./uploads/$n_orden-or.pdf\" data-tooltip=\"Ver Documento\" class=\"various\" ><img src=\"tema/img/ver-doc.gif\" alt=\"\"></a>";
								}else{
								echo "<td class=\"pep\"></td>";
								}			  
							echo "</td>";
							
							echo "<td class=\"ppto-proyecto\">$days</td>";
							echo "<td class=\"ppto-real\">";
							echo "<form method=\"POST\" action=\"send-form.php\">";
							  echo "<button type=\"submit\" value=\"Enviar\" class=\"gou\">Enviar</button>";
							  echo "<input type=\"text\" value=\"$n_orden\" name=\"nro_OC_send\" hidden=hidden >";
							echo "</form>";  
							echo "</td>";
							
							
							
						  echo "</tr>";
						echo "</tbody>";
					}
					
					echo  "</table>";
				echo "</section>";
				
			}else{
				echo "<section class=\"grupo\">";
					echo "<h3>No se encontraron resultados con ese número de OC</h3>";
				echo "</section>";
			}
			
		}
		/*
		else{
			echo "<section class=\"grupo\">";
				echo "<h3>Debe introducir un número de OC</h3>";
			echo "</section>";
		}*/
	
	
		$buscar_rut = @$_REQUEST["rut_proveedor"];
		
		if($buscar_rut!=''){
		
			$registrosProveedor = mysqli_query($conexion,"SELECT * FROM proveedor WHERE rut = '$buscar_rut' ") or die("Problemas en el select:".mysqli_error($conexion));
			
			$num_registros_pro = mysqli_num_rows($registrosProveedor);
			
			if($num_registros_pro!=0){
				
				if($reg_pro=mysqli_fetch_array($registrosProveedor)){
					$id_proveedor = $reg_pro['id_proveedor'];
					//echo $id_proveedor;
				}

				//echo $buscar;
				//Ojo esto es para buscar una orden en especifica
				$consulta_mysql=mysqli_query($conexion,"SELECT * FROM ordenes WHERE id_proveedor = '$id_proveedor' AND orden_sap IS NOT NULL AND orden_recepcion IS NOT NULL AND archivo='si' ") or				
				die("Problemas en el select:".mysqli_error($conexion));
				
				$more_fuu = 0;
			
				echo "<section class=\"grupo\">";
					echo "<table class=\"table-sap\">";
						echo "<thead>";
							echo "<tr class=\"cabecc-sap\">";
								echo "<th>Nº OC</th>";
								echo "<th>Editar</th>";
								echo "<th>Fecha</th>";
								echo "<th>Código PEP</th>";
								echo "<th>OC SAP</th>";
								echo "<th><img src=\"tema/img/upload.gif\" alt=\"\" class=\"marggen-tabl\"></th>";
								echo "<th>OC Recepción</th>";
								echo "<th><img src=\"tema/img/upload.gif\" alt=\"\" class=\"marggen-tabl\"></th>";
								echo "<th><img src=\"tema/img/time.gif\" alt=\"\" class=\"marggen-tabl\"></th>";
							echo "</tr>";
						echo "</thead>";
					
				$n_orden2 = 10000;
				$more_fooo = 400;
				$fooo_or = 5000;
				
				while($reg = mysqli_fetch_array($consulta_mysql)) {
				
					//Aqui se calculan los dias que van transcurriendo desde la emision de la OC
					$fecha = $reg['fecha'];		  
					$todate = date("Y-m-d",strtotime($fecha));		  
					$fecha_format = date("d-m-Y",strtotime($fecha));		  		  		  
					date_default_timezone_set('America/Santiago');
					$fromdate = date('Y-m-d', time());		  
					$calculate_seconds = strtotime($fromdate) - strtotime($todate); // Numero de segundos entre las dos fechas
					$days = floor($calculate_seconds / (24 * 60 * 60 )); // Conversion a dias	
					
					$n_orden = "";
					$n_orden = $reg['numero_orden'];			
					
					$n_orden2 = $n_orden2 + 1;		

					$nro_orden_fooo = $reg['numero_orden'];
					$more_fooo = $more_fooo + 1;
					$fooo_or = $fooo_or + 1;
					
					//-------------------------- Creacion del codigo PEP ---------------------------------------------
					$area_pago = $reg['area_pago'];
					$registro_gasto = $reg['registro_gasto'];
					$control_presupuesto = $reg['control_presupuesto'];
					$campana = $reg['campana'];
					
					$registrosAreaPago=mysqli_query($conexion,"SELECT * FROM centro_costo WHERE id_centro_costo = $area_pago") or die ("Problemas en el select area pago");
									
					if($reg2=mysqli_fetch_array($registrosAreaPago)){
						$codigo_areaP = $reg2['codigo'];
					}
									
					$registrosRegistro=mysqli_query($conexion,"SELECT * FROM registro WHERE id_registro = $registro_gasto") or die ("Problemas en el select registro gasto");
									
					if($reg3=mysqli_fetch_array($registrosRegistro)){				
						$id_sap_RG = $reg3['id'];
					}
									
					$registrosControlPre=mysqli_query($conexion,"SELECT * FROM control_presupuesto WHERE id_controlP = $control_presupuesto") or die ("Problemas en el select control presupuesto");
									
					if($reg4=mysqli_fetch_array($registrosControlPre)){
						$id_cp = $reg4['id'];
					}
					
					$registrosCampana=mysqli_query($conexion,"SELECT * FROM campana WHERE id_campana = $campana") or die ("Problemas en el select id campana");
					
					if($reg5=mysqli_fetch_array($registrosCampana)){
						$id_campana = $reg5['id'];
					}
					
					$codigoPep = $codigo_areaP."-".$id_sap_RG."-".$id_cp."-".$id_campana;
					
					//-------------------------- Creacion del codigo PEP ---------------------------------------------
					
					echo "<tbody>";
						  echo "<tr>";
							echo "<td class=\"area\"><a href=\"consultar-orden.php?numero_orden=",urlencode($n_orden)," \">$n_orden</a></td>";		
							
							echo "<td class=\"ppto-proyecto\">";
							echo "<a href=\"modificar-oc-detalle-sap.php?oc_send=",urlencode($n_orden)," \">Editar</a>";
							echo "</td>";
							
							echo "<td class=\"ceco\">".$fecha_format."</td>";					
							echo "<td class=\"desc-servicio\">$codigoPep</td>";
							
							//Modificar OC sap
							echo "<td class=\"ocsap\">".$reg['orden_sap']."<span style=\"float:left;\"></span><span style=\"float:right;\"><a href=\"#$n_orden\" data-tooltip=\"Editar\" class=\"various\"><img src=\"tema/img/edit.gif\" alt=\"\" style=\"margin-right: 3px;\">";  //<img src=\"tema/img/no.gif\" alt=\"\" style=\"margin-top:3px;padding-left: 3px;\">
								  echo "<div id=\"$n_orden\" style=\"display: none;\">";
									echo "<form id=\"edit-recep\" method=\"POST\" action=\"grabar-orden-sap-rev.php\">";
									  echo "<h1 style=\"font-size: 1em;\">Ingresa número de OC SAP</h1>";
									  echo "<input type=\"hidden\" name=\"nro_orden_send_hidden\" value=\"$reg[numero_orden]\">";
									  echo "<input type=\"hidden\" name=\"nro_orden_send_hidden\" value=\"$reg[numero_orden]\">";
									  echo "<input style=\"width: 100%; padding: 5px;\"; type=\"text\" name=\"nro_orden_send\" value=\"\">";
									  echo "<button style=\"width: 100%;margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" value=\"grabar\">Grabar</button>";
									echo "</form>";
								  echo "</div></a></span></td>";	
							
							//Uploader de archivos de OC SAP
							echo "<td class=\"pep\"><a href=\"#$more_fooo\" data-tooltip=\"Subir archivo\" class=\"various\"><img src=\"tema/img/upload.gif\" alt=\"\"></a>";					  
								echo "<div id=\"$more_fooo\" style=\"display: none;\">";					
									echo "<form id=\"upload\" action=\"getfile.php\" method=\"POST\" enctype=\"multipart/form-data\">";					
										echo "<h1 style=\"font-size: 1.5em;\">Subir un archivo</h1>";						  
										echo "<div class=\"drag-drop\" style=\"height: 100px; width: 100px; background: url(tema/img/up-hover.gif); text-align: center; color: white; position: relative; margin: 0 auto 1em; padding: 1em;\">";	
										echo "<input style=\"height: 100px;opacity: 0;position: absolute;top: 0;left: 0;width: 100%; cursor:pointer; z-index: 3;\" id=\"file\" name=\"userfile\" type=\"file\">";					
								echo "</div>";
										echo "<button style=\"width: 95%; text-align:center; margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" name=\"upload\" value=\"upload\" class=\"acept\">Aceptar</button>";
										echo "<input type=\"text\" name=\"nro_orden_form\" value=\"$nro_orden_fooo\" hidden=hidden>";
									echo "</form>";
								echo "</div>";										
							echo "</td>";
							
							//Modificar numero de OC Recepcion
							echo "<td class=\"ocrecepcion\">".$reg['orden_recepcion']."<span style=\"float:left;\"></span><span style=\"float:right;\"><a href=\"#$n_orden2\" data-tooltip=\"Editar\" class=\"various\"><img src=\"tema/img/edit.gif\" alt=\"\" style=\"margin-right: 3px;\">"; //<img src=\"tema/img/yes.gif\" alt=\"\" style=\"margin-top:3px;padding-left: 3px;\">
								  echo "<div id=\"$n_orden2\" style=\"display: none;\">";
									echo "<form id=\"edit-recep\" method=\"POST\" action=\"grabar-recepcion-sap-rev.php\">";
									  echo "<h1 style=\"font-size: 1em;\">Ingresa número de OC RECEPCION</h1>";
									  echo "<input type=\"hidden\" name=\"nro_ordenRecep_send_hidden\" value=\"$reg[numero_orden]\" >";
									  echo "<input style=\"width: 100%; padding: 5px;\"; type=\"text\" name=\"nro_recepcion_send\" value=\"\">";
									  echo "<button style=\"width: 100%;margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" value=\"grabar\">Grabar</button>";
									echo "</form>";
								 echo "</div></a></span></td>";
							
							//aqui debo construir el segundo uploader de archivos, pero este sube OC recepcion
							echo "<td class=\"pep\"><a href=\"#$fooo_or\" data-tooltip=\"Subir archivo\" class=\"various\"><img src=\"tema/img/upload.gif\" alt=\"\"></a>";					  
								echo "<div id=\"$fooo_or\" style=\"display: none;\">";					
									echo "<form id=\"upload\" action=\"getfile-or.php\" method=\"POST\" enctype=\"multipart/form-data\">";					
										echo "<h1 style=\"font-size: 1.5em;\">Subir un archivo</h1>";						  
										echo "<div class=\"drag-drop\" style=\"height: 100px; width: 100px; background: url(tema/img/up-hover.gif); text-align: center; color: white; position: relative; margin: 0 auto 1em; padding: 1em;\">";	
										echo "<input style=\"height: 100px;opacity: 0;position: absolute;top: 0;left: 0;width: 100%; cursor:pointer; z-index: 3;\" id=\"file\" name=\"userfile\" type=\"file\">";					
								echo "</div>";
										echo "<button style=\"width: 95%; text-align:center; margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" name=\"upload\" value=\"upload\" class=\"acept\">Aceptar</button>";
										echo "<input type=\"text\" name=\"nro_orden_form\" value=\"$nro_orden_fooo\" hidden=hidden>";
									echo "</form>";
								echo "</div>";										
							echo "</td>";
							
							  echo "</div>";
							  echo "</td>";
							echo "<td class=\"ppto-proyecto\">$days</td>";
						  echo "</tr>";
					echo "</tbody>";
				
				
				}			
				echo "</table>";
				echo "</section>";
				
			}else{
				echo "<section class=\"grupo\">";
					echo "<h3>No se encontraron resultados con ese número de Rut</h3>";
				echo "</section>";
			}
			
		}
		/*
		else{
			echo "<section class=\"grupo\">";
				echo "<h3>Debe introducir un número de Rut</h3>";
			echo "</section>";
		}*/
	
	
	
		$buscar_nombre = @$_REQUEST["nombre_proveedor"];
		
		if($buscar_nombre!=''){
		
			$registrosProveedor = mysqli_query($conexion,"SELECT * FROM proveedor WHERE nombre like '%$buscar_nombre%' ") or die("Problemas en el select:".mysqli_error($conexion));
			
			$num_registros_pro = mysqli_num_rows($registrosProveedor);
			
			if($num_registros_pro!=0){
				
				if($reg_pro=mysqli_fetch_array($registrosProveedor)){
					$id_proveedor = $reg_pro['id_proveedor'];
					//echo $id_proveedor;
				}

				//echo $buscar;
				//Ojo esto es para buscar una orden en especifica
				$consulta_mysql=mysqli_query($conexion,"SELECT * FROM ordenes WHERE id_proveedor = '$id_proveedor' AND orden_sap IS NOT NULL AND orden_recepcion IS NOT NULL AND archivo='si'  ") or				
				die("Problemas en el select:".mysqli_error($conexion));
				
				$more_fuu = 0;
			
				echo "<section class=\"grupo\">";
					echo "<table class=\"table-sap\">";
						echo "<thead>";
							echo "<tr class=\"cabecc-sap\">";
								echo "<th>Nº OC</th>";
								echo "<th>Editar</th>";
								echo "<th>Fecha</th>";
								echo "<th>Código PEP</th>";
								echo "<th>OC SAP</th>";
								echo "<th><img src=\"tema/img/upload.gif\" alt=\"\" class=\"marggen-tabl\"></th>";
								echo "<th>OC Recepción</th>";
								echo "<th><img src=\"tema/img/upload.gif\" alt=\"\" class=\"marggen-tabl\"></th>";
								echo "<th><img src=\"tema/img/time.gif\" alt=\"\" class=\"marggen-tabl\"></th>";
							echo "</tr>";
						echo "</thead>";
					
				$n_orden2 = 10000;
				$more_fooo = 400;
				$fooo_or = 5000;
				
				while($reg = mysqli_fetch_array($consulta_mysql)) {
				
					//Aqui se calculan los dias que van transcurriendo desde la emision de la OC
					$fecha = $reg['fecha'];		  
					$todate = date("Y-m-d",strtotime($fecha));		  
					$fecha_format = date("d-m-Y",strtotime($fecha));		  		  		  
					date_default_timezone_set('America/Santiago');
					$fromdate = date('Y-m-d', time());		  
					$calculate_seconds = strtotime($fromdate) - strtotime($todate); // Numero de segundos entre las dos fechas
					$days = floor($calculate_seconds / (24 * 60 * 60 )); // Conversion a dias	
					
					$n_orden = "";
					$n_orden = $reg['numero_orden'];			
					
					$n_orden2 = $n_orden2 + 1;		

					$nro_orden_fooo = $reg['numero_orden'];
					$more_fooo = $more_fooo + 1;
					$fooo_or = $fooo_or + 1;
					
					//-------------------------- Creacion del codigo PEP ---------------------------------------------
					$area_pago = $reg['area_pago'];
					$registro_gasto = $reg['registro_gasto'];
					$control_presupuesto = $reg['control_presupuesto'];
					$campana = $reg['campana'];
					
					$registrosAreaPago=mysqli_query($conexion,"SELECT * FROM centro_costo WHERE id_centro_costo = $area_pago") or die ("Problemas en el select area pago");
									
					if($reg2=mysqli_fetch_array($registrosAreaPago)){
						$codigo_areaP = $reg2['codigo'];
					}
									
					$registrosRegistro=mysqli_query($conexion,"SELECT * FROM registro WHERE id_registro = $registro_gasto") or die ("Problemas en el select registro gasto");
									
					if($reg3=mysqli_fetch_array($registrosRegistro)){				
						$id_sap_RG = $reg3['id'];
					}
									
					$registrosControlPre=mysqli_query($conexion,"SELECT * FROM control_presupuesto WHERE id_controlP = $control_presupuesto") or die ("Problemas en el select control presupuesto");
									
					if($reg4=mysqli_fetch_array($registrosControlPre)){
						$id_cp = $reg4['id'];
					}
					
					$registrosCampana=mysqli_query($conexion,"SELECT * FROM campana WHERE id_campana = $campana") or die ("Problemas en el select id campana");
					
					if($reg5=mysqli_fetch_array($registrosCampana)){
						$id_campana = $reg5['id'];
					}
					
					$codigoPep = $codigo_areaP."-".$id_sap_RG."-".$id_cp."-".$id_campana;
					
					//-------------------------- Creacion del codigo PEP ---------------------------------------------
					
					echo "<tbody>";
						  echo "<tr>";
							echo "<td class=\"area\"><a href=\"consultar-orden.php?numero_orden=",urlencode($n_orden)," \">$n_orden</a></td>";		
							
							echo "<td class=\"ppto-proyecto\">";
							echo "<a href=\"modificar-oc-detalle-sap.php?oc_send=",urlencode($n_orden)," \">Editar</a>";
							echo "</td>";
							
							echo "<td class=\"ceco\">".$fecha_format."</td>";					
							echo "<td class=\"desc-servicio\">$codigoPep</td>";
							
							//Modificar OC sap
							echo "<td class=\"ocsap\">".$reg['orden_sap']."<span style=\"float:left;\"></span><span style=\"float:right;\"><a href=\"#$n_orden\" data-tooltip=\"Editar\" class=\"various\"><img src=\"tema/img/edit.gif\" alt=\"\" style=\"margin-right: 3px;\">";  //<img src=\"tema/img/no.gif\" alt=\"\" style=\"margin-top:3px;padding-left: 3px;\">
								  echo "<div id=\"$n_orden\" style=\"display: none;\">";
									echo "<form id=\"edit-recep\" method=\"POST\" action=\"grabar-orden-sap-rev.php\">";
									  echo "<h1 style=\"font-size: 1em;\">Ingresa número de OC SAP</h1>";
									  echo "<input type=\"hidden\" name=\"nro_orden_send_hidden\" value=\"$reg[numero_orden]\">";
									  echo "<input type=\"hidden\" name=\"nro_orden_send_hidden\" value=\"$reg[numero_orden]\">";
									  echo "<input style=\"width: 100%; padding: 5px;\"; type=\"text\" name=\"nro_orden_send\" value=\"\">";
									  echo "<button style=\"width: 100%;margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" value=\"grabar\">Grabar</button>";
									echo "</form>";
								  echo "</div></a></span></td>";	
							
							//Uploader de archivos de OC SAP
							echo "<td class=\"pep\"><a href=\"#$more_fooo\" data-tooltip=\"Subir archivo\" class=\"various\"><img src=\"tema/img/upload.gif\" alt=\"\"></a>";					  
								echo "<div id=\"$more_fooo\" style=\"display: none;\">";					
									echo "<form id=\"upload\" action=\"getfile.php\" method=\"POST\" enctype=\"multipart/form-data\">";					
										echo "<h1 style=\"font-size: 1.5em;\">Subir un archivo</h1>";						  
										echo "<div class=\"drag-drop\" style=\"height: 100px; width: 100px; background: url(tema/img/up-hover.gif); text-align: center; color: white; position: relative; margin: 0 auto 1em; padding: 1em;\">";	
										echo "<input style=\"height: 100px;opacity: 0;position: absolute;top: 0;left: 0;width: 100%; cursor:pointer; z-index: 3;\" id=\"file\" name=\"userfile\" type=\"file\">";					
								echo "</div>";
										echo "<button style=\"width: 95%; text-align:center; margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" name=\"upload\" value=\"upload\" class=\"acept\">Aceptar</button>";
										echo "<input type=\"text\" name=\"nro_orden_form\" value=\"$nro_orden_fooo\" hidden=hidden>";
									echo "</form>";
								echo "</div>";										
							echo "</td>";
							
							//Modificar numero de OC Recepcion
							echo "<td class=\"ocrecepcion\">".$reg['orden_recepcion']."<span style=\"float:left;\"></span><span style=\"float:right;\"><a href=\"#$n_orden2\" data-tooltip=\"Editar\" class=\"various\"><img src=\"tema/img/edit.gif\" alt=\"\" style=\"margin-right: 3px;\">"; //<img src=\"tema/img/yes.gif\" alt=\"\" style=\"margin-top:3px;padding-left: 3px;\">
								  echo "<div id=\"$n_orden2\" style=\"display: none;\">";
									echo "<form id=\"edit-recep\" method=\"POST\" action=\"grabar-recepcion-sap-rev.php\">";
									  echo "<h1 style=\"font-size: 1em;\">Ingresa número de OC RECEPCION</h1>";
									  echo "<input type=\"hidden\" name=\"nro_ordenRecep_send_hidden\" value=\"$reg[numero_orden]\" >";
									  echo "<input style=\"width: 100%; padding: 5px;\"; type=\"text\" name=\"nro_recepcion_send\" value=\"\">";
									  echo "<button style=\"width: 100%;margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" value=\"grabar\">Grabar</button>";
									echo "</form>";
								 echo "</div></a></span></td>";
							
							//aqui debo construir el segundo uploader de archivos, pero este sube OC recepcion
							echo "<td class=\"pep\"><a href=\"#$fooo_or\" data-tooltip=\"Subir archivo\" class=\"various\"><img src=\"tema/img/upload.gif\" alt=\"\"></a>";					  
								echo "<div id=\"$fooo_or\" style=\"display: none;\">";					
									echo "<form id=\"upload\" action=\"getfile-or.php\" method=\"POST\" enctype=\"multipart/form-data\">";					
										echo "<h1 style=\"font-size: 1.5em;\">Subir un archivo</h1>";						  
										echo "<div class=\"drag-drop\" style=\"height: 100px; width: 100px; background: url(tema/img/up-hover.gif); text-align: center; color: white; position: relative; margin: 0 auto 1em; padding: 1em;\">";	
										echo "<input style=\"height: 100px;opacity: 0;position: absolute;top: 0;left: 0;width: 100%; cursor:pointer; z-index: 3;\" id=\"file\" name=\"userfile\" type=\"file\">";					
								echo "</div>";
										echo "<button style=\"width: 95%; text-align:center; margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" name=\"upload\" value=\"upload\" class=\"acept\">Aceptar</button>";
										echo "<input type=\"text\" name=\"nro_orden_form\" value=\"$nro_orden_fooo\" hidden=hidden>";
									echo "</form>";
								echo "</div>";										
							echo "</td>";
							
							  echo "</div>";
							  echo "</td>";
							echo "<td class=\"ppto-proyecto\">$days</td>";
						  echo "</tr>";
					echo "</tbody>";
				
				
				}			
				echo "</table>";
				echo "</section>";
				
			}else{
				echo "<section class=\"grupo\">";
					echo "<h3>No se encontraron resultados con ese nombre de proveedor</h3>";
				echo "</section>";
			}
			
		}
		/*
		else{
			echo "<section class=\"grupo\">";
				echo "<h3>Debe introducir un nombre de proveedor</h3>";
			echo "</section>";
		}*/
	
	
	?>
	
	
	<!-- Aqui se carga toda la informacion del historial -->
   
     
	
	
	<br>
	 <a href="perfil-sap.php"><input type="button" value="Volver"></a>	
	
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