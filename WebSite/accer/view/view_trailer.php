<?php
ob_start();

$request = ob_get_contents();
ob_end_clean();

ob_start();
?>

	<h2 class="center">Trailer</h2>
	<div class="divider"></div>
	<br/>
	
	<div class="container center trail">
		<iframe width="615" height="470"
		src="https://www.youtube.com/embed/tgNymZ7vqY?controls=0&autoplay=1">
		</iframe>
	</div>
	

<?php
$content = ob_get_contents();
ob_end_clean();