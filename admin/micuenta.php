<?php
    error_reporting(0);
    session_start();
    include("./editar/conexion.php");
    $id_administrador = $_GET["id_administrador"];
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
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Editar perfil administrador</title>   
</head>
<header class="bg-nav">
       
            <div class="flex justify-between">
                <div class="p-1 mx-3 inline-flex items-center">
                    <i class="fas fa-bars pr-2 text-white" onclick="sidebarToggle()"></i>
                    <h1 class="text-white p-2">Compu Start</h1>
                </div>
                <div class="p-1 flex flex-row items-center">
                <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block"><?php echo $_SESSION["admin"] ?></a>
                    <img onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full" src="../img/logo/avatar.png" alt="">
                    <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
                    </div>
                </div>
            </div>
        </header>
    
<body>
<?php
        if(isset($_POST['enviar'])){
            //entra si le da el boton enviar
            $id_administrador=$_POST['id'];
            $nombre=$_POST['nombre'];
            $apellido=$_POST['apellido'];
            $contrasena=$_POST['contrasena'];

            //update
            $sql="update administrador set nombre='".$nombre."',
            apellido='".$apellido."',
            contrasenia='".$contrasena."'
            where id_administrador='".$id_administrador."'";

            $resultado=mysqli_query($conexion,$sql);

            if($resultado){
                session_start();
                $_SESSION['actualizar_datos'] = 'actualizar';
                header("location: ./indexadmin.php");
                error_reporting(0);

            }else{
                session_start();
                $_SESSION['error'] = 'actualizar';
                header("location: ./idexadmin.php");
                error_reporting(0);
            }
            mysqli_close($conexion);


        } else{
            //no le ha dado al boton enviar
            $id_administrador=$_GET['id_administrador'];
            $sql="select * from administrador where id_administrador='".$id_administrador."'";
            $resultado=mysqli_query($conexion,$sql);

            $fila=mysqli_fetch_assoc($resultado);
            $id_administrador=$fila["id_administrador"];
            $nombre=$fila["nombre"];
            $apellido=$fila["apellido"];
            $email=$fila["email"]; 
            $contrasena=$fila["contrasenia"];
            
            mysqli_close($conexion);
    ?>
<!--Container -->
<div class="mx-auto bg-grey-lightest">
    <!--Screen-->
    <div class="min-h-screen flex flex-col">
        <!--Header Section Starts Here-->
        <header class="bg-nav">
        
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
                Editar perfil del administrador
            </div>
            <div class="p-3">
    <form class="w-full" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3" hidden>
        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
               for="grid-password">
            Id Cliente
        </label>
        <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
        name="id" value="<?php echo $id_administrador; ?>" >
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
            >
            Nombre(s)
        </label>
        <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
        type="text" name="nombre" id="nombre" onchange="nombre1()" required value="<?php echo $nombre; ?>" placeholder="<?php echo $nombre; ?>">
    </div>
    <div class="w-full md:w-1/2 px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
               for="grid-last-name">
            Apellido(s)
        </label>
        <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
        type="text" name="apellido" id="apellido" onchange="apellido1()" required value="<?php echo $apellido; ?>" placeholder="<?php echo $apellido; ?>">
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
               for="grid-last-name">
            Contraseña
        </label>
        <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
        type="password" name="contrasena" id="clave" onchange="contraseña()" required value="<?php echo $contrasena; ?>" >
    </div>
    <span >
     <i class="fa fa-eye" 
     style="color:#D8D8D8;
    position: absolute;
    right: 37rem;
    transform: translate(0, -50%);
    top: 40%;
    cursor: pointer; 
    font-size:20px;
     " id="eye" ></i>
     </span>

</div>
<div class="mt-5">
    <button class='bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded'
    type="submit" name="enviar" value="ACTUALIZAR"> Actualizar</button>
<button type="button" class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded'> <a href="./indexAdmin.php">Volver</a>
        
    </button>
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
</form>
<?php
}
?>
<script src="../js/main.js"></script>
<!-- VALIDACIONES Y ALERTAS -->
<script src="../js/validaciones.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>
<script>
var eye = document.getElementById('eye');
var input = document.getElementById('clave');

eye.addEventListener('click',mostrar);

function mostrar(){
    if(input.type == "password"){
        input.type = "text"
        eye.style.color="#383838"
    }else{
        input.type = "password"
        eye.style.color="#D8D8D8"
    }
}
</script>

</body>

</html>