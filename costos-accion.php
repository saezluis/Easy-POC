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
			width: 80px !important; 
			height: 33px;
		}
		
		.paraSelect {
			width: 190px;
			height: 32px;
		}
	</style>
	
  </head>
  <body>
	<?php
		//header("Content-Type: text/html;charset=utf-8");
		//$conexion=mysqli_connect("localhost","pmdigita_admin","Prodigy12","pmdigita_test") or die("Problemas con la conexión");	
		$conexion=mysqli_connect("localhost","root","123","test") or die("Problemas con la conexión");		
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
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
        <form id="search-form" method="POST" action="" class="info--cliente" name="myform" >
		<button type="submit" value="Buscar" name="buscar" hidden=hidden></button>
          <div class="caja base-20">
            <label>Acción Camapaña</label>
			<select name="campana" class="" style="width: 190px;">
              <option selected="" value="-1">Elija</option>
            </select>			
          </div>
		  
          <div class="caja base-60">
            <label>PEP</label>
			<input type="text" class="pep">				
          </div>
		  
          <div class="caja base-20">
            <label>N° Solicitud</label>
			<input type="text" class="resizedTextbox">				
          </div>
		  
           
		  
           <div class="caja base-20">
            <label>Responsable</label>
			<select name="campana" class="paraSelect">
              <option selected="" value="-1"></option>
            </select>		
          </div>
		  
           <div class="caja base-60">
            <label>Autorizante</label>
			<select name="campana" class="paraSelect">
              <option selected="" value="-1"></option>
            </select>		
          </div>
		  
           <div class="caja base-20">
            <label>V°B° Jefatura</label>
			<input type="text">				
          </div>
			<!--aqui empezé-->
		<!--aqui termine-->
        </form>
        <form action="" class="registro-campana">
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
		            <th>Nº OC</th>
		          </tr>
		        </thead>
		        <tbody>
		          <tr>
		            <td class="area">Marketing Institucional</td>
		            <td class="ceco">CEE1007752</td>
		            <td class="desc-servicio">Impresos flyers</td>
		            <td class="reg-gasto">Impresiones Mundo Experto Volantes/mailing directo/cartas/</td>
		            <td class="pep">AM</td>
		            <td class="control-presupuesto">Impresos</td>
		            <td class="pep">IC</td>
		            <td class="ppto-proyecto">$ 5.000.000</td>
		            <td class="ppto-real">$ 7.000.000</td>
		            <td class="diferencia">$ 2.000.000</td>
		            <td class="nOC">123456789</td>
		          </tr>
		          <tr>
		            <td class="area">Mundo Experto</td>
		            <td class="ceco">CEE1007752</td>
		            <td class="desc-servicio">Impresos flyers</td>
		            <td class="reg-gasto">Impresiones </td>
		            <td class="pep">AM</td>
		            <td class="control-presupuesto">Impresos</td>
		            <td class="pep">IC</td>
		            <td class="ppto-proyecto">$ 155.000.000</td>
		            <td class="ppto-real">$ 7.000.000</td>
		            <td class="diferencia">$ 2.000.000</td>
		            <td class="nOC">123456789</td>
		          </tr>
		        </tbody>
		      </table>
		      <section class="grupo borde-tabla">
		        <table class="tot-base">
		          <thead>
		            <tr class="total-all">
		              <th> </th>
		              <th> </th>
		              <th> </th>
		              <th> </th>
		              <th> </th>
		              <th> </th>
		              <th>Total</th>
		              <th class="tot-1">$ 99.000.000</th>
		              <th class="tot-1">$ 5.000.000</th>
		              <th class="tot-1">$ 5.000.000</th>
		              <th> </th>
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