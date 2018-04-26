<?php
define("WEB_PATH", dirname(realpath('index.php'),2));
require WEB_PATH.'/config/config.php';

require WEB_PATH.'/function/maintenance.php';
if (is_maintenance()) {
    if (getMaintenanceData()[1] != $_COOKIE['_admin_maj']) {header('Location: maintenance.php'); die();}
}


$imgtoken = isset($_GET["img"]) ? urldecode($_GET["img"]) : "";
$larg = isset($_GET["larg"]) ? (int)($_GET["larg"]) : "";
$cache = new CacheManager("image", $imgtoken.'-'.$larg);
$in_cache = $cache->on_cache();
if (!$in_cache) {
	
	ob_start();

	$img = new ImageManager($db);
	if ($img->GetImg($imgtoken, $larg) != false) {
		$img_standart = new ImageManager($db);
		$img_standart->GetImg($img_standart->GetTokenByID(2), $larg);
	}

	$content = ob_get_contents();
	ob_end_clean();
	$cache->createcache($content);

} else {
	$content = $cache->readcache();
}

echo $content;
exit();
?>
