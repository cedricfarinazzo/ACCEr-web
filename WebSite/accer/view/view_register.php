<?php
ob_start();
if ($connected)
{
	header("location: ?p=accueil");
	exit();
}

if (isset($_POST["register"])) {
  if ((isset($_POST["name"])) && (isset($_POST["mail"])) && (isset($_POST["pass"])) && (isset($_POST["login"])) && (isset($_POST["passcomfirm"])) && (isset($_POST["firstname"]))) {
	if ((!empty($_POST["name"])) && (!empty($_POST["mail"])) && (!empty($_POST["pass"])) && (!empty($_POST["login"])) && (!empty($_POST["passcomfirm"])) && (!empty($_POST["firstname"]))) {
		if (filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
			$mail = $_POST["mail"];
			$login = $_POST["login"];
			$name = $_POST["name"];
			$firstname = $_POST["firstname"];
			$name = $_POST["name"];
			$pass = hash("sha512",$_POST["pass"]);
			$passcomfirm = hash("sha512",$_POST["passcomfirm"]);
			if ($pass == $passcomfirm) {
				if ($user->register($name, $firstname, $pass, $mail, $login)) {
					if (isset($_POST["remember"])) {
						$user->remember();
					}
					$_SESSION["message"] = 0;
					header("Location: ?p=accueil");
					exit();
				} else {
					$error = "Email déja utilisé";
				}
			} else {
				$error = "Les mots de passe ne correspondent pas.";
			}
		} else {
			$error = "Email invalide !";
		}
	} else {
		$error = "Veuillez tous remplir les champs";
	}
  }
}


$request = ob_get_contents();
ob_clean();

ob_start();
?>

	<h2 class="center">Créer un compte</h2>
	<div class="divider"></div>
	<div class="car-panel green lighten-1 center-align" style="border-radius: 14px; padding: 10px;">Veuillez entrer vos informations personnelles.</div>

	<div class="row">
		<form class="col s12" action= "?p=register" method="post">
			<div class="row">
				<div class="input-field col s6">
					<input id="email" type="email" name="mail" class="validate"/>
					<label class="active" for="email">Email</label>
				</div>
				<div class="input-field col s6">
					<input id="login" name="login" type="text" value="<?= $user->login('nochange') ?>" class="validate"/>
					<label class="login" for="login">Pseudo</label>
				</div>
			</div>
			
			<div class="row">
				<div class="input-field col s12">
					<input id="mdp" name="pass" type="password" class="validate"/>
					<label class="active" for="mdp">Mot de passe</label>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<input id="passcomfirm" name="passcomfirm" type="password" class="validate"/>
					<label class="active" for="passconfirm">Confirmez votre mot de passe</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input id="Prenom" name="firstname" type="text" class="validate"/>
					<label class="active" for="Prenom">Prénom</label>
				</div>
				<div class="input-field col s6">
					<input id="Nom" name="name" type="text" class="validate"/>
					<label class="active" for="Nom">Nom</label>
				</div>
			</div>
			<div class="switch row center-align">
				Rester connecté :   
				<label>
					Off
				<input type="checkbox" name="remember" class="validate">
				<span class="lever"></span>
					On
				</label>
			</div>
			<div class="row center-align">
				<button class="btn waves-effect waves-light" type="submit" name="register" value="Enregistrer les informations" >
					Enregistrer les informations
					<i class="material-icons right">send</i>
				</button>
			</div>
		</form>
	</div>
	<?php if (isset($error)) { ?>
		<div class="error card-panel red darken-1 center-align">
		<?= $error; ?>
		</div>
	<?php } ?>
<?php
$content = ob_get_contents();
ob_clean();