<?php
	
	session_start();
	
	if (isset($_SESSION["username"]))
	{
		echo "Angemeldeter Benutzer: " . $_SESSION["username"];
	}
	else if (isset($_COOKIE["username"]))
	{
		echo "Angemeldeter Benutzer: " . $_COOKIE["username"];
	}
	else
	{
		echo "Angemeldeter Benutzer: invalid user";
	}
	echo "<br />";
	echo "<a href='./scripts/logout.php' class='logoutLink' onclick='logout()' style='color: blue'>Logout</a>";
    
?> 