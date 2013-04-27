<?php
session_start();
$updir = "../photos/";

if (isset($_FILES)) {
	$fileupload=$_FILES['file'];
	
	switch ($fileupload['type']) {
	case "image/png":
	case "image/jpeg":
	case "image/gif":

		if (!$fileupload['error'] 
		&& $fileupload['size'] > 0 
		&& $fileupload['tmp_name'] 
		&& is_uploaded_file($fileupload['tmp_name'])) {
			$num = (rand(0,1000) + time());
			$ext = end(explode('.', $fileupload['name']));
			$newFileName = sprintf("%d.%s", $num, $ext);
			move_uploaded_file($fileupload['tmp_name'],$updir.$newFileName);
			switch ($fileupload['type']) {
			case "image/png":
				$image = imagecreatefrompng($updir.$newFileName);
				break;
			case "image/jpeg":
				$image = imagecreatefromjpeg($updir.$newFileName);
				break;
			case "image/gif":
				$image = imagecreatefromgif($updir.$newFileName);
				break;
			}
			$tmpImage = imagecreatetruecolor(64, 64);
			imagecopyresized($tmpImage, $image, 0, 0, 0, 0, 64, 64, imagesx($image), imagesy($image));
			imagejpeg($tmpImage, sprintf("%s%d_thumb.%s", $updir, $num, $ext));
			echo $newFileName;
		} else {
			echo 'invalid file';
		}
		break;
	default:
		echo 'invalid file';
	}
}
?>
