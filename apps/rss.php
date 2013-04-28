<form action="" method="post" enctype="multipart/form-data">
	<label for="rssLink">Datei: </label>
	<input id="rssLink" type="text" name="LinkRSS" onclick="onClickRssText(event)"/>
	<input id="rssSend" type="button" name="SendRSS" value="SendRSS" onclick="onClickRssSend(event)"/><br/>
	<!--<iframe src="../pages/atom.php" style="width: 600px; height: 400px; margin-top: 8px;"></iframe>-->
	<div id="rssContainer" xmlns="http://www.w3.org/1999/xhtml"></div>
</form>
<?php
?>