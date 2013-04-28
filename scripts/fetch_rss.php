<?php
	require("../class/MyFeed.php");
	require("../class/dbHandler.php");
	
	if (isset($_POST['link']) && isset($_POST['option'])) {
		$link = $_POST['link'];
		$option = $_POST['option'];
		$feed = new MyFeed();
		$db = new DbHandler();
		
		if ($feed->parse($link)) {
			$titles = $feed->getTitles();
			$links = $feed->getLinks();
			$descriptions = $feed->getDesc();
			$count = count($titles);
			$data = $db->getData();
			$success = true;
			
			if ($data) {
				switch ($option) {
				case 1:
					for ($i = 0; $i < $count; $i++) {
						if (!$db->addEntry(
							$titles[$i], 
							$links[$i], 
							$descriptions[$i])) {
							$success = false;
							echo "error: couldn't add entry at index '$i'";
							break;
						}
					}
					break;
				case 2:
					$i = 0;
					$count = count($titles);
					while ($row = mysql_fetch_assoc($data) && $i < $count) {
						if (!$db->changeEntry(
							$row['title'],
							$row['link'],
							$row['description'],
							$titles[$i],
							$links[$i],
							$descriptions[$i])) {
							$success = false;
							echo "error: couldn't change entry at index '$i'";
							break;
						}
						$i++;
					}
					break;
				case 3:
					for ($i = 0; $i < $count; $i++) {
						if (!$db->deleteEntry(
							$titles[$i], 
							$links[$i], 
							$descriptions[$i])) {
							$success = false;
							echo "error: couldn't add entry at index '$i'";
							break;
						}
					}
					break;
				default:
					$success = false;
					echo "error: wrong option $option";
					break;
				}
				if ($success) {
					echo "success";
				}
			} else {
				echo "error: no data found";
			}
		} else {
			echo "error: not an atom feed";
		}
	} else {
		echo "error: link or option not set";
	}
?>