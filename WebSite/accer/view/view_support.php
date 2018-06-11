<?php
ob_start();

$send = false;
$failed = false;
if (isset($_POST["support_submit"])) {
	if ((isset($_POST["support_objet"])) && (isset($_POST["support_mail"])) && (isset($_POST["support_message"]))) {
		if ((!empty($_POST["support_objet"])) && (!empty($_POST["support_mail"])) && (!empty($_POST["support_message"]))) {
			$req_sup = $db->prepare('INSERT INTO support(Objet, Mail, Message, Date) VALUES(?, ?, ?, NOW())');
			$send = $req_sup->execute(array($_POST["support_objet"], $_POST["support_mail"], $_POST["support_message"]));
			$failed = !$send;
		} else {
			$failed = true;
		}
	} else {
		$failed = true;
	}
}

$request = ob_get_contents();
ob_end_clean();

ob_start();
?>

	<h2 class="center">Support</h2>
	<br/><br/>
	<div class="divider"></div>
	<br/><br/>
	<div class="
		<?php if ($failed) { ?>
			error card-panel red darken-1 center-align
		<?php } else { ?>
			card-panel green lighten-1 center-align
		<?php } ?>
		" style="border-radius: 14px; padding: 10px;">
		<?php if ($send) { ?>
			Message envoyé
		<?php } elseif ($failed) { ?>
			Erreur pendant l'envoie de votre message!
		<?php } else { ?>
			Cette page vous permet de nous contacter afin de nous rapporter les bugs que vous trouverez ou pour obtenir des renseignements.
		<?php } ?>
	</div>
	<br/><br/>
	<div class="divider"></div>
	<br/><br/>
	
	<div class="container center form">
		<form class="col s12" action= "?p=support" method="post">
			<div class="container">
				<div class="input-field col s6">
					<input id="support_objet" name="support_objet" type="text" class="validate" required="" aria-required="true"/>
					<label class="support_objet" for="support_objet">Objet</label>
				</div>
				<div class="input-field col s6">
					<input id="support_mail" type="email" name="support_mail" class="validate" required="" aria-required="true"/>
					<label class="active" for="support_mail">Email</label>
				</div>
			</div>
			
			<div class="input-field col s12">
				<textarea id="support_message" name="support_message" class="active materialize-textarea" required="" aria-required="true"></textarea>
				<label for="support_message">Votre message</label>
			</div>
			<div class="row center-align">
				<button class="btn waves-effect waves-light center-align" type="submit" name="support_submit" value="Enregistrer les informations" >
					Envoyer
					<i class="material-icons right">publish</i>
				</button>
			</div>
		</form>
	</div>
	

<?php
$content = ob_get_contents();
ob_end_clean();