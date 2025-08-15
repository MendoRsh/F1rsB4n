<?php
header('Content-Type: application/json');   
require_once __DIR__ . "/../controllers/conection.php";

try {
    $conexion = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4")
    );
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "¡Ups! Error al conectar... " . $e->getMessage();
    exit;
}


$GetId = $_POST['id'] ?? '';


try {
    $stmt = $conexion->prepare("
        SELECT status FROM sesiones 
        WHERE id = :id 
        LIMIT 1
    ");
    $stmt->bindParam(':id', $GetId);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($resultado) {
        echo json_encode([
            'success' => true,
            'status' => $resultado['status'] // "login", "otp", etc
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'Sesión no encontrada'
        ]);
    }
} catch (PDOException $e) {
    die(json_encode([
        'success' => false,
        'error' => 'Error de BD: ' . $e->getMessage()
    ]));
}
