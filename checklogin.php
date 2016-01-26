<?php
	/*
	ob_start();
	session_start();
	include_once 'config.php';

	// Connect to server and select databse.
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$db = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $username, $password);
	}
	catch(Exception $e)
	{
		die('Error : ' . $e->getMessage());
	}	

	// Define $myusername and $mypassword 
	$myusername = $_POST['myusername']; 
	$mypassword = $_POST['mypassword']; 

	// To protect MySQL injection
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
		
	$stmt = $db->query("SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'");

	// rowCount() is counting table row
	$count = $stmt->rowCount();

	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count == 1){

		// Register $myusername, $mypassword and print "true"
		echo "true";
		$_SESSION['username'] = 'myusername';
		$_SESSION['password'] = 'mypassword';
		//$_SESSION['dato'] = "1";
		
	}
	else {
		//return the error message
		echo "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Nombre de usuario o clave incorrectos</div>";
	}

	ob_end_flush();
	*/
	
	session_start();

		include "config.php";
	
	 //$host_db = "localhost";
	 //$user_db = "root";
	 //$pass_db = "123";
	 //$db_name = "test";
		$tbl_name = "members";

		// Connect to server and select databse.
		$con=mysqli_connect($host, $username, $password)or die("Cannot Connect to Data Base.");

		mysqli_select_db($con,$db_name)or die("Cannot Select Data Base");

		// sent from form
		$username = $_POST['myusername'];
		$password = $_POST['mypassword'];

		$sql= "SELECT * FROM $tbl_name WHERE username = '$username' and password ='$password'";

		$result=mysqli_query($con,$sql);

		// counting table row
		@$count = mysqli_num_rows(@$result);
		// If result matched $username and $password
		
		if($row=(mysqli_fetch_array($result))){
			$tipo_user = $row['tipo_user'];
		}
		
		//echo "Tipo user: ".$tipo_user;
		//echo "<br>";
		//echo "count: ".$count;
		
		if($count == 1){

		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $username;
		$_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start'] + (100 * 100 * 60) ;//ojo quitarle las 3 horas a la sesion
	
			if($tipo_user=='admin'){
			
				echo '<script type="text/javascript">';
				echo 'window.location.href="administrador.php";';
				echo '</script>';	
				
			}
			
			if($tipo_user=='user'){
				
				//echo "Entro a tipo user, exito..!";
				//header("Location:emision.php");
				
				echo '<script type="text/javascript">';
				echo 'window.location.href="emision.php";';
				echo '</script>';
				
			}
			
			if($tipo_user=='boss'){
				
				//echo "Entro a tipo user, exito..!";
				//header("Location:emision.php");
				
				echo '<script type="text/javascript">';
				echo 'window.location.href="seleccion-boss.php";';
				echo '</script>';
				
			}
			
			if($tipo_user=='sap'){
				
				//echo "Entro a tipo user, exito..!";
				//header("Location:emision.php");
				
				echo '<script type="text/javascript">';
				echo 'window.location.href="perfil-sap.php";';
				echo '</script>';
				
			}
			
			
			
			
		}
		else{
			  echo "<h1>Algo ocurrió mal :(</h1>";
			  echo "<p class=\"alarm\">Tu correo o contraseña está incorrecta, haz click <a href=\"login.php\">aquí  </a>para volver a intentarlo.</p>";
			
		}
	
?>
