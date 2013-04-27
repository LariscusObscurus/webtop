<?php
	require("mysql.php");

	if(isset($_POST['username']) && isset($_POST['password'])) {
		$username = $_POST['username'];
		$pw = $_POST['password'];
		$email = $_POST['email'];
		$name = $_POST['vorname'];
		$surname = $_POST['nachname'];

		if(mysql_newuser($username, $name, $surname, $email, $pw)) {
			$error = "User erstellt";
			header('Location: ../index.php');
			exit();
		} else {
			$error = "Fehler";
			header('Location: ../index.php');
			exit();
		}
	} else {

		$error = "Username und Passwort Notwendig";
	}
?>
