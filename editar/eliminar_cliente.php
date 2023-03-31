<?php
require('../database/basededatos.php');
$db = new Database();
$connection = $db->connect(); //Creamos la conexión a la BD
    $id=$_GET['id'];
    $estado = 0;

$query = $connection->prepare("UPDATE cliente SET estado=? WHERE id=?"); // Traduzco mi petición
$actualizar = $query->execute([$estado, $id]); //Ejecuto mi petición

    if($actualizar){
    session_start();
    $_SESSION['inhabilitado'] = 'aladsa';
    header("location: ../login-registro.php");
    } else{
    session_start();
    $_SESSION['error_cambio'] = 'registro';
    header("location: ../inicio.php");
    }


?>