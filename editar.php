<?php
session_start();
include("./editar/conexion.php");
$id = $_SESSION["id_usuario"];
error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- iconos en fontawesome -->
    <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
    <!-- css footer y el header -->
    <link rel="stylesheet" href="./css/footer-header.css">
    <!-- css cuerpo -->
    <link rel="stylesheet" href="./css/style_cuerpo.css">
    <link rel="stylesheet" href="./css/edit.css">
    <title>Actualizar</title>
    <script type="text/javascript">
    function confirmar() {
        return confirm('¿Estas seguro de inhabilitar la cuenta?');
    }
    </script>
</head>

<body>
    <header>
        <?php
        include("./componentes/headerinicio.php")
        ?>
    </header>
    <?php
    if (isset($_POST['enviar'])) {
        //entra si le da el botón enviar
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $td = $_POST['tipo'];
        $nro = $_POST['dni'];
        $email = $_POST['email'];
        $contrasena = $_POST['contrasena'];
        $image = $_POST['imagen_actual']; //Esta variable contiene la imagen actual

        $imgFile = $_FILES['imagen']['name']; //FILES contiene la nueva imagen
        $tmp_dir = $_FILES['imagen']['tmp_name'];
        $imgSize = $_FILES['imagen']['size'];

        if (!empty($imgFile)) { //Si la imagen es seleccionada 
            $upload_dir = 'imagenCliente/'; // upload directory	
            $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
            $userpic = $imgFile;
            if (in_array($imgExt, $valid_extensions)) {
                if ($imgSize < 1000000) {
                    unlink($upload_dir . $image);
                    move_uploaded_file($tmp_dir, $upload_dir . $userpic);
                } else {
                    $errMSG = "Su archivo es demasiado grande mayor a 1MB";
                }
            } else {
                $errMSG = "Solo archivos JPG, JPEG, PNG & GIF .";
            }
        } else {
            // Si la imagen no es seleccionada, se pondra de nuevo la vieja
            $userpic = $image; // old image from database
        }


        //update
        $sql = "update cliente set imagen='" . $userpic . "', 
            nombre='" . $nombre . "',
            apellido='" . $apellido . "',
            tipo_documento='" . $td . "',
            direccion='" . $direccion . "',
            telefono='" . $telefono . "',
            email='" . $email . "',
            contrasenia='" . $contrasena . "'
            where id='" . $id . "'";

        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            echo "<script language='JavaScript'>
                alert('Los datos se actualizaron correctamente');
                location.assign('./inicio.php');</script>";
            error_reporting(0);
        } else {
            echo "<script language='JavaScript'>
                alert('Los datos NO se actualizaron :(');
                location.assign('./editar.php');</script>";
            error_reporting(0);
        }
        mysqli_close($conexion);
    } else {
        //no le ha dado al botón enviar
        $id;
        $sql = "select *from cliente where id='" . $id . "'";
        $resultado = mysqli_query($conexion, $sql);

        $fila = mysqli_fetch_assoc($resultado);
        $id = $fila["id"];
        $nombre = $fila["nombre"];
        $apellido = $fila["apellido"];
        $direccion = $fila["direccion"];
        $email = $fila["email"];
        $tipo = $fila["tipo_documento"];
        $dni = $fila["numero_documento"];
        $telefono = $fila["telefono"];
        $contrasena = $fila["contrasenia"];
        $imagen = $fila["imagen"];

        $tipo_documento = array(
            "T.I."  => "Tarjeta de Identidad",
            "C.C." => "Cédula de Ciudadanía",
            "C.E." => "Cédula de Extranjeria",
        );

        mysqli_close($conexion);
        error_reporting(0);
    ?>

    <div class="container">
        <div class="form">
            <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
                <div class="form-header">
                    <div class="title">
                        <h1>Editar Perfil</h1>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-box">
                        <label for="">Nombres</label>
                        <input type="text" name="nombre" id="nombre" required onchange="nombre1()"
                            value="<?php echo $nombre; ?>">
                    </div>
                    <div class="input-box">
                        <label for="">Apellidos</label>
                        <input type="text" name="apellido" id="apellido" value="<?php echo $apellido; ?>" required
                            onchange="apellido1()">
                    </div>
                    <div class="input-box">
                        <label for="">Tipo de documento</label>
                        <select name="tipo" required id="">
                            <option value="">Seleccione Opción</option>
                            <?php
                                foreach ($tipo_documento as $key => $TD) {
                                    if ($TD == $tipo) {
                                ?>
                            <option value="<?php echo $TD ?>" selected>
                                <?php echo $key ?>
                            </option>
                            <?php
                                    } else {
                                    ?>
                            <option value="<?php echo $TD ?>">
                                <?php echo $key ?>
                            </option>
                            <?php
                                    }
                                }
                                ?>
                        </select>
                    </div>
                    <div class="input-box">
                        <label for="">Numero de documento</label>
                        <input type="text" name="dni" id="numero_documento" value="<?php echo $dni ?>" required
                            onchange="cedula1()">
                    </div>
                    <div class="input-box">
                        <label for="direccion">Dirección</label>
                        <input id="direccion" type="text" name="direccion" value="<?php echo $direccion; ?>" required
                            onchange="direccion1()">
                    </div>
                    <div class="input-box">
                        <label for="telefono">Teléfono</label>
                        <input id="telefono" type="text" name="telefono" value="<?php echo $telefono; ?>" required
                            onchange="telefono1()">
                    </div>
                    <div class="input-box">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="correo" value="<?php echo $email; ?>" required
                            onchange="ValidacionCorreo()">
                    </div>
                    <div class=" input-box">
                        <label for="password">Contraseña</label>
                        <input type="password" id="clave" name="contrasena" value="<?php echo $contrasena; ?>" required
                            onchange="contraseña()">
                    </div>
                    <span>
                        <i class="fa fa-eye" style="color:#D8D8D8" id="eye"></i>
                    </span>

                    <input type="text" name="imagen_actual" value="<?php echo $imagen; ?>" hidden>

                    <div class="input-box">
                        <label for="">Cambiar Avatar</label>
                        <input type="file" name="imagen">
                    </div>
                </div>

                <div class="continue-button">
                    <button type="submit" name="enviar" value="ACTUALIZAR">Actualizar</button>
                    <?php echo "<button class='elimina'><a href='./editar/eliminar_cliente.php?id=" . $fila['id'] . "' onclick='return confirmar()'>Inhabilitar</a></button>"; ?>
                </div>

            </form>
        </div>
    </div>

    <?php
    }
    ?>

    <footer>
        <?php include("./componentes/footer.php") ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <script>
    var eye = document.getElementById('eye');
    var input = document.getElementById('clave');

    eye.addEventListener('click', mostrar);

    function mostrar() {
        if (input.type == "password") {
            input.type = "text"
            eye.style.color = "#383838"
        } else {
            input.type = "password"
            eye.style.color = "#D8D8D8"
        }
    }

    function alerta() {
        Swal.fire({
            title: "Exito",
            text: "Tus datos han sido actualizados",
            icon: "success"
        });
    }
    </script>

    <script src="./js/validaciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>

</body>

</html>