<?php
session_start();
error_reporting(0);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link de iconos en fontawesome -->
    <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
    <!-- link de bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- estilos de login y registro -->
    <link rel="stylesheet" type="text/css" href="./css/login-registrate.css">
    <!-- validaciones de java script -->
    <script type='text/javascript' src=".\js\validaciones.js"></script>
    <script type='text/javascript' src="./js/mostrar.js"></script>
    <!-- link de Sweetalert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login</title>
</head>

<body>
    <!-- login y registro -->
    <div class="inicio">
        <div class="container" id="main">
            <!-- registrar -->
            <div class="sign-up">
                <form action="./validaciones/agregarClientes.php" method="post">
                    <h1>Crear Una Cuenta</h1>
                    <div class="social-container">
                        <a href="" class="social"><i class="fab fa-facebook"></i></a>
                        <a href="" class="social"><i class="fab fa-instagram"></i></a>
                        <a href="" class="social"><i class="fab fa-twitter"></i></a>
                    </div>
                    <p>Rellene todos los campos</p>
                    <input autocomplete="on" onchange="nombre1()" type="text" name="nombre" id="nombre"
                        placeholder="Nombres" required>
                    <input autocomplete="on" onchange="apellido1()" type="text" name="apellido" id="apellido"
                        placeholder="Apellidos" required>
                    <select name="tipo_documento" required>
                        <option>Selecionar Opción</option>
                        <option value="Tarjeta de Identidad">T.I</option>
                        <option value="Cédula de Ciudadanía">C.C</option>
                        <option value="Cedula de Extranjería">C.E</option>
                    </select>
                    <input type="text" name="numero_documento" id="numero_documento" onchange="cedula1()"
                        placeholder="Numero De Documento" required>
                    <input autocomplete="on" onchange="direccion1()" type="text" name="direccion" id="direccion"
                        placeholder="Dirección" required>
                    <input autocomplete="on" onchange="telefono1()" type="number" name="telefono" id="telefono"
                        inputmode="tel" placeholder="Numero Telefónico" required>
                    <input autocomplete="on" onchange="ValidacionCorreo()" type="email" name="email_registro"
                        id="correo" placeholder="Correo" required>
                    <input onchange="contraseña()" type="password" name="clave" id="clave"
                        placeholder="Ingresar su clave" required>
                    <span>
                        <i class="fa fa-eye" style="color:#D8D8D8" id="eye"></i>
                    </span>
                    <input onchange="verificarContraseña()" type="password" name="clave_c" id="clave_c"
                        placeholder="Confirma su clave" required>
                    <span class="eyes">
                        <i class="fa fa-eye" style="color:#D8D8D8" id="eye_c"></i>
                    </span>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                        <label class="form-check-label" for="flexCheckDefault">
                            Acepto Términos Y Condiciones
                        </label>
                    </div>
                    <button name="crear" type="submit">Crear</button>
                    <br><br>
                </form>
            </div>

            <!-- iniciar sesión -->
            <div class="sign-in">
                <form action="./validaciones/iniciosesion.php" method="post">
                    <h1>Compu start</h1>
                    <h3>Iniciar Sesión</h3>
                    <div class="div social-container">
                        <a href="https://es-la.facebook.com/" class="social"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.instagram.com/" class="social"><i class="fa fa-instagram"></i></a>
                        <a href="https://twitter.com/?lang=es" class="social"><i class="fa fa-twitter"></i></a>
                    </div>
                    <p>Rellene todos los campos</p>
                    <input type="email" name="email" placeholder="Correo" required>
                    <input type="password" name="clave_inicio" placeholder="Clave" id="clave_inicio" required>
                    <span class="Eye">
                        <i class="fa fa-eye" style="color:#D8D8D8" id="eye_inicio"></i>
                    </span>
                    <button name="inicio" type="submit">Iniciar Sesión</button>
                    <div class="iniciar">
                        <a href="./index.php">Iniciar Sin Cuenta</a>
                    </div>
                    <div class="olvidar">
                        <a href="./recuperacion/email.php">¿Olvidaste tu contraseña?</a>
                    </div>
                </form>
            </div>

            <div class="div overlay-container">
                <div class="overlay">
                    <div class="overlay-left">
                        <h1>Bienvenido</h1>
                        <p>Si ya estas registrado inicia sesión</p>
                        <button id="signIn">Iniciar Sesión</button>
                    </div>
                    <div class="overlay-right">
                        <h1>Hola</h1>
                        <p>¿Aún no te has Registrado?</p>
                        <button id="signUp">Crear Una Cuenta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const main = document.getElementById('main');
    signUpButton.addEventListener('click', () => {
        main.classList.add("right-panel-active");
    });
    signInButton.addEventListener('click', () => {
        main.classList.remove("right-panel-active");
    });
    </script>
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js
"></script>


</body>

</html>
<script>
var eye = document.getElementById('eye');
var input = document.getElementById('clave');
var eye_c = document.getElementById('eye_c');
var input1 = document.getElementById('clave_c');


eye.addEventListener('click', mostrarcontra);
eye_c.addEventListener('click', mostrarcontraseña);


function mostrarcontra() {
    if (input.type == "password") {
        input.type = "text"
        eye.style.color = "#383838"
    } else {
        input.type = "password"
        eye.style.color = "#D8D8D8"
    }
}

function mostrarcontraseña() {
    if (input1.type == "password") {
        input1.type = "text"
        eye_c.style.color = "#383838"
    } else {
        input1.type = "password"
        eye_c.style.color = "#D8D8D8"
    }
}
</script>
<script>
var eye_inicio = document.getElementById('eye_inicio');
var input2 = document.getElementById('clave_inicio');

eye_inicio.addEventListener('click', mostrarinicio);

function mostrarinicio() {
    if (input2.type == "password") {
        input2.type = "text"
        eye_inicio.style.color = "#383838"
    } else {
        input2.type = "password"
        eye_inicio.style.color = "#D8D8D8"
    }
}
</script>

<?php
if (isset($_SESSION["inhabilitado"])) {
    echo ('<script>Swal.fire({
            title: "Usuario Inhabilitado",
            text: "Tu usuario fue inhabilitado.",
            icon: "info" 
        });
        </>');
    session_destroy();
}

if (isset($_SESSION["IngresoForsozo"])) {
    echo ('<script>Swal.fire({
            title: "Ingreso Forsozo",
            text: "Por favor, para navegar en la página debe ingresar sesión o registrarse",
            icon: "info" 
        });
        </>');
    session_destroy();
}

    if (isset($_SESSION["agregar"])) {
        echo ('<script>Swal.fire({
            title: "Registro exitoso",
            text: "Ahora puedes iniciar tu sesión",
            icon: "success" 
        });
        </>');
        session_destroy();
    }

    if (isset($_SESSION["Datos_incorrectos"])) {
        echo ('<script>Swal.fire({
            title: "Datos incorrectos",
            text: "Los datos ingresados son incorrectos, por favor verifique",
            icon: "info" 
        });
        </script>');
        session_destroy();
    }

    if (isset($_SESSION["error"])) {
        echo ('<script>Swal.fire({
            title: "Datos incorrectos",
            text: "Los datos ingresados son incorrectos, por favor verifique",
            icon: "info" 
        });
        </script>');
        session_destroy();
    }

    if (isset($_SESSION["emailRepetido"])) {
        echo ('<script>Swal.fire({
            title: "Email repetido",
            text: "El email que intenta ingresar esta repetido",
            icon: "info" 
        });
        </script>');
        session_destroy();
    }

    if (isset($_SESSION["Sesion_no_ini"])) {
        echo ('<script>Swal.fire({
            title: "No has iniciado sesion",
            text: "Para poder ingresar al carrito, porfavor inicie sesion",
            icon: "info" 
        });
        </script>');
        session_destroy();
    }

    if (isset($_SESSION["alerta"])) {
        echo ('<script>Swal.fire({
            title: "Actualmente tú usuario se encuentra inhabilitado",
            text: "Para poder ingresar otra vez, hablar con soporte técnico",
            icon: "info" 
        });
        </script>');
        session_destroy();
    }

    if (isset($_SESSION["carritoSesion"])){
        echo ('<script>Swal.fire({
            title: "No has iniciado sesion",
            text: "Para poder proceder con la compra tienes que inciar sesión",
            icon: "info" 
        });
        </script>');
        session_destroy();
    }

    session_destroy();
    ?>