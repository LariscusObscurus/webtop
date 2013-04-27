<?php
if (isset($_POST["oldname"]) && isset($_POST["newname"])) {
	$oldname = ".".$_POST["oldname"];
	$newname = ".".$_POST["newname"];
	$ext = end(explode('.', $oldname));
	$content = explode('/', $oldname);
	$name = $content[2];
	$content = explode('.', $name);
	$name = $content[0];
	$oldthumb = sprintf("../photos/%s_thumb.%s", $name, $ext);
	$content = explode('/', $newname);
	$name = $content[2];
	$content = explode('.', $name);
	$name = $content[0];
	$newthumb = sprintf("../photos/%s_thumb.%s", $name, $ext);
	
	if (rename($oldname, $newname) && rename($oldthumb, $newthumb)) {
		echo "success";
	} else{
		echo "error: could not rename file";
	}
} else {
	echo "error: post variable is missing";
}
?>