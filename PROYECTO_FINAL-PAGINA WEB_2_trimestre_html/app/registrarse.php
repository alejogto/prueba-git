<?php
include 'conexion.php'; // Conectamos a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = trim($_POST['nombre_completo']);
    $email = trim($_POST['correo_electronico']);
    $password = trim($_POST['contrasena']);
    $confirm_password = trim($_POST['confirmar_contrasena']);

    // Verificar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        echo "❌ Error: Las contraseñas no coinciden.";
        exit;
    }

    // Encriptar la contraseña antes de guardarla
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Insertar el usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password_hash);

        if ($stmt->execute()) {
            echo "✅ Usuario registrado con éxito.";
        } else {
            echo "❌ Error al registrar usuario.";
        }
    } catch (PDOException $e) {
        echo "❌ Error: " . $e->getMessage();
    }
}
