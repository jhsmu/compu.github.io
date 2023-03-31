<?php
    //Para poder usar la clase Database y su función connect
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    $proveedor = $_POST['proveedor'];
    $nit = $_POST["nit"];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $web = $_POST['direccion_web'];
    $direccion = $_POST['direccion'];
    $estado=1;

    $query = $connection->prepare("INSERT INTO proveedor(proveedor, nit, correo, telefono,  direccion_web, direccion, estado_proveedor) VALUES(?, ?, ?, ?, ?, ?, ?)");// Traduzco mi petición
    $guardar = $query->execute([$proveedor, $nit, $correo, $telefono, $web, $direccion, $estado]); //Ejecuto mi petición

    if ($guardar) {
        session_start();
        $_SESSION['proveedor'] = 'registro';
        header("location: ../admin/proveedor.php");
        
    } else {
        session_start();
        $_SESSION['proveedor_error'] = 'guardad';
        header("location: ../admin/proveedor.php");
    }
