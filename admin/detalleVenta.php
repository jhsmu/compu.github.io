<?php
session_start();

require('../database/basededatos.php');

//Creamos un objeto del tipo Database
$db = new Database();
$connection = $db->connect(); //Creamos la conexión a la BD

$id = $_GET["id"];

$consulta5 = $connection->prepare("SELECT id_detalle_venta, PRODUCTO.producto AS NombreProducto, cantidad_venta, precio_producto, monto_total FROM DETALLE_VENTA INNER JOIN PRODUCTO ON DETALLE_VENTA.id_producto = PRODUCTO.id_producto WHERE id_venta=:id"); // Traduzco mi petición
$consulta5->execute(['id' => $id]); //Ejecuto mi petición

$detalles = $consulta5->fetchAll(PDO::FETCH_ASSOC); //Me traigo los datos que necesito
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie'=edge">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,admin templates, admin template, admin dashboard, free tailwind templates, tailwind example">
    <!-- Css -->
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/all.css">
            <!-- iconos en fontawesome -->
            <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Detalle de Ventas</title>
</head>

<body>
    
<!--Container -->
<div class="mx-auto bg-grey-400">
    <!--Screen-->
    <div class="min-h-screen flex flex-col">
        <!--Header Section Starts Here-->
        <header class="bg-nav">
            <?php include("../componentes/headerAdmin.php") ?>
        </header>
        <!--/Header-->

        <div class="flex flex-1">
            <!--Sidebar-->
            <aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">
<!--Barra lateral-->
                <ul class="list-reset flex flex-col">
                    <?php include("../componentes/barralateralAdmin.php") ?>
                </ul>
            </aside>

            <!--/Sidebar-->
            <!--Main-->
            <main class="bg-white-300 flex-1 p-3 overflow-hidden">
<!-- información -->
                <div class="flex flex-col">
                        <div class="rounded overflow-hidden shadow bg-white mx-2 w-full">
                            <div class="px-6 py-2 border-b border-light-grey">
                                <div class="font-bold text-xl">Detalle de la venta del Cliente</div>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-grey-darkest">
                                        <thead class="bg-grey-dark text-white text-normal">
                                            <tr>
                                                <th scope="col">Nombre del Producto</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Monto Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach ($detalles as $key => $detalle) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $detalle["NombreProducto"] . "<br>"; ?>                                                
                                                </td>
                                                <td>
                                                    <?php echo $detalle["cantidad_venta"] . "<br>"; ?></td>
                                                <td>
                                                    <?php echo number_format($detalle["precio_producto"],2) . "<br>"; ?>
                                                </td>
                                                <td>
                                                    <?php echo number_format($detalle["monto_total"],2) . "<br>"; ?>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                    <button class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded' type="button"> <a href="./indexadmin.php">Volver</a>
                    </button>
                </div>
                </div>
            </main>
            <!--/Main-->
        </div>
    </div>
</div>
<script src="../js/main.js"></script>
</body>

</html>