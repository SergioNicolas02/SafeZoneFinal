<?php
session_start();
include_once 'conexion.php';

// Verificar si el usuario está logueado y tiene rol de administrador
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// Obtener todos los usuarios de la base de datos
$query = "SELECT id, email, role FROM users";
$result = mysqli_query($conexion, $query);

// Editar usuario
if (isset($_GET['edit'])) {
    $user_id = $_GET['edit'];
    $query = "SELECT id, email, role FROM users WHERE id = $user_id";
    $user_result = mysqli_query($conexion, $query);
    $user = mysqli_fetch_assoc($user_result);

    if (isset($_POST['update'])) {
        $role = $_POST['role'];
        $update_query = "UPDATE users SET role = '$role' WHERE id = $user_id";
        if (mysqli_query($conexion, $update_query)) {
            header('Location: admin.php');
        } else {
            $error = "Error al actualizar el usuario.";
        }
    }
}

// Eliminar usuario
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $delete_query = "DELETE FROM users WHERE id = $user_id";
    if (mysqli_query($conexion, $delete_query)) {
        header('Location: admin.php');
    } else {
        $error = "Error al eliminar el usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Administrar Usuarios</title>
</head>
<body>
    <div class="container">
        <h2 class="my-4">Administrar Usuarios</h2>

        <!-- Mostrar errores -->
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Correo Electrónico</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td>
                            <!-- Enlace para editar usuario -->
                            <a href="admin.php?edit=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <!-- Enlace para eliminar usuario -->
                            <a href="admin.php?delete=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Formulario de edición si se seleccionó un usuario para editar -->
        <?php if (isset($_GET['edit'])): ?>
            <h3>Editar Usuario: <?php echo $user['email']; ?></h3>
            <form action="admin.php?edit=<?php echo $user['id']; ?>" method="POST">
                <div class="mb-3">
                    <label for="role" class="form-label">Rol</label>
                    <select name="role" id="role" class="form-control">
                        <option value="user" <?php if ($user['role'] === 'user') echo 'selected'; ?>>Usuario</option>
                        <option value="admin" <?php if ($user['role'] === 'admin') echo 'selected'; ?>>Administrador</option>
                    </select>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Actualizar</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
