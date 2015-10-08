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
		////$conexion=mysqli_connect("localhost","pmdigita_admin","Prodigy12","pmdigita_test") or die("Problemas con la conexión");	
		$conexion=mysqli_connect("localhost","root","123","test") or die("Problemas con la conexión");
				
		
		$registros=mysqli_query($conexion,"select * from ordenes where orden_sap IS NULL OR orden_recepcion IS NULL") or
		die("Problemas en el select:".mysqli_error($conexion));
							
		
		//-------------- INICIO Paginador ------------------
		
		//Limito la busqueda a 10 registros por pagina
		$TAMANO_PAGINA = 10; 
		
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
      	<a class="logout" href="logout.php" >Logout</a>
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
		//$conexion=mysqli_connect("localhost","pmdigita_admin","Prodigy12","pmdigita_test") or die("Problemas con la conexión");	
		$conexion=mysqli_connect("localhost","root","123","test") or die("Problemas con la conexión");
		//echo $buscar;
		//Ojo esto es para buscar una orden en especifica
		$consulta_mysql=mysqli_query($conexion,"SELECT * FROM ordenes WHERE numero_orden = '$buscar' ") or				
		die("Problemas en el select:".mysqli_error($conexion));
		
		$more_fuu = 0;
		
		while($registro = mysqli_fetch_array($consulta_mysql)) {
	?> 
	<br>	
	
	<div id="campana" class="grupo">
		<div class="caja-100">
			<div id="tabla">
				<div id="titulo--orden-1">N° de OC</div>
				<div id="titulo--orden-2">Fecha</div>
				<div id="titulo--orden-3">Detalle</div>
				<div id="titulo--orden-4">OC SAP</div>
				<div id="titulo--orden-5">OC RECEPCIÓN</div>
				<div id="titulo--orden-6T"> <img src="tema/img/time.gif" alt=""></div>
				<div id="titulo--orden-6S"> <img src="tema/img/upload.gif" alt=""></div>
			</div>
	 
	
	<?php
		
			$n_orden2 = 1000;
			
			//Aqui se calculan los dias que van transcurriendo desde la emision de la OC
			$fecha = $registro['fecha'];		  
			$todate = date("Y-m-d",strtotime($fecha));		  
			$fecha_format = date("d-m-Y",strtotime($fecha));		  		  		  
			date_default_timezone_set('America/Santiago');
			$fromdate = date('Y-m-d', time());		  
			$calculate_seconds = strtotime($fromdate) - strtotime($todate); // Numero de segundos entre las dos fechas
			$days = floor($calculate_seconds / (24 * 60 * 60 )); // Conversion a dias		
			
			$n_orden = "";
			$n_orden = $registro['numero_orden'];			
			
			$n_orden2 = $n_orden2 + 1;	

			$more_fuu = $more_fuu + 1;
			
			echo "<div id=\"tabla\">";
			  echo "<div id=\"orden--1\">".$registro['numero_orden']."</div>";
			  echo "<div id=\"orden--2\">".$fecha_format."</div>";
			  echo "<div id=\"orden--3\">".$registro['descripcion']."</div>";
			  //------------------- Aqui trabajo con orden SAP -------------------
			  echo "<div id=\"orden--4\">".$registro['orden_sap']."<span class=\"yes\"><img src=\"tema/img/no.gif\" alt=\"\"></span><span class=\"edit\"><a href=\"#ordensap\" data-tooltip=\"Editar\" class=\"various\"><img src=\"tema/img/edit.gif\" alt=\"\">";
					echo "<div id=\"ordensap\" name=\"\" style=\"display: none;\">";
					  //Ojo aqui redirecciono con una pagina php diferente para no perder el la pagina donde estoy editando
					  echo "<form id=\"edit-recep\" method=\"POST\" action=\"grabar-orden-sap-rev.php\">";
						echo "<h1 style=\"font-size: 1.5em;\">Ingresa número de OC SAP</h1>";
						// Este campo oculto lleva el nro orden para poder hacer el insert en BD
						echo "<input type=\"hidden\" name=\"nro_orden_send_hidden\" value=\"$registro[numero_orden]\">";
						//id=\"$reg[numero_orden]\"
						echo "<input style=\"width: 100%; padding: 5px;\"; type=\"text\" name=\"nro_orden_send\" value=\"\">";
						echo "<button style=\"width: 100%;margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" value=\"grabar\">Grabar</button>";
					  echo "</form>";
					echo "</div></a></span></div>";
			//------------------- Aqui trabajo con orden Recepcion -------------------
			  echo "<div id=\"orden--5\">".$registro['orden_recepcion']."<span class=\"no\"><img src=\"tema/img/no.gif\" alt=\"\"></span><span class=\"edit\"><a href=\"#ordenrecep\" data-tooltip=\"Editar\" class=\"various\"><img src=\"tema/img/edit.gif\" alt=\"\">";
					echo "<div id=\"ordenrecep\" style=\"display: none;\">";
					//Ojo aqui redirecciono con una pagina php diferente para no perder el la pagina donde estoy editando
					  echo "<form id=\"edit-recep\" method=\"POST\" action=\"grabar-recepcion-sap-rev.php\">";
						echo "<h1 style=\"font-size: 1.5em;\">Ingresa número de OC RECEPCION</h1>";
						// Este campo oculto lleva el nro orden para poder hacer el insert en BD
						echo "<input type=\"hidden\" name=\"nro_ordenRecep_send_hidden\" value=\"$registro[numero_orden]\" >";
						echo "<input style=\"width: 100%; padding: 5px;\"; type=\"text\" name=\"nro_recepcion_send\" value=\"\">";
						echo "<button style=\"width: 100%;margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" value=\"grabar\">Grabar</button>";
					  echo "</form>";
					echo "</div></a></span></div>";
			  //Aqui manipulo la fecha para que si pasa de 5 dias se muestre en rojo
			  if ($days>=5){
				echo "<div id=\"orden--6T\" style=\"color:#FF0000\">".$days." dias"."</div>";
			  } else {
				  echo "<div id=\"orden--6T\" >".$days." dias"."</div>";
			  }	
			  
			  // ------ Comienzo del subir archivos -----
			  echo "<div id=\"orden--6S\"><a href=\"#$more_fuu\" data-tooltip=\"Subir archivo\" class=\"various\"><img src=\"tema/img/upload.gif\" alt=\"\"></a>";
				echo "<div id=\"$more_fuu\" style=\"display: none;\">";				
				  echo "<form id=\"upload\" action=\"getfile.php\" method=\"POST\" enctype=\"multipart/form-data\">";
					echo "<h1 style=\"font-size: 1.5em;\">Subir un archivo</h1>";
					echo "<div class=\"drag-drop\" style=\"height: 100px; width: 100px; background: url(tema/img/up-hover.gif); text-align: center; color: white; position: relative; margin: 0 auto 1em; padding: 1em;\">";
					  echo "<input style=\"height: 100px;opacity: 0;position: absolute;top: 0;left: 0;width: 100%; cursor:pointer; z-index: 3;\" id=\"file\" name=\"userfile\" type=\"file\">";
					echo "</div>";
					echo "<button style=\"width: 95%; text-align:center; margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" name=\"upload\" value=\"upload\" class=\"acept\">Aceptar</button>";
					echo "<input type=\"text\" name=\"nro_orden_form\" value=\"$n_orden\" hidden=hidden>";
				  echo "</form>";
				echo "</div>";
			  echo "</div>";
			  
			  /*
			  echo "<div id=\"orden--6S\"><a href=\"#inline2\" data-tooltip=\"Subir archivo\" class=\"various\"><img src=\"tema/img/upload.gif\" alt=\"\"></a>";
				echo "<div id=\"inline2\" style=\"display: none;\">";
				  echo "<form id=\"upload\">";
					echo "<h1 style=\"font-size: 1.5em;\">Subir un archivo</h1>";
					echo "<div class=\"drag-drop\">";
					  echo "<input id=\"photo\" type=\"file\" multiple=\"multiple\">";
					echo "</div>";
					echo "<button type=\"button\" value=\"subir\" class=\"acept\">Aceptar</button>";
				  echo "</form>";
				echo "</div>";
			  echo "</div>";
			  */
			echo "</div>";	 
		  
	?>	  		
	
	<p> </p>
	
	<?php }   }  // fin if  ?>	
	
		</div>
	</div>	
	
	<!-- Aqui se carga toda la informacion del historial -->
    <div id="campana" class="grupo">
      <div class="caja-100">
        <div id="tabla">
          <div id="titulo--orden-1">N° de OC</div>
          <div id="titulo--orden-2">Fecha</div>
          <div id="titulo--orden-3">Detalle</div>
          <div id="titulo--orden-4">OC SAP</div>
          <div id="titulo--orden-5">OC RECEPCIÓN</div>
          <div id="titulo--orden-6T"> <img src="tema/img/time.gif" alt=""></div>
          <div id="titulo--orden-6S"> <img src="tema/img/upload.gif" alt=""></div>
        </div>
				
		
		<?php
		$n_orden2 = 1000;
		$more_fooo = 40;
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
			
			echo "<div id=\"tabla\">";
			  echo "<div id=\"orden--1\">".$reg['numero_orden']."</div>";
			  echo "<div id=\"orden--2\">".$fecha_format."</div>";
			  echo "<div id=\"orden--3\">".$reg['descripcion']."</div>";
			  //------------------- Aqui trabajo con orden SAP -------------------
			  echo "<div id=\"orden--4\">".$reg['orden_sap']."<span class=\"yes\"><img src=\"tema/img/no.gif\" alt=\"\"></span><span class=\"edit\"><a href=\"#$n_orden\" data-tooltip=\"Editar\" class=\"various\"><img src=\"tema/img/edit.gif\" alt=\"\">";
					echo "<div id=\"$n_orden\" name=\"\" style=\"display: none;\">";
					//Ojo aqui redirecciono con una pagina php diferente para no perder el la pagina donde estoy editando
					  echo "<form id=\"edit-recep\" method=\"POST\" action=\"grabar-orden-sap-rev.php\">";
						echo "<h1 style=\"font-size: 1.5em;\">Ingresa número de OC SAP</h1>";
						// Este campo oculto lleva el nro orden para poder hacer el insert en BD
						echo "<input type=\"hidden\" name=\"nro_orden_send_hidden\" value=\"$reg[numero_orden]\">";
						//id=\"$reg[numero_orden]\"
						echo "<input style=\"width: 100%; padding: 5px;\"; type=\"text\" name=\"nro_orden_send\" value=\"\">";
						echo "<button style=\"width: 100%;margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" value=\"grabar\">Grabar</button>";
					  echo "</form>";
					echo "</div></a></span></div>";
			//------------------- Aqui trabajo con orden Recepcion -------------------
			  echo "<div id=\"orden--5\">".$reg['orden_recepcion']."<span class=\"no\"><img src=\"tema/img/no.gif\" alt=\"\"></span><span class=\"edit\"><a href=\"#$n_orden2\" data-tooltip=\"Editar\" class=\"various\"><img src=\"tema/img/edit.gif\" alt=\"\">";
					echo "<div id=\"$n_orden2\" style=\"display: none;\">";
					//Ojo aqui redirecciono con una pagina php diferente para no perder el la pagina donde estoy editando
					  echo "<form id=\"edit-recep\" method=\"POST\" action=\"grabar-recepcion-sap-rev.php\">";
						echo "<h1 style=\"font-size: 1.5em;\">Ingresa número de OC RECEPCION</h1>";
						// Este campo oculto lleva el nro orden para poder hacer el insert en BD
						echo "<input type=\"hidden\" name=\"nro_ordenRecep_send_hidden\" value=\"$reg[numero_orden]\" >";
						echo "<input style=\"width: 100%; padding: 5px;\"; type=\"text\" name=\"nro_recepcion_send\" value=\"\">";
						echo "<button style=\"width: 100%;margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" value=\"grabar\">Grabar</button>";
					  echo "</form>";
					echo "</div></a></span></div>";
			//------------------- Aqui trabajo con la parte de los dias remanentes ------------------------		
			  //Aqui manipulo la fecha para que si pasa de 5 dias se muestre en rojo
			  if ($days>=5){
				echo "<div id=\"orden--6T\" style=\"color:#FF0000\">".$days." dias"."</div>";
			  } else {
				  echo "<div id=\"orden--6T\" >".$days." dias"."</div>";
			  }	
			  
			  // ------ Comienzo del subir archivos -----
			  echo "<div id=\"orden--6S\"><a href=\"#$more_fooo\" data-tooltip=\"Subir archivo\" class=\"various\"><img src=\"tema/img/upload.gif\" alt=\"\"></a>";
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
			  echo "</div>";
			  
			echo "</div>";	
		}
		
		mysqli_free_result($rs); 
		mysqli_close($conexion);
		
		//Falta centrar y darle estilo al selector de paginas
		
		echo "<div class=\"caja-100\">";
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