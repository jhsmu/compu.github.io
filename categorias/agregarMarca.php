<?php
    error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once '../database/conexion.php';

    $marca=$_POST["marca"];

    $agregar=$DB_con->prepare('INSERT INTO marca(marca) VALUES(:marca)');
    $agregar->bindParam(':marca', $marca);

    if ($agregar->execute()) {
        echo '<script> confirm("registro correcto")</script>';
        header("location:marca.php");
    } else {
        echo '<script> alert("registro incorrecto")</script>';
        header("location:marca.php");
    }