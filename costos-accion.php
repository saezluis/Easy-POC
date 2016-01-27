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
	
	<style>
		.resizedTextbox {
			width: 190px !important; 
			height: 33px;
		}
		
		.resizedTextbox2 {
			width: 190px !important; 
			height: 33px;
		}
		
		.pep {
			width: 35px !important; 
			height: 33px;
		}
		
		.paraSelect {
			width: 190px;
			height: 32px;
		}
		
		.pptoReal {
			width: 69px;
		}
		
		.ccs_nroOC {
			width: 30px;
			border: none;
			text-align: center;
		}
		
	</style>
	
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$("#nro_solicitud").keyup(function(){
				//Get
				var nro_so = $('#nro_solicitud').val();

				//Set
				$('#nroSolicitudBox').val(nro_so);				
			});
		})
	</script>
	
  </head>
  <body>
	<?php
		//header("Content-Type: text/html;charset=utf-8");
		//$conexion=mysqli_connect("localhost","pmdigita_admin","Prodigy12","pmdigita_test") or die("Problemas con la conexión");	
		include "config.php";
		
		//inicializacion de variales
		$id_user="";
		$nombre="";
		$apellido="";
		$nombre_completo="";
		$jefe_autorizacion="";
		$variable_increment = 0;
		$variable_increment2 = 0;
		$suma_PPTO = 0;
		$suma_PPTO_format = 0;
		$ppto_real="";
		$ppto_real_suma="";
		$ppto_real_suma_format=0;
		$ppto_real_format=0;
		$diferencia_total_sum=0;
		$diferencia_total_sum_format=0;
		
		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$registrosCamapana=mysqli_query($conexion,"SELECT * FROM campana") or die("Problemas en el select de registros campaña:".mysqli_error($conexion));
		
		@$id_campana_get2 = @$_REQUEST['campana'];
		
		$registrosOC=mysqli_query($conexion,"SELECT * FROM ordenes WHERE campana = '$id_campana_get2'");
		
		$registrosOC2=mysqli_query($conexion,"SELECT * FROM ordenes WHERE campana = '$id_campana_get2'");
		
		$rows = mysqli_num_rows($registrosOC);
		
		/*echo "Esta devolviendo este nro de OC: ".$rows;
		echo "<br>";
		echo "<br>";*/
		
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
			<!--
            <li> <a href="perfil-sap.php" >Historial de órdenes</a></li>
			-->
			<li> </li>
			<li> </li>
			<li> </li>
			<li> </li>
			<li> </li>
			<!--
			<li> <a href="historial-ordenes.php" >Historial de órdenes</a></li>
			-->
			<!--
				<li> <a href="por-revisar-sap.php" class="active" >Por revisar</a></li>
			-->
          </ul>
        </nav>
		<!--
		<div class="counter">15</div>
		-->
		<?php //echo "<div class=\"counter\">$num_rows</div>"; ?>        
      </div>
      <div class="caja base-100 no-padding">
        <h2></h2>
        <p></p>
      </div>
    </header>
	
    <div id="data--input" class="grupo">
      <h3>Costos Acción / Camapaña</h3>
    </div>
    <div class="grupo no-padding">
      <div class="caja base-100">
        <form id="search-form" method="POST" action="costos-accion.php" class="info--cliente" name="myform" >
		<!--
		<button type="submit" value="Buscar" name="buscar" hidden=hidden></button>
		-->
          <div class="caja base-20">
            <label>Acción Camapaña</label>
			<select name="campana" class="" style="width: 190px;" onchange="this.form.submit()">
				<?php
					@$id_campana_get1 = @$_REQUEST['campana'];
					echo "<option value=\"-1\" >Elija</option>";
					while($reg=mysqli_fetch_array($registrosCamapana)){
						$nombre_campana = $reg['nombre_campana'];
						$id_campana = $reg['id_campana'];
						
						if(@$id_campana_get1==$id_campana){
							echo "<option value=\"$id_campana\" selected=selected>$nombre_campana</option>";
						}else{
							echo "<option value=\"$id_campana\">$nombre_campana</option>";
						}
					}
				?>
            </select>			
          </div>
		  
          <div class="caja base-60">
            <label>PEP</label>
				<?php
					@$id_campana_get = @$_REQUEST['campana'];
					if($id_campana_get!='-1'){
						@$registrosCampa=mysqli_query($conexion,"SELECT * from campana WHERE id_campana = '$id_campana_get'") or die("Problemas en el select de registros campa:".mysqli_error($conexion));
						if(@$reg=mysqli_fetch_array($registrosCampa)){
							@$id = $reg['id'];
							echo "<span>$id</span>";
						}
					}else{
						echo "";
					}
				?>
          </div>
		  
          <div class="caja base-20">
            <label>N° Solicitud</label>
			<input type="text" id="nro_solicitud" class="resizedTextbox">				
          </div>
		  
           
		  
           <div class="caja base-20">
            <label>Responsable</label>
				<?php
					if($reg=mysqli_fetch_array($registrosOC)){
						$id_user = $reg['id_user'];
						$jefe_autorizacion = $reg['jefe_autorizacion'];
					}
					
					$registrosUser=mysqli_query($conexion,"SELECT * FROM members WHERE id = '$id_user'") or die("Problemas en el select de registros user:".mysqli_error($conexion));
						if($reg=mysqli_fetch_array($registrosUser)){
							$nombre = $reg['nombre'];
							$apellido = $reg['apellido'];
						}
						$nombre_completo = $nombre." ".$apellido;
						
					echo "<input type=\"text\" value=\"$nombre_completo\" class=\"resizedTextbox\">";
				?>
          </div>
		  
           <div class="caja base-60">
            <label>Autorizante</label>
				<?php
					echo "<input type=\"text\" value=\"$jefe_autorizacion\" class=\"resizedTextbox\">";
				?>
          </div>
		  
           <div class="caja base-20">
            <label>V°B° Jefatura</label>
			<input type="text">				
          </div>
			<!--aqui empezé-->
		<!--aqui termine-->
        </form>
        <form action="costos-accion-refresh.php" method="POST" class="registro-campana">
		    <section class="grupo">
		      <table class="table">
		        <thead>
		          <tr class="cabecc">
		            <th>Área</th>
		            <th>CECO</th>
		            <th>Desc. Servicio</th>
		            <th>Reg. gasto</th>
		            <th>PEP</th>
		            <th>Control presup.</th>
		            <th>PEP</th>
		            <th>PPTO proyect.</th>
		            <th>PPTO real</th>
		            <th>Diferencia</th>
		            <th>NºOC</th>
					<th>V°B°</th>
					<th>Actualizar</th>
		          </tr>
		        </thead>
		        <tbody>		          
					<?php
						while($reg=mysqli_fetch_array($registrosOC2)){
							
							$numero_orden = $reg['numero_orden'];
							$descripcion_oc = $reg['descripcion'];
							$area_pago = $reg['area_pago'];
							$registro_gasto = $reg['registro_gasto'];
							$control_presupuesto = $reg['control_presupuesto'];
							$total_final = $reg['total_final'];
							$campana_send = $reg['campana'];
							
							$total_sin_dots = str_replace(".","",$total_final);
							$suma_PPTO = $suma_PPTO + $total_sin_dots;							
							$suma_PPTO_format = number_format($suma_PPTO,0, ",", ".");
							
							$ppto_real_name = 'ppto';
							$variable_increment = $variable_increment + 1;
							$ppto_real_name_final = $ppto_real_name.$variable_increment;
							
							$nro_oc = 'nroOC';
							$variable_increment2 = $variable_increment2 + 1;
							$nro_oc_name_final = $nro_oc.$variable_increment2;
							
							$registrosAreaPago=mysqli_query($conexion,"SELECT * FROM centro_costo WHERE id_centro_costo = '$area_pago'") or die("Problemas en el select de registros Area Pago:".mysqli_error($conexion));
							
							if($reg2=mysqli_fetch_array($registrosAreaPago)){
								$descripcion = $reg2['descripcion'];
								$ceco = $reg2['ceco'];
							}
							
							$registrosRegistro=mysqli_query($conexion,"SELECT * FROM registro WHERE id_registro = $registro_gasto") or die("Problemas en el select de Registros:".mysqli_error($conexion));
							
							if($reg3=mysqli_fetch_array($registrosRegistro)){
								$registro_gasto_name = $reg3['registro_gasto'];
								$id_sap_RG = $reg3['id'];
							}
							
							$registrosControlPre=mysqli_query($conexion,"SELECT * FROM control_presupuesto WHERE id_controlP = $control_presupuesto") or die("Problemas en el select de Control Presupuesto:".mysqli_error($conexion));
							
							if($reg4=mysqli_fetch_array($registrosControlPre)){
								$id_cp = $reg4['id'];
								$control_pre_name = $reg4['control_presupuesto'];
							}
							
							$registrosCac=mysqli_query($conexion,"SELECT * FROM cac WHERE nro_oc = $numero_orden") or die("Problemas en el select de Registros CAC:".mysqli_error($conexion));
							
							if($reg5=mysqli_fetch_array($registrosCac)){
								$nro_oc = $reg5['nro_oc'];
								$ppto_real = $reg5['ppto_real'];
								$ppto_real_format = number_format($ppto_real,0, ",", ".");
							}
							
							$ppto_real_suma = $ppto_real_suma + $ppto_real;
							$ppto_real_suma_format = number_format($ppto_real_suma,0, ",", ".");
							
							$sub_t_diferencia = $ppto_real - $total_sin_dots;
							$sub_t_diferencia_format = number_format($sub_t_diferencia,0, ",", ".");
							
							$diferencia_total_sum = $diferencia_total_sum + $sub_t_diferencia;
							$diferencia_total_sum_format = number_format($diferencia_total_sum,0, ",", ".");
							
							echo "<tr>";
							echo "<td class=\"area\">$descripcion</td>";
							echo "<td class=\"ceco\">$ceco</td>";
							echo "<td class=\"desc-servicio\">$descripcion_oc</td>";
							echo "<td class=\"reg-gasto\">$registro_gasto_name</td>";
							echo "<td class=\"pep\">$id_sap_RG</td>";
							echo "<td class=\"control-presupuesto\">$control_pre_name</td>";
							echo "<td class=\"pep\">$id_cp</td>";
							echo "<td class=\"ppto-proyecto\">$ $total_final</td>";							
							if($nro_oc==$numero_orden){
								echo "<td class=\"ppto-real\"><input type=\"text\" name=\"$ppto_real_name_final\" value=\"$ppto_real_format\" class=\"pptoReal\"></input></td>";
							}else{
								echo "<td class=\"ppto-real\"><input type=\"text\" name=\"$ppto_real_name_final\" value=\"\" class=\"pptoReal\"></input></td>";
							}
							echo "<td class=\"diferencia\">$ $sub_t_diferencia_format</td>";
							echo "<td class=\"nOC\"><input type=\"text\" name=\"$nro_oc_name_final\" value=\"$numero_orden\" class=\"ccs_nroOC\" readonly></input></td>";
							echo "<td>
							<select>
								<option value=\"-1\">--</option>
								<option value=\"si\">si</option>
								<option value=\"no\">no</option>
							</select>
							</td>";
							echo "<td><a href=\"#\" onclick=\"$(this).closest('form').submit()\">OK</a></td>";
							echo "</tr>";
							echo "<input type=\"text\" value=\"$campana_send\" name=\"campana_send\" hidden=hidden >";
						}
						
					?>
		        </tbody>
		      </table>
		      <section class="grupo borde-tabla">
		        <table class="tot-base">
		          <thead>
		            <tr class="total-all">
		              <th> </th>
		              <th style="width: 120px;"> </th>
		              <th style="width: 80px;"> </th>
		              <th style="width: 50px;"> </th>
		              <th style="width: 50px;"> </th>
		              <th> </th>
		              <th>Total</th>
						<?php
							echo "<th class=\"tot-1\" style=\"width:7%; font-size:11px !important;\"  >$ $suma_PPTO_format</th>";
							echo "<th class=\"tot-1\" style=\"width:7%; font-size:11px !important;\">$ $ppto_real_suma_format</th>";
							echo "<th class=\"tot-1\" style=\"width:7%; font-size:11px !important;\">$ $diferencia_total_sum_format</th>";
						?>
		              <!--
					  <th><a href="costos-accion.php">actualizar</a> </th>
					  -->
					  <?php
						//echo "<th><a href=\"costos-accion.php?id_campana_send=",urlencode(@$id_campana_get2)," \">actualizar</a></th>";
						echo "<input type=\"text\" value=\"$rows\" name=\"rows\" hidden=hidden />";
						
						echo "<input type=\"text\" value=\"Dummy\" name=\"ppto0\" hidden=hidden />";
						echo "<input type=\"text\" value=\"Decoy\" name=\"nroOC0\" hidden=hidden />";
						
						echo "<input type=\"text\" id=\"nroSolicitudBox\" value=\"\" name=\"nro_solicitud_send\" hidden=hidden />";
						
						echo "<th></th>"; //<button type=\"submit\">actualizar</button>
					  ?>
					  
		            </tr>
		          </thead>
		        </table>
		      </section>
		    </section>
        </form>		
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