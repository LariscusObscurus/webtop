<?php
class DbHandler
{
	private $connection;
	
	function __construct($host, $user, $password)
	{
		$this->connection = mysql_connect($host, $user, $password);
		if(!$connection) {
			die('MySQL Fehler: '. mysql_error());
		}
		mysql_select_db("webtop", $con);
	}
	
	function __destruct()
	{
		mysql_close($this->connection);
	}
	
	function getData()
	{
		return null;
	}
	
	function addEntry($title, $link, $description)
	{
		$result = mysql_query("INSERT INTO rss (title, link, description, date) VALUES ('$title', '$link', '$description', NOW())", $this->connection);
		if(!$result) {
			die('MySQL Fehler: '. mysql_error());
		}
	}
	
	function changeEntry($oldTitle, $oldLink, $oldDescription, $newTitle, $newLink, $newDescription)
	{
		$result = mysql_query("UPDATE rss SET title = '$newTitle', link = '$newLink', description = '$newDescription', date = NOW() WHERE title = '$oldTitle' AND link = '$oldLink' AND description = '$oldDescription';", $this->connection);
		if(!$result) {
			die('MySQL Fehler: '. mysql_error());
		}
	}
	
	function deleteEntry($title, $link, $description)
	{
		$result = mysql_query("DELETE FROM rss WHERE title = '$title' AND link = '$link' AND description = '$description';");
		if(!$result) {
			die('MySQL Fehler: '. mysql_error());
		}
	}
}
?>