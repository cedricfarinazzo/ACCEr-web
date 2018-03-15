<?php
define("WEB_PATH", dirname(realpath('index.php'),2));
require WEB_PATH.'/function/maintenance.php';
if (!is_maintenance()) {header('Location: index.php'); exit();}
$data = getMaintenanceData();
$time = $data[0];
$tokenmaj = $data[1];
$pass = $data[2];
$tps_restant = $time - time();
$i_restantes = $tps_restant / 60; 
$H_restantes = $i_restantes / 60; 
$d_restants = $H_restantes / 24; 
$s_restantes = floor($tps_restant % 60);
$i_restantes = floor($i_restantes % 60);
$H_restantes = floor($H_restantes % 24);
$d_restants = floor($d_restants);
if (isset($_COOKIE['_admin_maj']) && $tokenmaj == $_COOKIE['_admin_maj']) {$adminmaj = true;}
?>
<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>ACCEr</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
		<link rel="stylesheet" type="text/css"  href="assets/css/style.css" media="screen,projection"/>
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	</head>
	<body>
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
		<div class="body">
			<header class="red accent-4">
				<h1 class="center">Maintenance du site ACCEr</h1>
			</header>
			<section>
				<div class="container center">
					<img src="/assets/image/mtn/maintenance-1.jpg" alt="maintenance-1" width="200" height="200"/>
					<p class="center">
						Le site du groupe <em>ACCEr</em> est actuellement en maintenance !
						<br/> Toutes l'équipe vous remercie pour votre patience.
						<br/><br/><br/>La maintenance se déterminera normalement dans : 
						<br/>
						<span class="center red-text text-darken-1" id="tps-maj">
						<?= $d_restants.' jours et  '.$H_restantes.'h '.$i_restantes.'min '.$s_restantes.'sec';?>
						</span>
						<br/>
						<span id="redirect"></span>
					</p>
					<img src="/assets/image/mtn/animation.gif" alt="animation-1" width="120" height="120"/>
					<br/><br/>
					<?php if (isset($adminmaj)) { ?>
						<div id="admin-maj">
							Vous avez déclenché la maintenance !<br/>
							Vous seul pouvez vous connecter au site.<br/><br/>
							Vous pouvez également désactiver la maintenance dans le panel d'administration.
						</div><br/>
					<?php } ?>
				</div>
			</section>
			<footer class="page-footer blue darken-4 text-white">
				<div class="container">
					<div class="row">
						<div class="col l6 s12">
							<h5 class="white-text">ACCEr</h5>
							<p class="grey-text text-lighten-4">
								ACCEr est un groupe d'étudiant en première année d'EPITA Strasbourg.
							</p>
						</div>
					  <div class="col l4 offset-l2 s12">
						<h5 class="white-text">Liens utiles</h5>
						<ul>
							<li><a class="grey-text text-lighten-3" href="#">Notre Facebook</a></li>
							<li><a class="grey-text text-lighten-3" href="#">Notre Tweeter</a></li>
							<li><a class="grey-text text-lighten-3" href="https://github.com/cedricfarinazzo/ACCEr">Notre GitHub</a></li>
						</ul>
					  </div>
					</div>
				</div>
				<div class="footer-copyright">
					<div class="container">
						© 2017 Copyright ACCEr
						<a class="grey-text text-lighten-4 right" href="?p=terms">Conditions générales</a>
					</div>
				</div>
			</footer>
		</div>
		<script>
			//(function ($) {
				var timer;
				var time_maj = <?= json_encode($time*1000) ;?>;
				var i = 0;
				var redirect_compteur = 5;

				function time_maj_animation() {
					span = $('#tps-maj');
					var date_actuelle = new Date();
					var date_maj = new Date(time_maj);
					var tps_restant = date_maj.getTime() - date_actuelle.getTime();
					if (i >= 30) {
						i = 0;
						refresh_time_maj();
					}
					if (tps_restant > 0) {
						var s_restantes = tps_restant / 1000;
						var i_restantes = s_restantes / 60; 
						var H_restantes = i_restantes / 60; 
						var d_restants = H_restantes / 24; 
						s_restantes = Math.floor(s_restantes % 60);
						i_restantes = Math.floor(i_restantes % 60);
						H_restantes = Math.floor(H_restantes % 24);
						d_restants = Math.floor(d_restants);
						var text = d_restants +' jours et  ' + H_restantes+'h ' + i_restantes+'min '+s_restantes+'sec';
						span.text(text);
						span.css('color','green');
						redirect_compteur = 5;
					} else {
						span.html('Maintenance terminée !');
						span.css('color','green');
						redirect = $('#redirect');
						redirect.html('Redirection dans ' + redirect_compteur + ' secondes ...<br/> Cliquer <a href="./">ici</a> si la redirection ne fonctionne pas.');
						redirect_compteur -=1;
						if (redirect_compteur < 0) {
							 clearInterval(timer);
							 document.location.href="./";
						}

					}
					i = i + 1;
				}

				function refresh_time_maj() {
					$.ajax({
						url : '/assets/ajax/mtn/refresh_time_maj.php',
						type : 'get',
						dataType : 'html',
						success : function(html, statut) {
							 time_maj = parseInt(html)*1000;
						}
					});
						/*data = parseInt(data);
						$('#log').html($('#log').html() + 'data : ' + data + '<br/>');*/
				}

				timer = setInterval(time_maj_animation, 1000);	
			//}) (jQuery);
		</script>
		
	</body>
</html>