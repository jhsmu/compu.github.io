<?php
    //Para poder usar la clase Database y su función connect
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $categoria = $_POST['categoria'];
        $estado = $_POST["estado_categoria"];

        $query = $connection->prepare("UPDATE categoria SET categoria=?, estado_categoria=? WHERE id_categoria=?");// Traduzco mi petición
        $actualizar = $query->execute([$categoria, $estado, $id]); //Ejecuto mi petición

        if ($actualizar) {
            session_start();
            $_SESSION['actualizar_categoria'] = 'registro';
            header("location: ../admin/categoria.php");
        } else {
            echo "<h2> Error al Actualizar <h2>";
        }
        echo "<a href='../admin/categoria.php'>Regresar</a>";
    }
?>