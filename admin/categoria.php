<?php
session_start();
require('../database/basededatos.php');

//Creamos un objeto del tipo Database
$db = new Database();
$connection = $db->connect(); //Creamos la conexión a la BD

// Cuando la conexión está establecida...
$query = $connection->prepare("SELECT * FROM categoria"); // Traduzco mi petición
$query->execute(); //Ejecuto mi petición

$categorias = $query->fetchAll(PDO::FETCH_ASSOC); //Me traigo los datos que necesito
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
    <link rel="stylesheet" href="./css/styleadmin.css">
    <!-- iconos en fontawesome -->
    <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Lista de Categoría</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js">
    </script>
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
                <!--Main-->
                <main class="bg-white-500 flex-1 p-3 overflow-hidden">
                    <!--Grid Form-->

                    <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
                        <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
                            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                                Lista de Categoría
                                <label class="flex justify-end" for="">
                                    <button data-modal='centeredFormModal' class="modal-trigger bg-blue-800 cursor-pointer rounded p-1 mx-1 text-white" href="">
                                        <i class="fa fa-user-plus"></i>
                                    </button>
                                    Agregar Categoría
                                </label>
                            </div>
                            <div class="p-3">
                                <table class="table-responsive w-full rounded" id="dataTable" style="margin-left: 30rem;">
                                    <thead>
                                        <tr>
                                            <th class="border w-1/1 px-4 py-2">Id</th>
                                            <th class="border w-1/1 px-4 py-2">Categoría</th>
                                            <th class="border w-1/1 px-4 py-2">Estado</th>
                                            <th class="border w-1/1 px-4 py-2">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($categorias as $key => $categoria) {
                                        ?>
                                                <tr>
                                                    <td class="border px-4 py-2"><?php echo $categoria["id_categoria"] . "<br>"; ?></td>
                                                    <td class="border px-4 py-2"><?php echo $categoria["categoria"] . "<br>"; ?></td>
                                                    <td class="border px-4 py-2"><?php if ($categoria["estado_categoria"] == 1) {
                                                                                        echo ("Activo");
                                                                                    } else {
                                                                                        echo ("Inactivo");
                                                                                    }
                                                                                    "<br>"; ?></td>
                                                    <td class="border px-4 py-2">
                                                        <a class="bg-blue-800 cursor-pointer rounded p-1 mx-1 text-white" href="./actualizarCategoria.php?id=<?php echo $categoria["id_categoria"]; ?>">
                                                            <i class="fas fa-edit"></i></a>
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
                    <!--/Grid Form-->
            </div>
            </main>
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
                        Agregar Categoría
                        <span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                            <i class="fas fa-times text-gray-700"></i>
                        </span>
                    </div>
                </div>
                <!-- Modal content -->
                <form class="w-full" action="../categorias/agregarCategoria.php" method="post">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                Categoría
                            </label>
                            <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="categoria" id="nombre" onchange="NombresNumeros()" type="text" placeholder="Ingrese una categoría nueva" required>
                        </div>
                    </div>
                    <div class="mt-5">
                        <button class='bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded'> Agregar</button>
                        <span class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded'>
                            Cerrar
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/validaciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        function confirmar() {
            return confirm('¿Estas seguro?, se eliminarán los datos');
        }
    </script>

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
if (isset($_SESSION['actualizar_categoria'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Categoría Actualizada'
        });
    </script>";
    unset($_SESSION['actualizar_categoria']);
}

if (isset($_SESSION['categoria'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Nueva Categoría Creada'
        });
    </script>";
    unset($_SESSION['categoria']);
}
