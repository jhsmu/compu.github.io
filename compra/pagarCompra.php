<?php
    include '../database/conexion.php';

    $cantidad=$_POST['cantidad'];
    $id=$_POST['id'];
    $precio=$_POST['precio']*0.6;
    $total=$cantidad*$precio;
    $idProveedor=$_POST['proveedor'];

    $agregar=$DB_con->prepare('INSERT INTO compra(id_proveedor,id_producto,cantidad,precio,total)
                                VALUES(:idProveedor, :id, :cantidad, :precio, :total)');
    $agregar->bindParam(':idProveedor', $idProveedor);
    $agregar->bindParam(':id', $id);
    $agregar->bindParam(':cantidad', $cantidad);
    $agregar->bindParam(':precio', $precio);
    $agregar->bindParam(':total', $total);
    $agregar->execute();

    $consulta=$DB_con->prepare('SELECT * FROM producto WHERE id_producto=:id');
    $consulta->bindParam(':id', $id);
    $consulta->execute();

    $cantidad_producto=$consulta->fetch(PDO::FETCH_ASSOC);

    $total_cantidad=$cantidad_producto['cantidad']+$cantidad;

    $pagar=$DB_con->prepare('UPDATE producto SET cantidad=:cantidad WHERE id_producto=:id');
    $pagar->bindParam(':cantidad', $total_cantidad);
    $pagar->bindParam(':id', $id);
    $pagar->execute();
    $comprobante = True;
?>