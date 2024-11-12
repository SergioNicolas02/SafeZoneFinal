<?php
// Contraseña original
$password = 'admin';

// Genera el hash de la contraseña
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Muestra el hash
echo $hashedPassword;
?>
