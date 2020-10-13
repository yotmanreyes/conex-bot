<?php 

    require_once __DIR__ . "/vendor/autoload.php";

    try {
        $bot = new \TelegramBot\Api\Client('1239904902:AAHWGS40MoO1x2wcvPs-SuzMmO_R-X28EOw', '571e37d4-a0b4-439f-a677-5f9ca6956803');
        // or initialize with botan.io tracker api key
        // $bot = new \TelegramBot\Api\Client('YOUR_BOT_API_TOKEN', 'YOUR_BOTAN_TRACKER_API_KEY'); 
    
        $bot->command('ping', function ($message) use ($bot) {
            $bot->sendMessage($message->getChat()->getId(), 'pong!');
        });
        
        $bot->command('consulta-usuario', function ($message) use ($bot) {
            $bot->sendMessage($message->getChat()->getId(), '
                Bienvenido a nuestro sistema de atención y soporte al usuario.
                Por este medio podra consultar información como: \n
                Fecha de Inscripciones \n
                Información Personal \n
                Consulta de Pagos \n
                Soporte Tecnico \n
                Cambiar codigo de verificación \n                
            ');
        });
        
        $bot->run();
    
    } catch (\TelegramBot\Api\Exception $e) {
        $e->getMessage();
    }