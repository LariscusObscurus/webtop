<?php
class DbHandler
{
	private $connection;
	
	public function __construct()
	{
		$this->connection = mysql_connect("localhost", "apache", "fingolfin");
		if(!$this->connection) {
			die('MySQL Fehler: '. mysql_error());
		}
		mysql_select_db("webtop", $this->connection);
	}
	
	public function __destruct()
	{
		mysql_close($this->connection);
	}
	
	public function getData(/*$option, */$limit = 10)
	{
		if ($limit <= 0) {
			return null;
		}
		$result = mysql_query("SELECT * FROM rss 
			ORDER BY date ASC
			LIMIT $limit;",
			$this->connection);
		/*
		switch ($option) {
		case 1:
			$result = mysql_query("SELECT * FROM rss 
				ORDER BY date ASC
				LIMIT $limit;",
				$this->connection);
			break;
		case 2:
			$result = mysql_query("SELECT * FROM rss 
				ORDER BY date DESC;
				LIMIT $limit",
				$this->connection);
			break;
		default:
			return null;
		}
		*/
		if (!$result || mysql_num_rows($result) <= 0) {
			return null;
		}
		return $result;
	}
	
	public function addEntry($title, $link, $description)
	{
		$result = mysql_query("INSERT INTO rss (title, link, description, date) 
			VALUES ('$title', '$link', '$description', NOW())", 
			$this->connection);
		return $result;
	}
	
	public function changeEntry($oldTitle, $oldLink, $oldDescription, 
		$newTitle, $newLink, $newDescription)
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
	
	public function deleteEntry($title, $link, $description)
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
