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
		$this->myXML = simplexml_load_file($rssAtom);
		if(!strcmp($this->myXML->feed['xmlns'],
			'http://www.w3.org/2005/Atom')) 
		{
			return -1;
		}
		foreach($this->myXML->entry as $entry) {
			$this->titles[$i] = $entry->title;
			$this->links[$i] = $entry->link['href'];
			$this->descriptions[$i] = $entry->summary;
			$i++;
		}
	}

	public function getTitles() 
	{
		return $this->titles;
	}
	
	public function getLinks()
	{
		return $this->links];
	}

	public function getDesc()
	{
		return $this->descriptions;
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
		$db->getData();
	}
}
?>
