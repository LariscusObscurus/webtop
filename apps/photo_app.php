<form action="" method="post" enctype="multipart/form-data">
    <label for="file">Datei: </label>
    <input id="file" type="file" name="files[]" onchange="onFileChange(event)" multiple />
    <input id="undo" type="button" name="Undo" value="Undo" onclick="onClickUndo(event)"/>
</form>
<div id="dropArea" ondrop="onFileDrop(event)" ondragenter="noopHandler(event)" ondragexit="noopHandler(event)" ondragover="noopHandler(event)">Fotos hier reinziehen</div>
<div id="photos">
	<?php

		$photos = '../photos/'; 
		$ext = array('png','jpg','jpeg','gif'); 

		$dir = opendir($photos); 

		while ($item = readdir($dir)) {

			if (in_array(strtolower(substr($item,-3)), $ext) 
				OR in_array(strtolower(substr($item,-4)), $ext)) {
				$pic[] = $item;
			}
		}
		echo "<ul id='photoList'>";

		$total = count($pic);
		for ($x = 0; $x < $total; $x++) {
			if (strpos($pic[$x], "_thumb") !== false) {
				$ext = end(explode('.', $pic[$x]));
				$content = explode('_', $pic[$x]);
				$name = "";
				for ($i = 0; $i < count($content) - 1; $i++) {
					$name .= $content[$i];
					if (count($content) - 1 == $i + 1) {
						break;
					} else {
						$name .= "_";
					}
				}
				echo "	<li>
						<a class='fancybox-thumb' rel='fancybox-thumb' href='./photos/" . $name . "." . $ext . "' title='" . $name . "'>
							<img class='photo' src='./photos/" . $pic[$x] . "' alt='" . $pic[$x] . " 'oncontextmenu='onContextMenu(event)'>
							</img>
						</a>
					</li>";
		  	}
		}
		echo "</ul>";

	?>
</div>

<div style="clear: both" /></div>
