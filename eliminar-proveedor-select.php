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

	if(isset($_GET['letra'])){
		$letra = $_GET['letra'];
	}else{
		$letra = 'a';
	}	
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosProveedor=mysqli_query($conexion,"select * from proveedor WHERE nombre like '$letra%'") or
	die("Problemas en el select:".mysqli_error($conexion));
	
	
	?>
    <header class="grupo">
      <div class="caja base-50 no-padding">
        <h1> <a href="administrador.php" class="logo"> <img src="tema/img/logo.jpg" alt="POC"></a></h1>
      </div>
      <div class="caja base-50 no-padding"><a href="logout.php" class="logout">Logout</a></div>
    </header>
    <div id="data--input" class="grupo">
      <h3>Administrador</h3>
	  <h4>Modificar Proveedores</h4>
	  <h6><a href="administrador.php">Volver</a></h6>
	  <h6>Seleccione rut de proveedor que desea eliminar.</h6>
    </div>
    <section class="grupo">
      <div class="nav-admin">
        <ul>
			<!--
          <li><a href="administrador.php" class="consultar">Consultar</a></li>
          <li><a href="agregar.php" class="agregar">Agregar</a></li>
		  
          <li><a href="" class="modificar">Modificar</a></li>
          <li><a href="" class="eliminar">Eliminar</a></li>
		  -->
        </ul>
      </div>
    </section>
    <section class="grupo">
      <p>Filtrar por letra</p>
      <div class="filtroAbc">
        <?php
			$a='a';
			$b='b';
			$c='c';
			$d='d';
			$e='e';
			
			$f='f';
			$g='g';
			$h='h';
			$i='i';
			$j='j';
			
			$k='k';
			$l='l';
			$m='m';
			$n='n';
			$nn='ñ';
			
			$o='o';
			$p='p';
			$q='q';
			$r='r';
			$s='s';
			
			$t='t';
			$u='u';
			$v='v';
			$w='w';
			$x='x';
			
			$y='y';
			$z='z';
			
			echo "<ul>";		
			//echo "<td class=\"area\"><a href=\"consultar-orden.php?numero_orden=",urlencode($n_orden)," \">$n_orden</a></td>";			
				//echo "<li><a href=\"#\" class=\"hofil\">a</a></li>";
				if($letra=='a'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($a),"  \">a</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($a),"  \">a</a></li>";
				}
				if($letra=='b'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($b)," \">b</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($b)," \">b</a></li>";
				}
				if($letra=='c'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($c)," \">c</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($c)," \">c</a></li>";
				}
				if($letra=='d'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($d)," \">d</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($d)," \">d</a></li>";
				}
				if($letra=='e'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($e)," \">e</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($e)," \">e</a></li>";
				}
				
				
				if($letra=='f'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($f)," \">f</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($f)," \">f</a></li>";
				}
				if($letra=='g'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($g)," \">g</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($g)," \">g</a></li>";
				}
				if($letra=='h'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($h)," \">h</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($h)," \">h</a></li>";
				}
				if($letra=='i'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($i)," \">i</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($i)," \">i</a></li>";
				}
				if($letra=='j'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($j)," \">j</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($j)," \">j</a></li>";
				}
				
				if($letra=='k'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($k)," \">k</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($k)," \">k</a></li>";
				}
				if($letra=='l'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($l)," \">l</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($l)," \">l</a></li>";
				}
				if($letra=='m'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($m)," \">m</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($m)," \">m</a></li>";
				}
				if($letra=='n'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($n)," \">n</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($n)," \">n</a></li>";
				}
				if($letra=='ñ'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($nn)," \">ñ</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($nn)," \">ñ</a></li>";
				}
				
				if($letra=='o'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($o)," \">o</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($o)," \">o</a></li>";
				}
				if($letra=='p'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($p)," \">p</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($p)," \">p</a></li>";
				}
				if($letra=='q'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($q)," \">q</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($q)," \">q</a></li>";
				}
				if($letra=='r'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($r)," \">r</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($r)," \">r</a></li>";
				}
				if($letra=='s'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($s)," \">s</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($s)," \">s</a></li>";
				}
				
				if($letra=='t'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($t)," \">t</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($t)," \">t</a></li>";
				}
				if($letra=='u'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($u)," \">u</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($u)," \">u</a></li>";
				}
				if($letra=='v'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($v)," \">v</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($v)," \">v</a></li>";
				}
				if($letra=='w'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($w)," \">w</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($w)," \">w</a></li>";
				}
				if($letra=='x'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($x)," \">x</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($x)," \">x</a></li>";
				}
				
				if($letra=='y'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($y)," \">y</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($y)," \">y</a></li>";
				}
				if($letra=='z'){
					echo "<li><a class=\"hofil\" href=\"eliminar-proveedor-select.php?letra=",urlencode($z)," \">z</a></li>";
				}else{
					echo "<li><a href=\"eliminar-proveedor-select.php?letra=",urlencode($z)," \">z</a></li>";
				}
				
			echo "</ul>";
		?>
      </div>
    </section>
    <section class="grupo">
      <table class="table-sap">
        <thead>
          <tr class="cabecc-sap">
            <th>RUT</th>
            <th>Nombre fantasía</th>
            <th>Razón social</th>
            <th>Giro</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Contacto</th>
          </tr>
        </thead>
        <tbody>
			<?php
				
				while($reg=mysqli_fetch_array($registrosProveedor)){
					$rut = $reg['rut'];
					$nombre = $reg['nombre'];
					$razon_social = $reg['razon_social'];
					$giro = $reg['giro'];
					$direccion = $reg['direccion'];
					$telefono = $reg['telefono'];
					$contacto = $reg['contacto'];
				
					echo "<tr>";
						echo "<td class=\"area\"><a href=\"eliminar-proveedor.php?rut_s=",urlencode($rut)," \">$rut</a></td>";
						echo "<td class=\"ceco\">$nombre</td>";
						echo "<td class=\"desc-servicio\">$razon_social</td>";
						echo "<td class=\"ppto-proyecto\">$giro</td>";
						echo "<td class=\"ppto-real\">$direccion</td>";
						echo "<td class=\"ppto-proyecto\">$telefono</td>";
						echo "<td class=\"ppto-real\">$contacto</td>";
					echo "</tr>";
				}
				
			?>
        </tbody>
      </table>
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