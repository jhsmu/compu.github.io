<?php
    session_start();

    if (isset($_POST['botonAdd'])) {
        switch ($_POST['botonAdd']) {

            //Esto es si la persona oprime el botón agregar al carrito
            case 'agregar':
                if (is_numeric($_POST['id'])) {
                    $id_producto=$_POST['id'];
                }else {
                    $mensaje="El id esta mal";
                }

                if (is_string($_POST['producto'])) {
                    $nombre_producto=$_POST['producto'];
                }else {
                    $mensaje="El producto esta mal";
                }

                if (is_numeric($_POST['precio'])) {
                    $precio_producto=$_POST['precio'];
                }else {
                    $mensaje="El precio esta mal";
                }

                if(is_numeric($_POST['cantidad'])){
                    $cantidad=$_POST['cantidad'];
                } else{
                    $mensaje="La cantidad esta mal";
                }

                if(is_numeric($_POST['cantidad_max'])){
                    $cantidadMax=$_POST['cantidad_max'];
                } else{
                    $mensaje="La cantidad esta mal";
                }

                if (!isset($_SESSION['carritoIndex'])) {
                    $carro_pro=array(
                        'id'=>$id_producto,
                        'producto'=>$nombre_producto,
                        'precio'=>$precio_producto,
                        'cantidad'=>$cantidad,
                        'cantidad_max'=>$cantidadMax
                    );
                    $_SESSION['carritoIndex'][0]=$carro_pro;
                    $mensaje="Producto agregado al carrito";
                } else {
                    $carro_pro=array(
                        'id'=>$id_producto,
                        'producto'=>$nombre_producto,
                        'precio'=>$precio_producto,
                        'cantidad'=>$cantidad,
                        'cantidad_max'=>$cantidadMax
                    );
                    $idsProductos=array_column($_SESSION['carritoIndex'], 'id');
                    if (in_array($id_producto, $idsProductos)) {
                        $carro_pro = array_replace($carro_pro, $carro_pro);
                        $_SESSION['carritoIndex'][0]=$carro_pro;
                        $mensaje="Producto actualizado al carrito";
                    }
                    else{

                        $numero_productos=count($_SESSION['carritoIndex']);
                        $carro_pro=array(
                            'id'=>$id_producto,
                            'producto'=>$nombre_producto,
                            'precio'=>$precio_producto,
                            'cantidad'=>$cantidad,
                            'cantidad_max'=>$cantidadMax
                        );
                        $_SESSION['carritoIndex'][$numero_productos]=$carro_pro;
                        $mensaje="Producto agregado al carrito";
                    }
                }
            break;

            case 'eliminar':
                if (is_numeric($_POST['id'])) {
                    $id_producto=$_POST['id'];
                    foreach ($_SESSION['carritoIndex'] as $indice => $producto) {
                        if ($producto['id']==$id_producto) {
                            unset($_SESSION['carritoIndex'][$indice]);
                            echo '<script> alert("Producto borrado.."); </script>';
                        }
                    }
                }else {
                    $mensaje="El id esta mal";
                }
            break;

            case 'aumentar':
                if (is_numeric($_POST['id'])) {
                    $id_producto=$_POST['id'];
                    foreach ($_SESSION['carritoIndex'] as $indice => $producto) {
                        if ($producto['id']==$id_producto) {
                            if ($_SESSION['carritoIndex'][$indice]['cantidad']==$_SESSION['carritoIndex'][$indice]['cantidad_max']) {
                                $_SESSION['carritoIndex'][$indice]['cantidad']=$_SESSION['carritoIndex'][$indice]['cantidad_max'];
                            }else {
                                $_SESSION['carritoIndex'][$indice]['cantidad']++; 
                            }
                            break;  
                        }
                    }
                }else {
                    $mensaje="El aumento esta mal";
                }
            break;

            case 'disminuir':
                if (is_numeric($_POST['id'])) {
                    $id_producto=$_POST['id'];
                    foreach ($_SESSION['carritoIndex'] as $indice => $producto) {
                        if ($producto['id']==$id_producto) {
                            if ($_SESSION['carritoIndex'][$indice]['cantidad']==1) {
                                $_SESSION['carritoIndex'][$indice]['cantidad']=1;
                            }else {
                                $_SESSION['carritoIndex'][$indice]['cantidad']--; 
                            }
                            break;  
                        }
                    }
                }else {
                    $mensaje="El aumento esta mal";
                }
            break;

            case 'proceder':
                header('location:./CarroIndex/destruyeSesion.php');
        }
    }