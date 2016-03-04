<?php
  session_start();

  if(!isset($_SESSION['username'])){
    header("location:login.php");
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Ordenes por revisar</title>
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
		
		include "config.php";
		
		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
				
		
		$registros=mysqli_query($conexion,"select * from ordenes where orden_sap IS NULL OR orden_recepcion IS NULL OR archivo = 'no' ") or
		die("Problemas en el select:".mysqli_error($conexion));
							
		
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
		
		$ssql = "select * from ordenes where orden_sap IS NULL OR orden_recepcion IS NULL OR archivo = 'no' limit " . $inicio . "," . $TAMANO_PAGINA; 
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
            <li> <a href="perfil-sap.php" >Historial de órdenes</a></li>
            <!--
			<li> <a href="#" class="active" >Por revisar</a></li>
			-->
          </ul>
        </nav>
		<!--
        <div class="counter">15</div>
		-->
      </div>
      <div class="caja base-100 no-padding">
        <h2>En esta sección podrás encontrar el historial de todas tus órdenes por revisar.</h2>
      </div>
    </header>
    <div id="data--input" class="grupo">
      <h3>Mis órdenes de compra</h3>
    </div>
    <div id="buscar" class="grupo">
      <div class="caja-80">
        <form id="" method="POST" action="" class="seek"> 
          <input type="search" name="palabra" placeholder="ingresa número de OC">
          <button type="submit" value="buscar OC" name="buscar">buscar</button>
        </form>
      </div>
    </div>

<?php    	
	//  ----------   A partir de este codigo se realiza la busqueda  OJO ----------
	if(isset($_POST['buscar'])){   
	
	?>
	
	<?php
		$buscar = $_POST["palabra"];

		//echo $buscar;
		//Ojo esto es para buscar una orden en especifica
		$consulta_mysql=mysqli_query($conexion,"SELECT * FROM ordenes WHERE numero_orden = '$buscar' AND archivo = 'no'") or				
		die("Problemas en el select:".mysqli_error($conexion));
		
		$more_fuu = 0;
		
		
	?> 
	<section class="grupo">
      <table class="table-sap">
        <thead>
          <tr class="cabecc-sap">
            <th>Nº OC</th>
			<th>Editar</th>
            <th>Fecha</th>
            <th>Código PEP</th>
            <th>OC SAP</th>
            <th> <img src="tema/img/upload.gif" alt="" class="marggen-tabl"></th>
            <th>OC Recepción</th>
            <th> <img src="tema/img/upload.gif" alt="" class="marggen-tabl"></th>
            <th> <img src="tema/img/time.gif" alt="" class="marggen-tabl"></th>
          </tr>
        </thead>		
		
		<?php
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
	}
	
	?>
	
	
	
	<!-- Aqui se carga toda la informacion del historial -->
	<section class="grupo">
      <table class="table-sap">
        <thead>
          <tr class="cabecc-sap">
            <th>Nº OC</th>
			<th>Editar</th>
            <th>Fecha</th>
            <th>Código PEP</th>
            <th>OC SAP</th>
            <th> <img src="tema/img/upload.gif" alt="" class="marggen-tabl"></th>
            <th>OC Recepción</th>
            <th> <img src="tema/img/upload.gif" alt="" class="marggen-tabl"></th>
            <th> <img src="tema/img/time.gif" alt="" class="marggen-tabl"></th>
          </tr>
        </thead>		
		
		<?php
		$n_orden2 = 10000;
		$more_fooo = 400;
		$fooo_or = 5000;
		while ($reg=mysqli_fetch_array($rs))
		{			
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
	
		mysqli_free_result($rs); 
		mysqli_close($conexion);
		
		//Falta centrar y darle estilo al selector de paginas
		
		echo "<div id=\"campana\" class=\"caja-100\">";
			echo "<div class=\"paginator\">";
		
		//muestro los distintos índices de las páginas, si es que hay varias páginas 
		
		if ($total_paginas > 1){ 
		for ($i=1;$i<=$total_paginas;$i++){ 
			if ($pagina == $i) 
				//si muestro el índice de la página actual, no coloco enlace 
				echo "<span class=\"pag--cube\">" . $pagina . "</span>" . " "; 
			else 
				//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página 				
				echo "<a href='por-revisar-sap.php?pagina=" . $i . "'>"  . $i .  "</a> " ; 
			}   
		}
			echo "</div>";				
		echo "</div>";
		
		?>
		
      </div>
    </div>
	
<!-- 	<a class="logout" href="logout.php" >Logout</a> -->
	<br>
	 <a href="seleccion-sap.php"><input type="button" value="Volver"></a>	
	
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