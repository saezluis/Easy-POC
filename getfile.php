<html>
<head>
<title></title>
</head>
<body>

<?php 

	//echo "numero de orden ".$_REQUEST['nro_orden_form'];
	$nombrefile = $_REQUEST['nro_orden_form'];

// Configuration - Your Options
      $allowed_filetypes = array('.jpg','.gif','.bmp','.png'); // These will be the types of file that will pass the validation.
      $max_filesize = 555524288; // Maximum filesize in BYTES (currently 0.5MB).
      $upload_path = './uploads/'; // The place the files will be uploaded to (currently a 'files' directory).

   $filename = $_FILES["userfile"]["name"]; // Get the name of the file (including file extension).
   $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the extension from the filename.

   // Check if the filetype is allowed, if not DIE and inform the user.
   //if(!in_array($ext,$allowed_filetypes))
      //die('The file you attempted to upload is not allowed.');

   // Now check the filesize, if it is too large then DIE and inform the user.
   if(filesize($_FILES["userfile"]["tmp_name"]) > $max_filesize)
      die('The file you attempted to upload is too large.');

   // Check if we can upload to the specified path, if not DIE and inform the user.
   if(!is_writable($upload_path))
      die('You cannot upload to the specified directory, please CHMOD it to 777.');
			
	
    $hora = time(); // this will give the file current time so avoid files having the same name
	$filename = $hora . $filename;
   // Upload the file to your specified path.
   if(move_uploaded_file($_FILES["userfile"]["tmp_name"],$upload_path . $nombrefile.$ext))
         //echo time(). ' Your file upload was successful, view the file <a href="' . $upload_path . $filename . '" title="Your File">here</a>'; // It worked.
		 echo "Carga completada";
      else
         echo 'There was an error during the file upload.  Please try again.'; // It failed :(.

	 header('Location: perfil-sap.php');  
	
?>

	   

</body>
</html>