<?php
$host = 'localhost'; // Nombre del servidor
$user = 'root'; // Usuario de la base de datos
$password = ''; // Contraseña del usuario
$dbname = 'safezone_db'; // Nombre de la base de datos

// Crear conexión
$conexion = mysqli_connect($host, $user, $password, $dbname);

// Verificar la conexión
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
} else {
    echo "Beta. Conexión exitosa a la base de datos";
}
?>
