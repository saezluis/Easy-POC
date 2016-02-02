<?php

	require_once('/PHPMailer/class.phpmailer.php');
	
	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$nro_oc = $_REQUEST['nro_oc_enviar'];
	
	$nombre_para = $_REQUEST['nombre_para']; //Esto servira para guardar en BBDD 
	$email_para = $_REQUEST['email_para'];
	$nombre_de = $_REQUEST['nombre_de'];
	$email_de = $_REQUEST['email_de'];
	$asunto = $_REQUEST['asunto'];
	$comentario = $_REQUEST['comentario'];
	
	$nro_oc_send = $_REQUEST['nro_oc_send'];
	$nro_rc_send = $_REQUEST['nro_rc_send'];
	
	mysqli_query($conexion,"INSERT INTO historial_oc(para,email_para,de,email_de,asunto,documento_oc_sap,documento_oc_re,comentario) values 
							('$nombre_para',
							'$email_para',
							'$nombre_de',
							'$email_de',
							'$asunto',
							'$nro_oc_send',
							'$nro_rc_send',
							'$comentario'
							)")or die("Problemas con el insert del proveedor");
	
	echo "nro que trae: ".$nro_oc;

	$email = new PHPMailer();
	$email->From      = $email_de;
	$email->FromName  = $nombre_de;
	$email->Subject   = $asunto;
	$email->Body      = $comentario;
	$email->AddAddress( $email_para );

	$file_to_attach = '/uploads/';

	$email->AddAttachment( $file_to_attach , $nro_oc_send );

	return $email->Send();
	
	
?>