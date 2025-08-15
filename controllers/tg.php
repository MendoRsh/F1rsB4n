<?php

use Dom\Document;

require_once __DIR__ . "/config.php";



class Telegram {
    private $token;
    private $chat_id;

    public function __construct() {
        $this->token = TELEGRAM_TOKEN;
        $this->chat_id = TELEGRAM_CHAT_ID;
    }

    public function enviarMensaje($mensaje) {
        $url = "https://api.telegram.org/bot{$this->token}/sendMessage";
        $data = [
            'chat_id' => $this->chat_id,
            'text'    => $mensaje
        ];

        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($data)
            ]
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        return $result;
    }
}
