<?php
$cache = new CacheManager("download");
$in_cache = $cache->on_cache();
if (!$in_cache) {
	ob_start();

	$request = ob_get_contents();
	ob_end_clean();

	ob_start();
	?>
		<h2 class="center">Télécharger Shadow Miner</h2>
		<div class="divider"></div>
		<br/>
		<div class="container">
			Pour le moment, le jeu Shadow Miner est encore en développement.
			La première version du jeu sortira en juin.
		</div>
		<br/>
		<div class="divide"></div>
		<br/>
		<div>
			<a href="/game">Test.é</a>
		</div>
		<br/>
		
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	$cache->createcache($content);

} else {
	$content = $cache->readcache();
}