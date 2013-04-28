<form action="" method="post" enctype="multipart/form-data">
	<label for="rssLink">Link: </label>
	<input id="rssLink" type="text" name="LinkRSS" onclick="onClickRssText(event)"/>
	<input id="rssSend" type="button" name="SendRSS" value="SendRSS" onclick="onClickRssSend(event)"/><br/>
	<div id="feedContainer">
</form>
<?php
	require_once("../class/MyFeed.php");
	$blub = new MyFeed();
	if ($blub->parse($blub->createRss(1), 1)) {
		echo "<div id='feedTitle'>";
		echo "<h1 id='feedTitleText'>Lorien Chickenkiller News</h1>";
		echo "<h2 id='feedSubtitleText'>Nukular Entertainment</h2>";
		echo "</div>";
		
		$count = count($blub->getTitles());
		$titles = $blub->getTitles();
		$links = $blub->getLinks();
		$descriptions = $blub->getDesc();
		$times = $blub->getTimes();
		
		for ($i = 0; $i < $count && $i < 10; $i++) {
			echo "<div class='entry'>";
			echo "<h3>";
			echo "<a href='".$links[$i]."'>".$titles[$i]."</a>";
			echo "<div class='lastUpdated'>".$times[$i]."</div>";
			echo "</h3>";
			echo "<div class='feedEntryContent' base='./pages/atom.php'>".$descriptions[$i]."</div>";
			echo "</div>";
			echo "<div style='clear: both;'></div>";
		}
	} else {
		echo "Error while parsing";
	}
?>
</div>