<?php
	include("mysql.php");
	session_start();

	if(isset($_SESSION["windowPhoto"])) {
		mysql_save("photo", $_SESSION["windowPhoto"], $_SESSION["uid"], $_SESSION["x_windowPhoto"], $_SESSION["y_windowPhoto"]);
	}
	if(isset($_SESSION["windowInfo"])) {
		mysql_save("info", $_SESSION["windowInfo"], $_SESSION["uid"], $_SESSION["x_windowInfo"], $_SESSION["y_windowInfo"]);
	}
	if(isset($_SESSION["windowAccount"])) {
		mysql_save("account", $_SESSION["windowAccount"], $_SESSION["uid"], $_SESSION["x_windowAccount"], $_SESSION["y_windowAccount"]);
	}
	if(isset($_SESSION["windowRss"])) {
		mysql_save("account", $_SESSION["windowRss"], $_SESSION["uid"], $_SESSION["x_windowRss"], $_SESSION["y_windowRss"]);
	}

	session_destroy();
	header("Location: ../index.php");
	exit();
?>
