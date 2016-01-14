<!DOCTYPE html>
<html lang="es">
  <head>
    <title> </title>
	
  </head>
  <body>
  
	<?php
		
		include "config.php";
		
		$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		
		//echo "Visto bueno: ".substr(@$_POST["revision"],0,2);
		//echo " nro orden: ".substr(@$_POST["revision"],3,6);
			
		$visto = substr(@$_POST["revision"],0,2);
		$nro_or = substr(@$_POST["revision"],3,6);
		
		if ($visto=="no"){
			//echo "Ahora visto si esta lleno";
			mysqli_query($conexion,"UPDATE ordenes SET visto_bueno=\"no\" where numero_orden = \"$nro_or\"") or
			die("Problemas en el select:".mysqli_error($conexion));				
			
			echo "<script>
				alert('Visto bueno del la OC Nro: $nro_or modificado a NO con exito');
				window.location.href='perfil-boss-vb-si.php';
				</script>";			
		}
		
		if ($visto=="si"){
		
			echo "<script>
				alert('Visto bueno no modificado');
				window.location.href='perfil-boss-vb-si.php';
				</script>";	
		
		}
		//header("location:perfil-boss.php");						
		
	?>  
  
  </body>
	
	


</html>