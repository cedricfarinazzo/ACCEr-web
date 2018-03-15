<?php
ob_start();
$report = new ShadowMinerReportManager($db);
$pdf = new PdfManager($db);

if ($connected && $user->rank() == "admin" || $user->rank() == "webmaster" && !isset($_GET["id"])) {
	if (isset($_POST["submit-report"])) {
		if (isset($_POST["description"]) && isset($_POST["title"]) && isset($_FILES["pdf-file"])) {
			if (!empty($_POST["description"]) && !empty($_POST["title"]) && $_FILES['pdf-file']['error'] == 0) {
				$description = $_POST["description"];
				$title = $_POST["title"];
				if (strlen($description) <= 500) {
					$id_pdf = $pdf->register($_FILES["pdf-file"]["tmp_name"], $_FILES["pdf-file"]["name"]);
					if ((int)$id_pdf > 0) {
						if ($report->create($user->ID(), $title, $description, $id_pdf)) {
							$success = "Le rapport a bien été envoyé!";
						} else {
							$error = "Une erreur s'est produite. Veuillez réessayer dans un moment.";
						}
					} else {
						$error = "Rapport invalide !";
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

if (isset($_GET["id"]) && !empty($_GET["id"])) {
	$id_report = (int) $_GET["id"];
	$pdf = new PdfManager($db);
	$cacheid = new CacheManager("report", $id_report);
	$in_cacheid = $cacheid->on_cache();
	if (!$in_cacheid) {
		if($report->getbyid($id_report)) {
			$pdf_token = $pdf->GetTokenByID($report->pdf_content());
			$author = new UserManager($db);
			$author->getbyid((int)$report->ID_user());
		} else {
			header("Location: ?p=report");
			exit();
		}
	}

} else {
	$caches = new CacheManager("report");
	$in_caches = $caches->on_cache();
	if (!$in_caches) {
		$req_all_report = $report->GetAllReport();
	}
}
$request = ob_get_contents();
ob_end_clean();

ob_start();
?>
	<h2 class="center">Rapport de projet</h2>
	<div class="divider"></div>
	<br/>
	
	<?php if (!isset($id_report)) { ?>
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
				<h4 class="center">Ajouter un rapport de projet</h4>
				<form class="col s12" enctype="multipart/form-data" action= "?p=report" method="post">
					<div class="row">
						<div class="input-field col s6 offset-s3">
							<input id="title" name="title" type="text" class="validate"/>
							<label class="active" for="title">Titre : </label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<textarea id="description" name="description" class="active materialize-textarea" data-length="500"></textarea>
							<label for="description">Description du rapport</label>
						</div>
					</div>
					<div class="file-field input-field">
						<div class="btn">
							<span><i class="material-icons left">file_upload</i>File</span>
							<input type="file" name="pdf-file" class="validate">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" placeholder="Uploader le rapport au format pdf">
						</div>
					</div>
					<div class="row center-align">
						<button class="btn waves-effect waves-light center-align" type="submit" name="submit-report" value="Enregistrer les informations">
							Envoyer le rapport
							<i class="material-icons right">description</i>
						</button>
					</div>
				</form>
			</div>
			<br/>
			
			<div class="divider"></div>
			<br/>
		<?php } ?>
		<?php
		if (!$in_caches) { 
			ob_start(); ?>
			<div class="report-list-container">
				<?php while($r = $req_all_report->fetch()) { ?>
					<div class="report">
						<p>
							<a href="<?= URL_PATH ?>?p=report&id=<?= $r->ID() ?>">
								<h4 class="center"><?= $r->titre(); ?></h4>
							</a>
						</p>
					</div>
					<br/>
					<div class="divider"></div>
				<?php } ?>
			</div>
		<?php 
			$r = ob_get_contents();
			ob_end_clean();
			$caches->createcache($r);
		} else {
			$r = $caches->readcache();
		}
		echo $r;
		?>
	<?php } else { ?>
		<?php
		if (!$in_cacheid) {
			ob_start();
			?>
				<h3 class="center"><?= $report->titre(); ?></h3>
				<div class="container center">
					<p>Posté par <a href="<?= URL_PATH.'/?p=user&id='.urldecode($author->ID()); ?>"><?= $author->firstname()." ".$author->name(); ?></a></p>
					<p>Le <?= $report->date_created(); ?></p>
				</div>
				<br/>
				<div class="row description border">
					<div class="col s6 offset-s3">
						<?= $report->description(); ?>
					</div>
				</div>
				<br/>
				<div class="container center-align pdf-download">
					<a class="waves-effect waves-light btn-large" href="<?= URL_PATH; ?>/pdf.php?pdf=<?= urlencode($pdf_token); ?>&d=1">
						Télécharger le pdf
					</a>
				</div>
				<br/>
				<div class="container center-align pdf-content">
					<object data="<?= URL_PATH; ?>/pdf.php?pdf=<?= urlencode($pdf_token); ?>" type="application/pdf" width="600" height="800"></object>
				</div>
				<br/>
			<?php
			$rid = ob_get_contents();
			ob_end_clean();
			$cacheid->createcache($rid);
		} else {
			$rid = $cacheid->readcache();
		}
		echo $rid;
	} ?>
<?php
$content = ob_get_contents();
ob_end_clean();