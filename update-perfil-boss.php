<!DOCTYPE html>
<html lang="es">
  <head>
  </head>
<body>
<?php
	
	$visto = substr(@$_POST["revision"],0,2);
	$nro_or = substr(@$_POST["revision"],3,6);
	
	echo "<form id=\"form\" method=\"POST\" action=\"send-no-msj.php\" >";
	
	$id_user = $_REQUEST['id_user_send'];
	
	echo "<input type=\"text\" name=\"id_user_send\" value=\"$id_user\" hidden=hidden >";
	echo "<input type=\"text\" name=\"nro_or_send\" value=\"$nro_or\" hidden=hidden >";
?>

	<input id="campo2" type="text" name="razon_send" value="" hidden=hidden>
	
	</form>

<?php
	
	//$id_user = $_REQUEST['id_user_send'];
	
	//echo "id user:".$id_user;
	//echo "<br>";
	
	//$razon = $_REQUEST['razon_send'];
	
	//echo "razon: ".$razon;
	//echo "<br>";
	
	include "config.php";

	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosUsuario=mysqli_query($conexion,"select * from members where id = $id_user ") or die("Problemas en el select:".mysqli_error($conexion));
	
	if($reg=mysqli_fetch_array($registrosUsuario)){
		$email_user = $reg['username'];
		$nombre = $reg['nombre'];
		$apellido = $reg['apellido'];
	}
	
	$nombre_final = $nombre." ".$apellido;
	//echo "Visto bueno: ".substr(@$_POST["revision"],0,2);
	//echo " nro orden: ".substr(@$_POST["revision"],3,6);
		
	
		
	if ($visto=="si"){
			//echo "Ahora visto si esta lleno";
		mysqli_query($conexion,"UPDATE ordenes SET visto_bueno=\"si\" where numero_orden = \"$nro_or\"") or
		die("Problemas en el select:".mysqli_error($conexion));				
			
		
		$to = $email_user;
		$subject = "OC SAP aprobada";		
		$message = "Su orden SAP nro:$nro_or ha sido aprobada";
		$headers = "Sistema Easy POC";
		
		mail($to,$subject,$message,$headers);
		
		echo "<script>
			alert('Visto bueno de la OC Nro: $nro_or modificado con exito, usuario: $nombre_final notificado.');
			window.location.href='perfil-boss.php';
			</script>";	
			
		
	}
		
	if ($visto=="no"){
		
			echo "<script>
				//alert('Visto bueno no modificado');
			
				//function myFunction() {
				var person = prompt('Introduza la razón por la cual fue denegada la OC SAP:','');
			
					if (person != null) {
						document.getElementById('campo2').value = person;
						document.getElementById('form').submit();
					}
				//}
			</script>";
			
			
			
			echo "<script>
				//window.location.href='perfil-boss.php';
			</script>";
				
			//echo "<input id=\"campo2\" type=\"text\" name=\"id_user_send\" value=\"\" >";	
		}
		//header("location:perfil-boss.php");						
		
?>  

<body>
</html>