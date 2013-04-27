<?php
class MyFeed
{
	private $myXML;
	private $titles;
	private $links;
	private $descriptions;

	public function parse($rssAtom)
	{
		$i = 0;
		$this->myXML = smplexml_load_file($rssAtom);
		foreach($this->myXML as $entry) {
			$this->titles[$i] = $entry->title;
			$this->links[$i] = $entry->link['href'];
			$this->descriptions[$i] = $entry->summary;
			$i++;
		}
	}

	public function getTitles($i) 
	{
		return $this->titles[$i];
	}
	
	public function getLinks($i)
	{
		return $this->links[$i];
	}

	public function getDesc($i)
	{
		return $this->descriptions[$i];
	}

	public function setTitles($title, $i) 
	{
		$this->titles[$i] = $title;
	}
	
	public function setLinks($link, $i)
	{
		$this->links[$i] = $link;
	}

	public function setDesc($desc, $i)
	{
		$this->descriptions[$i] = $desc;
	}

	public function createRss()
	{
		require("dbHandler.php");
		$db = new DbHandler();
		$db->getData
	}
}
?>
