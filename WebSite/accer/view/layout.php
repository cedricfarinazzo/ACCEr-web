<?php 
$accer_logoManager = new ImageManager($db);
$accer_logo = $accer_logoManager->GetTokenByID(1);
?>
<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title><?= ORGANIZATION_NAME ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
		<link rel="stylesheet" type="text/css"  href="assets/css/style.css" media="screen,projection"/>
		<link rel="shortcut icon" type="image/x-icon" href="/assets/favicon/favicon.ico" />
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114348221-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'UA-114348221-1');
		</script>
		<!--script type="text/javascript" src="/assets/js/turbolinks.js"></script-->
	</head>
	<body>
		<div id="body">
			<!--[if lt IE 10]>
				<div class="disclaimer-error">
					Vous utilisez un navigateur obsolète, veuillez le <a href="https://browser-update.org/update.html">mettre à jour</a>.
				</div>
			<![endif]-->
			<noscript>
				<div class="disclaimer  disclaimer--error">
					Veuillez utiliser un <a href="https://browser-update.org/update.html">navigateur internet moderne</a> avec JavaScript activé pour naviguer sur notre site web !
				</div>
			</noscript>
			<header>
				<!--h1 class="header center"><?= PROJECT_NAME ?></h1-->
				<div class="navbar-div">
					<nav class="red accent-4">
						<div class="container nav-wrapper">
							<a href="?p=accueil" class="brand-logo"><img class="responsive-img" src="<?= URL_PATH.'/image.php?img='.urlencode($accer_logo).'&larg=90'; ?>"  alt="accer-logo"></a>
							<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
							<?php if ($connected) { ?>
								<ul id="account-dropdown" class="dropdown-content">
									<li><a href="?p=account">Paramètre du compte</a></li>
									<li class="divider"></li>
									<li><a href="<?= URL_PATH.'/?p=user&id='.urldecode($user->ID()); ?>">Voir mon profil </a></li>
									<li><a href="<?= URL_PATH.'/?p=progressgame&id='.urldecode($user->ID()); ?>">Ma progression </a></li>
									<li class="divider"></li>
									<li><a href="?p=logout">Déconnexion</a></li>
								</ul>
							<?php } ?>
							
							<ul id="project-dropdown" class="dropdown-content">
								<li><a href="?p=project">Le projet</a></li>
								<li class="divider"></li>
								<li><a href="?p=source">Les sources</a></li>
								<li class="divider"></li>
								<li><a href="?p=report">Rapport</a></li>
								<li class="divider"></li>
								<li><a href="?p=progress">Progression</a></li>
								<li class="divider"></li>
								<li><a href="?p=leaderboard">Classement des joueurs</a></li>
								<li class="divider"></li>
								<li><a href="?p=download">Télécharger !</a></li>
							</ul>
							
							<ul class="right hide-on-med-and-down">
								<li>
									<a class="dropdown-button" href="#!" data-activates="project-dropdown">
										Shadow Miner
										<i class="material-icons right">arrow_drop_down</i>
									</a>
								</li>
								<li><a href="?p=chat">Discussion en direct</a></li>
								<!--li><a href="?p=forum">Forum</a></li-->
								<?php if ($connected) { ?>
									<li>
										<a class="dropdown-button" href="#!" data-activates="account-dropdown">
											<i class="material-icons left">account_box</i>Mon compte<i class="material-icons right">arrow_drop_down</i>
										</a>
									</li>
								<?php } else { ?>
									<li><a href="?p=connect">Se connecter</a></li>
									<li><a href="?p=register">S'inscrire</a></li>
								<?php } ?>
								<?php if ($user->rank() == "admin" || $user->rank() == "webmaster") { ?> 
									<li><a href="?p=admin">Administration</a></li>
								<?php } ?>
							</ul>
							
							<ul class="side-nav" id="mobile-demo">
								<li><a href="?p=project">Le projet</a></li>		
								<li><a href="?p=source">Les sources</a></li>
								<li><a href="?p=report">Rapport</a></li>
								<li><a href="?p=progress">Progression</a></li>
								<li><a href="?p=leaderboard">Classement des joueurs</a></li>
								<li><a href="?p=download">Télécharger !</a></li>
								<li class="divider"></li>
								<li><a href="?p=chat">Discussion en direct</a></li>
								<li class="divider"></li>
								<!--li><a href="?p=forum">Forum</a></li-->
								<!--li class="divider"></li-->
								<?php if ($connected) { ?>
									<li><a href="?p=account">Paramètre du compte</a></li>
									<li><a href="<?= URL_PATH.'/?p=user&id='.urldecode($user->ID()); ?>">Voir mon profil </a></li>
									<li><a href="<?= URL_PATH.'/?p=progressgame&id='.urldecode($user->ID()); ?>">Ma progression </a></li>
									<li><a href="?p=logout">Déconnexion</a></li>
								<?php } else { ?>
									<li><a href="?p=connect">Se connecter</a></li>
									<li><a href="?p=register">S'inscrire</a></li>
								<?php } ?>
								<?php if ($user->rank() == "admin" || $user->rank() == "webmaster") { ?> 
									<li><a href="?p=admin">Administration</a></li>
								<?php } ?>
							</ul>
						</div>
					</nav>
				<div>
			</header>
			<br/>
			<section>
				<div class="container">
					<?php if (isset($content)) {echo $content;} ?>
				</div>
			</section>
			<br/>
			<footer class="page-footer blue darken-4 text-white">
				<div class="container">
					<div class="row">
						<div class="col l6 s12">
							<h5 class="white-text"><?= ORGANIZATION_NAME ?></h5>
							<p class="grey-text text-lighten-4">
								<?= ORGANIZATION_NAME ?> est un groupe d'étudiants en première année d'EPITA Strasbourg.
							</p>
						</div>
					  <div class="col l4 offset-l2 s12">
						<h5 class="white-text">Liens utiles</h5>
						<ul>
							<li><a class="grey-text text-lighten-3" href="https://github.com/cedricfarinazzo/ACCEr-exe">Notre GitHub</a></li>
						</ul>
					  </div>
					</div>
				</div>
				<div class="footer-copyright">
					<div class="container">
						© 2017 Copyright <?= ORGANIZATION_NAME ?>
						<a class="grey-text text-lighten-4 right" href="?p=terms">Conditions générales</a>
					</div>
				</div>
			</footer>
			<?php
			if(isset($_COOKIE['accept_cookie'])) {
				$showcookie = false;
			} else {
				$showcookie = true;
			}
			if($showcookie) { ?>
				<div id="cookie">
					<div class="cookie-alert">
						En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de cookies pour vous proposer des contenus et services adaptés à vos centres d’intérêts.
						<br/>
						<a onclick="accept_cookie($)" >OK</a>
					</div>
				</div>
			<?php } ?>
		</div>	
		<script>
			
			$(document).ready(function() {
				
				(function($){
					$(".dropdown-button").dropdown();
					Materialize.updateTextFields();
					$('select').material_select();
					$('.materialboxed').materialbox();
					$(".button-collapse").sideNav();
				})(jQuery);
			});
			function accept_cookie ($){
				$('#cookie').load('<?= URL_PATH ?>/assets/ajax/accept_cookie.php');
			}
		</script>
		<?php if ((int)date("m") >= 11 || (int)date("m") <= 3) { ?>
			<script type="text/javascript" src="<?= URL_PATH ?>/assets/js/snow.js"></script>
			<script>
				window.onload = function(){
					snow.init(40);
				};
			</script>
		<?php } ?>
	</body>
</html>