<?php
ob_start();

$progress = new ProgressManager($db);
$profil = new UserManager($db);
if ($progress->GetById((int)$_GET['id']) == false || $profil->getbyid($_GET['id']) == false) {
	header("Location: ?p=accueil");
	exit();
}

$profil_img = new ImageManager($db);
$token_img = $profil_img->GetTokenByID($profil->avatar_path());

$request = ob_get_contents();
ob_end_clean();

ob_start();
?>

	<h2 class="center">Progression du joueur</h2>
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
					<h3 class="center"><a href="<?= URL_PATH.'/?p=user&id='.urldecode($progress->ID_user()); ?>"><?= $progress->login(); ?></a></h4>
					<br/ >
					<p> Avancement des niveaux solo : <?= $progress->solostats() ?></p>
					<p> Partie multijoueurs gagnées : <?= $progress->multistats() ?></p>
					<p>Dernière mise à jour : <?= $progress->lastupdate(); ?></p>
				</div>
			</div>
		</div>
		<div class="col s12 m4 l3"></div>
	</div>

<?php
$content = ob_get_contents();
ob_end_clean();