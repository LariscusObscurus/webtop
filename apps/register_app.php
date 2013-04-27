<?php include_once "../scripts/register.php";
?>
<div id="register">
	<span style="font-size: 20px">Register</span><br/>
	<form action="scripts/register.php" method="post">
		<label for="userName">Username:* </label><input type="text" name="username" id="userName"/>
		<label for="userPassword">Password:* </label><input type="password" name="password" id="userPassword" />
		<label for="userEmail">Email: </label><input type="text" name="email" id="userEmail" />
		<label for="userVorname">Forename: </label><input type="text" name="vorname" id="userVorname" />
		<label for="userNachname">Surname: </label><input type="text" name="nachname" id="userNachname" />
		<input type="submit" name="register" value="Benutzer registrieren" onclick="" />
	</form>
	<div id="errorRegister"><?php echo $error; ?></div>
</div>
