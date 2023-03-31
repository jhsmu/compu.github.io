<?php
    include '../database/conexion.php';

    if (isset($_GET['id']) and isset($_GET['token'])) {
        $id = $_GET['id'];
        $token = $_GET['token'];

        $consulta = $DB_con->prepare('SELECT * FROM cliente WHERE id=:id');
        $consulta->bindParam(':id', $id);
        $consulta->execute();

        $cliente=$consulta->fetch(PDO::FETCH_ASSOC);
    } else {
        header("location:./email.php");
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
    
    <title>Cambia tu contraseña</title>
</head>

<body>

                
    <?php
        if ($cliente['token']==$token) {
    ?>
    <div class="sign-in">
        <form action="./condicion.php" method="post">
            <h1>Compu start</h1>
            <h3>Cambia tu contraseña</h3>
            <p>Ingrese su nueva contraseña</p>
            <input type="number" name="id" id="con-pass" value=<?php echo $id ?> hidden>
            <input type="password" name="contrasena" id="pass" placeholder="Contraseña" required>
            <input type="password" name="confirma_contrasena" placeholder="Confirma tu contraseña" required>
            <button name="cambio" type="submit">Cambiar</button>
        </form>
    </div>  
    <?php
        } else {
    ?>        
        <h1>Error</h1>
        <a href="./email.php">Regresar</a>         
    <?php
        }
    ?>
            



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script type="text/javascript"> </script>
    
</body>
</html>
