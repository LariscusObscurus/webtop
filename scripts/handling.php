<?php

	require("mysql.php");
	session_start();

	if (version_compare(phpversion(), "5.3.13", ">=") == 1) {
		error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	} else {
		error_reporting(E_ALL & ~E_NOTICE);
	}
	    
	/*********************************************************
	 * FUNCTIONS
	 *********************************************************/
	
	// RETURNS 'TRUE' or 'FALSE' IF USER IS ALLOWED TO ACCESS THE WEBTOP
	function authenticateuser($user, $pass) {
		return ((($user == 'arif') && ($pass == 'arif')) || (($user == 'david') && ($pass == 'david')));
	}
    
	/********************************************************:q!*
	* POSITION-HANDLING
	*********************************************************/
    
	if (isset($_POST["xicon_1"])) {
		$_SESSION["xicon1"] = $_POST["xicon_1"] . "px";
		$_SESSION["yicon1"] = $_POST["yicon_1"] . "px";
	} else if (isset($_POST["xicon_2"])) {
		$_SESSION["xicon2"] = $_POST["xicon_2"] . "px";
		$_SESSION["yicon2"] = $_POST["yicon_2"] . "px";
	} else if (isset($_POST["xicon_3"])) {
		$_SESSION["xicon3"] = $_POST["xicon_3"] . "px";
		$_SESSION["yicon3"] = $_POST["yicon_3"] . "px";
	} else if (isset($_POST["xicon_4"])) {
		$_SESSION["xicon4"] = $_POST["xicon_4"] . "px";
		$_SESSION["yicon4"] = $_POST["yicon_4"] . "px";
	} else if (isset($_POST["xicon_5"])) {
		$_SESSION["xicon5"] = $_POST["xicon_5"] . "px";
		$_SESSION["yicon5"] = $_POST["yicon_5"] . "px";
	} else if (isset($_POST["xicon_6"])) {
		$_SESSION["xicon6"] = $_POST["xicon_6"] . "px";
		$_SESSION["yicon6"] = $_POST["yicon_6"] . "px";
	}

	if (isset($_POST["windowPhoto"])) {
		$_SESSION["windowPhoto"] = $_POST["windowPhoto"];
	} else if (isset($_POST["windowInfo"])) {
		$_SESSION["windowInfo"] = $_POST["windowInfo"];
	} else if (isset($_POST["windowAccount"])) {
		$_SESSION["windowAccount"] = $_POST["windowAccount"];
	} else if (isset($_POST["windowRss"])) {
		$_SESSION["windowRss"] = $_POST["windowRss"];
	}

	if (isset($_POST["x_windowPhoto"])) {
		$_SESSION["x_windowPhoto"] = $_POST["x_windowPhoto"] . "px";
		$_SESSION["y_windowPhoto"] = $_POST["y_windowPhoto"] . "px";
	} else if (isset($_POST["x_windowInfo"])) {
		$_SESSION["x_windowInfo"] = $_POST["x_windowInfo"] . "px";
		$_SESSION["y_windowInfo"] = $_POST["y_windowInfo"] . "px";
	} else if (isset($_POST["x_windowAccount"])) {
		$_SESSION["x_windowAccount"] = $_POST["x_windowAccount"] . "px";
		$_SESSION["y_windowAccount"] = $_POST["y_windowAccount"] . "px";
	} else if (isset($_POST["x_windowRss"])) {
		$_SESSION["x_windowRss"] = $_POST["x_windowRss"] . "px";
		$_SESSION["y_windowRss"] = $_POST["y_windowRss"] . "px";
	}



	/*********************************************************
	 * USER-HANDLING
	 *********************************************************/
	
	// RECEIVE LOGIN DATA
	if (isset($_POST["login"]))
	{
		$ldapserver = "ldap.technikum-wien.at";
		$searchbase = "dc=technikum-wien,dc=at";
		$loginname = (isset($_POST['username'])) ? $_POST['username'] : NULL;
		$loginpw = (isset($_POST['password'])) ? $_POST['password'] : NULL;
		$loginname = strtolower($loginname);
		$ds = ldap_connect($ldapserver);
		if (!$ds) {
			$error = "Unable to connect to LDAP server.<br>\n";
			$error .= "<a href='".$_SERVER['PHP_SELF']."'>Neuer Versuch >></a>";
		} else {
			if (!ldap_bind($ds)) {
				$error = "Unable to bind to LDAP server.<br>\n";
				$error .= "<a href='".$_SERVER['PHP_SELF']."'>Neuer Versuch >></a>";
			} else {
				// bind
				$dn = "uid=".$loginname.", ou=People, dc=technikum-wien, dc=at";
				$pw = $loginpw;
				if(!@ldap_bind($ds, $dn, $pw) || !$loginpw) {
					if(mysql_login($loginname, $pw) == 0) {

						mysql_recreate($_SESSION["uid"]);
						$_SESSION["play"] = TRUE;
						
						header('Location: ./index.php');
						exit();
					} else {
						$error = "<h3>Technikum-Wien</h3>";
						$error .= "Ung&uuml;ltiges Login / Password.<br><br>\n";
						$error .= "<a href='".$_SERVER['PHP_SELF']."'>Neuer Versuch >></a>";
					}
				} else {
					$filter = "(&(uid=".$loginname.")(objectClass=posixAccount))";
					$sr = ldap_search($ds, $searchbase, $filter);
					$info = ldap_get_entries($ds, $sr);

					// echo "Connected to LDAP server at technikum-wien.at.";
					unset($loginpw);
					$user_name = $loginname;
					$vorname = $info[0]['givenname'][0];
					$nachname = $info[0]['sn'][0];
				}
       				ldap_close($ds);
       			
				if (isset($error)) {
					// do nothing
				} else {
					$_SESSION["username"] = $vorname." ".$nachname;
					$_SESSION["uid"] = 1;
					mysql_recreate(1);
					$_SESSION["play"] = TRUE;
					
					header('Location: ./index.php');
					exit();
				}
			}
		}
	}
	
?>
