<?php

$cache = new CacheManager("project");
$in_cache = $cache->on_cache();
if (!$in_cache) {
	ob_start();

	$request = ob_get_contents();
	ob_end_clean();

	ob_start();
	?>
		<h2 class="center">Le projet : Shadow Miner</h2>
		<div class="divider"></div>
		<br/>
			<div class="container">
				<p>
					Ce projet est la réaisation d'un jeu vidéo dans le cadre de la mise en oeuvre des connaissances acquises 
					lors des cours de TD et TP informatiques et nous permet de renforcer et d’approfondir nos apprentissages.   
					<br/>
					Nous avons donc décidé de le baptiser "Shadow Miner" car l’histoire du jeu se passe dans une mine.
					Le jeu se déroulera à la première personne (vision subjective).
					Nous avons pensé à un mode solo et un mode multijoueurs.
				</p>
				<div class="divider"></div>
				<br/>
				
				<h4 class="center">Le mode solo</h4>
				<p>
					Scénario:
					<br/>
					<span>
						Un mineur descend tôt le matin dans les derniers sous-sols de la mine, là où l’oxygène se fait rare. 
						Un mineur fou (le Shadow Miner) coupe les câbles de l’ascenseur. 
						Le mineur veut alors rejoindre la surface. Le Shadow Miner va alors vouloir l’en empêcher.
					</span>
					<br/>
					L’utilisateur incarnera alors le mineur et devra réussir une succéssion de niveaux de plus en plus
					difficiles pour rejoindre la surface.
				</p>
				<div class="divider"></div>
				<br/>
				
				<h4 class="center">Le mode multijoueurs</h4>
				<p>
					Le joueur devra créer un compte pour pouvoir accéder au mode multijoueurs.
					Ce compte pourra être créer sur le site internet ou dans le jeu lui-même
					Ainsi le joueur pourra consulter et modifier ses données depuis le site internet ou le jeu.
					Ce système lui permet de jouer sur une version éxécutable du jeu comme sur la version web du jeu en conservant ses données.
					Ainsi la portabilité et l'accessibilité du jeu en seront augmentée.
					<br/>					
					Dans ce mode, nous avons pensé qu'un joueur serait le Shadow Miner 
					et devrait tuer les deux autres joueurs qui incarneront deux mineurs voulant rejoindre la surface. 
					Un des mineurs pourra s’enlever la vie et devenir un esprit de la mine 
					qui contrôle les cloisons de la mine (porte, mur, gouffre) pour aider l’autre mineur.
				</p>
				<div class="divider"></div>
				<br/>
				
				<h4 class="center">Le gameplay</h4>
				<p>
					Le joueur, autant en mode solo qu'en mode multijoueurs, sera ralenti dans sa progression 
					à cause des pièges et d'autres animations (éboulements, piques, ...)  qui pourront le bloquer, le blesser, voire le tuer. 
					Ces pièges s’appliqueront aussi bien au mineur qu'au shadow miner.
					Le joueur progressera de niveaux en niveaux avec des options de sauvegarde.
					<br/>
					Chaque niveau sera composé d’un point de départ et d'un checkpoint qui représentera la fin du niveau.
					Si le joueur parvient au checkpoint, alors il pourra passer au niveau suivant.
					<br/>
					Sinon il devra recommencer le niveau.
					<br/>
					Le joueur sera équipé par défaut d'une torche et d'une pioche. Les torches seront indispensables puisqu'elles permettront de voir dans l'obscurité.
					Les pioches permettront de se défendre contre de potentielles créatures ou de creuser pour s'échapper.
					Ces équipements pourront être perdus au cours de l'aventure.
				</p>
				<br/>
				
			</div>
			<div class="divider"></div>
		<br/>
		
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	$cache->createcache($content);

} else {
	$content = $cache->readcache();
}