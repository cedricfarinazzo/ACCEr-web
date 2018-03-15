<?php
ob_start();
if ($connected)
{
	header("location: ?p=accueil");
	exit();
}

if (isset($_POST["connect"])) {
	if ((isset($_POST["pass"])) && (isset($_POST["mail"]))) {
		if ((!empty($_POST["pass"])) && (!empty($_POST["mail"]))) {
			if (filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
				$mail = $_POST["mail"];
				$pass = hash("sha512",$_POST["pass"]);
				if ($user->connect($mail,$pass))
				{
					if (isset($_POST["remember"])) {
						$user->remember();
					}
					$_SESSION["message"] = 1;
					header("Location: ?p=accueil");
					exit();
				} else {
					$error = "Les imformations fournis sont invalides.";
				}
			} else {
				$error = "Email invalide !";
			}
		} else {
			$error = "Veuillez remplir les champs";
		}
	}
}

$request = ob_get_contents();
ob_clean();

ob_start();
?>

	<h2 class="center">Se connecter</h2>
	<div class="divider"></div>
	<div class="car-panel green lighten-1 center-align"  style="border-radius: 14px; padding: 10px;">Veuillez entrer vos informations personnelles.</div>

	<div class="row">
		<form class="col s12" action= "?p=connect" method="post">
			<div class="row">
				<div class="input-field col s12">
					<input id="email" type="email" name="mail" class="validate"/>
					<label class="active" for="email">Email</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="mdp" name="pass" type="password" class="validate"/>
					<label class="active" for="mdp">Mot de passe</label>
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
			<br/>
			<div class="row center-align">
				<button class="btn waves-effect waves-light" type="submit" name="connect" value="Valider les informations" >
					Valider les informations
					<i class="material-icons right">send</i>
				</button>
			</div>
		</form>
	</div>
	<?php sleep(1);
	if (isset($error)) { ?>
	<div class="error card-panel red darken-1 center-align">
	<?= $error; ?>
	</div>
	<?php } ?>

<?php
$content = ob_get_contents();
ob_clean();