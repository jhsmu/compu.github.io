<?php
    error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once '../database/conexion.php';

    $categoria=$_POST["categoria"];
    $estado = 1;

    $agregar=$DB_con->prepare('INSERT INTO categoria(categoria,estado_categoria) VALUES(:categoria, :estado_categoria)');
    $agregar->bindParam(':categoria', $categoria);
    $agregar->bindParam(':estado_categoria', $estado);

    if ($agregar->execute()) {
        session_start();
        $_SESSION['categoria'] = 'registro';
        header("location: ../admin/categoria.php");
    } else {
        echo '<script> alert("registro incorrecto")</script>';
        header("location:categoria.php");
    }