<?php

$cache = new CacheManager("source");
$in_cache = $cache->on_cache();
if (!$in_cache) {
	ob_start();

	$request = ob_get_contents();
	ob_end_clean();

	ob_start();
	?>
		<h2 class="center">Les sources</h2>
		<div class="divider"></div>
		<br/>
		<div class="container">
			<p class="center">
				Voici les sources de certains éléments présents dans le projet :
			</p>
			<br/>
			<ul class="collection">
				<li class="collection-item">
					Le modèle 3D et les animations du mineur proviennent des Standart Assets d'Unity 4
					<br/><a href="https://unity3d.com/fr/legal/as_terms">licence</a>
				</li>
				<li class="collection-item">
					Le modèle 3D et les animations du shadow mineur proviennent du site 
					<a href="https://www.mixamo.com/">https://www.mixamo.com/</a><br/><a href="https://forums.adobe.com/thread/1992542">Licence</a>
				</li>
				<li class="collection-item">
					Le design du site a été créé avec le <a href="http://materializecss.com/">Materialize css</a>.
				</li>
				<li class="collection-item">
					Le javascript du site utilise le framework <a href="https://jquery.com/">JQuery</a>.
				</li>
			</ul>
		</div>
		<br/>
		
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	$cache->createcache($content);

} else {
	$content = $cache->readcache();
}