<?php
    //Para poder usar la clase Database y su función connect
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $serial=$_POST["serial"];
        $producto=$_POST["producto"];
        $descripcion_breve=$_POST["descripcion_breve"];
        $descripcion=$_POST["descripcion"];
        $cantidad=$_POST["cantidad"];
        $precio=$_POST["precio"]*0.6;
        $id_categoria=$_POST["categoria"];
        $id_marca=$_POST["marca"];
        $estado=$_POST["estado"];

        $query = $connection->prepare("UPDATE producto SET serial=?, producto=?, descripcion_breve=?, descripcion=?, cantidad=?, precio=?, id_categoria=?, id_marca=?, estado_producto=? WHERE id_producto=?");// Traduzco mi petición
        $actualizar = $query->execute([$serial, $producto, $descripcion_breve, $descripcion, $cantidad, $precio, $id_categoria, $id_marca, $estado, $id ]); //Ejecuto mi petición

        if ($actualizar) {
            session_start();
            $_SESSION['actualizar_producto'] = 'registro';
            header("location: ../admin/productos.php");
        } else {
            session_start();
            $_SESSION['actualizar_error'] = 'registro';
            header("location: ../admin/productos.php");
        }
    }
?>