<?php
define("WEB_PATH", dirname(realpath('index.php'),2));
require WEB_PATH.'/config/config.php';

require WEB_PATH.'/function/maintenance.php';
if (is_maintenance()) {
    if (getMaintenanceData()[1] != $_COOKIE['_admin_maj']) {header('Location: maintenance.php'); die();}
}

$downloadmanager = new DownloadManager($db);
if ($downloadmanager->search()) {
	$downloadmanager->download(true);
}
exit();
?>