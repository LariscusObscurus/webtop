<?php
class MyFeed
{
	var $myXML;
	var $titles;
	var $links;

	function__construct($rssAtom)
	{
		$this->myXML = smplexml_load_file($rssAtom);
	}

	public function parse()
	{
		$i = 0;
		foreach($this->myXML as $entry){
		$this->titles[$i] = $entry->title;
		$this->links[$i] = $entry->link['href'];
		$i++;
		}
	}

	public function getTitles() 
	{
		return $this->titles;
	}
	
	public function getLinks()
	{
		return $this->links;
	}

	public function setTitles($title, $i) 
	{
		$this->titles[$i] = $title;
	}
	
	public function setLinks($link, $i)
	{
		$this->links[$i] = $link;
	}
}
?>
