<?php
	function mysql_login ($username, $pw) 
	{

		$salt = substr($username,0,2);
		$cryp_pw = crypt($pw, $salt);

		$con = mysqli_connect ("localhost", "apache", "fingolfin");
		if(!$con) {
			die('MySQL Fehler: '. mysqli_error($con));
		}
		mysqli_select_db($con, "webtop");

		$query = sprintf("SELECT * FROM user WHERE username='%s' AND pwd='%s'",
			mysqli_real_escape_string($con, $username),
			mysqli_real_escape_string($con, $cryp_pw));
		$result = mysqli_query($con, $query);
		if(!$result) {
			die('MySQL Fehler: '. mysqli_error($con));
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
			die('MySQL Fehler: '. mysqli_error($con));
		}
		mysqli_select_db($con, "webtop");

		$query = sprintf("SELECT * FROM applikation WHERE uid='%s'",
			mysqli_real_escape_string($con, $uid));
		$result = mysqli_query($con ,$query);
		if(!$result) {
			die('MySQL Fehler: '. mysqli_error($con));
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
			die('MySQL Fehler: '. mysqli_error($con));
		}
		mysqli_select_db($con, "webtop");
		$query = sprintf("INSERT INTO user (username, vorname, nachname, email, pwd)
		VALUES ('%s','%s','%s','%s','%s')",
			mysqli_real_escape_string($con, $username),
			mysqli_real_escape_string($con, $name),
			mysqli_real_escape_string($con, $surname),
			mysqli_real_escape_string($con, $email),
			mysqli_real_escape_string($con, $cryp_pw));
		$result = mysqli_query($con , $query);
		if(!$result) {
				die('MySQL Fehler: '. mysqli_error($con));
			}
		mysqli_close($con);
		return $result;

	}

	function mysql_save($app, $open, $uid, $x, $y) 
	{
		$con = mysqli_connect ("localhost", "apache", "fingolfin");
		if(!$con) {
			die('MySQL Fehler: '. mysqli_error($con));
		}
		mysqli_select_db($con, "webtop");

		$query = sprintf("SELECT status FROM applikation WHERE
		uid='%s' AND app_name='%s'",
			mysqli_real_escape_string($con, $uid),
			mysqli_real_escape_string($con, $app));
		$result = mysqli_query($con, $query);

		if (!($row = mysqli_fetch_row($result))) {
			$query = sprintf("INSERT INTO applikation (app_name, status, pos_x, pos_y, uid) 
			VALUES ('%s','%s','%s','%s', '%s')",
			mysqli_real_escape_string($con, $app),
			mysqli_real_escape_string($con, $open),
			mysqli_real_escape_string($con, $x),
			mysqli_real_escape_string($con, $y),
			mysqli_real_escape_string($con, $uid));

			mysqli_query($con , $query);
		} else {
			$query = sprintf("UPDATE applikation SET pos_x='%s', 
			pos_y='%s', status='%s' WHERE uid='%s' AND app_name='%s'",
			mysqli_real_escape_string($con, $x),
			mysqli_real_escape_string($con, $y),
			mysqli_real_escape_string($con, $open),
			mysqli_real_escape_string($con, $uid),
			mysqli_real_escape_string($con, $app));

			mysqli_query($con ,$query);
		}

		mysqli_close($con);
	}
?>
