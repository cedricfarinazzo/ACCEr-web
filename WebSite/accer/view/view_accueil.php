<?php
ob_start();
//$user->logout();
//var_dump($_SESSION);
//var_dump($user);
//var_dump($_COOKIE);
//var_dump($_SERVER);
//var_dump($_GET);
//$_COOKIE = array();

if (isset($_SESSION["message"])) {
	$id_message = (int)$_SESSION["message"];
}
if (isset($_GET["messa"])) {
	$id_message = (int)$_GET["messa"];
}
$visit = new Visited;
if ($visit->needMessage()) {
	$id_message = 4;
}
if(isset($id_message)) {
	$messagetoast = new MessageToast($id_message);
	if ($messagetoast->GetMessage() == false) {
		unset($messagetoast);
	}
}
$request = ob_get_contents();
ob_clean();

ob_start();
?>
	<h2 class="center">Accueil</h2>
	<div class="divider"></div>
	<br/>
	<div class="container">
		<h4>Bienvenue sur le site du groupe ACCEr.</h4>
		<p>
			Nous sommes un groupe de 4 étudiants : Antoine Claudel , Cédric Farinazzo, Clément Languerre, Edgar Grizzi.
			<br/>
			Nous nous sommes donné pour but de réaliser un jeu vidéo pour notre projet de S2 à EPITA : ShadowMiner
		</p>
		<p>
			Vous pouvez suivre la progression du développement du jeu <a href="<?= URL_PATH.'?p=progress' ?>" >ici</a>.
			<br/>
			Vous pouvez consulter nos rapports <a href="<?= URL_PATH.'?p=report' ?>" >ici</a>.
			<br/>
			Vous pourrez bientôt télécharger le jeu <a href="<?= URL_PATH.'?p=download' ?>" >ici</a>.
		</p>
	</div>


<?php if (isset($messagetoast)) { ?>
<script>
	(function($){
		var $toastMessageContent = $('<?= $messagetoast->GetMessage() ?>').add($('<button class="btn-flat toast-action" onclick="Materialize.Toast.removeAll();" >Hide</button>'));
		Materialize.toast($toastMessageContent, 6000);//, 'rounded');
	})(jQuery);
</script>
<?php 
unset($_SESSION["message"]);
} ?>
<?php
$content = ob_get_contents();
ob_clean();