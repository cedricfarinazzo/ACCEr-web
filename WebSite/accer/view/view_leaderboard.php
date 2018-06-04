<?php
ob_start();

function bubble_sort($arr) {
    $size = count($arr)-1;
    for ($i=0; $i<$size; $i++) {
        for ($j=0; $j<$size-$i; $j++) {
            $k = $j+1;
            if ($arr[$k]->multistats() > $arr[$j]->multistats()) {
                // Swap elements at indices: $j, $k
                list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
            }
        }
    }
    return $arr;
}

$progress = new ProgressManager($db);

$req_progress = $progress->GetList();
$req_progress_sort = bubble_sort($req_progress);

$request = ob_get_contents();
ob_end_clean();

ob_start();
?>

	<h2 class="center">Classement des joueurs</h2>
	<div class="divider"></div>
	<br/>
	
	<div class="user-list">
		<table class="bordered highlight centered responsive-table">
			<thead style="font-weight: bold;">
				<tr>
					<td>N°</td>
					<td>Pseudo</td>
					<td>Avancement solo</td>
					<td>Parties multijoueurs gagnées</td>
				</tr>
			</thead>
			<tfoot style="font-weight: bold;">
				<tr>
					<td>N°</td>
					<td>Pseudo</td>
					<td>Avancement solo</td>
					<td>Parties multijoueurs gagnées</td>
				</tr>
			</tfoot>
			<tbody>
				<?php 
				$id = 0;
				foreach($req_progress_sort as $u) { 
				$id++; ?>
					<tr>
						<td><?= $id; ?></td>
						<td><a href="<?= URL_PATH.'/?p=progressgame&id='.urldecode($u->ID_user()); ?>"><?= $u->login(); ?></a></td>
						<td><?= $u->solostats(); ?></td>
						<td><?= $u->multistats(); ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	

<?php
$content = ob_get_contents();
ob_end_clean();