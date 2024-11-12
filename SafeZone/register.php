<?php
// Iniciar sesión
session_start();

// Conectar a la base de datos
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar si el correo ya está registrado
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) > 0) {
        $error = "Este correo ya está registrado.";
    } else {
        // Si el correo no está registrado, guardar el usuario en la base de datos
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";
        
        if (mysqli_query($conexion, $query)) {
            // Redirigir a la página de login después de registrar al usuario
            header("Location: login.php");
            exit();
        } else {
            $error = "Hubo un error al registrar el usuario.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="boostrap.min.css" rel="stylesheet">
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
    <title>Registro SafeZone</title>
</head>
<body>
    <div class="container w-75 bg-primary mt-5 rounded shadow">
        <div class="row align-items-stretch">
            <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded"></div>
            <div class="col bg-white p-5 rounded-end">
                <div class="text-end">
                    <img src="img/SafeZoneSolo.png" width="48" alt="">
                </div>
                <h2 class="fw-bold text-center py-5">Registro</h2>

                <!-- Mostrar error si existe -->
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <!-- Formulario de Registro -->
                <form action="register.php" method="POST">
                    <div class="mb-4">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </div>

                    <div class="my-3">
                        <span>¿Ya tienes una cuenta? <a href="login.php">Inicia Sesión</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
