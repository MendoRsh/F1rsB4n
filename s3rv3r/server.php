<?php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/../controllers/config.php";



use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use React\Socket\ConnectorInterface;

class NotificadorEstado implements MessageComponentInterface
{

    protected $clients;
    protected $pdo; 

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;

        $this->pdo = new PDO(
       "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4")
    );
    $this -> pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function onOpen($conn)
    {
        $this->clients->attach($conn);
        echo "Nueva conexión ({$conn->resourceId})\n";
    }

    public function onMessage($conn, $msg)
    {
        $data = json_decode($msg, true);

        // Guardar session_id asociado a la conexión
        if (isset($data['id'])) {
            $conn->session_id = $data['id'];
            echo "Cliente {$conn->resourceId} asociado a sesión: {$conn->session_id}\n";
        }
    }

    public function onClose($conn)
    {
        $this->clients->detach($conn);
        echo "Conexión cerrada ({$conn->resourceId})\n";
    }

    public function onError($conn, \Exception $e)
    {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }

// ¡Método clave! Llámala cuando el Admin actualice el estado
    public function notificarCambioEstado($session_id, $nuevo_estado) {
        foreach ($this->clients as $client) {
            if ($client->session_id === $session_id) {
                $client->send(json_encode([
                    'tipo' => 'cambio_estado',
                    'estado' => $nuevo_estado
                ]));
                echo "Notificado: Sesión {$session_id} -> {$nuevo_estado}\n";
            }
        }
    }
}

// Iniciar servidor
$server = IoServer::factory(
    new HttpServer(new WsServer(new NotificadorEstado())),
    8080
);
echo "Servidor WebSocket iniciado en puerto 8080\n";
$server->run();
