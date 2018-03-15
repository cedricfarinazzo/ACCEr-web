<?php

define("WEB_PATH", dirname(realpath('getMessage.php'),5));
require WEB_PATH.'/config/config.php';

$chat = new ChatManager($db);
$id = isset($_POST["lastid"]) ? (int)$_POST["lastid"] : $chat->lastid();
echo $chat->GetLastMessage($id);