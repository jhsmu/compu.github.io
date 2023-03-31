<?php
session_start();
require('../database/basededatos.php');

//Creamos un objeto del tipo Database
$db = new Database();
$connection = $db->connect(); //Creamos la conexión a la BD

$id = $_GET["id"];

// Cuando la conexión está establecida...
$consulta = $connection->prepare("SELECT * FROM proveedor WHERE id_proveedor=:id"); // Traduzco mi petición
$consulta->execute(['id' => $id]); //Ejecuto mi petición

$prove = $consulta->fetch(PDO::FETCH_ASSOC);

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
    <!-- iconos en fontawesome -->
    <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <title>Actualizar Proveedor</title>
</head>

<body>
    <!--Container -->
    <div class="mx-auto bg-grey-lightest">
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
                    <div class="flex">

                    </div>
                    <ul class="list-reset flex flex-col">
                        <?php include("../componentes/barralateralAdmin.php") ?>
                    </ul>

                </aside>
                <!--/Sidebar-->
                <!--Main-->
                <main class="bg-white-500 flex-1 p-3 overflow-hidden">

                    <div class="flex flex-col">
                        <!--Grid Form-->

                        <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
                            <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
                                <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                                    Actualizar proveedor
                                </div>
                                <div class="p-3">
                                    <form class="w-full" action="../proveedor/actualizarProveedor.php" method="post">
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0" hidden>
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                                    Id_Proveedor
                                                </label>
                                                <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" type="text" name="id" id="id" value="<?php echo $prove['id_proveedor']; ?>">
                                            </div>
                                            <div class="w-full md:w-1/2 px-3">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                                                    Proveedor
                                                </label>
                                                <input onchange="NombresNumeros()" class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" type="text" name="proveedor" id="nombre" value="<?php echo $prove['proveedor']; ?>" placeholder="<?php echo $prove['proveedor']; ?>" required>
                                            </div>
                                            <div class="w-full md:w-1/2 px-3">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="nit">
                                                    NIT
                                                </label>
                                                <input onchange="NIT123()" class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" type="text" name="nit" id="nit" value="<?php echo $prove['nit']; ?>" placeholder="<?php echo $prove['nit']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full px-3">
                                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-password">
                                                    Correo Electrónico
                                                </label>
                                                <input onchange="ValidacionCorreo()" class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" type="email" name="correo" id="correo" value="<?php echo $prove['correo']; ?>" placeholder="<?php echo $prove['correo']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full px-3">
                                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-password">
                                                    Teléfono
                                                </label>
                                                <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" type="text" name="telefono" id="telefono" onchange="telefono1()" value="<?php echo $prove['telefono']; ?>" placeholder="<?php echo $prove['telefono']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-2">
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-city">
                                                    Dirección Web
                                                </label>
                                                <input onchange="PaginaWeb()" class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" type="text" name="direccion_web" id="direccion_web" value="<?php echo $prove['direccion_web']; ?>" placeholder="<?php echo $prove['direccion_web']; ?>" required>
                                            </div>
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-city">
                                                    Dirección
                                                </label>
                                                <input onchange="direccion1()" class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" type="text" name="direccion" id="direccion" value="<?php echo $prove['direccion']; ?>" placeholder="<?php echo $prove['direccion']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="relative">
                                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="estado_proveedor">
                                                Estado
                                            </label>
                                            <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" id="estado_marca" name="estado_proveedor" required>
                                                <?php
                                                if ($prove["estado_proveedor"] == 1) {
                                                    echo ('<option value="1" selected>Activo</option>');
                                                    echo ('<option value="0" >Inactivo</option>');
                                                } else {
                                                    echo ('<option value="1" >Activo</option>');
                                                    echo ('<option value="0" selected>Inactivo</option>');
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mt-5">
                                            <button class='bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded'> Actualizar</button>
                                            <button class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded' type="button"> <a href="./proveedor.php">Volver</a>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--/Grid Form-->
                    </div>
                </main>
                <!--/Main-->
            </div>

        </div>

    </div>

    <script src="../js/main.js"></script>
    <script src="../js/validaciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>

</body>

</html>