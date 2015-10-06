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
	
  </head>
  <body>
	<?php
	
		$conexion=mysqli_connect("localhost","root","123","test") or die("Problemas con la conexión");
						
		$registros=mysqli_query($conexion,"select * from ordenes where visto_bueno = \"si\"") or
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
		
		$ssql = "select * from ordenes where visto_bueno = \"si\" limit " . $inicio . "," . $TAMANO_PAGINA; 
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
            <li> <a href="perfil-boss.php">Historial de órdenes de compra sin VºBº</a></li>
            <!-- 	<li> <a href="#" class="active">Perfil</a></li>  -->
          </ul>
        </nav>
		<!--	<div class="counter">15</div>	-->
      </div>
      <div class="caja base-100 no-padding">
        <h2>En esta sección podrás encontrar el historial de todas tus órdenes de compra emitidas.</h2>
      </div>
    </header>
    <div id="data--input" class="grupo">
      <h3>Mis órdenes de compra <img src="tema/img/si.gif"></h3>
    </div>
    <div id="buscar" class="grupo">
      <div class="caja-80">
	  <!-- Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod -->
        <form id="" method="POST" action="" onSubmit="return validarForm(this)" class="seek"> 
          <input type="search" name="palabra" placeholder="ingresa número de OC">
          <button type="submit" value="Buscar" name="buscar">buscar</button>
        </form>
	  <!-- Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod Mod -->	
      </div>
    </div>

	
	<?php    	
	//  ----------   A partir de este codigo se realiza la busqueda  ----------
	if(isset($_POST['buscar'])){   
	
	?>
	
	<?php
		$buscar = $_POST["palabra"];
		$conexion=mysqli_connect("localhost","root","123","test") or die("Problemas con la conexión");
		
		//Ojo esto es para buscar una orden en especifica
		$consulta_mysql=mysqli_query($conexion,"SELECT * FROM ordenes WHERE numero_orden = '$buscar' ") or				
		die("Problemas en el select:".mysqli_error($conexion));
				
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
          <div id="titulo--orden-6S">VºBº</div>
        </div>   
	</div>	
	<?php
		//if ($reg=mysqli_fetch_array($registros))
		
		  echo "<div id=\"tabla\">";
		  echo "<div id=\"orden--1\">".$registro['numero_orden']."</div>";
		  $visto_bd = $registro['visto_bueno'];
		  
		  //Aqui se calculan los dias que van transcurriendo desde la emision de la OC
		  $fecha = $registro['fecha'];		  
		  $todate = date("Y-m-d",strtotime($fecha));		  
		  $fecha_format = date("d-m-Y",strtotime($fecha));		  		  		  
		  date_default_timezone_set('America/Santiago');
		  $fromdate = date('Y-m-d', time());		  
		  $calculate_seconds = strtotime($fromdate) - strtotime($todate); // Numero de segundos entre las dos fechas
		  $days = floor($calculate_seconds / (24 * 60 * 60 )); // Conversion a dias	
		  
		  echo "<div id=\"orden--2\">".$fecha_format."</div>";
		  echo "<div id=\"orden--3\">".$registro['descripcion']."</div>";
		  echo "<div id=\"orden--4\">".$registro['orden_sap']."<span class=\"yes\"><img src=\"tema/img/yes.gif\" alt=\"\"></span>"."</div>";
		  echo "<div id=\"orden--5\">".$registro['orden_recepcion']."<span class=\"no\"><img src=\"tema/img/no.gif\" alt=\"\"></span>"."</div>";		  
		  //Aqui manipulo la fecha para que si pasa de 5 dias se muestre en rojo
		  if ($days>=5){
			echo "<div id=\"orden--6T\" style=\"color:#FF0000 \">".$days." dias"."</div>";
		  } else {
			  echo "<div id=\"orden--6T\" >".$days." dias"."</div>";
		  }	
		  echo "<div id=\"orden--6S\">";
            echo "<form class=\"choose\">";
              echo "<select name=\"revision\" form=\"revision\">";
                echo "<option value=\"si\">Elija</option>";
                echo "<option value=\"si\">Si</option>";
                echo "<option value=\"no\">No</option>";
              echo "</select>";
            echo "</form>";
          echo "</div>";
		  
		  echo "</div>";	
	?>	  		
	
	<p> </p>
	
	<?php }   }  // fin if  ?>
	
	</div>
	
    <div id="campana" class="grupo">
      <div class="caja-100">
        <div id="tabla">
          <div id="titulo--orden-1">Nº de OC</div>
          <div id="titulo--orden-2">Fecha</div>
          <div id="titulo--orden-3">Detalle</div>
          <div id="titulo--orden-4">OC SAP</div>
          <div id="titulo--orden-5">OC RECEPCIÓN</div>
          <div id="titulo--orden-6T"> <img src="tema/img/time.gif" alt=""></div>
          <div id="titulo--orden-6S">VºBº</div>
        </div>   		        
		
		<?php
		
		while ($reg=mysqli_fetch_array($rs))
		{
		  echo "<div id=\"tabla\">";
		  echo "<div id=\"orden--1\">".$reg['numero_orden']."</div>";	
		  $n_orden = $reg['numero_orden'];
		  
		  //Aqui se calculan los dias que van transcurriendo desde la emision de la OC
		  $fecha = $reg['fecha'];		  
		  $todate = date("Y-m-d",strtotime($fecha));		  
		  $fecha_format = date("d-m-Y",strtotime($fecha));		  		  		  
		  date_default_timezone_set('America/Santiago');
		  $fromdate = date('Y-m-d', time());		  
		  $calculate_seconds = strtotime($fromdate) - strtotime($todate); // Numero de segundos entre las dos fechas
		  $days = floor($calculate_seconds / (24 * 60 * 60 )); // Conversion a dias	
		  
		  echo "<div id=\"orden--2\">".$fecha_format."</div>";
		  echo "<div id=\"orden--3\">".$reg['descripcion']."</div>";
		  echo "<div id=\"orden--4\">".$reg['orden_sap']."<span class=\"yes\"><img src=\"tema/img/yes.gif\" alt=\"\"></span>"."</div>";
		  echo "<div id=\"orden--5\">".$reg['orden_recepcion']."<span class=\"no\"><img src=\"tema/img/yes.gif\" alt=\"\"></span>"."</div>";		  
		  //Aqui manipulo la fecha para que si pasa de 5 dias se muestre en rojo
		  if ($days>=5){
			echo "<div id=\"orden--6T\" style=\"color:#FF0000\">".$days." dias"."</div>";
		  } else {
			  echo "<div id=\"orden--6T\" >".$days." dias"."</div>";
		  }		  
		  echo "<div id=\"orden--6S\">";
            echo "<form method=\"POST\" id=\"$n_orden\" class=\"choose\" action=\"update-perfil-boss-vb-si.php\" >";
              echo "<select name=\"revision\" form=\"$n_orden\" onchange=\"this.form.submit()\">";			  
                echo "<option value=\"elija\">Elija</option>";
                echo "<option value=\"si.$n_orden\">Si</option>";
                echo "<option value=\"no.$n_orden\">No</option>";
              echo "</select>";
            echo "</form>";
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
				echo "<a href='perfil-boss-vb-si.php?pagina=" . $i . "'>" . $i . "</a> "; 
			} 
		}	
			echo "</div>";
		echo "</div>";
		
		?>
		
      </div>	  	  
    </div>
		
	
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