<?php
require_once __DIR__ . '/../controllers/conection.php';

header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);

$session_id = $_POST['id'] ?? null;
$status = $_POST['status'] ?? null;

// 1. Actualizar BD
$db = new PDO(
    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
    DB_USER,
    DB_PASS,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4")
);
$sql = "UPDATE sesiones SET status = :status, updated_at = NOW() WHERE id = :id";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':status', $status);
$stmt->bindParam(':id', $session_id);
$stmt->execute();

// 2. Notificar vía WebSocket (¡Magia aquí!)
$socket = stream_socket_client('tcp://localhost:8080');
fwrite($socket, json_encode([
    'accion' => 'notificar',
    'session_id' => $session_id,
    'estado' => $status
]));
fclose($socket);

echo json_encode(['success' => true]);
