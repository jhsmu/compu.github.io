<?php
session_start();
require_once '../database/conexion.php';
require('../database/basededatos.php');

//Creamos un objeto del tipo Database
$db = new Database();
$connection = $db->connect(); //Creamos la conexión a la BD

$id = $_GET["id"];

// Cuando la conexión está establecida...
$consulta = $connection->prepare("SELECT * FROM producto WHERE id_producto=:id"); // Traduzco mi petición
$consulta->execute(['id' => $id]); //Ejecuto mi petición

$producto = $consulta->fetch(PDO::FETCH_ASSOC);

//Consultamos para obtener las categorias
$consulta1 = $DB_con->prepare('SELECT * FROM categoria');
$consulta1->execute();
$categorias = $consulta1->fetchAll(PDO::FETCH_ASSOC);

//consultamos para obtener las marcas
$consulta2 = $DB_con->prepare('SELECT * FROM marca');
$consulta2->execute();
$marcas = $consulta2->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Actualizar Productos</title>
    <script src="../js/validaciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                    Actualizar Producto
                                </div>
                                <div class="p-3">
                                    <form class="w-full" action="../productos/actualizarProducto.php" method="post">
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0" hidden>
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                                    ID_Producto
                                                </label>
                                                <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" type="text" name="id" id="id" value="<?php echo $producto['id_producto']; ?>">
                                            </div>
                                            <div class="w-full md:w-1/2 px-3">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                                                    Serial
                                                </label>
                                                <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" type="text" name="serial" id="serial" value="<?php echo $producto['serial']; ?>" placeholder="<?php echo $producto['serial']; ?>" required onchange="Serial1()">
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full px-3">
                                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-password">
                                                    Producto
                                                </label>
                                                <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" type="text" name="producto" id="nombre" value="<?php echo $producto['producto']; ?>" placeholder="<?php echo $producto['producto']; ?>" required onchange="NombresNumeros()">
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-2">
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-city">
                                                    Descripción Breve
                                                </label>
                                                <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" type="text" name="descripcion_breve" id="descripcion_breve" value="<?php echo $producto['descripcion_breve']; ?>" placeholder="<?php echo $producto['descripcion_breve']; ?>" required onchange="Descripciones2()">
                                            </div>
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-city">
                                                    Descripción
                                                </label>
                                                <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" type="descripcion" name="descripcion" id="descripcion" value="<?php echo $producto['descripcion']; ?>" placeholder="<?php echo $producto['descripcion']; ?>" required onchange="Descripciones1()">
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-2">
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-city">
                                                    Cantidad
                                                </label>
                                                <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" type="text" name="cantidad" id="cantidad" value="<?php echo $producto['cantidad']; ?>" placeholder="<?php echo $producto['cantidad']; ?>" required onchange="Cantidad123()">
                                            </div>
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-city">
                                                    Precio
                                                </label>
                                                <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" type="text" name="precio" id="precio" value="<?php echo $producto['precio']; ?>" placeholder="<?php echo $producto['precio']; ?>" onchange="Valores1234()">
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-2">
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-city">
                                                    Categoría
                                                </label>
                                                <div class="relative">
                                                    <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-state" name="categoria" required>
                                                        <option value="">Seleccione una opción</option>
                                                        <?php
                                                        foreach ($categorias as $key => $categoria) { //Agregamos las categorias a la lista desplegable
                                                            if ($producto["id_categoria"]==$categoria["id_categoria"]){
                                                        ?>
                                                                <option value="<?php echo $categoria["id_categoria"] ?>" selected>
                                                                <?php echo $categoria["categoria"] ?></option>
                                                        <?php
                                                            } else {
                                                        ?>
                                                            <option value="<?php echo $categoria["id_categoria"] ?>">
                                                                <?php echo $categoria["categoria"] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-city">
                                                    Marca
                                                </label>
                                                <div class="relative">
                                                    <select required class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-state" name="marca">
                                                        <option value="">Seleccione una opción</option>
                                                        <?php
                                                        foreach ($marcas as $key => $marca) {
                                                            if ($producto["id_marca"]==$marca["id_marca"]){
                                                        ?>
                                                                <option value="<?php echo $marca["id_marca"] ?>" selected>
                                                                    <?php echo $marca["marca"] ?></option>
                                                        <?php
                                                            } else {
                                                        ?>
                                                                <option value="<?php echo $marca["id_marca"] ?>">
                                                                    <?php echo $marca["marca"] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-2">
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-city">
                                                    Estado
                                                </label>
                                                <div class="relative">
                                                    <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-state" name="estado" required>
                                                        <option value="">Seleccione una opción</option>
                                                        <?php 
                                                            if($producto["estado_producto"]== 1){
                                                                echo('<option value="1" selected>Activo</option>');
                                                                echo('<option value="0" >Inactivo</option>');
                                                            }else{
                                                                echo('<option value="1" >Activo</option>');
                                                                echo('<option value="0" selected>Inactivo</option>');
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-5">
                                            <button class='bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded'> Actualizar</button>
                                            <button class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded' type="button"> <a href="./productos.php">Volver</a>
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

    <script src="../js/validaciones.js"></script>
    <script src="../js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>

</body>

</html>