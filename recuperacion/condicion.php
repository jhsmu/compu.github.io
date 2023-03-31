<?php
    include '../database/conexion.php';
    
    if ($_POST) {
        $contrasena=$_POST['contrasena'];
        $contrasena2=$_POST['confirma_contrasena'];
        $id=$_POST['id'];

        if ($contrasena==$contrasena2) {
            $consulta1 = $DB_con->prepare('UPDATE cliente SET contrasenia=:contra, token="" WHERE id=:id');
            $consulta1->bindParam(':contra', $contrasena);
            $consulta1->bindParam(':id', $id);
            
            if ($consulta1->execute()) {
                header("location:./email.php");
            } else {
                header("location:./cambio.php");
            }
        } else {
            echo '<script> alert("la contrasena no es la misma")</script>';
            header("location:./cambio.php");
        }
    } else {
        echo '<script> alert("el boton")</script>';
    }
?>