<?php
    error_reporting( ~E_NOTICE ); // avoid notice
        
    require '../database/conexion.php';

    if(isset($_POST["inicio"])){
        $email_i=$_POST["email"];
        $contrasena=(htmlentities($_POST["clave_inicio"]));
        $contra=htmlentities($_POST["clave_inicio"]);

        $consultar1=$DB_con->prepare('SELECT * FROM administrador WHERE email=:email');
        $consultar1->bindParam(':email', $email_i);
        $consultar1->execute();

        $admin=$consultar1->fetch(PDO::FETCH_ASSOC);

        if ($email_i==$admin["email"] and $contra==$admin["contrasenia"]) {
            session_start();
            $_SESSION["id_administrador"]=$admin["id_administrador"];
            $_SESSION["admin"]=$admin["nombre"];
            header('location:../admin/indexadmin.php');
        }else {
            $consultar=$DB_con->prepare('SELECT * FROM cliente WHERE email=:email');
            $consultar->bindParam(':email', $email_i);
            $consultar->execute();

            $verificacion=$consultar->fetch(PDO::FETCH_ASSOC);

            if ($email_i==$verificacion["email"] and $contrasena==$verificacion["contrasenia"] ) {
                if ($verificacion['estado']==0) {
                    session_start();
                    $_SESSION['alerta']="Alerta";
                    header('location:../login-registro.php');
                } else {
                    session_start();
                    $_SESSION["usuario"]=$verificacion["nombre"];
                    $_SESSION["id_usuario"]=$verificacion["id"];
                    header("location: ../inicio.php");
                }
            }
            else {
                session_start();
                $_SESSION["Datos_incorrectos"] = "Datos incorrectos";
                header("location:../login-registro.php");
                echo '<script> alert("Inicio de sesión incorrecto, por favor verifique sus datos")</script>';
        }  
        }

        
    }


?>