<?php
$cache = new CacheManager("download");
$in_cache = $cache->on_cache();
if (!$in_cache) {
	ob_start();
	$downloadmanager = new DownloadManager($db);
	$available = false;
	if ($downloadmanager->search()) {
		$path = $downloadmanager->build_folder;
		$name = $downloadmanager->exe_name;
		$size = filesize($path.$name);
		if ($size >= 1000000000) {
			$size = ((int)($size / 1000000000)).' Go';
		}
		elseif ($size >= 1000000) {
			$size = ((int)($size / 1000000)).' mo';
		}
		elseif ($size >= 1000) {
			$size = ((int)($size / 1000)).' ko';
		}
		else {
			$size = ((int)$size).' o';
		}
		$available = true;
	}
	$request = ob_get_contents();
	ob_end_clean();

	ob_start();
	?>
		<h2 class="center">Télécharger Shadow Miner</h2>
		<div class="divider"></div>
		<br/>
		<div class="container">
			Pour le moment, le jeu Shadow Miner est encore en développement.<br/>
			La version finale du jeu sortira en début juin.
		</div>
		<br/>
		<div class="divider"></div>
		<?php if ($available) { ?>
			<br/>
			<div class="container">
				<h4 class="center">Version disponible</h4>
				<br/>
				<table class="bordered highlight responsive-table">
					<thead style="font-weight: bold;">
						<tr>
							<td>Nom</td>
							<td>version</td>
							<td>plateforme</td>
							<td>taille</td>
							<td>lien</td>
						</tr>
					</thead>
					<tfoot style="font-weight: bold;">
						<tr>
							<td>Nom</td>
							<td>version</td>
							<td>plateforme</td>
							<td>taille</td>
							<td>lien</td>
						</tr>
					</tfoot>
					<tbody>
							<td><?= $name; ?></td>
							<td>Beta(0.1)</td>
							<td>Windows</td>
							<td><?= $size ?></td>
							<td><a href="<?= URL_PATH ?>/download.php">Télécharger</a></td>
					</tbody>
				</table>
			</div>
			<br/>
			<div class="divider"></div>
		<?php } ?>
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