<?php
	require_once("../class/MyFeed.php");
	$blub = new MyFeed();

	Header('Content-type: text/xml');
	$blub->createRss();
?>
