<?php
session_start();
$_SESSION["Sesion_no_ini"]="La sesion no ha sido iniciada";
header("location:../login-registro.php");