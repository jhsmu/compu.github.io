<?php
    error_reporting( ~E_NOTICE ); // avoid notice
	
	include '../database/conexion.php';

    //Definimos las variables
    $estado=1;
    $serial=$_POST["serial"];
    $producto=$_POST["producto"];
    $descripcion_breve=$_POST["descripcion_breve"];
    $descripcion=$_POST["descripcion"];
    $cantidad=$_POST["cantidad"];
    $precio=$_POST["precio"];
    $id_categoria=$_POST["categoria"];
    $id_marca=$_POST["marca"];
    $id_proveedor=$_POST["proveedor"];
    $total=$cantidad*$precio;

    //Primero agregamos el producto en la tabla producto
    $agregar=$DB_con->prepare('INSERT INTO producto(serial, producto, descripcion_breve, descripcion, cantidad, precio, id_categoria, id_marca, estado_producto) VALUES(:serial, :producto, :descripcion_breve, :descripcion, :cantidad, :precio, :categoria, :marca, :estado_producto)');
    $agregar->bindParam(':serial', $serial);
    $agregar->bindParam(':producto', $producto);
    $agregar->bindParam(':descripcion_breve', $descripcion_breve);
    $agregar->bindParam(':descripcion', $descripcion);
    $agregar->bindParam(':cantidad', $cantidad);
    $agregar->bindParam(':precio', $precio);
    $agregar->bindParam(':categoria', $id_categoria);
    $agregar->bindParam(':marca', $id_marca);
    $agregar->bindParam(':estado_producto', $estado);
    $agregar->execute();

    $idProducto=$DB_con->lastInsertId();


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
            $userpic = $imgFile;
                
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
            $agregar->bindParam(':producto', $idProducto);
            $agregar->bindParam(':ruta', $userpic);
            $agregar->execute();
        }
    }


    $compra=$DB_con->prepare('INSERT INTO compra(id_proveedor, id_producto, cantidad, precio, total) VALUES(:proveedor, :producto, :cantidad, :precio, :total)');
    $compra->bindParam(':proveedor', $id_proveedor);
    $compra->bindParam(':producto', $idProducto);
    $compra->bindParam(':cantidad', $cantidad);
    $compra->bindParam(':precio', $precio);
    $compra->bindParam(':total', $total);

    if ($compra->execute()) {
        session_start();
        $_SESSION["producto"]="Registro correcto";
        header("location:../admin/productos.php");
    } else {
        session_start();
        $_SESSION["producto_error"]="Registro";
        header("location:../admin/productos.php");
    }