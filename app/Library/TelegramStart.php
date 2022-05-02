<?php

namespace App\Library;
use Longman\TelegramBot\Telegram;

class TelegramStart {


    function initialTelegram(){
        $mysql_credentials = [
            'host'     => getenv("DB_HOST"),
            'port'     => getenv("DB_PORT"), 
            'user'     => getenv("DB_USERNAME"),
            'password' => getenv("DB_PASSWORD"),
            'database' => getenv("DB_DATABASE")
        ];
        
            // Create Telegram API object
        $telegram = new Telegram(getenv("API_KEY"), getenv("BOT_USERNAME"));
    
        $telegram->enableMySql($mysql_credentials);
        
        $server_response = $telegram->handleGetUpdates();
        
        $server_response->getUpdates();
    }
   


}




?>