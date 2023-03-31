<?php
    include "./database/conexion.php"; 
    $consulta=$DB_con->prepare('SELECT * FROM categoria');
    $consulta->execute();
    $categorias=$consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<header>
    <nav class="navbar navbar-expand-md border-bottom border-primary">
        <div class="container-fluid">
            <a href="./index.php" class="navbar-brand">Compu Start</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#MenuNavegacion">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="MenuNavegacion" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto" id="nav1">
                    <li class="nav-item"><a href="./index.php" class="nav-link">Inicio</a></li>
                    <li class="nav-item"><a href="./nosotros.php" class="nav-link">Nosotros</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Categorías
                        </a>
                        <div class="transparente">
                            <div class="dropdown-menu">
                                <?php
                                foreach ($categorias as $key => $categoria) {
                            ?>
                                <ul>
                                    <li><a class="dropdown-item"
                                            href="./paginaCategoria.php?id=<?php echo $categoria['id_categoria'] ?>"><?php echo $categoria['categoria'] ?></a>
                                    </li>
                                </ul>
                                <?php
                                }
                            ?>

                            </div>
                        </div>
                    </li>
                    <li class="nav-item"><a href="./mostrarCarritoIndex.php"
                            class="nav-link">Carrito(<?php echo (empty($_SESSION['carritoIndex']))?0:count($_SESSION['carritoIndex']); ?>)</a>
                    </li>

                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="./login-registro.php" class="social"><i class="fa fa-user"></i> Iniciar
                            Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script>
    function Alerta1() {
        <?php 
            ?>
    }
    </script>
</header>