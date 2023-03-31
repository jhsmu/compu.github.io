<?php
    session_start();
    
    $_SESSION["carritoSesion"]="no has iniciado sesion";

    header('location:../login-registro.php');