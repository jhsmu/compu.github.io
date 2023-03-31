<?php
    include '../database/conexion.php';

    $consulta=$DB_con->prepare('SELECT * FROM proveedor');
    $consulta->execute();

    $proveedores=$consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <br>
    <h1>Lista de proveedores</h1>
    <br>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Proveedor</th>
                <th scope="col">Correo</th>
                <th scope="col">Web</th>
                <th scope="col">Dirección</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($proveedores as $key => $proveedor) {
            ?>
                <tr>
                    <th scope="row"><?php echo $proveedor['id_proveedor'] ?></th>
                    <td><a href="./compra.php?id=<?php echo $proveedor['id_proveedor'] ?>"><?php echo $proveedor['proveedor'] ?></a></td>
                    <td><?php echo $proveedor['correo'] ?></td>
                    <td><?php echo $proveedor['direccion_web'] ?></td>
                    <td><?php echo $proveedor['direccion'] ?></td> 
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>