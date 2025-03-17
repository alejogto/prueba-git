<?php
// Variables de entorno definidas en docker-compose.yml
$db_host = getenv('DB_HOST');       // 'db'
$db_name = getenv('DB_NAME');       // 'mrdb'
$db_user = getenv('DB_USER');       // 'user'
$db_pass = getenv('DB_PASSWORD');   // 'userpassword'

try {
    // Conectar a la base de datos usando PDO
    $conexion = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    echo "❌ Error de conexión a la base de datos: " . $e->getMessage();
    exit;
}
