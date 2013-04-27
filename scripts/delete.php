<?php
	if (isset($_POST['filename'])) {
		if (unlink("." . $_POST['filename'])) {
			$ext = end(explode('.', $_POST['filename']));
			$content = explode('/', $_POST['filename']);
			$name = $content[2];
			$content = explode('.', $name);
			$name = $content[0];
			$thumb = sprintf("./photos/%s_thumb.%s", $name, $ext);
			unlink(".".$thumb);
			echo "success;";
			echo $thumb;
		} else {
			echo "failure";
		}
	}
?>