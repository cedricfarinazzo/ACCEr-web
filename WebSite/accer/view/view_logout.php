<?php
ob_start();
if (!$connected)
{
	header("location: ?p=accueil");
	exit();
}
$user->logout();
header("Location: ?p=accueil&messa=2");
exit();
$request = ob_get_contents();
ob_clean();