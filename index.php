
<?php

if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}


include 'madeline.php';

$MadelineProto = new \danog\MadelineProto\API('session.madeline');
$MadelineProto->start();
$time=date("H:i",strtotime("5 hour"));
$sana = date('d-m-Y',strtotime('5 hour'));
$MadelineProto->account->updateProfile(['first_name'=>"$time #KoderNet",'about'=>"👨‍💻 #KoderNet vaqti:⌚️ $time 📆Sana: $sana 📡Kanalim: @Php_Koderlar"]);
$Bool = $MadelineProto->account->updateStatus(['offline' => false ]);
while (true) {
    $updates = $MadelineProto->get_updates(['offset' =>'-1', 'limit' => 10, 'timeout' => 0]); // Just like in the bot API, you can specify an offset, a limit and a timeout
    \danog\MadelineProto\Logger::log($updates);
    foreach ($updates as $update) {
        $offset = $update['update_id'] + 1; // Just like in the bot API, the offset must be set to the last update_id
        switch ($update['update']['_']) {
            case 'updateNewMessage':
                if (isset($update['update']['message']['out']) && $update['update']['message']['out']) {
                    continue;
                }
                $res = json_encode($update, JSON_PRETTY_PRINT);
                if ($res == '') {
                    $res = var_export($update, true);
                }
                $text=$update['update']['message']['message'];
                if(mb_stripos($text,'Salom')!==false or mb_stripos($text,'salom')!==false or mb_stripos($text,'Assalomu alekum')!==false){
                    try {
                        $MadelineProto->messages->sendMessage([
                            'peer' => $update['update']['message']['from_id'], 
                            'message' => "👋Assalomu alekum,bu avto javob qaytargichim
⏰Mening ish vaqtim: 13:00 - 21:00 
⚠Agar online bo'lmasam xabaringizni qoldiring 24 Soat ichida o'zim javob beraman!",
                            'reply_to_msg_id' => $update['update']['message']['id'],
                            'entities' => [['_' => 'messageEntityPre', 'offset' => 0, 'length' => strlen($res), 'language' => 'json']]]);
                    
                    } catch (\danog\MadelineProto\RPCErrorException $e) {
                    $MadelineProto->messages->sendMessage(['peer' => '@KoderNet', 'message' => $e->getCode().': '.$e->getMessage().PHP_EOL.$e->getTraceAsString()]);
                        
                    }
                }
        }
    }
}
?>

