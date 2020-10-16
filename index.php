<?php 

    require_once __DIR__ . "/vendor/autoload.php";
    require_once "../src/DB.php";

    try {
        $bot = new \TelegramBot\Api\Client('1239904902:AAHWGS40MoO1x2wcvPs-SuzMmO_R-X28EOw', '571e37d4-a0b4-439f-a677-5f9ca6956803');
        // or initialize with botan.io tracker api key
        // $bot = new \TelegramBot\Api\Client('YOUR_BOT_API_TOKEN', 'YOUR_BOTAN_TRACKER_API_KEY'); 
    
        $bot->command('ping', function ($message) use ($bot) {
            $bot->sendMessage($message->getChat()->getId(), 'pong!');
        });
        
        $bot->command('start', function ($message) use ($bot) {
            $user = $message->getChat()->getFirstname() . ' ' . $message->getChat()->getLastName();
            $bot->sendMessage($message->getChat()->getId(), "
                ¡Hola! {$user} y bienvenido a nuestro sistema de mensajeria.
                Para proceder al registro de tu usuario es necesario:
                1. Utilizar el comando /registrar seguido de tu número de cédula.
                2. Se validara tu cedula en nuestro sistema
                3. Luego podras recibir todas las notificaciones por este medio
            ");
        });

        $bot->command('registrar', function ($message) use ($bot) {
            $str = explode(' ', $message->getText());
            $chat_id = $message->getChat()->getId();
            $cedula_id = intval($str[1]);
            $db = Database::getInstance();

            $sql = "SELECT COUNT(*) FROM nominas WHERE NOM_CEDULAID = ${cedula_id}";

            if($cedula_id != null){
                if ($db->query($sql)) {
                   return $bot->sendMessage($message->getChat()->getId(), "Gracias por registrarse. Ahoras recibiras todas las notifaciones por este medio");
                }
                
                return $bot->sendMessage($message->getChat()->getId(), "No se encontramos un usuario con esa cedula. Intente de nuevo!");
                
            }else{
                $bot->sendMessage($message->getChat()->getId(), "No has introducido tu cedula ID");
            }
        });
        
        $bot->run();
    
    } catch (\TelegramBot\Api\Exception $e) {
        $e->getMessage();
    }