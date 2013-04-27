<?php
	function mysql_login ($username, $pw) 
	{

		$salt = substr($username,0,2);
		$cryp_pw = crypt($pw, $salt);

		$con = mysql_connect ("localhost", "apache", "fingolfin");
		if(!$con) {
			die('MySQL Fehler: '. mysql_error());
		}
		mysql_select_db("webtop", $con);

		$result = mysql_query("SELECT * FROM user WHERE username='$username' AND pwd='$cryp_pw'", $con);
		if(!$result) {
			die('MySQL Fehler: '. mysql_error());
		}

		if ($row = mysql_fetch_row($result)) {
			$_SESSION['uid'] = $row[0];
			if($row[3] && $row[4]) {
				$_SESSION['username'] = $row[3]." ".$row[4];
			} else {
				$_SESSION['username'] = $row[1];

			}
			return 0;
		} else {
			mysql_close($con);
			return -1;
		}
	}
	
	function mysql_recreate($uid) 
	{
		$con = mysql_connect ("localhost", "apache", "fingolfin");
		if(!$con) {
			die('MySQL Fehler: '. mysql_error());
		}
		mysql_select_db("webtop", $con);

		$result = mysql_query("SELECT * FROM applikation WHERE uid='$uid'", $con);
		if(!$result) {
			die('MySQL Fehler: '. mysql_error());
		}
		
		while ($row = mysql_fetch_row($result)) {
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
		}
		mysql_close($con);

	}

	function mysql_newuser($username, $name, $surname, $email, $pw) 
	{
		$salt = substr($username,0,2);
		$cryp_pw = crypt($pw, $salt);

		$con = mysql_connect ('localhost', 'apache', 'fingolfin');
		if(!$con) {
			die('MySQL Fehler: '. mysql_error());
		}
		mysql_select_db('webtop', $con);
		$result = mysql_query("INSERT INTO user (username, vorname, nachname, email, pwd)
		VALUES ('$username','$name','$surname','$email','$cryp_pw')", $con);
		if(!$result) {
				die('MySQL Fehler: '. mysql_error());
			}
		mysql_close($con);
		return $result;

	}

	function mysql_save($app, $open, $uid, $x, $y) 
	{
		$con = mysql_connect ("localhost", "apache", "fingolfin");
		if(!$con) {
			die('MySQL Fehler: '. mysql_error());
		}
		mysql_select_db("webtop", $con);

		$result = mysql_query("SELECT status FROM applikation WHERE uid='$uid' AND app_name='$app'", $con);

		if (!($row = mysql_fetch_row($result))) {
			mysql_query("INSERT INTO applikation (app_name, status, pos_x, pos_y, uid) 
			VALUES ('$app','$open','$x','$y', '$uid')", $con);
		} else {
			mysql_query("UPDATE applikation SET pos_x='$x', pos_y='$y', status='$open' WHERE uid='$uid' AND app_name='$app'", $con);
		}

		mysql_close($con);
	}
?>
