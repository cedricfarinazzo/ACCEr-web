<?php
ob_start();

$progress = new ProgressManager($db);

if ($progress->GetById((int)$_GET['id']) == false) {
	header("Location: ?p=accueil");
	exit();
}

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
				<div class="card-content">
					<h3 class="center"><?= $progress->login(); ?></h4>
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