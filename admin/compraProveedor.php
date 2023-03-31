<?php
session_start();
require('../database/basededatos.php');

//Creamos un objeto del tipo Database
$db = new Database();
$connection = $db->connect(); //Creamos la conexión a la BD

// Cuando la conexión está establecida...
$query = $connection->prepare("SELECT * FROM proveedor"); // Traduzco mi petición
$query->execute(); //Ejecuto mi petición

$proveedores = $query->fetchAll(PDO::FETCH_ASSOC); //Me traigo los datos que necesito

$query2 = $connection->prepare("SELECT * FROM categoria");
$query2->execute();

$categorias = $query2->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["categoria"])) {
    $_SESSION["id_categoria"]=$_POST["categoria"];
    $_SESSION["id_proveedor"]=$_POST["proveedor"];
    $query3 = $connection->prepare("SELECT * FROM producto
    INNER JOIN marca ON producto.id_marca =  marca.id_marca
    WHERE id_categoria=:categoria");
    $query3->bindParam(":categoria", $_POST["categoria"]);
    $query3->execute();

    $_SESSION["productos"] = $query3->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_POST["producto"])) {
    $_SESSION["id_producto"]=$_POST["producto"];
    $query4 = $connection->prepare("SELECT id_producto, serial, producto, cantidad, precio, estado_producto, marca.marca AS nombre_marca, id_categoria
    FROM producto
    INNER JOIN marca ON producto.id_marca =  marca.id_marca
    WHERE id_producto=:producto");
    $query4->bindParam(":producto", $_SESSION["id_producto"]); 
    $query4->execute();

    $product = $query4->fetch(PDO::FETCH_ASSOC);

    $query5 = $connection->prepare('SELECT * FROM imagenes WHERE producto_id=:id');
    $query5->bindParam(":id", $_SESSION["id_producto"]);
    $query5->execute();
    $imagenes = $query5->fetchAll(PDO::FETCH_ASSOC);
}
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
    <title>Compras Proveedor</title>
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
                <aside id="sidebar"
                    class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">
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
                        <!-- Card Sextion Starts Here -->
                        <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
                            <!--Horizontal form-->
                            <div
                                class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full md:w-1/2 lg:w-1/2">
                                <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                                    Solicitud de compra
                                </div>
                                <div class="p-3">
                                    <form action="" method="post" class="w-full">
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                <div class="relative md:w-1/1 ">
                                                    <label
                                                        class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                                        for="grid-last-name">
                                                        Provedores
                                                    </label>
                                                    <select
                                                        class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                                        id="grid-state" name="proveedor">
                                                        <option value="" selected type="hidden">Selecciona un proveedor
                                                        </option>
                                                        <?php
                                                    foreach ($proveedores as $key => $proveedor) {
                                                        if (isset($_SESSION["id_proveedor"]) && $_SESSION["id_proveedor"]==$proveedor["id_proveedor"]){
                                                ?>
                                                        <option value="<?php echo $proveedor["id_proveedor"] ?>"
                                                            selected><?php echo $proveedor["proveedor"] ?></option>
                                                        <?php
                                                    } else {
                                                ?>
                                                        <option value="<?php echo $proveedor["id_proveedor"] ?>">
                                                            <?php echo $proveedor["proveedor"] ?></option>
                                                        <?php
                                                    }
                                                    }
                                                ?>
                                                    </select>
                                                    <div
                                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-darker ">
                                                        <svg class="fill-current h-4 w-4"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                        </svg>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full md:w-1/2 px-3">
                                                <label
                                                    class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                                    for="grid-last-name">
                                                    Categorias
                                                </label>
                                                <div class="relative md:w-1/1 ">
                                                    <select
                                                        class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                                        id="" name="categoria" onchange="cambio()">
                                                        <option value="" selected type="hidden">Selecciona una categoria
                                                        </option>
                                                        <?php
                                                    foreach ($categorias as $key => $categoria) {
                                                        if (isset($_SESSION["id_categoria"]) && $_SESSION["id_categoria"]==$categoria["id_categoria"]){
                                                            ?>
                                                        <option value="<?php echo $categoria["id_categoria"] ?>"
                                                            selected><?php echo $categoria["categoria"] ?></option>
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
                                                    <button type="submit" id="boton" hidden>enviar</button>
                                                    <div
                                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-darker ">
                                                        <svg class="fill-current h-4 w-4"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                    </form>
                                    <form action="" method="post">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <div class="relative md:w-1/1 ">
                                                <label
                                                    class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                                    for="grid-last-name">
                                                    Productos
                                                </label>
                                                <select
                                                    class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                                    id="grid-state" name="producto" onchange="cambio2()">
                                                    <option value="" selected type="hidden">Selecciona un producto
                                                    </option>
                                                    <?php
                                                    foreach ($_SESSION["productos"] as $key => $producto) {
                                                        if (isset($_SESSION["id_producto"]) && $_SESSION["id_producto"]==$producto["id_producto"]){
                                                ?>
                                                    <option value="<?php echo $producto["id_producto"] ?>" selected>
                                                        <?php echo $producto["producto"] ?></option>
                                                    <?php
                                                        } else {
                                                ?>
                                                    <option value="<?php echo $producto["id_producto"] ?>">
                                                        <?php echo $producto["producto"] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                ?>
                                                </select>
                                                <button type="submit" id="boton2"></button>
                                                <div
                                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-darker ">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                    </svg>
                                                </div>

                                            </div>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <!--/Horizontal form-->

                        <!--Underline form-->
                        <div
                            class="mb-2 md:mx-2 lg:mx-2 border-solid border-gray-200 rounded border shadow-sm w-full md:w-1/2 lg:w-1/2">
                            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                                Información
                            </div>
                            <div class="p-3">
                                <form action="../compra/pagarCompraProveedor.php" method="post" class="w-full">

                                    <?php
                                    if (isset($product)){
                                ?>

                                    <div class="max-w-screen-lg w-full lg:flex mx-5">
                                        <div class="w-1/1 h-96">

                                            <img src="../imagenes/<?php echo $imagenes[0]["url"] ?>" alt="" class="object-cover lg:max-h-96 md:max-h-48">

                                        </div>
                                        <div
                                            class="border-r border-b border-l border-gray-300 lg:border-1-0 lg:border-t lg:border-gray-300 rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal w-full">
                                            <div class="mb-2 ">
                                                <h3 class="text-black-500 font-bold text-lg mb-2">
                                                    <?php echo $product["producto"] ?></h3>
                                                <p class="text-gray-700 text-base">
                                                    Marca:<?php echo " ".$product["nombre_marca"] ?></p>
                                                <p class="text-gray-700 text-base">
                                                    Precio: $<?php echo number_format($product["precio"]*0.6) ?></p>
                                                <input type="number" class="bg-gray-200" name="cantidadCompra"
                                                    placeholder="Ingrese la cantidad">
                                                <input type="number" name="precioCompra" id=""
                                                    value="<?php echo $product["precio"] ?>" hidden>
                                                <input type="number" name="idProducto" id=""
                                                    value="<?php echo $product["id_producto"] ?>" hidden>
                                                <input type="number" name="proveedorCompra" id=""
                                                    value="<?php echo $_SESSION["id_proveedor"] ?>" hidden>
                                                <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-black font-bold" name="comprar" class="rounded">Comprar</button>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    }
                                ?>

                                </form>

                            </div>
                        </div>
                        <!--/Underline form-->
                    </div>
                    <!-- /Cards Section Ends Here -->


            </div>
            </main>
            <!--/Main-->
        </div>
        <!--Footer-->
        <footer class="bg-grey-darkest text-white p-2">
            <div class="flex flex-1 mx-auto">&copy; My Design</div>
        </footer>
        <!--/footer-->

    </div>

    </div>

    <script src="./js/main.js"></script>
    <script>
    function cambio() {
        document.getElementById("boton").click();
    }

    function cambio2() {
        document.getElementById("boton2").click();
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
