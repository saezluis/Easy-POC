<?php
  session_start();

  if(!isset($_SESSION['username'])){
    header("location:login.php");
  }
  
?>
<?php

	header('Content-Type: text/html; charset=utf-8');
	
	$clave_anterior = $_REQUEST['clave_anterior'];
	$nueva_clave = $_REQUEST['nueva_clave'];
	$nueva_clave_repita = $_REQUEST['nueva_clave_repita'];
	
	include "config.php";
	
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$username = $_SESSION['username'];
	
	$registrosMembers=mysqli_query($conexion,"SELECT * FROM members WHERE username = '$username' ") or die("Problemas en el select:".mysqli_error($conexion));
	
	if($reg=mysqli_fetch_array($registrosMembers)){
		$password = $reg['password'];
		
		if($password==$clave_anterior && $nueva_clave==$nueva_clave_repita){
				mysqli_query($conexion, "UPDATE members SET password='$nueva_clave_repita' WHERE username='$username' ") or die("Problemas en el select:".mysqli_error($conexion));
				echo "<script>
						alert('Clave actualizada con éxito');
						window.location.href = \"mi-perfil.php\";
					</script>";	
					//header("location:mi-perfil.php");			
		}
		
		if($password==$clave_anterior && $nueva_clave!=$nueva_clave_repita){
				echo "<script>
						alert('Las claves no coindiden');
						window.location.href = \"mi-perfil.php\";
					</script>";			
					//header("location:mi-perfil.php");			
		}
			
		if($password!=$clave_anterior){
			echo "<script>
						alert('Error: clave anterior incorrecta');
						window.location.href = \"mi-perfil.php\";
					</script>";
					//header("location:mi-perfil.php");
		}
	}
	
	

?>