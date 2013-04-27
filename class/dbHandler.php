<?php
class DbHandler
{
	private $connection;
	
	function __construct()
	{
		$this->connection = mysql_connect("localhost", "apache", "fingolfin");
		if(!$connection) {
			die('MySQL Fehler: '. mysql_error());
		}
		mysql_select_db("webtop", $con);
	}
	
	function __destruct()
	{
		mysql_close($this->connection);
	}
	
	function getData($option)
	{
		switch ($option) {
		case 1:
			$result = mysql_query("SELECT * FROM rss ORDER BY title ASC;",
				$this->connection);
			break;
		case 2:
			$result = mysql_query("SELECT * FROM rss ORDER BY title DESC;",
				$this->connection);
			break;
		case 3:
			$result = mysql_query("SELECT * FROM rss ORDER BY date ASC;",
				$this->connection);
			break;
		case 4:
			$result = mysql_query("SELECT * FROM rss ORDER BY date DESC;",
				$this->connection);
			break;
		}
		if (!$result || mysql_num_rows($result) <= 0) {
			return null;
		}
		return mysql_fetch_assoc($result);
	}
	
	function addEntry($title, $link, $description)
	{
		$result = mysql_query("INSERT INTO rss (title, link, description, date) 
			VALUES ('$title', '$link', '$description', NOW())", 
			$this->connection);
		return $result;
	}
	
	function changeEntry($oldTitle, $oldLink, $oldDescription, $newTitle, $newLink, $newDescription)
	{
		$result = mysql_query("UPDATE rss SET 
			title = '$newTitle', 
			link = '$newLink', 
			description = '$newDescription', 
			date = NOW() 
		WHERE title = '$oldTitle' AND 
			link = '$oldLink' AND 
			description = '$oldDescription';", 
			$this->connection);
		return $result;
	}
	
	function deleteEntry($title, $link, $description)
	{
		$result = mysql_query("DELETE FROM rss WHERE 
			title = '$title' AND 
			link = '$link' AND 
			description = '$description';",
			$this->description);
		return $result;
	}
}
?>