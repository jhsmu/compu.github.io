<?php
    include '../database/conexion.php';
    include './carrito.php';

    if ($_POST) {
        $total=0;
        $estado=1;
        foreach ($_SESSION['carrito'] as $indice => $producto) {
            $total+=$producto['precio']*$producto['cantidad'];
        } 

        $insertar=$DB_con->prepare('INSERT INTO orden(cliente,total,estado) VALUES(:cliente, :total, :estado) ');
        $insertar->bindParam(':cliente', $_SESSION["id_usuario"]);
        $insertar->bindParam(':total', $total);
        $insertar->bindParam(':estado', $estado);
        $insertar->execute();

        $idOrden=$DB_con->lastInsertId();

        foreach ($_SESSION['carrito'] as $indice => $producto) {
            $total_producto=$producto['precio']*$producto['cantidad'];
            $insertar=$DB_con->prepare('INSERT INTO detalle_orden(cliente,id_orden,id_producto,cantidad_venta,precio_producto,monto_total,estado)
                                        VALUES(:cliente, :id_orden, :id_producto, :cantidad, :precio, :total, :estado)');
            $insertar->bindParam(':cliente', $_SESSION["id_usuario"]);
            $insertar->bindParam(':id_orden', $idOrden);
            $insertar->bindParam(':id_producto', $producto['id']);
            $insertar->bindParam(':cantidad', $producto['cantidad']);
            $insertar->bindParam(':precio', $producto['precio']);
            $insertar->bindParam(':total', $total_producto);
            $insertar->bindParam(':estado', $estado);
            $insertar->execute();

            $consulta=$DB_con->prepare('SELECT * FROM producto WHERE id_producto=:id');
            $consulta->bindParam(':id', $producto['id']);
            $consulta->execute();

            $cantidad=$consulta->fetch(PDO::FETCH_ASSOC);

            $sustraccion=$cantidad['cantidad']-$producto['cantidad'];

            $resto=$DB_con->prepare('UPDATE producto SET cantidad=:cantidad WHERE id_producto=:id');
            $resto->bindParam(':cantidad', $sustraccion);
            $resto->bindParam(':id', $producto['id']);
            $resto->execute();
        } 
        unset($_SESSION['carrito']);
        $_SESSION['compra']=true;
        header("location:../inicio.php");


        //current_timestamp()
    }

?>