<?php
    include '../database/conexion.php';

    if (isset($_GET['id'])) {
        $idProveedor=$_GET['id'];
    }

    $consulta=$DB_con->prepare('SELECT * FROM producto');
    $consulta->execute();

    $productos=$consulta->fetchAll(PDO::FETCH_ASSOC);

    $consulta3=$DB_con->prepare('SELECT * FROM imagenes');
    $consulta3->execute();
    $imagenes=$consulta3->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_POST['comprar'])) {
        include './pagarCompra.php';
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <br>
    <h1>Productos</h1>
    <br>
    <?php
        foreach ($productos as $key => $producto) {
    ?>
    <div class="card" style="width: 18rem;">
        
        <?php
            $ayudante = 0;
            foreach ($imagenes as $key => $imagen) {
                if(($producto['id_producto']==$imagen['producto_id'])and($producto['id_producto']!=$ayudante)){
                    $ayudante++;
        ?>

        <img src="../imagenes/<?php echo $imagen['url'] ?>" class="card-img-top" alt="...">

        <?php
            break;
                }
            }
        ?>

        <div class="card-body">
            <h5 class="card-title"><?php echo $producto['producto'] ?></h5>
            <p class="card-text"><?php echo $producto['descripcion'] ?></p>
            <form action="" method="post">
                <input type="number" name="cantidad" id="">
                <input type="number" name="proveedor" id="" value="<?php echo $idProveedor ?>" hidden>
                <input type="number" name="precio" id="" value="<?php echo $producto['precio']*0.6 ?>" hidden>
                <input type="text" name="id" id="" value="<?php echo $producto['id_producto'] ?>" hidden>
                <button type="submit" class="btn btn-primary" name="comprar">Comprar</button>
            </form>
        </div>
    </div>
    <?php
        }
        if ($comprobante==True) {
            $comprobante=false;
            echo ('<script>Swal.fire({
                title: "Compra exitosa",
                text: "Tus productos estan en tu inventario",
                icon: "success" 
            });
            </script>');
        } else {
            $comprobante=false;
            echo ('<script>Swal.fire({
                title: "Compra fallida",
                text: "Hubo un error con la compra",
                icon: "error" 
            });
            </script>');
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>