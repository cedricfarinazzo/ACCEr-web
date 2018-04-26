<?php
ob_start();
if (!$connected)
{
	header("location: ?p=accueil");
	exit();
}

if (isset($_POST["account-perso"])) {
  if ((isset($_POST["name"])) && (isset($_POST["mail"])) && (isset($_POST["firstname"])) && (isset($_POST["login"]))) {
	if ((!empty($_POST["name"])) && (!empty($_POST["mail"])) && (!empty($_POST["firstname"])) && (!empty($_POST["login"]))) {
		if (filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
			$name = $_POST["name"];
			$firstname = $_POST["firstname"];
			$email = $_POST["mail"];
			$login = $_POST["login"];
			if ($user->update($name, $firstname, NULL, $email, $login, $user->description('nochange'), $user->avatar_path())) {
				$user->refresh();
				$success = "Les modifications ont bien été pris en compte.";
			} else {
				$error = "Email déjà utilisé.";
			}
		} else {
			$error = "email invalide";
		}
	}
  }
}

if (isset($_POST["account-pass"])) {
  if ((isset($_POST["oldpass"])) && (isset($_POST["pass"])) && (isset($_POST["passcomfirm"]))) {
	if ((!empty($_POST["oldpass"])) && (!empty($_POST["pass"])) && (!empty($_POST["passcomfirm"]))) {
		$oldpass = hash("sha512",$_POST["oldpass"]);
		$newpass = hash("sha512",$_POST["pass"]);
		$passcomfirm = hash("sha512",$_POST["passcomfirm"]);
		if ($oldpass == $user->pass()) {
			if ($newpass == $passcomfirm) {
				if ($user->update($user->name('nochange'), $user->firstname('nochange'), $newpass, $user->email('nochange'), $user->description('nochange'), $user->avatar_path())) {
					$user->refresh();
					$success = "Les modifications ont bien été pris en compte.";
				} else {
					$error = "Une erreur s'est produite. Veuillez réessayer dans un moment.";
				}
			} else {
				$error = "Les nouveaux mots de passe ne correspond pas.";
			}
		} else {
			$error = "Ancien mot de passe invalide.";
		}
	} else {
		$error = "Veuillez tous remplir les champs pour changer votre mot de passe.";
	}
  }
}

if (isset($_POST["account-description"])) {
  if (isset($_POST["description"])) {
	if (!empty($_POST["description"])) {
		$description = $_POST["description"];
		if (strlen($description) <= 500) {
			if ($user->update($user->name('nochange'), $user->firstname('nochange'), NULL, $user->email('nochange'), $description, $user->avatar_path())) {
				$user->refresh();
				$success = "Les modifications ont bien été pris en compte.";
			} else {
				$error = "Une erreur s'est produite. Veuillez réessayer dans un moment.";
			}
		} else {
			$error = "Votre description trop long !";
		}	
	}
  }
}

if (isset($_POST["account-avatar"])) {
	if (isset($_FILES["profil-file"])) {
		if (!empty($_FILES["profil-file"]['name'])) {
			if ($_FILES['profil-file']['error'] == 0) {
				$upload_img = new ImageManager($db);
				$id_img = $upload_img->register($_FILES["profil-file"]['tmp_name'], $_FILES["profil-file"]['name']);
				if (((int) $id_img) > 0) {
					if ($user->update($user->name('nochange'), $user->firstname('nochange'), NULL, $user->email('nochange'), $user->description('nochange'), $id_img)) {
						$user->refresh();
						$success = "Les modifications ont bien été pris en compte.";
					} else {
						$error = "Une erreur s'est produite. Veuillez réessayer dans un moment.";
					}
				} else {
					$error = "Image invalide !";
				}
			} else {
					$error = "Une erreur est survenue lors du chargement de l'image ! Veuillez réessayer.";
			}
		}
	}
}

if (isset($_POST["account-delete"])) {
  if (isset($_POST["passdel"])) {
	if (!empty($_POST["passdel"])) {
		$pass = hash("sha512", $_POST["passdel"]);
		if ($pass == $user->pass()) {
			if ($user->delete_user($pass)) {
				header("Location: ?p=accueil&messa=5");
				exit();
			} else {
				$error = "Une erreur s'est produite. Veuillez réessayer dans un moment.";
			}
		} else {
			$errror = "Mot de passe invalide ! ";
		}
	} else {
		$error = "Veuillez remplir le champ pour supprimer le compte.";
	}
  }
}

$profil_img = new ImageManager($db);
$token_img = $profil_img->GetTokenByID($user->avatar_path());
$request = ob_get_contents();
ob_end_clean();

ob_start();
?>
	<h2 class="center">Mon compte</h2>
	<div class="divider"></div>
	<br/>
	<div class="view-profil container center" >
		<a href="<?= URL_PATH.'/?p=user&id='.urldecode($user->ID()); ?>" class="waves-effect waves-light btn-large"><i class="material-icons right">public</i>Voir mon profil </a>
	</div>
	<br/>
	<div class="car-panel green lighten-1 center-align"  style="border-radius: 14px; padding: 10px;">Vous pouvez modifier vos informations personnelles.</div>
	<br/>
	<div class="divider"></div>
	<br/>	
	<?php
	if (isset($error)) { ?>
	<div class="error card-panel red darken-1 center-align">
	<?= $error; ?>
	</div>
	<?php } ?>
	<?php
	if (isset($success)) { ?>
	<div class="success card-panel green darken-2 center-align">
	<?= $success; ?>
	</div>
	<?php } ?>
	<br/>
	<div class="row">
		<form class="col s12" enctype="multipart/form-data" action= "?p=account" method="post">
			<div class="change-info-perso border">
				<div class="row">
					<div class="input-field col s6">
						<input id="Prenom" name="firstname" type="text" value="<?= $user->firstname('nochange') ?>" class="validate"/>
						<label class="active" for="Prenom">Prénom</label>
					</div>
					<div class="input-field col s6">
						<input id="Nom" name="name" type="text" value="<?= $user->name('nochange') ?>" class="validate"/>
						<label class="active" for="Nom">Nom</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6">
						<input id="email" type="email" name="mail" value="<?= $user->email('nochange') ?>" class="validate"/>
						<label class="active" for="email">Email</label>
					</div>
					<div class="input-field col s6">
						<input id="login" name="login" type="text" value="<?= $user->login('nochange') ?>" class="validate"/>
						<label class="login" for="login">Pseudo</label>
					</div>
				</div>
				<div class="row center-align">
					<button class="btn waves-effect waves-light center-align" type="submit" name="account-perso" value="Enregistrer les informations" >
						Enregistrer les modifications
						<i class="material-icons right">account_box</i>
					</button>
				</div>
			</div>
			
			<br/>
			<div class="change-pass border">
				<p class="center-align">Si vous voulez changer votre mot de passe, remplissez les 3 champs suivants.</p>
				<div class="row">
					<div class="input-field col s12">
						<input id="oldmdp" name="oldpass" type="password" class="validate"/>
						<label class="active" for="oldmdp">Ancien mot de passe</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="mdp" name="pass" type="password" class="validate"/>
						<label class="active" for="mdp">Nouveau mot de passe</label>
					</div>
				</div>
				<div class="row">
					<div class="col s12">
						<input id="passcomfirm" name="passcomfirm" type="password" class="validate"/>
						<label class="active" for="passconfirm">Confirmez votre mot de passe</label>
					</div>
				</div>
				<div class="row center-align">
					<button class="btn waves-effect waves-light center-align" type="submit" name="account-pass" value="Enregistrer les informations" >
						Changer le mot de passe
						<i class="material-icons right">send</i>
					</button>
				</div>
			</div>
			
			<br/>
			<div class="change-description border">
				<div class="row">
					<div class="input-field col s12">
						<textarea id="description" name="description" class="active materialize-textarea" data-length="500"></textarea>
						<label for="description">Vous pouvez modifier votre description ici.</label>
					</div>
				</div>
				<div class="row center-align">
					<button class="btn waves-effect waves-light center-align" type="submit" name="account-description" value="Enregistrer les informations" >
						Enregistrer la description
						<i class="material-icons right">description</i>
					</button>
				</div>
			</div>
			
			<br/>
			<div class="change-avatar border">
				<p class="center-align">Changer votre image de profil</p>
				<img class="responsive-img materialboxed" src="<?= URL_PATH.'/image.php?img='.urlencode($token_img).'&larg=200'; ?>" alt="profil image" />
				<div class="file-field input-field">
					<div class="btn">
						<span><i class="material-icons left">file_upload</i>File</span>
						<input type="file" name="profil-file" class="validate">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text" placeholder="Uploader une image">
					</div>
				</div>
				<div class="row center-align">
					<button class="btn waves-effect waves-light center-align" type="submit" name="account-avatar" value="Enregistrer les informations" >
						Changer l'image de profil
						<i class="material-icons right">add_a_photo</i>
					</button>
				</div>
			</div>
			
			<br/>
			<div class="delete-account border">
				<p class="center-align">Supprimer votre compte</p>
				<div class="row">
					<div class="input-field col s12">
						<input id="mdpdel" name="passdel" type="password" class="validate"/>
						<label class="active" for="mdpdel">mot de passe</label>
					</div>
				</div>
				<div class="row center-align">
					<button class="btn waves-effect waves-light center-align red darken-1" type="submit" onclick="return confirm('Confirmer l\'action.\nATTENTION\nSi vous comfirmer, vos données seront perdus sans possibilitée de récupération.Ainsi vous serez déconnecté et redirigé vers l\'accueil du site.');" name="account-delete" value="Enregistrer les informations" >
						Valider
						<i class="material-icons right">delete</i>
					</button>
				</div>
			</div>
			
			<br/>
			<div class="account-info border" style="padding: 15px">
				<p class="center-align">Autre informations sur votre compte.</p>
				<div class="row" style="padding: 15px">
					Date d'inscription : <?= $user->date_register(); ?>
				</div>
			</div>
		</form>
	</div>
	<script>
		(function($){
			<?php
				echo 'var data = '.json_encode(($user->description('input'))).';'.PHP_EOL;
			?>
			$('#description').val(data);
			$('#description').trigger('autoresize');
		})(jQuery);
		$(document).ready(function(){
			$('.materialboxed').materialbox();
		});
	</script>	
<?php
$content = ob_get_contents();
ob_end_clean();