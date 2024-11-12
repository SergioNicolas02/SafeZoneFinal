<?php
// Iniciar sesión
session_start();
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consultar si existe un usuario con ese correo
    $query = "SELECT * FROM users WHERE email = ?"; // Usar una consulta preparada
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Si el usuario existe, verificar la contraseña
        $user = mysqli_fetch_assoc($result);
        
        // Comprobar si la contraseña ingresada coincide con la contraseña guardada en la base de datos
        if (password_verify($password, $user['password'])) {
            // Si la contraseña es correcta, iniciar sesión y redirigir a home.php
            $_SESSION['user_id'] = $user['id']; // Guardar el ID del usuario en la sesión
            $_SESSION['email'] = $user['email']; // Guardar el correo en la sesión
            header("Location: home.php"); // Cambié la redirección de home.html a home.php
            exit();
        } else {
            // Si la contraseña no coincide
            $error = "Las credenciales son incorrectas.";
        }
    } else {
        // Si no se encuentra el usuario con ese correo
        $error = "El correo electrónico no está registrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #171bff, #31cff7);
        }
        .bg {
            background-image: url(img/SafeZoneSolo.png);
            background-position: center center;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login SafeZone</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <div class="container w-75 bg-primary mt-5 rounded shadow">
        <div class="row align-items-stretch">
            <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded"></div>

            <div class="col bg-white p-5 rounded-end">
                <div class="text-end">
                    <img src="img/SafeZoneSolo.png" width="48" alt="">
                </div>
                <h2 class="fw-bold text-center py-5">Bienvenido</h2>
                
                <!-- Mostrar error si existe -->
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <!-- Formulario de Login -->
                <form action="login.php" method="POST">
                    <div class="mb-4">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-4"></div>
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password" required>
                    <div class="mb-4 form-check">
                        <input type="checkbox" name="connected" class="form-check-input">
                        <label for="connected" class="form-check-label">Mantenme conectado</label>
                    </div>
                    <div class="d-grd">
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </div>

                    <div class="my-3">
                        <span>No tienes cuenta? <a href="register.html">Registrate</a></span><br>
                        <span><a href="#">Recuperar Password</a></span>
                    </div>
                </form>

                <!-- Login Con Redes Sociales -->
                <div class="container w-100 my-5">
                    <div class="row text-center">
                        <div class="col-12">Iniciar Sesión</div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-outline-primary w-100 my-1">
                                <div class="row align-items-center">
                                    <div class="col-2 d-none d-md-block">
                                        <img src="img/FcLogo.webp" width="32" alt="">
                                    </div>
                                    <div class="col-12 col-md-10 text-center">Facebook</div>
                                </div>
                            </button>
                        </div>
                        <div class="col">
                            <button class="btn btn-outline-danger w-100 my-1">
                                <div class="row align-items-center">
                                    <div class="col-2 d-none d-md-block">
                                        <img src="img/Google.png" width="28" alt="">
                                    </div>
                                    <div class="col-12 col-md-10 text-center">Google</div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>
