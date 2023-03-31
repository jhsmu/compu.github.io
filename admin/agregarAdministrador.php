<?php
    //Para poder usar la clase Database y su función connect
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $query = $connection->prepare("INSERT INTO administrador(nombre, apellido, email, contrasenia) VALUES(?, ?, ?, ?)");// Traduzco mi petición
    $guardar = $query->execute([$nombre, $apellido, $email, $contrasena]); //Ejecuto mi petición

    if ($guardar) {
        session_start();
        $_SESSION['agregado'] = 'id';
        header("location: ../admin/usuario.php");
    } else {
        echo "<script> alert 'Error al crear nuevo administrador' </script>";
    }