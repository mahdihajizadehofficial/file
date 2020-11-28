<?php

 // O G H A B

@$oghab = file_get_contents("data/$chatID/com.txt");
@$tt = file_get_contents("data/$chatID/name.txt");
 if($msg == 'ping'){
  $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "😶"]);
  }

if($msg == '/start'){
if (!file_exists("data/$chatID/com.txt")) {
  mkdir("data/$chatID");
  file_put_contents("data/$chatID/com.txt","none");
  file_put_contents("data/$chatID/vip.txt","no");
	}
  $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "به ربات تغییر نام فایل ها خوش امدید😊
 خوب برای اینکار شما اول باید دستور /setname را برای من بفرستید

To the robot, change the file name welcome😊
Good to do this, you must first command /setname for me send
 
🔥 PoweredBy: @OGHAB_TM"]);
  }

if($msg == '/setname'){

file_put_contents("data/$chatID/com.txt","set");
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "خوب دوست عزیز دوست داری اسم فایل ها را به چی تغییر بدم😅
راستی فرمت فایل یادتون نره ها 
فرمت به اینا میگن :  
apk,mp3,mp4,ogg و  ........
مثلا
app.apk

————————

Well, like the name of the files to what changed you?😅
The name of the file in question, along with the extension it send. For example : 
apk,mp3,mp4,ogg, and ........
Or
app.apk"]);

}

if(strpos($msg, '.') !== false){
if($oghab == 'set'){
file_put_contents("data/$chatID/com.txt","none");
file_put_contents("data/$chatID/name.txt","$msg");
 $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "✔ نام فایل باموفقیت ذخیره شد .
😊 حالا لینک دانلود مستقیم فایلی رو که میخوای اسمشو تغییر بدم و بهت بفرستم رو ارسال کن :

——————————

✔ The name of the file was saved successfully .
😊 link to the direct download of the file that you want to name her, change me, and to you I send, enter :"]);
}
}

 if(strpos($msg, 'http') !== false){
 $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "🌵 Downloading ..."]);
copy("$msg","files/$tt");
$MadelineProto->messages->sendMedia([
 'peer' => $chatID,
 'media' => [
 '_' => 'inputMediaUploadedDocument',
 'file' => new \danog\MadelineProto\FileCallback(
 "files/$tt",
 function ($progress) use ($MadelineProto, $chatID, $msg_id) {
  $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '✳ Uploading ('.$progress.'%)']);
            }
        ),
 'attributes' => [[
 '_' => 'documentAttributeFilename',
 'file_name' => "$tt"]
 ]
  ],
 'message' => '💠 فایل شما آماده است!

[🔸ربات آپلودر و تغییرنام هوشمند🔹](https://t.me/Rnamer_bot)',
    'parse_mode' => 'Markdown'
]);
unlink("files/$tt");
}