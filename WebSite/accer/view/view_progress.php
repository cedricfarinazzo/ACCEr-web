<?php
ob_start();
$tasks = new ShadowMinerProgressManager($db);

if ($connected && $user->rank() == "admin" || $user->rank() == "webmaster" && !isset($_GET["id"])) {
	if (isset($_POST["submit-report"])) {
		if (isset($_POST["description"]) && isset($_POST["title"])) {
			if (!empty($_POST["description"]) && !empty($_POST["title"])) {
				$description = $_POST["description"];
				$title = $_POST["title"];
				if (strlen($description) <= 500) {
					if ($tasks->create($user->ID(), $title, $description)) {
						$success = "La tâche a bien été envoyé!";
					} else {
						$error = "Une erreur s'est produite. Veuillez réessayer dans un moment.";
					}
				} else {
					$error = "Votre description est trop long !";
				}	
			} else {
				$error = "Veuillez remplir tous les champs pour envoyer le rapport";
			}
		}
	}
}

$cache = new CacheManager("progress");
$in_cache = $cache->on_cache();
if (!$in_cache) {
	$req_all_tasks = $tasks->GetAllTask();
}
$request = ob_get_contents();
ob_end_clean();

ob_start();
?>
	<h2 class="center">Progression du projet</h2>
	<div class="divider"></div>
	<br/>
	
	
	<?php if ($user->rank() == "admin" || $user->rank() == "webmaster") { ?>
		<?php if (isset($success)) { ?>
			<div class="success card-panel green darken-2 center-align">
			<?= $success; ?>
			</div>
			<div class="divider"></div>
			<br/>
		<?php } ?>
		<?php if (isset($error)) { ?>
			<div class="error card-panel red darken-1 center-align">
			<?= $error; ?>
			</div>
			<div class="divider"></div>
			<br/>
		<?php } ?>
		<div class="center border">
			<h4 class="center">Ajouter une tâche</h4>
			<form class="col s12" action= "?p=progress" method="post">
				<div class="row">
					<div class="input-field col s6 offset-s3">
						<input id="title" name="title" type="text" class="validate"/>
						<label class="active" for="title">Titre : </label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<textarea id="description" name="description" class="active materialize-textarea" data-length="500"></textarea>
						<label for="description">Description de la tâche</label>
					</div>
				</div>
				<div class="row center-align">
					<button class="btn waves-effect waves-light center-align" type="submit" name="submit-report" value="Enregistrer les informations">
						Envoyer
						<i class="material-icons right">description</i>
					</button>
				</div>
			</form>
		</div>
		<br/>
		
		<div class="divider"></div>
		<br/>
	<?php } ?>
	<div class="report-list-container">
	<?php
		if (!$in_cache) { 
			ob_start(); ?>
			<?php 
				if ($req_all_tasks->rowCount() == 0) { ?>
					<div class="task item">
						<i class="material-icons">error</i>
						<span class="title col s12 center">Oups !</span>
						<p class="center">
							Pas de tâche actuelement ! 
						</p>
					</div>
			<?php } else { ?>
					<div class="task">
						<table class="bordered highlight responsive-table">
							<thead style="font-weight: bold;">
								<tr>
									<td>titre</td>
									<td>description</td>
									<td>etat (en %)</td>
								</tr>
							</thead>
							<tfoot style="font-weight: bold;">
								<tr>
									<td>titre</td>
									<td>description</td>
									<td>etat (en %)</td>
								</tr>
							</tfoot>
							<tbody>
								<?php while($t = $req_all_tasks->fetch()) { ?>
									<tr>
										<td><?= $t->titre(); ?></td>
										<td><?= $t->description(); ?></td>
										<td>
											<span class="center"><?= $t->etat(); ?> %</span> 
											<br/>
											<div class="progress">
												<div class="determinate" style="width: <?= $t->etat(); ?>%"></div>
											</div>
										</td>
									</tr>	
								<?php } ?>
							</tbody>
						</table>
					</div>
			<?php } ?>
		<?php 
			$t = ob_get_contents();
			ob_end_clean();
			$cache->createcache($t);
		} else {
			$t = $cache->readcache();
		}
		echo $t;
		?>
	</div>
	
<?php
$content = ob_get_contents();
ob_end_clean();