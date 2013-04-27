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
			$count = count($title);
			$data = $db->getData();
			
			if ($data && $option == 2) {
				$i = 0;
				$count = count($titles);
				while ($row = mysql_fetch_assoc($data) && $i < $count) {
					$db->changeEntry(
						$row['title'],
						$row['link'],
						$row['description'],
						$titles[$i],
						$links[$i],
						$descriptions[$i]
					);
					$i++;
				}
				echo "success";
			} else if ($data && ($option == 1 || $option == 3)) {
				for ($i = 0; $i < $count; $i++) {
					switch ($option) {
					case 1:
						$db->addEntry(
							$titles[$i], 
							$links[$i], 
							$descriptions[$i]);
						break;
					case 3:
						$db->deleteEntry(
							$titles[$i], 
							$links[$i], 
							$descriptions[$i]);
						break;
					}
				}
				echo "success";
			} else {
				echo "error: wrong option or no data found";
			}
		} else {
			echo "error: not an atom feed";
		}
	} else {
		echo "error: link or option not set";
	}
?>