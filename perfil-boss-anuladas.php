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
	
	<style>
	
	.redText { 
			background-color:red;
		}
	
	.textoRojo {
		color:red !important;
	}
	
	</style>
	
  </head>
  <body>
  	
	
	<?php
		
		include "config.php";
	
		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$registros=mysqli_query($conexion,"select * from ordenes where anular = \"si\" ") or
		die("Problemas en el select:".mysqli_error($conexion));
						
		$username = $_SESSION['username'];
		
		$registrosMembers = mysqli_query($conexion, "SELECT * FROM members WHERE username = '$username' ") or die("Problemas con la conexión de members");
		
		if($reg=mysqli_fetch_array($registrosMembers)){
			$nombre_user = $reg['nombre'];
			$apellido_user = $reg['apellido'];
			$nombre_final = $nombre_user." ".$apellido_user;
		}
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
		
		$ssql = "select * from ordenes WHERE anular = \"si\" AND jefe_autorizacion = '$nombre_final' limit " . $inicio . "," . $TAMANO_PAGINA; 
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
            <li> <a href="perfil-boss-vb-si.php">Historial de órdenes de compra con VºBº</a></li>
			
			<li> <a href="perfil-boss.php">Historial de órdenes de compra sin VºBº</a></li>
          </ul>
        </nav>
		<!--	<div class="counter">15</div>	-->
      </div>
      <div class="caja base-100 no-padding">
        <h2>En esta sección podrás encontrar el historial de todas las órdenes de compra anuladas.</h2>
      </div>
    </header>
    <div id="data--input" class="grupo">
      <h3>Órdenes de compra anuladas<img src="tema/img/no.gif"> </h3>
    </div>
    <div id="buscar" class="grupo">
      <div class="caja-80">
	  <!-- Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod -->
        <form id="" method="POST" action="pba-buscar.php" onSubmit="return validarForm(this)" class="seek"> 
          <input type="search" name="palabra" placeholder="ingresa número de OC">
          <button type="submit" value="Buscar" name="buscar">buscar</button>
        </form>
		<form id="" method="POST" action="pba-buscar.php" class="seek"> 
          <input type="search" name="rut_proveedor" placeholder="ingresa RUT proveedor">
          <button type="submit" value="Busca_pro" name="buscar_pro" style="margin-right: 70px;">buscar</button>
        </form>
		<form id="" method="POST" action="pba-buscar.php" class="seek"> 
          <input type="search" name="nombre_proveedor" placeholder="ingresa nombre proveedor" size="35">
          <button type="submit" value="Busca_Npro" name="buscar_Npro" style="margin-right: 70px;">buscar</button>
        </form>
	  <!-- Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod -->	
      </div>
    </div>

	
	<?php    	
	//  ----------   A partir de este codigo se realiza la busqueda  ----------
	if(isset($_POST['buscar'])){   
	
		$buscar = @$_POST["palabra"];
		
		if($buscar!=''){
		
			//Ojo esto es para buscar una orden en especifica
			$consulta_mysql = mysqli_query($conexion,"SELECT * FROM ordenes WHERE numero_orden = '$buscar' AND jefe_autorizacion = '$nombre_final' AND anular = \"si\" ") or die("Problemas en el select:".mysqli_error($conexion));
			
			$rows_consulta = mysqli_num_rows($consulta_mysql);
			
			if($rows_consulta!=0){
			
				echo "<section class=\"grupo\">";
				echo "<table class=\"table-sap\">";
				echo "<thead>";
					echo "<tr class=\"cabecc-sap\">";
						echo "<th>Nº OC - Ver OC</th>";
						echo "<th>Editar</th>";
						echo "<th>Fecha Emisión</th>";
						echo "<th>OC SAP</th>";
						echo "<th>OC RECEPCIÓN</th>";
						echo "<th>Notificacion Via Email</th>";
						echo "<th>V°B°</th>";
						echo "<th>Restaurar</th>";
					echo "</tr>";
				echo "</thead>";
				
				
				while($reg = mysqli_fetch_array($consulta_mysql)) {
				
					$n_orden = $reg['numero_orden'];
					  
					$registrosOrdenesNeg=mysqli_query($conexion,"select * from ordenes_negadas WHERE id_orden = $n_orden") or die("Problemas en el select:".mysqli_error($conexion));
					  
					$num_rows = mysqli_num_rows($registrosOrdenesNeg);	  
					  
					$visto_bd = $reg['visto_bueno'];
					  
					  //Aqui se calculan los dias que van transcurriendo desde la emision de la OC
					$fecha = $reg['fecha'];		  
					$todate = date("Y-m-d",strtotime($fecha));		  
					$fecha_format = date("d-m-Y",strtotime($fecha));		  		  		  
					date_default_timezone_set('America/Santiago');
					$fromdate = date('Y-m-d', time());		  
					$calculate_seconds = strtotime($fromdate) - strtotime($todate); // Numero de segundos entre las dos fechas
					$days = floor($calculate_seconds / (24 * 60 * 60 )); // Conversion a dias	
					  
					$id_user = $reg['id_user'];
					  
					$detalle = $reg['descripcion'];
					
					$detalle_corto = substr($detalle,0,50);
					
					$detalle_corto_final = $detalle_corto."...";
					
					echo "<tbody>";
						echo "<tr>";
							echo "<td class=\"area\"><a href=\"consultar-orden.php?numero_orden=",urlencode($n_orden)," \">$n_orden</a></td>";	
								
							echo "<td class=\"ppto-proyecto\">";						
								echo "<a href=\"modificar-oc-detalle-sap.php?oc_send=",urlencode($n_orden)," \">Editar</a>";						
							echo "</td>";
								
							echo "<td class=\"ceco\">".$fecha_format."</td>";
								
							//-------------- OC SAP
							echo "<td class=\"ocrecepcion\">".$reg['orden_sap']."</td>";												
								
							//-------------- OC RECEPCION
							echo "<td class=\"ocsap\">".$reg['orden_recepcion']."</td>";
		
							echo "<td class=\"desc-servicio\">";
							
								if($num_rows==1){
									echo "<a class=\"textoRojo\" href=\"ver-razon-orden-neg.php?numero_orden=",urlencode($n_orden)," \">Si</a>";
								}else{
									echo "No";
								}						
								echo "</td>";
								
								echo "<td class=\"ppto-proyecto\">";						
									echo "<form method=\"POST\" id=\"$n_orden\" class=\"choose\" action=\"update-perfil-boss.php\" >";				  
										echo "<select name=\"revision\" form=\"$n_orden\" onchange=\"this.form.submit();\">";			  
											echo "<option class=\"redText\" value=\"\">$visto_bd</option>";
											echo "<option value=\"si.$n_orden\">Si</option>";
											echo "<option value=\"no.$n_orden\">No</option>";
										echo "</select>";
										echo "<input type=\"text\" name=\"id_user_send\" value=\"$id_user\" hidden=hidden >";
									echo "</form>";				
								echo "</td>";

								echo "<td class=\"ppto-real\">";
									echo "<form method=\"POST\" action=\"restaurar-form.php\">";
									echo "<button type=\"submit\" class=\"gou\">Restaurar</button>";
									echo "<input type=\"text\" value=\"$n_orden\" name=\"nro_OC_send\" hidden=hidden >";
								echo "</form>";  
						echo "</td>";
						echo "</tr>";
					echo "</tbody>";	
				}
				
				echo "</table>";
				echo "</section>";
			
			}else{
				echo "<section class=\"grupo\">";
					echo "<h3>No se encontraron resultados con ese número de OC</h3>";
				echo "</section>";
			}
			
		}else{
			echo "<section class=\"grupo\">";
				echo "<h3>Debe introducir un número de OC</h3>";
			echo "</section>";
		}
	}  
	
	
	if(isset($_POST['rut_proveedor'])){   
	
		$buscar_pro = @$_POST["rut_proveedor"];
		
		if($buscar_pro!=''){
		
			$registrosProveedor = mysqli_query($conexion,"SELECT * FROM proveedor WHERE rut = '$buscar_pro' ") or die("Problemas en el select:".mysqli_error($conexion));
			
			$num_registros_pro = mysqli_num_rows($registrosProveedor);
			
			if($num_registros_pro!=0){
				
				if($reg_pro=mysqli_fetch_array($registrosProveedor)){
					$id_proveedor = $reg_pro['id_proveedor'];
					//echo $id_proveedor;
				}
			
				//Ojo esto es para buscar una orden en especifica
				$consulta_mysql = mysqli_query($conexion,"SELECT * FROM ordenes WHERE id_proveedor = '$id_proveedor' AND jefe_autorizacion = '$nombre_final' AND anular = \"si\" ") or die("Problemas en el select:".mysqli_error($conexion));
			
				echo "<section class=\"grupo\">";
				echo "<h5>Resultados de OC para proveedor con Rut: $buscar_pro</h5>";
				echo "<table class=\"table-sap\">";
					echo "<thead>";
						echo "<tr class=\"cabecc-sap\">";
							echo "<th>Nº OC - Ver OC</th>";
							echo "<th>Editar</th>";
							echo "<th>Fecha Emisión</th>";
							echo "<th>OC SAP</th>";
							echo "<th>OC RECEPCIÓN</th>";
							echo "<th>Notificacion Via Email</th>";
							echo "<th>V°B°</th>";
							echo "<th>Restaurar</th>";
						echo "</tr>";
					echo "</thead>";
				
				//76.384.058-1
				
				while($reg = mysqli_fetch_array($consulta_mysql)) {
				
					$n_orden = $reg['numero_orden'];
					  
					$registrosOrdenesNeg=mysqli_query($conexion,"select * from ordenes_negadas WHERE id_orden = $n_orden") or die("Problemas en el select:".mysqli_error($conexion));
					  
					$num_rows = mysqli_num_rows($registrosOrdenesNeg);	  
					  
					$visto_bd = $reg['visto_bueno'];
					  
					  //Aqui se calculan los dias que van transcurriendo desde la emision de la OC
					$fecha = $reg['fecha'];		  
					$todate = date("Y-m-d",strtotime($fecha));		  
					$fecha_format = date("d-m-Y",strtotime($fecha));		  		  		  
					date_default_timezone_set('America/Santiago');
					$fromdate = date('Y-m-d', time());		  
					$calculate_seconds = strtotime($fromdate) - strtotime($todate); // Numero de segundos entre las dos fechas
					$days = floor($calculate_seconds / (24 * 60 * 60 )); // Conversion a dias	
					  
					$id_user = $reg['id_user'];
					  
					$detalle = $reg['descripcion'];
					
					$detalle_corto = substr($detalle,0,50);
					
					$detalle_corto_final = $detalle_corto."...";
					
					echo "<tbody>";
						echo "<tr>";
							echo "<td class=\"area\"><a href=\"consultar-orden.php?numero_orden=",urlencode($n_orden)," \">$n_orden</a></td>";	
								
							echo "<td class=\"ppto-proyecto\">";						
								echo "<a href=\"modificar-oc-detalle-sap.php?oc_send=",urlencode($n_orden)," \">Editar</a>";						
							echo "</td>";
								
							echo "<td class=\"ceco\">".$fecha_format."</td>";
								
							//-------------- OC SAP
							echo "<td class=\"ocrecepcion\">".$reg['orden_sap']."</td>";												
								
							//-------------- OC RECEPCION
							echo "<td class=\"ocsap\">".$reg['orden_recepcion']."</td>";
		
							echo "<td class=\"desc-servicio\">";
							
								if($num_rows==1){
									echo "<a class=\"textoRojo\" href=\"ver-razon-orden-neg.php?numero_orden=",urlencode($n_orden)," \">Si</a>";
								}else{
									echo "No";
								}						
								echo "</td>";
								
								echo "<td class=\"ppto-proyecto\">";						
									echo "<form method=\"POST\" id=\"$n_orden\" class=\"choose\" action=\"update-perfil-boss.php\" >";				  
										echo "<select name=\"revision\" form=\"$n_orden\" onchange=\"this.form.submit();\">";			  
											echo "<option class=\"redText\" value=\"\">$visto_bd</option>";
											echo "<option value=\"si.$n_orden\">Si</option>";
											echo "<option value=\"no.$n_orden\">No</option>";
										echo "</select>";
										echo "<input type=\"text\" name=\"id_user_send\" value=\"$id_user\" hidden=hidden >";
									echo "</form>";				
								echo "</td>";
								
								echo "<td class=\"ppto-real\">";
									echo "<form method=\"POST\" action=\"restaurar-form.php\">";
									echo "<button type=\"submit\" class=\"gou\">Restaurar</button>";
									echo "<input type=\"text\" value=\"$n_orden\" name=\"nro_OC_send\" hidden=hidden >";
								echo "</form>";
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
			
		}else{
			echo "<section class=\"grupo\">";
				echo "<h3>Debe introducir un número de Rut</h3>";
			echo "</section>";
		}
	} 
	
	if(isset($_POST['nombre_proveedor'])){   
	
		$buscar_nombre = @$_POST["nombre_proveedor"];
		
		if($buscar_nombre!=''){
		
			$registrosProveedorName = mysqli_query($conexion,"SELECT * FROM proveedor WHERE nombre like '%$buscar_nombre%' ") or die("Problemas en el select:".mysqli_error($conexion));
			
			$num_registros_Npro = mysqli_num_rows($registrosProveedorName);
			
			if($num_registros_Npro!=0){
				
				if($reg_pro_name=mysqli_fetch_array($registrosProveedorName)){
					$id_proveedor = $reg_pro_name['id_proveedor'];
					//echo $id_proveedor;
				}
			
				//Ojo esto es para buscar una orden en especifica
				$consulta_mysql = mysqli_query($conexion,"SELECT * FROM ordenes WHERE id_proveedor = '$id_proveedor' AND jefe_autorizacion = '$nombre_final' AND anular = \"si\" ") or die("Problemas en el select:".mysqli_error($conexion));
			
				echo "<section class=\"grupo\">";
				echo "<h5>Resultados de OC para proveedor con nombre: $buscar_nombre</h5>";
				echo "<table class=\"table-sap\">";
					echo "<thead>";
						echo "<tr class=\"cabecc-sap\">";
							echo "<th>Nº OC - Ver OC</th>";
							echo "<th>Editar</th>";
							echo "<th>Fecha Emisión</th>";
							echo "<th>OC SAP</th>";
							echo "<th>OC RECEPCIÓN</th>";
							echo "<th>Notificacion Via Email</th>";
							echo "<th>V°B°</th>";
							echo "<th>Restaurar</th>";
						echo "</tr>";
					echo "</thead>";
				
				//76.384.058-1
				
				while($reg = mysqli_fetch_array($consulta_mysql)) {
				
					$n_orden = $reg['numero_orden'];
					  
					$registrosOrdenesNeg=mysqli_query($conexion,"select * from ordenes_negadas WHERE id_orden = $n_orden") or die("Problemas en el select:".mysqli_error($conexion));
					  
					$num_rows = mysqli_num_rows($registrosOrdenesNeg);	  
					  
					$visto_bd = $reg['visto_bueno'];
					  
					  //Aqui se calculan los dias que van transcurriendo desde la emision de la OC
					$fecha = $reg['fecha'];		  
					$todate = date("Y-m-d",strtotime($fecha));		  
					$fecha_format = date("d-m-Y",strtotime($fecha));		  		  		  
					date_default_timezone_set('America/Santiago');
					$fromdate = date('Y-m-d', time());		  
					$calculate_seconds = strtotime($fromdate) - strtotime($todate); // Numero de segundos entre las dos fechas
					$days = floor($calculate_seconds / (24 * 60 * 60 )); // Conversion a dias	
					  
					$id_user = $reg['id_user'];
					  
					$detalle = $reg['descripcion'];
					
					$detalle_corto = substr($detalle,0,50);
					
					$detalle_corto_final = $detalle_corto."...";
					
					echo "<tbody>";
						echo "<tr>";
							echo "<td class=\"area\"><a href=\"consultar-orden.php?numero_orden=",urlencode($n_orden)," \">$n_orden</a></td>";	
								
							echo "<td class=\"ppto-proyecto\">";						
								echo "<a href=\"modificar-oc-detalle-sap.php?oc_send=",urlencode($n_orden)," \">Editar</a>";						
							echo "</td>";
								
							echo "<td class=\"ceco\">".$fecha_format."</td>";
								
							//-------------- OC SAP
							echo "<td class=\"ocrecepcion\">".$reg['orden_sap']."</td>";												
								
							//-------------- OC RECEPCION
							echo "<td class=\"ocsap\">".$reg['orden_recepcion']."</td>";
		
							echo "<td class=\"desc-servicio\">";
							
								if($num_rows==1){
									echo "<a class=\"textoRojo\" href=\"ver-razon-orden-neg.php?numero_orden=",urlencode($n_orden)," \">Si</a>";
								}else{
									echo "No";
								}						
								echo "</td>";
								
								echo "<td class=\"ppto-proyecto\">";						
									echo "<form method=\"POST\" id=\"$n_orden\" class=\"choose\" action=\"update-perfil-boss.php\" >";				  
										echo "<select name=\"revision\" form=\"$n_orden\" onchange=\"this.form.submit();\">";			  
											echo "<option class=\"redText\" value=\"\">$visto_bd</option>";
											echo "<option value=\"si.$n_orden\">Si</option>";
											echo "<option value=\"no.$n_orden\">No</option>";
										echo "</select>";
										echo "<input type=\"text\" name=\"id_user_send\" value=\"$id_user\" hidden=hidden >";
									echo "</form>";				
								echo "</td>";
								
								echo "<td class=\"ppto-real\">";
									echo "<form method=\"POST\" action=\"restaurar-form.php\">";
									echo "<button type=\"submit\" class=\"gou\">Restaurar</button>";
									echo "<input type=\"text\" value=\"$n_orden\" name=\"nro_OC_send\" hidden=hidden >";
								echo "</form>";
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
			
		}else{
			echo "<section class=\"grupo\">";
				echo "<h3>Debe introducir un nombre de proveedor</h3>";
			echo "</section>";
		}
	}
	
	?>
	<br>	
	
	
		<section class="grupo">
		<table class="table-sap">
			<thead>
				<tr class="cabecc-sap">
					<th>Nº OC - Ver OC</th>
					<th>Editar</th>
					<th>Fecha Emisión</th>
					<th>OC SAP</th>
					<th>OC RECEPCIÓN</th>
					<th>Notificacion Via Email</th>
					<th>V°B°</th>					
					<th>Restaurar</th>
				</tr>
			</thead>
			<?php
			
			while ($reg=mysqli_fetch_array($rs))
			{
			  $n_orden = $reg['numero_orden'];
			  
			  $registrosOrdenesNeg=mysqli_query($conexion,"select * from ordenes_negadas WHERE id_orden = $n_orden") or die("Problemas en el select:".mysqli_error($conexion));
			  
			  $num_rows = mysqli_num_rows($registrosOrdenesNeg);	  
			  
			  $visto_bd = $reg['visto_bueno'];
			  
			  //Aqui se calculan los dias que van transcurriendo desde la emision de la OC
			  $fecha = $reg['fecha'];		  
			  $todate = date("Y-m-d",strtotime($fecha));		  
			  $fecha_format = date("d-m-Y",strtotime($fecha));		  		  		  
			  date_default_timezone_set('America/Santiago');
			  $fromdate = date('Y-m-d', time());		  
			  $calculate_seconds = strtotime($fromdate) - strtotime($todate); // Numero de segundos entre las dos fechas
			  $days = floor($calculate_seconds / (24 * 60 * 60 )); // Conversion a dias	
			  
			  $id_user = $reg['id_user'];
			  
			  $detalle = $reg['descripcion'];
			
			$detalle_corto = substr($detalle,0,50);
			
			$detalle_corto_final = $detalle_corto."...";
			
			echo "<tbody>";
					  echo "<tr>";
						echo "<td class=\"area\"><a href=\"consultar-orden.php?numero_orden=",urlencode($n_orden)," \">$n_orden</a></td>";	
						
						echo "<td class=\"ppto-proyecto\">";						
							echo "<a href=\"modificar-oc-detalle-sap.php?oc_send=",urlencode($n_orden)," \">Editar</a>";						
						echo "</td>";
						
						echo "<td class=\"ceco\">".$fecha_format."</td>";
						
						//-------------- OC SAP
						echo "<td class=\"ocrecepcion\">".$reg['orden_sap']."</td>";												
						
						//-------------- OC RECEPCION
						echo "<td class=\"ocsap\">".$reg['orden_recepcion']."</td>";
												
						
						echo "<td class=\"desc-servicio\">";						
							if($num_rows==1){
								echo "<a class=\"textoRojo\" href=\"ver-razon-orden-neg.php?numero_orden=",urlencode($n_orden)," \">Si</a>";
							}else{
								echo "No";
							}						
						echo "</td>";
						
						echo "<td class=\"ppto-proyecto\">";						
							echo "<form method=\"POST\" id=\"$n_orden\" class=\"choose\" action=\"update-perfil-boss.php\" >";				  
								echo "<select name=\"revision\" form=\"$n_orden\" onchange=\"this.form.submit();\">";			  
									echo "<option class=\"redText\" value=\"\">$visto_bd</option>";
									echo "<option value=\"si.$n_orden\">Si</option>";
									echo "<option value=\"no.$n_orden\">No</option>";
								echo "</select>";
								echo "<input type=\"text\" name=\"id_user_send\" value=\"$id_user\" hidden=hidden >";			  
							echo "</form>";				
						echo "</td>";
						
						echo "<td class=\"ppto-real\">";
						echo "<form method=\"POST\" action=\"restaurar-form.php\">";
							  echo "<button type=\"submit\" class=\"gou\">Restaurar</button>";
							  echo "<input type=\"text\" value=\"$n_orden\" name=\"nro_OC_send\" hidden=hidden >";
							echo "</form>";  
						echo "</td>";
					  echo "</tr>";
				echo "</tbody>";	
			}
			?>
			
		</table>
	</section>	
				
			<?php
					
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
					echo "<a href='perfil-boss.php?pagina=" . $i . "'>"  . $i .  "</a> " ; 
				}   
			}	
				echo "</div>";				
			echo "</div>";
		
			?>
		
		
 	  <br>
	 <a href="seleccion-boss.php"><input type="button" value="Volver"></a>	
    				
	
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