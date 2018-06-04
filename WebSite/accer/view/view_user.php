<?php

ob_start();

$profil = new UserManager($db);
if ($profil->getbyid($_GET['id']) == false) {
	header("Location: ?p=accueil");
	exit();
}


$profil_img = new ImageManager($db);
$token_img = $profil_img->GetTokenByID($profil->avatar_path());

$request = ob_get_contents();
ob_end_clean();

ob_start();
?>

	<h2 class="center">Profil</h2>
	<div class="divider"></div>
	<br/>
	
	<div class="row profil-info border">
		<div class="col s12 m4 l3"></div>
		<div class="col s12 m4 l6">
			<div class="card">
				<div class="card-image">
					<img class="responsive-img materialboxed" src="<?= URL_PATH.'/image.php?img='.urlencode($token_img).'&larg=2000'; ?>"  alt="profil-image">
					<span class="card-title"></span>
				</div>
				<div class="card-content">
					<h3 class="center"><?= $profil->name().' '.$profil->firstname(); ?></h3>
					<h4 class="center"><?= $profil->login(); ?></h4>
					<br/ >
					<p><?= $profil->description() ?></p>
					<p>Date d'inscription : <?= $profil->date_register(); ?></p>
				</div>
				<div class="card-action">
					<a href="mailto:<?= $profil->email(); ?>">Contacter cette personne</a>
				</div>
			</div>
		</div>
		<div class="col s12 m4 l3"></div>
	</div>

<?php
$content = ob_get_contents();
ob_end_clean();