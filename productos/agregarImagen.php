<?php

	error_reporting( ~E_NOTICE ); // avoid notice
	
	include '../database/conexion.php';
	
	if(isset($_POST['agregar']))
	{
		$id_producto=$_POST['producto'];

		foreach ($_FILES['imagen']['tmp_name'] as $key => $value) { 
	
			$imgFile = $_FILES['imagen']['name'][$key];
			$tmp_dir = $_FILES['imagen']['tmp_name'][$key];
			$imgSize = $_FILES['imagen']['size'][$key];

			if(empty($imgFile)){
				$errMSG = "Seleccione el archivo de imagen.";
			}
			else
			{
				$upload_dir = '../imagenes/'; // upload directory
		
				$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			
				// valid image extensions
				$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'webp'); // valid extensions
			
				// rename uploading image
				$userpic = rand(1000,1000000).".".$imgExt;
					
				// allow valid image file formats
				if(in_array($imgExt, $valid_extensions)){			
					// Check file size '1MB'
					if($imgSize < 1000000)				{
						move_uploaded_file($tmp_dir,$upload_dir.$userpic);
					}
					else{
						$errMSG = "Su archivo es muy grande.";
					}
				}
				else{
					$errMSG = "Solo archivos JPG, JPEG, PNG, GIF & WEBP son permitidos.";		
				}
			}
			
			
			// if no error occured, continue ....
			if(!isset($errMSG))
			{
				$agregar=$DB_con->prepare('INSERT INTO imagenes(producto_id, url) VALUES(:producto, :ruta)');
				$agregar->bindParam(':producto', $id_producto);
				$agregar->bindParam(':ruta', $userpic);
				$agregar->execute();
			}
		}
	header("location:imgane.php"); // redirects image view page after 5 seconds.
	}