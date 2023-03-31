<?php
    error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once '../database/conexion.php';

    $marca=$_POST["marca"];
    $estado = 1;

    $agregar=$DB_con->prepare('INSERT INTO marca(marca,estado_marca) VALUES(:marca, :estado_marca)');
    $agregar->bindParam(':marca', $marca);
    $agregar->bindParam(':estado_marca', $estado);

    if ($agregar->execute()) {
        session_start();
        $_SESSION['agregar'] = 'registro';
        header("location: ../admin/marca.php");
    } else {
        session_start();
        $_SESSION['error'] = 'registro';
        header("location: ../admin/marca.php");
    }