<?php
if (isset($_GET["filename"])) {
	$filename = ".".$_GET["filename"];
	$ext = end(explode('.', $filename));
	$content = explode('/', $filename);
	$name = $content[2];
	$content = explode('.', $name);
	$name = $content[0];
	$mime = "";
	switch ($ext) {
	case "png":
		$mime = "image/png";
		break;
	case "jpeg":
	case "jpg":
		$mime = "image/jpeg";
		break;
	case "gif":
		$mime = "image/gif";
		break;
	}
	
	header("Content-type: $mime");
	header("Content-Disposition: attachment; filename='$name.$ext'");
	readfile($filename);
}
?>