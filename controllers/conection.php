<?php
// Cargamos las credenciales desde config.php
require_once __DIR__ . "/config.php";

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
