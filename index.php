<?php
    session_start();

    if (isset($_POST["sesion"])) {
        header('location:login-registro.php');
    }

    require_once './database/conexion.php';

    $consulta1 = $DB_con->prepare('SELECT * FROM producto ORDER BY id_producto DESC');
    $consulta1->execute();
    $productos = $consulta1->fetchAll(PDO::FETCH_ASSOC);

    $consulta2 = $DB_con->prepare('SELECT * FROM imagenes');
    $consulta2->execute();
    $imagenes = $consulta2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- iconos en fontawesome -->
    <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
    <!-- css footer y el header -->
    <link rel="stylesheet" href="./css/footer-header.css">
    <!-- css cuerpo -->
    <link rel="stylesheet" href="./css/style_cuerpo.css">
    <link rel="stylesheet" href="./css/style.css">

    <style>
    @import url('https://fonts.googleapis.com/css2?family=PT+Sans:ital@1&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Foundation:wght@500&family=PT+Sans:ital@1&family=Permanent+Marker&display=swap');
    </style>
    <title>Compu_Star</title>
</head>

<body>
    <!-- encabezado -->
    <header>
        <?php include("./componentes/headerindex.php"); ?>

        <!-- cuerpo -->
        <div class="container ">
            <div class="row mt-4 mb-4">
                <!-- card 1 -->
                <!-- Este foreach es para iterar y traer los productos de la base de datos -->
                <?php
                $ayudante = $productos[0]['id_producto'];
                $numero = 1;
                foreach ($productos as $key => $producto) {
                ?>
                <div class="col-md-4">
                    <div class="card">
                        <figure>
                            <?php //Este script sirve para poner solo la primera imagen
                                foreach ($imagenes as $key => $imagen) {
                                    if (($producto['id_producto'] == $imagen['producto_id']) and ($producto['id_producto'] == $ayudante)) {
                                        $ayudante--;
                                ?>
                            <img src="./imagenes/<?php echo $imagen['url'] ?>" height="200px" class="card-img-top"
                                alt="...">
                            <?php
                                        break;
                                    }
                                }
                                ?>
                        </figure>

                        <div class="card-body">
                            <h5 class="card-title"><strong><?php echo $producto['producto'] ?></strong></h5>
                            <p style="text-align: justify;"><?php echo $producto['descripcion_breve'] ?></p>
                            <p name="precio" id="precio" style="margin-left: 13rem; color:grey">
                                $ <?php echo number_format($producto['precio']) ?></p>
                            <a style="margin-left: 7rem;"
                                href="./descripcion.php?id=<?php echo $producto['id_producto'] ?>"
                                class="btn btn-primary">Ver mas</a>
                        </div>

                    </div>

                </div>

                <?php
                    if ($numero % 3 == 0) {
                        break;
                    } else {
                        $numero++;
                    }
                }
                ?>

                <!-- carusel -->
                <div id="carouselExampleAutoplaying" class="carousel slide mt-3 mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./img/carrusel/1.1.jpg" height="250px" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://hardzone.es/app/uploads-hardzone.es/2022/02/Intel-vs-AMD-2022.jpg"
                                height="250px" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/carrusel/3.1.png" height="250px" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- card 3 -->
                <?php
                for ($i = 3; $i < 6; $i++) {
                ?>

                <div class="col-md-4">
                    <div class="card">
                        <figure>
                            <?php //Este script sirve para poner solo la primera imagen
                                foreach ($imagenes as $key => $imagen) {
                                    if (($productos[$i]['id_producto'] == $imagen['producto_id']) and ($productos[$i]['id_producto'] == $ayudante)) {
                                        $ayudante--;
                                ?>
                            <img src="./imagenes/<?php echo $imagen['url'] ?>" height="200px" class="card-img-top"
                                alt="...">
                            <?php
                                        break;
                                    }
                                }
                                ?>
                        </figure>
                        <div class="card-body">
                            <h5 class="card-title"><strong><?php echo $productos[$i]['producto'] ?></strong></h5>
                            <p style="text-align: justify;"><?php echo $productos[$i]['descripcion_breve'] ?></p>
                            <p name="precio" id="precio" style="margin-left: 13rem; color:grey">
                                $ <?php echo number_format($productos[$i]['precio']) ?></p>
                            <a style="margin-left: 7rem;"
                                href="./descripcion.php?id=<?php echo $productos[$i]['id_producto'] ?>"
                                class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="container">
            <!-- barra con animación -->
            <div class="color">
                <div class="loader">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>

        <div class="container ">
            <div class="row mt-4 mb-4">
                <?php
                for ($i = 6; $i < 9; $i++) {
                ?>

                <div class="col-md-4">
                    <div class="card">
                        <figure>
                            <?php //Este script sirve para poner solo la primera imagen
                                foreach ($imagenes as $key => $imagen) {
                                    if (($productos[$i]['id_producto'] == $imagen['producto_id']) and ($productos[$i]['id_producto'] == $ayudante)) {
                                        $ayudante--;
                                ?>
                            <img src="./imagenes/<?php echo $imagen['url'] ?>" height="200px" class="card-img-top"
                                alt="...">
                            <?php
                                        break;
                                    }
                                }
                                ?>
                        </figure>
                        <div class="card-body">
                            <h5 class="card-title"><strong><?php echo $productos[$i]['producto'] ?></strong></h5>
                            <p style="text-align: justify;"><?php echo $productos[$i]['descripcion_breve'] ?></p>
                            <p name="precio" id="precio" style="margin-left: 13rem; color:grey">
                                $ <?php echo number_format($productos[$i]['precio']) ?></p>
                            <a style="margin-left: 7rem;"
                                href="./descripcion.php?id=<?php echo $productos[$i]['id_producto'] ?>"
                                class="btn btn-primary">Ver mas</a>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="container ">
            <section class=" mb-3">
                <img src="./img/scroll/gabinete1.jpg" alt="">
                <img src="./img/scroll/gabinete2.jpg" alt="">
                <img src="./img/scroll/gabinete3.jpg" alt="">
                <img src="./img/scroll/gabinete4.jpg" alt="">
                <img src="./img/scroll/gabinete5.jpg" alt="">
                <img src="./img/scroll/gabinete6.jpg" alt="">
                <img src="./img/scroll/gabinete7.jpg" alt="">
                <img src="./img/scroll/gabinete8.jpg" alt="">
            </section>
        </div>

        <div class="container ">
            <div class="fondo">
                <div class="slider">
                    <span style="--i:1"><img src="./img/pruebas/1.jpg" alt=""></span>
                    <span style="--i:2"><img src="./img/pruebas/2.jpg" alt=""></span>
                    <span style="--i:3"><img src="./img/pruebas/3.webp" alt=""></span>
                    <span style="--i:4"><img src="./img/pruebas/4.jpg" alt=""></span>
                    <span style="--i:5"><img src="./img/pruebas/5.jpg" alt=""></span>
                    <span style="--i:6"><img src="./img/pruebas/6.jpg" alt=""></span>
                    <span style="--i:7"><img src="./img/pruebas/7.jpg" alt=""></span>
                    <span style="--i:8"><img src="./img/pruebas/8.jpg" alt=""></span>
                </div>
            </div>
        </div>

        <!-- Pie de pagina -->
        <footer>
            <?php include("./componentes/footer.php") ?>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>

</body>

</html>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
<script src="/js/app.js"></script>
<script>