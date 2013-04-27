<?php

session_start();

function saveImage ($picture) {
	$ext = end(explode('.', $_POST['filename']));
	switch ($ext) {
	case "png":
		$result = imagepng($picture, ".".$_POST['filename']);
		break;
	case "jpeg":
	case "jpg":
		$result = imagejpeg($picture, ".".$_POST['filename']);
		break;
	case "gif":
		$result = imagegif($picture, ".".$_POST['filename']);
		break;
	}
}
function saveThumb ($thumb) {
	$ext = end(explode('.', $_POST['filename']));
	$content = explode('/', $_POST['filename']);
	$name = $content[2];
	$content = explode('.', $name);
	$name = $content[0];
	$dir = sprintf("../photos/%s_thumb.%s", $name, $ext);
	switch ($ext) {
	case "png":
		$result = imagepng($thumb, $dir);
		break;
	case "jpeg":
	case "jpg":
		$result = imagejpeg($thumb, $dir);
		break;
	case "gif":
		$result = imagegif($thumb, $dir);
		break;
	}
}
function grayscale ($picture, $thumb) {
	imagefilter($picture, IMG_FILTER_GRAYSCALE);
	imagefilter($thumb, IMG_FILTER_GRAYSCALE);
	saveImage($picture);
	saveThumb($thumb);
}
function negate ($picture, $thumb) {
	imagefilter($picture, IMG_FILTER_NEGATE);
	imagefilter($thumb, IMG_FILTER_NEGATE);
	saveImage($picture);
	saveThumb($thumb);
}
function meanRemoval ($picture, $thumb) {
	imagefilter($picture, IMG_FILTER_MEAN_REMOVAL);
	imagefilter($thumb, IMG_FILTER_MEAN_REMOVAL);
	saveImage($picture);
	saveThumb($thumb);
}
function turnRight ($picture, $thumb) {
	$rotPicture = imagerotate($picture, 270, 0);
	$rotThumb = imagerotate($thumb, 270, 0);
	saveImage($rotPicture);
	saveThumb($rotThumb);
	imagedestroy($rotPicture);
	imagedestroy($rotThumb);
}
function turnLeft ($picture, $thumb) {
	$rotPicture = imagerotate($picture, 90, 0);
	$rotThumb = imagerotate($thumb, 90, 0);
	saveImage($rotPicture);
	saveThumb($rotThumb);
	imagedestroy($rotPicture);
	imagedestroy($rotThumb);
}
function mirror ($picture, $thumb) {
	$width = imagesx($picture);
	$height = imagesy($picture);
	$picMirror = imagecreatetruecolor($width, $height);
	imagefill($picMirror, 0, 0, 0);
	$dst_y = 0;
	$src_y = 0;
	$coordinate = ($width - 1);
	
	foreach (range($width, 0) as $range) {
		$src_x = $range;
		$dst_x = $coordinate - $range;
		imagecopy($picMirror, $picture, $dst_x, $dst_y, $src_x, $src_y, 1, $height);
	}
	saveImage($picMirror);
	
	$width = imagesx($thumb);
	$height = imagesy($thumb);
	$thuMirror = imagecreatetruecolor($width, $height);
	imagefill($thuMirror, 0, 0, 0);
	$coordinate = ($width - 1);
	
	foreach (range($width, 0) as $range) {
		$src_x = $range;
		$dst_x = $coordinate - $range;
		imagecopy($thuMirror, $thumb, $dst_x, $dst_y, $src_x, $src_y, 1, $height);
	}
	saveThumb($thuMirror);
	imagedestroy($picMirror);
	imagedestroy($thuMirror);
	
}
function cut ($picture, $thumb) {
}
function download ($picture, $thumb) {
}
function undo ($lastFile, $lastAction) {
	$filename = ".".$lastFile;
	$ext = end(explode('.', $lastFile));
	$content = explode('/', $lastFile);
	$name = $content[2];
	$content = explode('.', $name);
	$name = $content[0];
	$thumb = sprintf("../photos/%s_thumb.%s", $name, $ext);
	
	switch ($ext) {
	case "png":
		$undoPic = imagecreatefrompng("../backup/undo.png");
		$undoThumb = imagecreatefrompng("../backup/undo_thumb.png");
		$result = imagepng($undoPic, $filename);
		$result = imagepng($undoThumb, $thumb);
		break;
	case "jpeg":
	case "jpg":
		$undoPic = imagecreatefromjpeg("../backup/undo.jpeg");
		$undoThumb = imagecreatefromjpeg("../backup/undo_thumb.jpeg");
		$result = imagejpeg($undoPic, $filename);
		$result = imagejpeg($undoThumb, $thumb);
		break;
	case "gif":
		$undoPic = imagecreatefromgif("../backup/undo.gif");
		$undoThumb = imagecreatefromgif("../backup/undo_thumb.gif");
		$result = imagegif($undoPic, $filename);
		$result = imagegif($undoThumb, $thumb);
		break;
	}
	imagedestroy($undoPic);
	imagedestroy($undoThumb);
}

if (isset($_POST['filename']) && isset($_POST['action'])) {
	$filename = ".".$_POST['filename'];
	$ext = end(explode('.', $_POST['filename']));
	$content = explode('/', $_POST['filename']);
	$name = $content[2];
	$content = explode('.', $name);
	$name = $content[0];
	$thumb = sprintf("../photos/%s_thumb.%s", $name, $ext);
	switch ($ext) {
	case "png":
		$picture = imagecreatefrompng($filename);
		$thumb = imagecreatefrompng($thumb);
		$result = imagepng($picture, "../backup/undo.png");
		$result = imagepng($thumb, "../backup/undo_thumb.png");
		break;
	case "jpeg":
	case "jpg":
		$picture = imagecreatefromjpeg($filename);
		$thumb = imagecreatefromjpeg($thumb);
		$result = imagejpeg($picture, "../backup/undo.jpeg");
		$result = imagejpeg($thumb, "../backup/undo_thumb.jpeg");
		break;
	case "gif":
		$picture = imagecreatefromgif($filename);
		$thumb = imagecreatefromgif($thumb);
		$result = imagegif($picture, "../backup/undo.gif");
		$result = imagegif($thumb, "../backup/undo_thumb.gif");
		break;
	}
	if ($picture) {
		$_SESSION['lastAction'] = $_POST['action'];
		$_SESSION['lastFile'] = $_POST['filename'];
		switch ($_POST['action']) {
		case 0:
			grayscale($picture, $thumb);
			break;
		case 1:
			negate($picture, $thumb);
			break;
		case 2:
			meanRemoval($picture, $thumb);
			break;
		case 3:
			turnRight($picture, $thumb);
			break;
		case 4:
			turnLeft($picture, $thumb);
			break;
		case 5:
			mirror($picture, $thumb);
			break;
		case 6:
			cut($picture, $thumb);
			break;
		case 7:
			download($picture, $thumb);
			break;
		}
	}
	imagedestroy($picture);
	imagedestroy($thumb);
	echo $_POST['filename'];
} else {
	if ($_SESSION["lastFile"] != "") {
		undo($_SESSION["lastFile"], $_SESSION["lastAction"]);
		echo "undo file: ".$_SESSION["lastFile"];
		$_SESSION["lastFile"] = "";
	} else {
		echo "nothing to undo";
	}
}

?>