<?php
	session_start();
	echo "<div id='username'>";
	if (isset($_SESSION["username"]))
	{
		echo $_SESSION["username"];
	}
	else if (isset($_COOKIE["username"]))
	{
		echo $_COOKIE["username"];
	}
	else
	{
		echo "invalid user";
	}
	echo "</div>";
	
	echo "<div><a id='arbeitsplatz' href='#' onclick='openWindow()'>Arbeitsplatz</a></div>
		<div><a id='internetexplorer' href='./pages/bluescreen.php'>Internet Explorer 6</a></div>
		<div><a id='papierkorb' href='#' onclick='openWindow()'>Papierkorb</a></div>
		<div><a id='accountAppProg' href='#' onclick='openAccount()'>Account</a></div>
		<div><a id='photoAppProg' href='#' onclick='openPhoto()'>Photo Application</a></div>
		<div><a id='rssAppProg' href='#' onclick='openRss()'>RSS</a></div>";
	
	echo "<div id='logout'>";
	echo "<a href='./scripts/logout.php' class='logoutLink' onclick='logout()'></a>";
	echo "</div>";
	
?>