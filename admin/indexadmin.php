<?php
session_start();
require('../database/basededatos.php');

//Creamos un objeto del tipo Database
$db = new Database();
$connection = $db->connect(); //Creamos la conexión a la BD

// Cuando la conexión está establecida...
$consulta = $connection->prepare("SELECT SUM(total) FROM venta"); // Traduzco mi petición
$consulta->execute(); //Ejecuto mi petición

$total = $consulta->fetch(PDO::FETCH_NUM); //Me traigo los datos que necesito

$consulta2 = $connection->prepare("SELECT COUNT(*) FROM cliente"); // Traduzco mi petición
$consulta2->execute(); //Ejecuto mi petición

$usuarios = $consulta2->fetch(PDO::FETCH_NUM); //Me traigo los datos que necesito

$consulta3 = $connection->prepare("SELECT COUNT(*) FROM producto"); // Traduzco mi petición
$consulta3->execute(); //Ejecuto mi petición

$productos = $consulta3->fetch(PDO::FETCH_NUM); //Me traigo los datos que necesito

$consulta4 = $connection->prepare("SELECT SUM(total) FROM compra"); // Traduzco mi petición
$consulta4->execute(); //Ejecuto mi petición

$compras = $consulta4->fetch(PDO::FETCH_NUM); //Me traigo los datos que necesito

$consulta5 = $connection->prepare("SELECT id_venta, CONCAT(CLIENTE.nombre, ' ', CLIENTE.apellido) AS nombre_cliente, total, fecha FROM VENTA INNER JOIN CLIENTE ON VENTA.cliente =  CLIENTE.id;"); // Traduzco mi petición
$consulta5->execute(); //Ejecuto mi petición

$ventas = $consulta5->fetchAll(PDO::FETCH_ASSOC); //Me traigo los datos que necesito
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
    <title>Ventas</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js">
    </script>
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
                        <!-- Stats Row Starts Here -->
                        <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
                            <div class="shadow-lg bg-red-vibrant border-l-8 hover:bg-red-vibrant-dark border-red-vibrant-dark mb-2 p-2 md:w-1/4 mx-2">
                                <div class="p-4 flex flex-col">
                                    <p class="no-underline text-white text-lg">
                                        Total de Ventas:
                                    </p>
                                    <p class="no-underline text-white text-2xl">
                                        $ <?php if ($total_ventas = $total[0] == null) {
                                                echo "0";
                                            } else {
                                                echo number_format($total_ventas = $total[0], 2);
                                            } ?>
                                    </p>
                                </div>
                            </div>

                            <div class="shadow bg-info border-l-8 hover:bg-info-dark border-info-dark mb-2 p-2 md:w-1/4 mx-2">
                                <div class="p-4 flex flex-col">
                                    <p class="no-underline text-white text-lg">
                                        Total de Compras:
                                    </p>
                                    <p class="no-underline text-white text-2xl">
                                        $ <?php if ($total_compras = $compras[0] == null) {
                                                echo "0";
                                            } else {
                                                echo number_format($total_compras = $compras[0], 2);
                                            } ?>
                                    </p>
                                </div>
                            </div>

                            <div class="shadow bg-warning border-l-8 hover:bg-warning-dark border-warning-dark mb-2 p-2 md:w-1/4 mx-2">
                                <div class="p-4 flex flex-col">
                                    <p class="no-underline text-white text-lg">
                                        Total de Usuarios:
                                    </p>
                                    <p class="no-underline text-white text-2xl">
                                        <?php if ($total_usuarios = $usuarios[0] == null) {
                                            echo "0";
                                        } else {
                                            echo $total_usuarios = $usuarios[0];
                                        } ?>
                                    </p>
                                </div>
                            </div>

                            <div class="shadow bg-success border-l-8 hover:bg-success-dark border-success-dark mb-2 p-2 md:w-1/4 mx-2">
                                <div class="p-4 flex flex-col">
                                    <p class="no-underline text-white text-lg">
                                        Total de Productos:
                                    </p>
                                    <p class="no-underline text-white text-2xl">
                                        <?php echo $total_productos = $productos[0]; ?>
                                    </p>

                                </div>
                            </div>
                        </div>

                        <!-- /Stats Row Ends Here -->

                        <!-- Card Section Starts Here -->
                        <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">

                            <!-- card -->

                            <div class="rounded overflow-hidden shadow bg-white mx-2 w-full">
                                <div class="px-6 py-2 border-b border-light-grey">
                                    <div class="font-bold text-xl">Ventas</div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table text-grey-darkest" id="dataTable">
                                        <thead class="bg-grey-dark text-white text-normal">
                                            <tr>
                                                <th scope="col">Número de Orden #</th>
                                                <th scope="col">Nombre del Cliente</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Más detalles</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($ventas as $key => $venta) {
                                            ?>
                                                <tr>
                                                    <td scope="row">
                                                        <?php echo $venta["id_venta"] . "<br>"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $venta["nombre_cliente"] . "<br>"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($venta["total"], 2) . "<br>"; ?></td>
                                                    <td>
                                                        <?php echo $venta["fecha"] . "<br>"; ?>
                                                    </td>
                                                    <td>
                                                        <a class="bg-blue-800 cursor-pointer rounded p-1 mx-1 text-white" href="./detalleVenta.php?id=<?php echo $venta["id_venta"]; ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
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
                    </div>
                </main>
                <!--/Main-->
            </div>
        </div>
    </div>

    <script src="../js/main.js"></script>
</body>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
            "url":"//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
        }
        });

    });
</script>


</html>

<?php
if (isset($_SESSION['actualizar_datos'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Datos Actualizados'
        });
    </script>";
    unset($_SESSION['actualizar_datos']);
}

if (isset($_SESSION['error'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Datos Actualizados'
        });
    </script>";
    unset($_SESSION['error']);
}

if (isset($_SESSION["comprobante"])) {
    echo ('<script>Swal.fire({
        title: "Compra exitosa",
        text: "Tus productos estan en tu inventario",
        icon: "success" 
    });
    </script>');
    unset($_SESSION["comprobante"]);
    unset($_SESSION["id_categoria"]);
    unset($_SESSION["id_proveedor"]);
    unset($_SESSION["id_producto"]);
    unset($_SESSION["productos"]);
}
?>
