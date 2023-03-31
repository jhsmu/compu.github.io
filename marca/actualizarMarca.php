<?php
    //Para poder usar la clase Database y su función connect
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $marca = $_POST['marca'];
        $estado = $_POST["estado_marca"];

        $query = $connection->prepare("UPDATE marca SET marca=?, estado_marca=? WHERE id_marca=?");// Traduzco mi petición
        $actualizar = $query->execute([$marca, $estado, $id]); //Ejecuto mi petición

        if ($actualizar) {
            session_start();
            $_SESSION['actualizar_marca'] = 'registro';
            header("location: ../admin/marca.php");
        } else {
            $_SESSION['actualizar_error'] = 'registro';
            header("location: ../admin/marca.php");
        }
    }
?>