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
		
		$nro_oc = $_REQUEST['nro_OC_send'];
	
		//echo "nro que trae: ".$nro_oc;
		
		include "config.php";
		
		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$nro_orden_comp = $nro_oc . ".pdf";
		$nro_recep_comp = $nro_oc."-or".".pdf";
		
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
            <li> <a href="emision.php">Emisor de órdenes de compra</a></li>
			-->
            <li> </li>
          </ul>
        </nav>
      </div>
      <div class="caja base-100 no-padding">
        <h2>En esta sección podrás enviar las OC SAP y OC recepción a los proveedores.</h2>
      </div>
    </header>
    <div id="data--input" class="grupo">
      <h3></h3>
    </div>
	
	<!-- Aqui se carga toda la informacion del historial -->
    <section class="grupo">
    	<form action="procesar-send-form.php" method="post" id="formulario__mail">
			<div class="wrap__total">
				<div class="wrap__input">
					<label for="">Para</label>
					<input type="text" name="nombre_para">
				</div>
				<div class="wrap__input">
					<label for="">Email</label>
					<input type="text" name="email_para">
				</div>
			</div><!-- fin wrap__total -->

			<div class="wrap__total">
				<div class="wrap__input">
					<label for="" class="marFo">De</label>
					<input type="text" name="nombre_de">
				</div>
				<div class="wrap__input">
					<label for="">Email</label>
					<input type="text" name="email_de">
				</div>
			</div><!-- fin wrap__total -->

			<div class="wrap__total">
				<label for="">Asunto</label>
				<input type="text" class="asunTForm" name="asunto">
			</div><!-- fin wrap__total -->

			<div class="wrap__total">
				<div class="wrap__input">
					<label for="" class="marFo">Archivo: OC SAP</label>
					<?php
						//echo "<input type=\"text\" style=\"width:95%; margin-top:10px;\">";
						echo "<br>";					
						echo "<a href=\"./uploads/$nro_orden_comp\" >Ver documento</a>"
					?>
				</div>
				<div class="wrap__input">
					<label for="" class="marFo">Archivo: OC Recepción</label>
					<?php
						//echo "<input type=\"text\" style=\"width:100%; margin-top:10px;\">";
						echo "<br>";					
						echo "<a href=\"./uploads/$nro_recep_comp\" >Ver documento</a>"
					?>
				</div>
			</div><!-- fin wrap__total -->

			<div class="wrap__total">
					<label for="" style="width:100%;">Comentario:</label>
					<textarea name="comentario" id="" style="width:100%; margin-top:10px; height:130px; margin-bottom:15px;"></textarea>
			</div><!-- fin wrap__total -->
			
			<?php
				echo "<input type=\"text\" name=\"nro_oc_send\" value=\"$nro_orden_comp\" hidden=hidden>";
				echo "<input type=\"text\" name=\"nro_rc_send\" value=\"$nro_recep_comp\" hidden=hidden>";
				
				echo "<input type=\"text\" name=\"nro_oc_enviar\" value=\"$nro_oc\" hidden=hidden>";
			
				echo "<input type=\"submit\" value=\"Enviar\" style=\"margin-right:15px;\">";
				//echo "<input type=\"submit\" value=\"Cancelar\" >";
				echo "<input type=\"button\" value=\"Cancelar\" onclick=\"history.go(-1);\">";
			?>
    		
    	</form>
      
    </section>
	
	
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