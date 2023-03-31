<?php
session_start();
require('../database/basededatos.php');

//Creamos un objeto del tipo Database
$db = new Database();
$connection = $db->connect(); //Creamos la conexión a la BD

// Cuando la conexión está establecida...
$query = $connection->prepare("SELECT * FROM marca"); // Traduzco mi petición
$query->execute(); //Ejecuto mi petición

$marcas = $query->fetchAll(PDO::FETCH_ASSOC); //Me traigo los datos que necesito

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
    <title>lista de Marcas</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
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
                                Lista de Marcas
                                <label class="flex justify-end" for="">
                                    <button data-modal='centeredFormModal' class="modal-trigger bg-blue-800 cursor-pointer rounded p-1 mx-1 text-white" href="">
                                        <i class="fa fa-user-plus"></i>
                                    </button>
                                    Agregar Marca
                                </label>
                            </div>
                            <div class="p-3">
                                <table class="table-responsive w-full rounded " id="dataTable"   style="margin-left: 30rem;">
                                    <div class="flex justify-center">
                                        <thead>
                                            <tr>
                                                <th class="border w-1/1 px-4 py-2">Id</th>
                                                <th class="border w-1/1 px-4 py-2">Marca</th>
                                                <th class="border w-1/1 px-4 py-2">Estado</th>
                                                <th class="border w-1/1 px-4 py-2">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            foreach ($marcas as $key => $marca) {
                                            ?>
                                                    <tr>
                                                        <td class="border px-4 py-2"><?php echo $marca["id_marca"] . "<br>"; ?></td>
                                                        <td class="border px-4 py-2"><?php echo $marca["marca"] . "<br>"; ?></td>
                                                        <td class="border px-4 py-2"><?php if ($marca["estado_marca"] == 1) {
                                                                                            echo ("Activo");
                                                                                        } else {
                                                                                            echo ("Inactivo");
                                                                                        }
                                                                                        "<br>"; ?></td>
                                                        <td class="border px-4 py-2">
                                                            <a class="bg-blue-800 cursor-pointer rounded p-1 mx-1 text-white" href="./actualizarMarca.php?id=<?php echo $marca["id_marca"]; ?>">
                                                                <i class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </div>
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
                        Agregar Marca
                        <span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                            <i class="fas fa-times text-gray-700"></i>
                        </span>
                    </div>
                </div>
                <!-- Modal content -->
                <form class="w-full" action="../marca/agregarmarca.php" method="post">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                marca
                            </label>
                            <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="marca" id="nombre" onchange="NombresNumeros()" type="text" placeholder="Ingrese una marca nueva" required>
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
if (isset($_SESSION['actualizar_marca'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Marca Actualizada'
        });
    </script>";
    unset($_SESSION['actualizar_marca']);
}

if (isset($_SESSION['actualizar_error'])) {
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Marca no actualizada'
        });
    </script>";
    unset($_SESSION['actualizar_error']);
}

if (isset($_SESSION['agregar'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Nueva Marca Creada'
        });
    </script>";
    unset($_SESSION['agregar']);

    if (isset($_SESSION['error'])) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Marca no agregada'
            });
        </script>";
        unset($_SESSION['error']);
    }
}
