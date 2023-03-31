<?php
    include '../database/conexion.php';

    $cantidad=$_POST['cantidadCompra'];
    $id=$_POST['idProducto'];
    $precio=$_POST['precioCompra'];
    $total=$cantidad*$precio;
    $idProveedor=$_POST['proveedorCompra'];

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
    
    if ($pagar->execute()){
        session_start();
        $_SESSION["comprobante"]="pagado";
        header("location:../admin/indexadmin.php");
    }