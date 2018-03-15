<?php
function initOutputFilter() {
	ob_start('ob_gzhandler');
	register_shutdown_function('ob_end_flush');
}
initOutputFilter();

define("WEB_PATH", dirname(realpath('index.php'),2));
require WEB_PATH.'/config/config.php';

require WEB_PATH.'/function/maintenance.php';
if (is_maintenance()) {
    if (getMaintenanceData()[1] != $_COOKIE['_admin_maj']) {header('Location: maintenance.php'); exit();}
}

$image_manager = new ImageManager($db);
if ($image_manager->IsEmpty()) {
	$image_manager->AddDefault();
}
unset($image_manager);

$user = new UserManager($db);
$connected = $user->verifSess();
if (!$connected AND isset($_COOKIE["_authcookie-remember"])) {
	if ($user->cookie_connect($_COOKIE["_authcookie-remember"])) {
		$_SESSION["message"] = 3;
		header("Location: ?p=accueil");
		exit();
	}
}

if (isset($_GET['p']) AND !empty($_GET['p'])){
	$p = str_replace(['1','2','3','4','5','6','7','8','9','0', '/', "'", '=', '|', '\\'], "", strtolower($_GET['p']));
	$file = WEB_PATH.'/view/view_'.$p.'.php';
    if (file_exists($file)) {
        require $file;
    } else {
        require WEB_PATH.'/view/view_accueil.php';
    }
} else {
    require WEB_PATH.'/view/view_accueil.php';
}

if (isset($request)) {echo $request;}
require WEB_PATH.'/view/layout.php';