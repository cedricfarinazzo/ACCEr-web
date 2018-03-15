<?php
ob_start();

$chat = new ChatManager($db);

if (isset($_POST["submit-chat"]) && $connected) {
  if (isset($_POST["message-chat"])) {
	if (!empty($_POST["message-chat"])) {
		$message = $_POST["message-chat"];
		if (strlen($message) <= 100) {
			if ($chat->post_message($user->ID(), $message)) {
				
			} else {
				$error = "Une erreur s'est produite. Veuillez réessayer dans un moment.";
			}
		} else {
			$error = "Votre message trop long !";
		}	
	} else {
		$error = "Pour envoyer un message, remplissez le champ !";
	}
  }
}

$request = ob_get_contents();
ob_clean();

ob_start();
?>

	<h2 class="center">Disccussion en direct</h2>
	<div class="divider"></div>
	<div class="car-panel light-blue center-align" style="border-radius: 14px; padding: 10px;">Vous pouvez discuter avec les membres du site.<br/>Veuillez ne pas diffuser d'informations personnelles.</div>

	<?php if (!$connected) { ?>
		<div class="card-panel red lighten-1 center-align" style="border-radius: 14px; padding: 10px;">
			<i class="material-icons center">report</i>
			<p style="font-size: 1.5em">Pour participer à la discussion instantannée, vous devez être connecté</p>
			<br/>
			<div class="row center">
				<a class="waves-effect waves-light btn col s2 offset-s3" href="?p=connect">Se connecter</a>
				<a class="waves-effect waves-light btn col s2 offset-s2" href="?p=register">S'inscrire</a>
			</div>
			
		</div>
	<?php } ?>
	
	<br/>
	<div class="row">
		<div class="send-message">
			<form class="col s12" id="form-chat" action="?p=chat" method="post">
				<div class="row">
					<div class="input-field col s12">
						<input id="input_message_chat" name="message-chat" type="text" data-length="100"/>
						<label for="input_message_chat">Votre message :</label>
					</div>
				</div>
				<div class="row center-align">
					<button class="btn waves-effect waves-light" id="submit-chat-button"  type="submit" name="submit-chat" value="Enregistrer les informations" <?php if (!$connected) echo 'disabled'; ?>>
						Envoyer le message
						<i class="material-icons right">send</i>
					</button>
				</div>
			</form>
		</div>
	</div>
	<div class="row" id="error-panel" hidden>
		<div class="error card-panel red darken-1 center-align" id="error-panel-container">
			<?php
			if (isset($error)) { ?>
				<?= $error; ?>
			<?php } ?>
		</div>
	</div>	
	<br/>
	<div class="row">
		<div class="col s12 light-blue center-align" style="border-radius: 14px; padding: 10px;">
			<p style="font-size: 1.1em">Si le chat ne s'actualise pas automatiquement cliquez sur bouton ci-dessous</p>
			<p><a class="waves-effect waves-light btn" href="?p=chat"><i class="material-icons right">refresh</i>Actualiser</a></p>
		</div>
	</div>
	<br/>
	<div class="message-list">
		<div class="col s12 border" style="padding: 25px">
				<?= $chat->display_chat(); ?>
		</div>
	</div>	
	<script>
		//display message
		var lastid = <?= $chat->lastid(); ?>;
		function load_message() {
			setTimeout(function() {
				$.post(
					'<?= URL_PATH ?>/assets/ajax/chat/getMessage.php',
					{
						lastid : lastid
					},
					AddMessage,
					'json'
					);
				load_message();
			}, 2000);
		}
		function AddMessage(json) {
			data = (json);
			lastid = data[0];
			html = data[1];
			$('#message-container').prepend(decodeURIComponent(escape(window.atob(html))));
		}
		load_message();
		
		<?php if($connected) { ?>
		//send message
		$("#submit-chat-button").click(function( event ) {
			event.preventDefault();
			$.post(
					'<?= URL_PATH ?>/assets/ajax/chat/postMessage.php',
					{
						data : $("#form-chat").serialize()
					},
					successPost,
					'json'
					);
		});
		
		function successPost(json) {
			if (json[0] == true) {
				$("#input_message_chat").val('');
				$("#error-panel").slideUp();
			} else {
				console.log(json[1]);
				$("#error-panel").show();
				$("#error-panel-container").html(json[1]);
			}
		}
		<?php } ?>		
	</script>
<?php
$content = ob_get_contents();
ob_clean();