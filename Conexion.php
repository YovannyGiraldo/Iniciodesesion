<?php
$host = "localhost"; // aca es donde se realiza la conexion a la base de datos por xamp
$user = "root";
$pass = "";
$db = "iniciosesiondb";

$conexion = mysqli_connect($host, $user, $pass, $db);

if (!$con) {
    echo "Conexión fallida";
}