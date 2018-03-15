<?php
define("WEB_PATH", dirname(realpath('index.php'),2));
require WEB_PATH.'/config/config.php';

require WEB_PATH.'/function/maintenance.php';
if (is_maintenance()) {
    if (getMaintenanceData()[1] != $_COOKIE['_admin_maj']) {header('Location: maintenance.php'); die();}
}

$pdftoken = isset($_GET["pdf"]) ? urldecode($_GET["pdf"]) : "";
$d = isset($_GET["d"]) ? (int)urldecode($_GET["d"]) : "";
if ($pdftoken != "") {
	$pdf = new PdfManager($db);
	$pdf->GetPdf($pdftoken, $d);
	$content = ob_get_contents();
}

exit();
?>