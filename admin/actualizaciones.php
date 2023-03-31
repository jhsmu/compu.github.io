<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- iconos en fontawesome -->
    <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Proveedor</title>
</head>

<body>
    <?php
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD
    ?>

    <!--Container -->
    <div class="mx-auto bg-gray-300est">
        <!--Screen-->
        <div class="min-h-screen flex flex-col">
            <!--Header Section Starts Here-->
            <header class="bg-nav">
                <?php include("../componentes/headerAdmin.php") ?>
            </header>

            <div class="flex flex-1">
                <!--Sidebar-->
                <aside id="sidebar" class="bg- side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">
                    <div class="flex">

                    </div>
                    <ul class="list-reset flex flex-col">
                        <?php include("../componentes/barralateralAdmin.php") ?>
                    </ul>

                </aside>
                <!--/Sidebar-->
                <!--Main-->
                <main class="bg-white-medium flex-1 p-3 overflow-hidden">
                    <div class='flex flex-col'>
                        <div class='flex flex-1  flex-col md:flex-row lg:flex-row mx-2'>

                            <div class='flex flex-1  flex-col md:flex-row lg:flex-row mx-2'>
                                <div class="mb-2 mx-2 border-solid border-gray-300  rounded border shadow-sm w-full md:w-1/2 lg:w-1/2">
                                    <div class="bg-gray-200 px-2 py-3 border-solid border-gray-300 border-b">
                                        Proveedor
                                    </div>
                                    <div class="p-3">
                                        <button data-modal='centeredFormModal' class="modal-trigger bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Agregar Proveedor
                                        </button>
                                    </div>

                                </div>
                                <div class="mb-2 mx-2 border-solid border-gray-300  rounded border shadow-sm w-full md:w-1/2 lg:w-1/2">
                                    <div class="bg-gray-200 px-2 py-3 border-solid border-gray-300 border-b">
                                        Agregar Imagen
                                    </div>
                                    <div class="p-3">
                                        <input class="modal-trigger bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="file">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <!--/Main-->
            </div>
        </div>

    </div>

    <!-- Centered With a Form Modal -->
    <div id='centeredFormModal' class="modal-wrapper">
        <div class="overlay close-modal"></div>
        <div class="modal modal-centered">
            <div class="modal-content shadow-lg p-5">
                <div class="border-b p-2 pb-3 pt-0 mb-4">
                    <div class="flex justify-between items-center">
                        Agregar Proveedor
                        <span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                            <i class="fas fa-times text-gray-700"></i>
                        </span>
                    </div>
                </div>
                <!-- Modal content -->
                <form class="w-full" action="../proveedor/guardarProveedor.php" method="post">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                Proveedor
                            </label>
                            <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="proveedor" id="nombre" onchange="NombresNumeros()" type="text" placeholder="Ingrese el nombre del proveedor" required>
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                                Correo EElectrónico
                            </label>
                            <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="correo" id="correo" type="email" placeholder="Ingrese el Correo" onchange="ValidacionCorreo()" required>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-password">
                                Sitio Web
                            </label>
                            <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="direccion_web" id="direccion_web" onchange="PaginaWeb()" type="text" placeholder="Ingrese el sitio web" required>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-city">
                                Dirección
                            </label>
                            <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" name="direccion" id="direccion" type="text" placeholder="Ingrese la dirección" onchange="direccion1()" required>
                        </div>
                    </div>
                    <div class="mt-5">
                        <button class='bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded'> Agregar</button>
                        <span class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded'>
                            Close
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/validaciones.js"></script>
    <script src="../js/main.js"></script>

</body>

</html>
<?php
if (isset($_SESSION['proveedor'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Proveedor agregado'
        });
    </script>";
    unset($_SESSION['proveedor']);
}
?>
