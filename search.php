<?php
    $key=$_GET['key'];
    $array = array();
	
	include "config.php";
	
	$con=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		//echo $buscar;
	$consulta_mysql=mysqli_query($con,"select * from proveedor where nombre LIKE '%{$key}%'") or
		//142-424-555
		//$consulta_mysql=mysqli_query($conexion,"SELECT * FROM ordenes WHERE numero_orden = '142-424-555'") or
		die("Problemas en el select:".mysqli_error($conexion));
	
    //$con=mysql_connect("localhost","root","123");
    //$db=mysql_select_db("test",$con);
    //$query=mysql_query("select * from members where username LIKE '%{$key}%'");
    while($row=mysqli_fetch_array($consulta_mysql))
    {
      $array[] = $row['nombre'];
    }
    echo json_encode($array);
?>
