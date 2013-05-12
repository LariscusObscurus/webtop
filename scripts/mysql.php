<?php
	function mysql_login ($username, $pw) 
	{

		$salt = substr($username,0,2);
		$cryp_pw = crypt($pw, $salt);

		$con = mysqli_connect ("localhost", "apache", "fingolfin");
		if(!$con) {
			die('MySQL Fehler: '. mysqli_error());
		}
		mysqli_select_db($con, "webtop");

		$result = mysqli_query($con, "SELECT * FROM user WHERE username='$username' AND pwd='$cryp_pw'");
		if(!$result) {
			die('MySQL Fehler: '. mysqli_error());
		}

		if ($row = mysqli_fetch_row($result)) {
			$_SESSION['uid'] = $row[0];
			if($row[3] && $row[4]) {
				$_SESSION['username'] = $row[3]." ".$row[4];
			} else {
				$_SESSION['username'] = $row[1];

			}
			return 0;
		} else {
			mysqli_close($con);
			return -1;
		}
	}
	
	function mysql_recreate($uid) 
	{
		$con = mysqli_connect ("localhost", "apache", "fingolfin");
		if(!$con) {
			die('MySQL Fehler: '. mysqli_error());
		}
		mysqli_select_db($con, "webtop");

		$result = mysqli_query($con ,"SELECT * FROM applikation WHERE uid='$uid'");
		if(!$result) {
			die('MySQL Fehler: '. mysqli_error());
		}
		
		while ($row = mysqli_fetch_row($result)) {
			if($row[1] == "photo") {
				$_SESSION['windowPhoto'] = $row[2];
				$_SESSION['x_windowPhoto'] = $row[3]. "px";
				$_SESSION['y_windowPhoto'] = $row[4]. "px";

			}
			if($row[1] == "info") {
				$_SESSION['windowInfo'] = $row[2];
				$_SESSION['x_windowInfo'] = $row[3]. "px";
				$_SESSION['y_windowInfo'] = $row[4]. "px";
			}
			if($row[1] == "account") {
				$_SESSION['windowAccount'] = $row[2];
				$_SESSION['x_windowAccount'] = $row[3]. "px";
				$_SESSION['y_windowAccount'] = $row[4]. "px";
			}
			if($row[1] == "rss") {
				$_SESSION['windowRss'] = $row[2];
				$_SESSION['x_windowRss'] = $row[3]. "px";
				$_SESSION['y_windowRss'] = $row[4]. "px";
			}
		}
		mysqli_close($con);

	}

	function mysql_newuser($username, $name, $surname, $email, $pw) 
	{
		$salt = substr($username,0,2);
		$cryp_pw = crypt($pw, $salt);

		$con = mysqli_connect ('localhost', 'apache', 'fingolfin');
		if(!$con) {
			die('MySQL Fehler: '. mysqli_error());
		}
		mysqli_select_db($con, "webtop");
		$result = mysqli_query($con ,"INSERT INTO user (username, vorname, nachname, email, pwd)
		VALUES ('$username','$name','$surname','$email','$cryp_pw')");
		if(!$result) {
				die('MySQL Fehler: '. mysqli_error());
			}
		mysqli_close($con);
		return $result;

	}

	function mysql_save($app, $open, $uid, $x, $y) 
	{
		$con = mysqli_connect ("localhost", "apache", "fingolfin");
		if(!$con) {
			die('MySQL Fehler: '. mysqli_error());
		}
		mysqli_select_db($con, "webtop");

		$result = mysqli_query($con, "SELECT status FROM applikation WHERE uid='$uid' AND app_name='$app'");

		if (!($row = mysqli_fetch_row($result))) {
			mysqli_query($con ,"INSERT INTO applikation (app_name, status, pos_x, pos_y, uid) 
			VALUES ('$app','$open','$x','$y', '$uid')");
		} else {
			mysqli_query($con ,"UPDATE applikation SET pos_x='$x', pos_y='$y', status='$open' WHERE uid='$uid' AND app_name='$app'");
		}

		mysqli_close($con);
	}
?>
