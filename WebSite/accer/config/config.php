<?php
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");
session_cache_expire(60);
// ini_set("SMTP", "smtp.gmail.com");
// ini_set("smtp_port", "587");
// ini_set("default_domain", "gmail.com");
// ini_set("auth_username", "");
// ini_set("auth_password", "");
// ini_set("force_sender", "");
//require '../config/reCaptcha_key.php';

define("ORGANIZATION_NAME" , "ACCEr");
define("PROJECT_NAME" , "Shadow Miner");

if ($_SERVER["SERVER_NAME"] == "localhost" OR $_SERVER["SERVER_NAME"] == "0.0.0.0" OR $_SERVER["SERVER_NAME"] == "127.0.0.1") {
	define("URL_PATH", 'http://localhost:8080');
	$production = false;
} else {
	$sub = '';
	define("URL_PATH", 'https://'.$_SERVER["SERVER_NAME"].$sub);
	$production = true;
}

if ($production) {
	// error_reporting(0);
	require WEB_PATH.'/config/dbKeyProd.php';
} else {
	error_reporting(E_ALL);
	require WEB_PATH.'/config/dbKeyLoc.php';
}
require WEB_PATH.'/class/Factory.php';
Factory::autoload_starter();
Factory::error_handler();
$db = PDOFactory::getMysqlConnexion($dbname);
session_start();