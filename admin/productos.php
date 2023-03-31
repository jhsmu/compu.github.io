<?php
session_start();

error_reporting(~E_NOTICE); // avoid notice

require('../database/basededatos.php');

$db = new Database();
$connection = $db->connect(); //Creamos la conexión a la BD

// Cuando la conexión está establecida...
$query = $connection->prepare("SELECT id_producto, serial, producto, cantidad, precio, estado_producto, marca.marca AS nombre_marca, categoria.categoria AS nombre_categoria
FROM producto
INNER JOIN marca ON producto.id_marca =  marca.id_marca
INNER JOIN categoria ON producto.id_categoria = categoria.id_categoria"); // Traduzco mi petición
$query->execute(); //Ejecuto mi petición

$productos = $query->fetchAll(PDO::FETCH_ASSOC); //Me traigo los datos que necesito


require_once '../database/conexion.php';

//Consultamos para obtener las categorias
$consulta1 = $DB_con->prepare('SELECT * FROM categoria');
$consulta1->execute();
$categorias = $consulta1->fetchAll(PDO::FETCH_ASSOC);

//consultamos para obtener las marcas
$consulta2 = $DB_con->prepare('SELECT * FROM marca');
$consulta2->execute();
$marcas = $consulta2->fetchAll(PDO::FETCH_ASSOC);

//consultamos para obtener los proveedores
$consulta3 = $DB_con->prepare('SELECT * FROM proveedor');
$consulta3->execute();
$proveedores = $consulta3->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Productos</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js">
    </script>
    <script src="../js/"></script>
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
                                    Lista de Productos
                                    <label class="flex justify-end">
                                        <button data-modal='centeredFormModal' class="modal-trigger bg-blue-800 cursor-pointer rounded p-1 mx-1 text-white" href="">
                                            <i class="fa fa-user-plus"></i>
                                        </button>
                                        Agregar Producto
                                    </label>
                                </div>
                                <div class="p-3">
                                    <table class="table-responsive w-full rounded" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th class="border w-1/1 px-4 py-2 " hidden>Id</th>
                                                <th class="border w-1/1 px-4 py-2">Serial</th>
                                                <th class="border w-1/1 px-4 py-1 ">Producto</th>
                                                <th class="border w-1/1 px-4 py-2">Cantidad</th>
                                                <th class="border w-1/1 px-4 py-2">Precio</th>
                                                <th class="border w-1/1 px-4 py-2">Categoría</th>
                                                <th class="border w-1/1 px-4 py-2">Marca</th>
                                                <th class="border w-1/1 px-4 py-2">Estado</th>
                                                <th class="border w-1/1 px-4 py-2">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($productos as $key => $producto) {
                                            ?>
                                                    <tr>
                                                        <td class="border px-4 py-2" hidden>
                                                            <?php echo $producto["id_producto"] . "<br>"; ?></td>
                                                        <td class="border px-4 py-2"><?php echo $producto["serial"] . "<br>"; ?>
                                                        </td>
                                                        <td class="border px-4 py-2">
                                                            <?php echo $producto["producto"] . "<br>"; ?></td>
                                                        <td class="border  px-4 py-2">
                                                            <?php echo $producto["cantidad"] . "<br>"; ?></td>
                                                        <td class="border w-1/6 px-4 py-2">
                                                            $ <?php echo number_format($producto["precio"]) . "<br>"; ?></td>
                                                        <td class="border w-1/6 px-4 py-2">
                                                            <?php echo $producto["nombre_categoria"] . "<br>"; ?></td>
                                                        <td class="border w-1/6 px-4 py-2">
                                                            <?php echo $producto["nombre_marca"] . "<br>"; ?></td>
                                                        <td class="border w-1/6 px-4 py-2">
                                                            <?php if ($producto["estado_producto"] == "1") {
                                                                echo "Habilitado <br>";
                                                            } else {
                                                                echo "Inhabilitado <br>";
                                                            }
                                                            ?></td>
                                                        <td class="border px-4 py-2">
                                                            <a class="bg-red-500 cursor-pointer rounded p-1 mx-1 text-white" href="./actualizarProducto.php?id=<?php echo $producto["id_producto"]; ?>">
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

                        <!--Modal para agregar productos-->
                        <!-- Centered With a Form Modal -->
                        <div id='centeredFormModal' class="modal-wrapper w-full md:w1/1">
                            <div class="overlay close-modal"></div>
                            <div class="modal modal-centered">
                                <div class="modal-content shadow-lg p-5">
                                    <div class="border-b p-2 pb-3 pt-0 mb-4">
                                        <div class="flex justify-between items-center">
                                            Agregar Producto
                                            <span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                                                <i class="fas fa-times text-gray-700"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Modal content -->
                                    <form action="../productos/agregarProducto.php" method="post" enctype="multipart/form-data">
                                        <div class="w-full">
                                            <div class="flex flex-wrap -mx-3 mb-6">
                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                                        Serial
                                                    </label>
                                                    <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="serial" id="serial" type="text" placeholder="Ingrese el serial" required onchange="Serial1()">
                                                </div>
                                                <div class="w-full md:w-1/2 px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                                                        Nombre del Producto
                                                    </label>
                                                    <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="producto" id="nombre" type="text" placeholder="Ingrese el nombre del producto" required onchange="NombresNumeros()">
                                                </div>
                                            </div>
                                            <div class="flex flex-wrap -mx-3 mb-6">
                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                                        Descripción Breve
                                                    </label>
                                                    <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="descripcion_breve" id="descripcion_breve" type="text" placeholder="Ingrese una descripción breve" required onchange="Descripciones2()">
                                                </div>
                                                <div class="w-full md:w-1/2 px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                                                        Descripción
                                                    </label>
                                                    <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="descripcion" id="descripcion" type="text" placeholder="Ingrese una descripción" required onchange="Descripciones1()">
                                                </div>
                                            </div>
                                            <div class="flex flex-wrap -mx-3 mb-6">
                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                                        Cantidad
                                                    </label>
                                                    <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="cantidad" id="cantidad" type="number" placeholder="Ingrese la cantidad" required onchange="Cantidad123()">
                                                </div>
                                                <div class="w-full md:w-1/2 px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                                                        Precio
                                                    </label>
                                                    <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="precio" id="precio" type="text" placeholder="Ingrese un precio" required onchange="Valores1234()">
                                                </div>
                                            </div>
                                            <div class="flex flex-wrap -mx-3 mb-6">
                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                                        Categoría
                                                    </label>
                                                    <div class="relative">
                                                        <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-state" name="categoria" required>
                                                            <option value="">Seleccione una opción</option>
                                                            <?php
                                                            foreach ($categorias as $key => $categoria) { //Agregamos las categorias a la lista desplegable
                                                            ?>
                                                                <option value="<?php echo $categoria["id_categoria"] ?>">
                                                                    <?php echo $categoria["categoria"] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-darker">
                                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-full md:w-1/2 px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                                                        Marca
                                                    </label>
                                                    <div class="relative">
                                                        <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-state" name="marca" required>
                                                            <option value="">Seleccione una opción</option>
                                                            <?php
                                                            foreach ($marcas as $key => $marca) {
                                                            ?>
                                                                <option value="<?php echo $marca["id_marca"] ?>">
                                                                    <?php echo $marca["marca"] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-darker">
                                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                            </svg>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="w-full md:w-1/2 px-3 mt-5">
                                                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-city">
                                                        Elige un Proveedor
                                                    </label>
                                                    <div class="relative">
                                                        <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-state" name="proveedor" required>
                                                            <option value="">Seleccione una opción</option>
                                                            <?php
                                                            foreach ($proveedores as $key => $proveedor) {
                                                            ?>
                                                                <option value="<?php echo $proveedor["id_proveedor"] ?>">
                                                                    <?php echo $proveedor["proveedor"] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-darker">
                                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="border-b p-2 pb-3 pt-0 mb-4">
                                                <div class="flex justify-between items-center">
                                                    Agregar Imagen
                                                </div>
                                            </div>
                                            <div class="w-full">
                                                <div class="flex flex-wrap -mx-3 mb-6" id="incrementa">

                                                    <div class="w-full1 md:w-1/2 px-3 mb-6 md:mb-0">
                                                        <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="imagen[]" type="file" required>
                                                        <button class="rounded-full bg-green-800 hover:bg-green-500 w-32 h-8 text-white " type="button" id="agregar_mas">Agregar</button>
                                                    </div>

                                                </div>
                                                <div class="mt-8 ml-32">
                                                    <button class='bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded' type="submit">
                                                        Agregar</button>
                                                    <span class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded'>
                                                        Cerrar
                                                    </span>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    </div>


    <!-- modal agregar imagen -->
    <!-- Centered With a Form Modal -->
    <div id='centeredFormModal1' class="modal-wrapper w-full md:w1/1">
        <div class="overlay close-modal"></div>
        <div class="modal modal-centered">
            <div class="modal-content shadow-lg p-5">
                <div class="border-b p-2 pb-3 pt-0 mb-4">
                    <div class="flex justify-between items-center">
                        Seleccione la imagen
                        <span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                            <i class="fas fa-times text-gray-700"></i>
                        </span>
                    </div>
                    <div class="w-full">
                        <div class="flex flex-wrap -mx-3 mb-6" id="incrementa">

                            <div class="w-full1 md:w-1/2 px-3 mb-6 md:mb-0">
                                <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="imagen[]" type="file" required>
                                <button type="button" id="agregar_mas">+</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--</form>-->


            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

            < <script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
            "url":"//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
        }
        });

    });

                $(function() {
                var i = 1;
                $('#agregar_mas').click(function() {
                var div = '<div class="w-full'+(i+1)+' md:w-1/2 px-3 mb-6 md:mb-0">';
                    var inputCode = '<input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="imagen[]" type="file" required>';
                    i++;
                    //Importante esta variable debe ir debajo del autoincrementable
                    var btnDelete = '<button class="rounded-full bg-red-800 hover:bg-red-500 w-32 h-8 text-white" id="'+i+'">Eliminar</button>';
                    $('#incrementa').append( div + inputCode + btnDelete +
                    ' </div>');
                });


                $(document).on('click', '.rounded-full', function() {
                var button_id = $(this).attr("id");
                console.log(button_id);
                $('.w-full' + button_id).remove();
                });


                });
                </script>
                <script src="../js/main.js"></script>

</body>

</html>
<?php
if (isset($_SESSION['producto'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Producto agregado'
        });
    </script>";
    unset($_SESSION['producto']);
}

if (isset($_SESSION['actualizar_producto'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Producto Actualizado'
        });
    </script>";
    unset($_SESSION['actualizar_producto']);
}

if (isset($_SESSION['actualizar_error'])) {
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Producto no actualizado'
        });
    </script>";
    unset($_SESSION['actualizar_error']);
}

if (isset($_SESSION['producto_error'])) {
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Producto no agregado'
        });
    </script>";
    unset($_SESSION['producto_error']);
}
?>