<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- css bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <!-- iconos en fontawesome -->
    <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
    <!-- css foote y el header -->
    <link rel="stylesheet" href="./css/footer-header.css">
    <!-- css cuerpo -->
    <link rel="stylesheet" href="./css/stylecuerpo.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=PT+Sans:ital@1&display=swap');
  @import url('https://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Foundation:wght@500&family=PT+Sans:ital@1&family=Permanent+Marker&display=swap');
  </style>
    <title>Document</title>
</head>
<body>
  <!-- encabezado -->
<header>
    <?php include("./componentes/headerindex.php"); ?>
    </header>

    <div class="container">
        <div class="row">
            <div class="col mt-3 mb-4">
            <div class="d-flex position-relative " >
            <img src="./img/logo/images.png" height="200px" class="flex-shrink-0 me-3" alt="...">
            <div>
            <h1 style="text-align: center;">Techno Solution</h1>
            <p style="text-align: justify;margin-right: 15px;" >La empresa TECNO SOLUTIONS tiene una tienda de componentes computacionales como lo son: monitores, CPU, tarjetas graficas etc. Pero esta empresa los ultimos meses ha tenido un bajón en sus ventas así que se les propuso crear una página web para que asi puedan impulsar sus ventas.</p>
            </div>
            <div >
            <img src="./img/logo/jefe.jpg" height="200px" alt="">
            <p style="text-align: center;">German Garmendia</p>
            </div>
        </div>
            </div>
        </div>
        <div class="row">
            <!-- Mision -->
        <div class="col-sm-6 mb-3">
        <div>
      <div class="card-body ">
        <h2 class="card-title" style="text-align: center;">Misión</h2>
        <p class="card-text" style="text-align: justify;">La misión principal de este software es ayudar a dicha empresa a ser más reconocida para aumentar las posibilidades de que sus ventas incrementen. Además, buscar un lugar en el mundo digital por medio de la realización de una pagina web, que facilite la interacción Usuario/Cliente con la empresa.</p>
      </div>
    </div>
            </div>
    <!-- Vision -->
            <div class="col-sm-6 mb-3">
        <div>
      <div class="card-body">
        <h2 class="card-title" style="text-align: center;">Visión</h2>
        <p class="card-text" style="text-align: justify;">Visualizar el objetivo a largo plazo en el que la empresa Tecno Solutions sea más conocida con su primer software llamado "Compu_Start", para así posicionarse en el mercado como una de las empresas con más altos  estándares de calidad y eficacia a la hora  desarrollar el software propuesto por el cliente.</p>
     
      </div>
    </div>
            </div>
        </div>
    </div>
    <div class="container mt-4 mb-4">
  <h3 style="text-align: center; border-top:3px solid #111; ">Desarrolladores</h3>
</div>
<div class="container">

      <section class="swiper mySwiper">
        <!-- desarrollador 1 -->
      <div class="swiper-wrapper">
      <div class="card_cont swiper-slide">
        <div class="card_image ">
          <img src="./img/desarrolladores/yo.jpeg" alt="">
        </div>
        <div class="card_contenido">
          <span class="card_titulo">Desarrollador Frontend</span>
          <span class="card_nombre">Jhonatan Mena</span>
          <p class="card_texto">
            Estudiante de programación en el centro de servicio y gestión empresarial SENA</p>
        </div>
      </div>
<!-- desarrollador 2 -->
      <div class="card_cont swiper-slide">
        <div class="card_image ">
          <img src="./img/avatar.png" alt="">
        </div>
        <div class="card_contenido">
          <span class="card_titulo">Desarrollador Frontend</span>
          <span class="card_nombre"> Santiago Naranjo</span>
          <p class="card_texto">
          Estudiante de programación en el centro de servicio y gestión empresarial SENA
        </p>
        </div>
      </div>
<!-- desarrollador 3 -->
      <div class="card_cont swiper-slide">
        <div class="card_image ">
          <img src="./img/avatar.png" alt="">
        </div>
        <div class="card_contenido">
          <span class="card_titulo">Desarrollador Frontend</span>
          <span class="card_nombre"> Santiago Quiñones</span>
          <p class="card_texto">
          Estudiante de programación en el centro de servicio y gestión empresarial SENA
        </p>
        </div>
      </div>
      <!-- desarrollador 4 -->
      <div class="card_cont swiper-slide">
        <div class="card_image ">
          <img src="./img/desarrolladores/frey.jpeg" alt="">
        </div>
        <div class="card_contenido">
          <span class="card_titulo">Desarrollador Backend</span>
          <span class="card_nombre"> Freymer Sepúlveda</span>
          <p class="card_texto">
          Estudiante de programación en el centro de servicio y gestión empresarial SENA
        </p>
        </div>
      </div>
      <!-- desarrollador 5 -->
      <div class="card_cont swiper-slide">
        <div class="card_image ">
          <img src="./img/desarrolladores/lean.webp" alt="">
        </div>
        <div class="card_contenido">
          <span class="card_titulo">Desarrollador Backend</span>
          <span class="card_nombre"> Leandro Pastor</span>
          <p class="card_texto">
          Estudiante de programación en el centro de servicio y gestión empresarial SENA
        </p>
        </div>
      </div>
      <!-- desarrollador 6 -->
      <div class="card_cont swiper-slide">
        <div class="card_image ">
          <img src="./img/desarrolladores/zapata.avif" alt="">
        </div>
        <div class="card_contenido">
          <span class="card_titulo">Validaciones</span>
          <span class="card_nombre"> Miguel Zapata</span>
          <p class="card_texto">
          Estudiante de programación en el centro de servicio y gestión empresarial SENA
        </p>
        </div>
      </div>
      <!-- desarrollador 7 -->
      <div class="card_cont swiper-slide">
        <div class="card_image ">
          <img src="./img/desarrolladores/oswalus.jpeg" alt="">
        </div>
        <div class="card_contenido">
          <span class="card_titulo">Gestor De Base de Datos</span>
          <span class="card_nombre"> Oswaldo Natera</span>
          <p class="card_texto">
          Estudiante de programación en el centro de servicio y gestión empresarial SENA
        </p>
        </div>
      </div>
      <!-- desarrollador 8 -->
    

      </div>
        </section>
</div>



    <!-- Pie de pagina -->
    <footer>
        <?php include("./componentes/footer.php")?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    coverflowEffect: {
      rotate: 0,
      stretch: 0,
      depth: 300,
      modifier: 1,
      slideShadows: false,
    },
    pagination: {
      el: ".swiper-pagination",
    },
  });
</script>

</body>
</html>
