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
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosOrdenes=mysqli_query($conexion,"select * from ordenes") or
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
	  <h4>Consultar Ordenes de Compra</h4>
	  <h6><a href="administrador-oc.php">Volver</a></h6>
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
      
    </section>
    <section class="grupo">
      <table class="table-sap">
        <thead>
          <tr class="cabecc-sap">
            <th>Nro OC</th>
			<th>Generada por</th>
            <th>Nombre fantasía proveedor</th>
            <th>Campaña</th>
            <th>Fecha</th>
            <th>Nro Presupuesto</th>
            <th>Nro Factura</th>            
          </tr>
        </thead>
        <tbody>
			<?php
				//id_proveedor debo buscar con esto nombre de fantasia
				//campana manda el id busco el nombre
				
				while($reg=mysqli_fetch_array($registrosOrdenes)){
					$numero_orden = $reg['numero_orden'];
					$id_proveedor = $reg['id_proveedor'];
					$campana = $reg['campana'];
					$fecha_oc = $reg['fecha'];
					$nro_presupuesto_proveedor = $reg['nro_presupuesto_proveedor'];
					$nro_factura_proveedor = $reg['nro_factura_proveedor'];
					$id_user = $reg['id_user'];
					
					$registrosProveedor=mysqli_query($conexion,"select * from proveedor WHERE id_proveedor=$id_proveedor") or die("Problemas en el select:".mysqli_error($conexion));
					
					if($regPr=mysqli_fetch_array($registrosProveedor)){
						$nombre_proveedor = $regPr['nombre'];
					}
					
					$registrosCampana=mysqli_query($conexion,"select * from campana WHERE id_campana=$campana") or die("Problemas en el select:".mysqli_error($conexion));
					
					if($regCa=mysqli_fetch_array($registrosCampana)){
						$nombre_campana = $regCa['nombre_campana'];
					}
					
					$registrosUser=mysqli_query($conexion,"select * from members WHERE id=$id_user") or die("Problemas en el select:".mysqli_error($conexion));
					
					if($regU=mysqli_fetch_array($registrosUser)){
						$nombre = $regU['nombre'];
						$apellido = $regU['apellido'];
					}
					
					$newDate_oc = date("d-m-Y", strtotime($fecha_oc));	
					
					echo "<tr>";
						echo "<td class=\"area\"><a href=\"consultar-oc-detalle.php?oc_send=",urlencode($numero_orden),"  \">$numero_orden</a></td>";
						echo "<td class=\"ceco\">$nombre $apellido</td>";
						echo "<td class=\"ceco\">$nombre_proveedor</td>";
						echo "<td class=\"desc-servicio\">$nombre_campana</td>";
						echo "<td class=\"ppto-proyecto\">$newDate_oc</td>";
						echo "<td class=\"ppto-real\">$nro_presupuesto_proveedor</td>";
						echo "<td class=\"ppto-proyecto\">$nro_factura_proveedor</td>";						
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