<?php
$cache = new CacheManager("download");
$in_cache = $cache->on_cache();
if (!$in_cache) {
	ob_start();
	$downloadmanager = new DownloadManager($db);
	$downloadmanager->search();
	$available = count($downloadmanager->exe_name) != 0;
	$path = $downloadmanager->build_folder;
	
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
						<?php
							foreach($downloadmanager->exe_name as $exe)
							{
								$size = filesize($path.$exe);
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
								$version = "Beta(0.3)";
								$link = "/download.php";
								if (strpos($exe, 'lite') !== false) {
									$version = "lite-".$version;
									$link = "/download-lite.php";
								}
								?>
								<tr>
									<td><?= $exe; ?></td>
									<td><?= $version; ?></td>
									<td>Windows</td>
									<td><?= $size ?></td>
									<td><a href="<?= URL_PATH.$link; ?>">Télécharger</a></td>
								</tr>
								<?php
							}							
						?>
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