<?php
    include '../database/conexion.php';

    if (isset($_POST['enviar'])) {
        $email=$_POST['email'];
        $consulta=$DB_con->prepare('SELECT * FROM cliente');
        $consulta->execute();

        $clientes=$consulta->fetchAll(PDO::FETCH_ASSOC);

        foreach ($clientes as $key => $cliente) {
            if ($cliente['email']==$email) {
                $token=uniqid();

                $agregar=$DB_con->prepare('UPDATE cliente SET token=:token WHERE email=:email');
                $agregar->bindParam(':token', $token);
                $agregar->bindParam(':email', $email);
                $agregar->execute();

                $asunto="Recuperación de contraseña";
                $url="http://".$_SERVER["SERVER_NAME"]."/recuperacion/cambio.php?id=".$cliente["id"]."&token=".$token;

                $mensaje='
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Recuperación de contraseña</title>
                </head>
                <body>

                    <style>
                        p {
                            text-align: center;
                        }

                    img {
                            display: block;
                            margin-left: auto;
                            margin-right: auto;
                            width: 80px;

                        }

                        a {
                            background: blue;
                            border-radius: 30%;
                            color: white;
                            text-decoration: none;
                            padding: 5px;

                        }
                        header {
                        background-color: blue;
                        margin: 0%;
                        padding: 20px;
                        }

                        footer {
                        background-color: blue;
                        padding: auto;
                        color: white;
                        }
                    </style>

                    <header>
                    <br>
                    </header>
                    <img src="../img/logo/3-2.png" alt="Compu_Start">

                    <p> Estimda usuario: <br>
                    Hemos recibido una solicitud para restablecer la contraseña de tu cuenta. <br>
                    Para continuar, haz clic en el siguiente enlace: <br> <br>
                    <a href="'.$url.'">Restablecer contraseña</a> <br> <br>
                    Si no solicitaste el restablecimiento de tu contraseña, puedes ignorar este mensaje.
                    Gracias.</p> <br> <br> <br> <br>

                    <footer>
                    <p>
                        **********NO RESPONDER - Mensaje Generado Automáticamente************ <br> <br>

                    Este correo es únicamente informativo y es de uso exclusivo del destinatario(a), puede contener información privilegiada y/o confidencial. Si no es usted el destinatario(a) deberá borrarlo inmediatamente. Queda notificado que el mal uso, divulgación no autorizada, alteración y/o  modificación malintencionada sobre este mensaje y sus anexos quedan estrictamente prohibidos y pueden ser legalmente sancionados. 

                    </p>
                    </footer>
                    
                </body>
                </html>
                ';

                mail($email, $asunto, $mensaje);
                echo '<script>alert("Se le envio un correo a su email para recuperar su contraseña")</script>';
                break;
            } else {
                continue;
            }
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link de iconos en fontawesome -->
    <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
    <!-- link de bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- estilos de login y registro -->
    <link rel="stylesheet" type="text/css" href="./login-registrate.css">
    <!-- validaciones de java script -->
    <script type='text/javascript' src=".\js\validaciones.js"></script>
    <!-- link de Sweetalert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <title>Recupera tu contraseña</title>
</head>

<body>


            
            <div class="sign-in">
                <form action="" method="post">
                    <h1>Compu start</h1>
                    <h3>Recupera tu contraseña</h3>
                    <p>Por favor, ingrese su correo para recuperar su contraseña</p>
                    <div class="div social-container">
                    </div>
                    <input type="email" name="email" placeholder="Correo" required>
             
                    <button name="enviar" type="submit">Enviar</button>
                  
                    </div>
                </form>
            </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script type="text/javascript"> </script>
    
</body>
</html>