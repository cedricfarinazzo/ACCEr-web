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
		
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	$cache->createcache($content);

} else {
	$content = $cache->readcache();
}