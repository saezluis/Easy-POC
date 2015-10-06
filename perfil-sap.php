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
	
	<script>
	/*
    $(function() {
		$('#botoneditar').click(function() {
			$("#hidecamp").hide();
		}
	}
	*/
	</script>
	<script type = "text/javascript" >
		history.pushState(null, null, 'perfil-sap.php');
		window.addEventListener('popstate', function(event) {
			history.pushState(null, null, 'perfil-sap.php');
		});
    </script>
	
  </head>
  <body>
	
	<?php
		//$conexion=mysqli_connect("localhost","pmdigita_admin","Prodigy12","pmdigita_test") or die("Problemas con la conexión");	
		$conexion=mysqli_connect("localhost","root","123","test") or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		//$registros=mysqli_query($conexion,"select numero_orden,fecha,orden_sap,orden_recepcion,visto_bueno from ordenes where visto_bueno = \"no\"") or
		//die("Problemas en el select:".mysqli_error($conexion));
		
		$registros=mysqli_query($conexion,"select * from ordenes where visto_bueno = \"no\" AND orden_sap IS NOT NULL AND orden_recepcion IS NOT NULL") or
		die("Problemas en el select:".mysqli_error($conexion));
		
		$revisar=mysqli_query($conexion,"select * from ordenes where visto_bueno = \"no\" AND orden_sap IS NULL OR orden_recepcion IS NULL") or
		die("Problemas en el select:".mysqli_error($conexion));
		
		$num_rows = mysqli_num_rows($revisar);
		//echo "$num_rows Rows\n";
		
		//$registrosserv=mysqli_query($conexion,"select * from servicios where id_orden = \"147\"") or
		//die("Problemas en el select:".mysqli_error($conexion));				
		
	?>
	
    <header class="grupo">
      <div class="caja base-50 no-padding">
        <h1> <a href="#" class="logo"> <img src="tema/img/logo.jpg" alt="POC"></a></h1>
      </div>
      <div class="caja base-50 no-padding">
      	<a class="logout" href="logout.php" >Logout</a>
        <nav>
          <ul>
            <li> <a href="emision.php">Emisor de órdenes de compra</a></li>
            <li> <a href="por-revisar-sap.php" class="active" >Por revisar</a></li>
          </ul>
        </nav>
        <?php echo "<div class=\"counter\">$num_rows</div>"; ?>
      </div>
      <div class="caja base-100 no-padding">
        <h2>En esta sección podrás encontrar el historial de todas tus órdenes de compra emitidas.</h2>
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
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		//echo $buscar;
		//Ojo esto es para buscar una orden en especifica
		$consulta_mysql=mysqli_query($conexion,"SELECT * FROM ordenes WHERE numero_orden = '$buscar' ") or		
		//$consulta_mysql=mysqli_query($conexion,"SELECT * FROM ordenes WHERE numero_orden = '142-424-555'") or
		die("Problemas en el select:".mysqli_error($conexion));
		
		//$consulta_mysql= mysql_query ("SELECT * FROM ordenes WHERE numero_orden like '%$buscar%'");
		while($registro = mysqli_fetch_array($consulta_mysql)) {
	?> 
	<br>	
	
	<div id="campana" class="grupo">
		<div class="caja-100">
			<div id="tabla">
				<div id="titulo--orden-1">Nº de OC</div>
				<div id="titulo--orden-2">Fecha</div>
				<div id="titulo--orden-3">Detalle</div>
				<div id="titulo--orden-4">OC SAP</div>
				<div id="titulo--orden-5">OC RECEPCIÓN</div>
				<div id="titulo--orden-6T"> <img src="tema/img/time.gif" alt=""></div>
				<div id="titulo--orden-6S"> <img src="tema/img/upload.gif" alt=""></div>
			</div>
	 
	
	<?php
		//if ($reg=mysqli_fetch_array($registros))
			$n_orden2 = 1000;
			
			$fecha = $registro['fecha'];
			$fecha_format = date("d/m/y",strtotime($fecha));			
			$n_orden = "";
			$n_orden = $registro['numero_orden'];			
			
			$n_orden2 = $n_orden2 + 1;								
			echo "<div id=\"tabla\">";
			  echo "<div id=\"orden--1\">".$registro['numero_orden']."</div>";
			  echo "<div id=\"orden--2\">".$fecha_format."</div>";
			  echo "<div id=\"orden--3\">".$registro['descripcion']."</div>";
			  //------------------- Aqui trabajo con orden SAP -------------------
			  echo "<div id=\"orden--4\">".$registro['orden_sap']."<span class=\"yes\"><img src=\"tema/img/yes.gif\" alt=\"\"></span><span class=\"edit\"><a href=\"#ordensap\" data-tooltip=\"Editar\" class=\"various\"><img src=\"tema/img/edit.gif\" alt=\"\">";
					echo "<div id=\"ordensap\" name=\"\" style=\"display: none;\">";
					  echo "<form id=\"edit-recep\" method=\"POST\" action=\"grabar-orden-sap.php\">";
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
					  echo "<form id=\"edit-recep\" method=\"POST\" action=\"grabar-recepcion-sap.php\">";
						echo "<h1 style=\"font-size: 1.2em;\">Ingresa número de OC RECEPCION</h1>";
						// Este campo oculto lleva el nro orden para poder hacer el insert en BD
						echo "<input type=\"hidden\" name=\"nro_ordenRecep_send_hidden\" value=\"$registro[numero_orden]\" >";
						echo "<input style=\"width: 100%; padding: 5px;\"; type=\"text\" name=\"nro_recepcion_send\" value=\"\">";
						echo "<button style=\"width: 100%;margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" value=\"grabar\">Grabar</button>";
					  echo "</form>";
					echo "</div></a></span></div>";
			  echo "<div id=\"orden--6T\">3 días</div>";
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
			echo "</div>";	 
		  
	?>	  		
	
	<p> </p>
	
	<?php }   }  // fin if  ?>	
	
		</div>
	</div>	
	
	<!-- Aqui se carga toda la informacion del historial -->
    <div id="campana" class="grupo">
      <div class="caja-100">
        <div id="tabla">
          <div id="titulo--orden-1">Nº de OC</div>
          <div id="titulo--orden-2">Fecha</div>
          <div id="titulo--orden-3">Detalle</div>
          <div id="titulo--orden-4">OC SAP</div>
          <div id="titulo--orden-5">OC RECEPCIÓN</div>
          <div id="titulo--orden-6T"> <img src="tema/img/time.gif" alt=""></div>
          <div id="titulo--orden-6S"> <img src="tema/img/upload.gif" alt=""></div>
        </div>
		
		<!--
        <div id="tabla">
          <div id="orden--1">xxx-xxx-xxx</div>
          <div id="orden--2">xxx-xxx-xxx</div>
          <div id="orden--3"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. </div>
          <div id="orden--4">xxx-xxx-xxx<span class="yes"><img src="tema/img/yes.gif" alt=""></span><span class="edit"><a href="#inline1" data-tooltip="Editar" class="various"><img src="tema/img/edit.gif" alt="">
                <div id="inline1" style="display: none;">
                  <form id="edit-recep">
                    <h1>Ingresa número de OC</h1>
                    <input type="text">
                    <button type="button" value="grabar">Grabar</button>
                  </form>
                </div></a></span></div>
          <div id="orden--5">xxx-xxx-xxx<span class="no"><img src="tema/img/no.gif" alt=""></span><span class="edit"><a href="#inline1" data-tooltip="Editar" class="various"><img src="tema/img/edit.gif" alt="">
                <div id="inline1" style="display: none;">
                  <form id="edit-recep">
                    <h1>Ingresa número de OC</h1>
                    <input type="text">
                    <button type="button" value="grabar">Grabar</button>
                  </form>
                </div></a></span></div>
          <div id="orden--6T">3 días</div>
          <div id="orden--6S"><a href="#inline2" data-tooltip="Subir archivo" class="various"><img src="tema/img/upload.gif" alt=""></a>
            <div id="inline2" style="display: none;">
              <form id="upload">
                <h1>Subir un archivo</h1>
                <div class="drag-drop">
                  <input id="photo" type="file" multiple="multiple">
                </div>
                <button type="button" value="subir" class="acept">Aceptar</button>
              </form>
            </div>
          </div>
        </div>
		-->
		
		<?php
		$n_orden2 = 1000;
		$more_foo = 2000;
		while ($reg=mysqli_fetch_array($registros))
		{			
			//nro OC -- fecha -- detalle -- OC SAP -- OC RECEPCION -- dias 	
			$fecha = $reg['fecha'];
			$fecha_format = date("d/m/y",strtotime($fecha));
			$n_orden = "";
			$n_orden = $reg['numero_orden'];						
			$n_orden2 = $n_orden2 + 1;	
			
			$nro_orden_foo = $reg['numero_orden'];
			$more_foo = $more_foo + 1;
			
			echo "<div id=\"tabla\">";
			  echo "<div id=\"orden--1\">".$reg['numero_orden']."</div>";
			  echo "<div id=\"orden--2\">".$fecha_format."</div>";
			  echo "<div id=\"orden--3\">".$reg['descripcion']."</div>";
			  //------------------- Aqui trabajo con orden SAP -------------------
			  echo "<div id=\"orden--4\">".$reg['orden_sap']."<span class=\"yes\"><img src=\"tema/img/yes.gif\" alt=\"\"></span><span class=\"edit\"><a href=\"#$n_orden\" data-tooltip=\"Editar\" class=\"various\"><img src=\"tema/img/edit.gif\" alt=\"\">";
					echo "<div id=\"$n_orden\" name=\"\" style=\"display: none;\">";
					  echo "<form id=\"edit-recep\" method=\"POST\" action=\"grabar-orden-sap.php\">";
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
					  echo "<form id=\"edit-recep\" method=\"POST\" action=\"grabar-recepcion-sap.php\">";
						echo "<h1 style=\"font-size: 1.5em;\">Ingresa número de OC RECEPCION</h1>";
						// Este campo oculto lleva el nro orden para poder hacer el insert en BD
						echo "<input type=\"hidden\" name=\"nro_ordenRecep_send_hidden\" value=\"$reg[numero_orden]\" >";
						echo "<input style=\"width: 100%; padding: 5px;\"; type=\"text\" name=\"nro_recepcion_send\" value=\"\">";
						echo "<button style=\"width: 100%;margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" value=\"grabar\">Grabar</button>";
					  echo "</form>";
					echo "</div></a></span></div>";
			  echo "<div id=\"orden--6T\">3 días</div>";
			  echo "<div id=\"orden--6S\"><a href=\"#$more_foo\" data-tooltip=\"Subir archivo\" class=\"various\"><img src=\"tema/img/upload.gif\" alt=\"\"></a>";
				echo "<div id=\"$more_foo\" style=\"display: none;\">";
				  // ------ Comienzo del subir archivos -----
				  echo "<form id=\"upload\" action=\"getfile.php\" method=\"POST\" enctype=\"multipart/form-data\">";
					echo "<h1 style=\"font-size: 1.5em;\">Subir un archivo</h1>";
					echo "<div class=\"drag-drop\" style=\"height: 100px; width: 100px; background: url(tema/img/up-hover.gif); text-align: center; color: white; position: relative; margin: 0 auto 1em; padding: 1em;\">";
					  echo "<input style=\"height: 100px;opacity: 0;position: absolute;top: 0;left: 0;width: 100%; cursor:pointer; z-index: 3;\" id=\"file\" name=\"userfile\" type=\"file\">";
					echo "</div>";
					echo "<button style=\"width: 95%; text-align:center; margin-top: 10px; background: transparent linear-gradient(to bottom, #FF1500 0%, #C0000B 100%) repeat scroll 0% 0%; color:#fff; border:none;\" type=\"submit\" name=\"upload\" value=\"upload\" class=\"acept\">Aceptar</button>";
					echo "<input type=\"text\" name=\"nro_orden_form\" value=\"$nro_orden_foo\" hidden=hidden>";
				  echo "</form>";
				  //OJO los archivos llevan el nro de orden para poder luego ubicarlos y bajarlos
				  // ----- Aqui finaliza el subir archivos -----
				echo "</div>";
			  echo "</div>";
			echo "</div>";	
		}
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