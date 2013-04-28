<?php
	require_once("../class/MyFeed.php");
	$blub = new MyFeed();

	Header('Content-type: text/xml');
	if ($blub->parse($blub->createRss())) {
		$count = count($blub->getTitles());
		
		for ($i = 0; $i < $count && $i < 10; $i++) {
		}
	} else {
		echo "Error while parsing<br/>";
	}
?>
