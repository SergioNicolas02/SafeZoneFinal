<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirigir al login si no está logueado
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="boostrap.min.css" rel="stylesheet">
    <style>
        body{
            background: #ffe259;
            background: linear-gradient(to right, #171bff, #31cff7);
        }
        .bg{
            background-image: url(img/SafeZoneSolo.png);
            background-position:center center ;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Home SafeZone</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <div class="container w-75 bg-primary mt-5 rounded shadow">
        <div class="row align-items-stretch">
            <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">
                <!-- Imagen de fondo o contenido si es necesario -->
            </div>

            <div class="col bg-white p-5 rounded-end">
                <div class="text-end">
                    <img src="img/SafeZoneSolo.png" width="48" alt="">
                </div>
                <h2 class="fw-bold text-center py-5">Bienvenido a SafeZone</h2>
                
                <!-- Aquí puedes poner el contenido de la página de inicio -->
                <p>Contenido de tu página home.</p>
                
                <!-- Mostrar información del usuario logueado -->
                <p>Bienvenido, <?php echo $_SESSION['email']; ?>.</p>
                
                <!-- Botón de Cerrar sesión -->
                <div class="text-center">
                    <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
