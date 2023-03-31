<?php
    //Para poder usar la clase Database y su función connect
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $proveedor = $_POST['proveedor'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $web = $_POST['direccion_web'];
        $direccion = $_POST['direccion'];
        $nit= $_POST['nit'];
        $estado=$_POST['estado_proveedor'];

        $query = $connection->prepare("UPDATE proveedor SET proveedor=?, nit=?, correo=?, telefono=?, direccion_web=?, direccion=?, estado_proveedor=? WHERE id_proveedor=?");// Traduzco mi petición
        $actualizar = $query->execute([$proveedor, $nit, $correo, $telefono, $web, $direccion, $estado, $id]); //Ejecuto mi petición

        if ($actualizar) {
            session_start();
            $_SESSION['actualizar'] = 'registro';
            header("location: ../admin/proveedor.php");
        } else {
            session_start();
            $_SESSION['error_actualizar'] = 'actualizar';
            header("location: ../admin/proveedor.php");
        }
    }
?>