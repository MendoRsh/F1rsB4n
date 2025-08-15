<?php
require_once __DIR__ . '/../controllers/conection.php';

try {
    $conexion = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4")   
    );

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa";
    
} catch (PDOException $e) {
    echo "¡Ups! Error al conectar... " . $e->getMessage();
    exit;
}

// Recibimos datos por POST
$UniId = $_POST['id'] ?? null;
$status = $_POST['status'] ?? null;

if (empty($UniId) || empty($status)) {
    die("Faltan datos");
}

$sql = "UPDATE sesiones SET status = :status, updated_at = NOW() WHERE id = :id";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':status', $status);
$stmt->bindParam(':id', $UniId);
$stmt->execute();

echo "Estado actualizado correctamente.";
?>
