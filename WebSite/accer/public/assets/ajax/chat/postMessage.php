 <?php

define("WEB_PATH", dirname(realpath('getMessage.php'),5));
require WEB_PATH.'/config/config.php';

$user = new UserManager($db);
$connected = $user->verifSess();

$chat = new ChatManager($db);

if ($connected) {
	if (isset($_POST["data"])) {
		$data = ($_POST["data"]);
		$data = explode("=",$data);
		$content = urldecode($data[1]);
		if (!empty($content)) {
			if (strlen($content) <= 100) {
				if ($chat->post_message($user->ID(), $content)) {
					
				} else {
				$error = "Une erreur s'est produite. Veuillez réessayer dans un moment.";
				}
			} else {
			$error = "Votre message trop long !";
			}	
		} else {
		$error = "Pour envoyer un message, remplissez le champ !";
		}
	}
	if (isset($error)) {
		echo json_encode(array(false, $error));
	} else {
		echo json_encode(array(true, ''));
	}
}